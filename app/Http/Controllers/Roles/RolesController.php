<?php

namespace App\Http\Controllers\Roles;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:admin');
    }

	public function rolesList()
	{
		$data = [
			'roles' => Role::all()
		];

		return view('roles.roles-list', $data);
	}
}
