<?php

namespace App\Http\Controllers\Members;

use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class EditMembersController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'name' => ['required', 'string', 'max:255'],
			'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$data['user_id'].''],
			'role' => ['required_without_all']
		]);
	}

	public function showForm($userId)
	{
		$user = User::find($userId);

		if (empty($user))
		{
			abort(404);
		}
		else
		{
			$roles = Role::all()->toArray();

			$data = [
				'user' => $user,
				'roles' => $roles
			];

			return view('members.edit-member', $data);
		}
	}

	public function update(Request $request)
	{
		$data = $request->all();
		$this->validator($data)->validate();

		$user = User::find($data['user_id']);
		if (empty($user))
		{
			abort(404);
		}
		else
		{
			DB::beginTransaction();
			try
			{
				$user->name = $data['name'];
				$user->email =  $data['email'];
				$user->save();

				DB::delete('DELETE FROM role_user WHERE user_id=?', [$user->id]);

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

			return redirect()->route('members-list')->with('successMessage', 'Member successfully updated');
		}
	}
}
