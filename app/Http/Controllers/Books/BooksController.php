<?php

namespace App\Http\Controllers\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Books\Books;
use DB;

class BooksController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:admin,librarian,member');
    }

	public function booksList()
	{
		$data = [
			'books' => Books::paginate(10)
		];

		return view('books.books-list', $data);
	}
}
