<?php

namespace App\Http\Controllers\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Books\Category;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('roles:admin,librarian');
    }
    
	public function categoryList()
	{
		$data = [
			'categories' => Category::paginate(10)
		];

		return view('books.category-list', $data);
	}
}
