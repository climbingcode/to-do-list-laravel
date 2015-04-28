<?php namespace todolist;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todolist extends Model {

	use SoftDeletes;

	// RELATIONSHIPS 
	public function tasks() 
	{
		return $this->hasMany('todolist\Task')->orderBy('order');
	}

	public function categories() 
	{
		return $this->belongsToMany('todolists\Category')->withTimestamps();
	}

	// STRONG PARAMS 
	protected $fillable = ['name', 'description'];


	protected $dates = ['deleted_at'];

	// VALIDATIONS
	private $rules = [
		'name' => 'required',
		'description' => 'required'
	];

	

}
