<?php namespace todolist;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	protected $fillable = [];

	public function todolists() 
	{
		return $this->belongsToMany('todolists\Todolist')->withTimestamps();
	}

}
