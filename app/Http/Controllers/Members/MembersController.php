<?php

namespace App\Http\Controllers\Members;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MembersController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:admin,librarian');
    }
    
    public function membersList()
    {
        $data = [
            'members' => User::all()
        ];

        return view('members.members-list', $data);
    }
}
