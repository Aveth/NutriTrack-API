<?php namespace App;

use App\Search;
use App\Nutrients;

class APIResource {
     
    private $_configPath = 'services.usda.';
    
    protected $endpoint;
    
    public static function resource($endpoint) {
        return new APIResource($endpoint);
    }
    
    public function __construct($endpoint) {
        $this->endpoint = $endpoint;
    }
    
    public function get($param) {
        $method = $this->endpoint;
        return $this->$method($param);
    }
    
    public function search($param) {
        $contents = @file_get_contents($this->_getURL('search', ['q' => $param]));
        if ( $contents ) {
            $json = json_decode($contents);
            $json = $json->list->item;
            $this->_batchReassign($json, 'ndbno', 'id');
            usort($json, function($a, $b) use($param) {
               return $this->_sort($a, $b, $param);
            });
            return $json;
        }
        return false;
    }
    
    public function details($param) {
        $nutrients = Nutrient::where('is_active', true)->lists('name', 'id');
        $contents = @file_get_contents($this->_getURL('reports', ['ndbno' => $param]));
        if ( $contents ) {
            $json = json_decode($contents);
            $json = $json->report->food;
            $this->_reassign($json, 'ndbno', 'id');
            $this->_batchReassign($json->nutrients, 'nutrient_id', 'id');
            print_r($json);
            $json->nutrients = array_filter($json->nutrients, function(&$obj) use($nutrients) {
                if ( isset($nutrients[$obj->id]) ) {
                    $obj->name = $nutrients[$obj->id];
                    return true;
                }
                return false;
            });
            $json->nutrients = array_values($json->nutrients);
            $this->_prepareDetails($json);
            return $json;
        }
        return false;
    }
    
    private function _prepareDetails(&$details) {
        $nutrients = [];
        $measures = [];
        $index = 0;
        $measures[] = (object)[
            'index' => $index,
            'name' => '100 g',
            'value' => 100
        ];
        foreach ( $details->nutrients[0]->measures as $measure ) {
            $measures[] = (object)[
                'index' => ++$index,
                'name' => $measure->label,
                'value' => $measure->eqv,
            ];
        }
        foreach ( $details->nutrients as $nutrient ) {
            $nutrients[] = (object)[
                'id' => $nutrient->id,
                'name' => $nutrient->name,
                'unit' => $nutrient->unit,
                'value' => $nutrient->value
            ];
        }
        $details->nutrients = $nutrients;
        $details->measures = $measures;
    }
    
    private function _sort($a, $b, $query) {
        $diff = 0;
        $diff += $this->_sortByClicks($a, $b);
        $diff += $this->_sortByRelevance($a, $b, $query);
        $diff += $this->_sortByLength($a, $b);
        return $diff;
    }
    
    private function _sortByLength($a, $b) {
        $lenA = strlen($a->name);
        $lenB = strlen($b->name);
        return $lenA - $lenB;
    }
    
    private function _sortByClicks($a, $b) {
        $searchA = Search::find($a->id);
        $searchB = Search::find($b->id);
        $countA = $searchA ? $searchA->count : 0;
        $countB = $searchB ? $searchB->count : 0;
        return $countB - $countA;
    }
    
    private function _sortByRelevance($a, $b, $query) {
        $query = strtolower($query);
        $posA = strpos(strtolower($a->name), $query);
        $posB = strpos(strtolower($b->name), $query);
        if ( $posA === false && $posB === false ) {
            return 0;
        } else if ( $posA === false ) {
            return 1;
        } else if ( $posB === false ) {
            return -1;
        } else {
            return $posA - $posB;
        }
    }
    
    private function _batchReassign(&$array, $from, $to) {
        foreach ( $array as &$obj ) {
            $this->_reassign($obj, $from, $to);
        }
    }
    
    private function _reassign(&$obj, $from, $to) {
        if ( isset($obj->$from) ) {
            $obj->$to = $obj->$from;
            unset($obj->$from);
        }
    }
    
    private function _configItem($key) {
        return \Config::get($this->_configPath.$key);
    }
    
    protected function _getURL($endpoint, $params = []) {
        $params['api_key'] = $this->_configItem('api_key');
        $params['format'] = 'json';
        $params['max'] = 500;
        return $this->_configItem('base_url').$endpoint.'/?'.http_build_query($params);
    }
    
}