<?php

namespace App\Http\Controllers\Members;

use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;

class AddMembersController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
			'password' => ['required', 'string', 'min:6', 'confirmed'],
			'role' => ['required_without_all']
		]);
	}

	public function showForm()
	{
		$roles = Role::all()->toArray();

		$data = [
			'roles' => $roles
		];

		return view('members.add-member', $data);
	}

	public function add(Request $request)
	{
		$data = $request->all();
		$this->validator($data)->validate();

		DB::beginTransaction();
		try
		{
			$user = User::create([
				'name'     => $data['name'],
				'email'    => $data['email'],
				'password' => Hash::make($data['password']),
			]);

			foreach ($data['role'] as $id)
			{
				DB::insert('INSERT INTO role_user (role_id, user_id) values (?, ?)', [$id, $user->id]);
			}

			DB::commit();
		}
		catch (Exception $e)
		{
			DB::rollBack();	
		}

		return redirect()->route('members-list')->with('successMessage', 'Member successfully added');
	}
}
