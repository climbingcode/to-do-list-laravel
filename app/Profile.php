<?php namespace todolist;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model {

	public function profile()
	{
		return $this->belongsTo('todolists\User');
	}

}
