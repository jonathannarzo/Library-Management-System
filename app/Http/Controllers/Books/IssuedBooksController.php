<?php

namespace App\Http\Controllers\Books;

use App\Models\Books\Issued;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class IssuedBooksController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	public function issuedList()
	{
		$issued = Issued::paginate(10);
		$member_ids = array_column($issued->toArray()['data'], 'member_id');
		$members = User::findMany($member_ids)->toArray();
		
		$data = [
			'booksIssued' => $issued,
			'members' => array_column($members, 'name', 'id')
		];

		return view('books.issued-list', $data);
	}
}
