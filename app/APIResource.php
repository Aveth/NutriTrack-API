<?php namespace App;

use App\Models\Search;
use App\Models\Nutrient;

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
    
    public function search($query, $category = null) {
        $params = ['q' => $query];
        if ( isset($category) ) {
            $params['fg'] = $category;
        }
        $contents = @file_get_contents($this->_getURL('search', $params));
        if ( $contents ) {
            $json = json_decode($contents);
            $json = $json->list->item;
            $this->_batchReassign($json, 'ndbno', 'id');
            $this->_batchReassign($json, 'group', 'category');
            usort($json, function($a, $b) use($query) {
               return $this->_sort($a, $b, $query);
            });

            $this->_unsetExcept($json, array('name', 'id', 'category'));

            return $json;
        }
        return false;
    }

    public function category($category) {
        return $this->search('', $category);
    }
    
    public function details($param) {
        $nutrients = Nutrient::where('is_active', true)->lists('name', 'id');
        $contents = @file_get_contents($this->_getURL('reports', ['ndbno' => $param]));
        if ( $contents ) {
            $json = json_decode($contents);
            $json = $json->report->food;
            $this->_reassign($json, 'ndbno', 'id');
            $this->_reassign($json, 'fg', 'category');
            $this->_batchReassign($json->nutrients, 'nutrient_id', 'id');
            $json->nutrients = array_filter($json->nutrients, function(&$obj) use($nutrients) {
                if ( isset($nutrients[$obj->id]) ) {
                    $obj->name = $nutrients[$obj->id];
                    return true;
                }
                return false;
            });
            $json->nutrients = array_values($json->nutrients);
            $this->_prepareDetails($json);

            $this->_unsetExcept($json, array('name', 'id', 'category', 'measures', 'nutrients'));

            return $json;
        }
        return false;
    }

    private function _unsetExcept(&$obj, $props = array()) {
        foreach ( $obj as $key => $value ) {
            if ( !in_array($key, $props) ) {
                unset($obj->$key);
            }
        }
    }
    
    private function _prepareDetails(&$details) {
        $nutrients = [];
        $measures = [];
        $index = 0;
        foreach ( $details->nutrients[0]->measures as $measure ) {
            $measures[] = (object)[
                'index' => $index++,
                'name' => $measure->qty == 1.0 ? $measure->label : $measure->qty.' '.$measure->label,
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
    
    private function _sort($a, $b, $query = null) {
        $diff = 0;
        $diff += $this->_sortByClicks($a, $b);
        $diff += $this->_sortByLength($a, $b);
        if ( isset($query) && strlen($query) > 0 ) {
            $diff += $this->_sortByRelevance($a, $b, $query);
        }
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
        $params['type'] = 'f';
        return $this->_configItem('base_url').$endpoint.'/?'.http_build_query($params);
    }
    
}