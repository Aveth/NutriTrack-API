<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Search extends Model {

	protected $table = 'searches';
    protected $fillable = ['id', 'name', 'count'];
	protected $hidden = ['created_at', 'updated_at'];

}
