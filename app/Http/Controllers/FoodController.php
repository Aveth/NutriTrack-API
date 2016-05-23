<?php namespace App\Http\Controllers;

use Response;
use App\Models\Search;
use App\Models\Nutrient;
use App\Models\Category;
use App\APIResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FoodController extends Controller {
    
    public function search($query) {
        return $this->_preparedSearchResults('search', $query);
    }

    public function category($category) {
        return $this->_preparedSearchResults('category', $category);
    }
    
    public function nutrients() {
        return $this->response(Nutrient::getActive());
    }

    public function categories() {
        return $this->response(Category::get());
    }

    public function details($ids) {
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

    private function _preparedSearchResults($resourceType, $query) {
        $results = APIResource::resource($resourceType)->get($query);
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