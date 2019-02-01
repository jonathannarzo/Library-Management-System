<?php

namespace App\Http\Controllers\Roles;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AddRolesController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin');
	}

	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required'],
			'description' => ['required']
		]);
	}

	public function showForm()
	{
		return view('roles.add-roles');
	}

	public function add(Request $request)
	{
		$data = $request->all();

		$this->validator($data)->validate();

		Role::create($data);

		return redirect()->route('roles-list')->with('successMessage', 'Role successfully added');
	}
}
