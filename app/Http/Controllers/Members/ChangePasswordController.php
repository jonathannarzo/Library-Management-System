<?php

namespace App\Http\Controllers\Members;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChangePasswordController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'user_id' => ['required', 'integer'],
			'password' => ['required', 'string', 'min:6', 'confirmed']
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
			$data = [
				'user' => $user
			];

			return view('members.change-password', $data);
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
			$user->password = Hash::make($data['password']);
			$user->save();

			return redirect()->route('members-list')->with('successMessage', "Member ({$user->name}) successfully changed password");
		}
	}
}
