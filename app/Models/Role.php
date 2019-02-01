<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $tale = 'roles';

    protected $fillable = [
        'name',
        'description'
    ];

	public function users()
	{
		return $this->belongsToMany(User::class, 'role_user');
	}
}