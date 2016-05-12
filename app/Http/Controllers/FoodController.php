<?php
namespace App\Http\Controllers;

use Response;
use App\Search;
use App\Nutrient;
use App\APIResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller {
    
    private $_configPath = 'services.usda.';

    public function search(Request $request, $query) {
        $results = APIResource::resource('search')->get($query);
        if ( $results ) {
            return $this->response([
                'query' => $query,
                'results' => $results
            ]);
        }
        return $this->errorResponse([
            $this->getError('err_no_results', 'No results found for the search parameter')
        ], 404);
    }
    
    public function nutrients() {
        return $this->response(Nutrient::select('id', 'name', 'unit')->where('is_active', true)->get());
    }
    
    public function details(Request $request, $ids) {
        $ids = explode(',', $ids);
        $response = [];
        foreach ( $ids as $id ) {
            $result = APIResource::resource('details')->get($id);
            if ( $result ) {
                $this->_addNutrients($result);
                $this->_addSearch($result);
                $response[] = $result;
            }
        }
        return $this->response($response);
    }
    
    private function _addSearch($food) {
        $search = Search::find($food->id);
        if ( !$search ) {
            $search = new Search([
                'id' => $food->id,
                'name' => $food->name,
                'count' => 0
            ]);
        }
        $search->count++;
        $search->save();
    }
    
    private function _addNutrients($food) {
        foreach ( $food->nutrients as $item ) {
            $nutrient = Nutrient::find($item->id);
            if ( !$nutrient ) {
                $nutrient = Nutrient::create([
                    'id' => $item->id,
                    'name' => $item->name,
                    'unit' => $item->unit 
                ]);
            }
        }
    }
    
}