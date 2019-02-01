<?php

namespace App\Http\Controllers\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Books\Category;
use Illuminate\Support\Facades\Validator;

class AddCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'category' => ['required'],
			'description' => ['required']
		]);
	}

	public function showForm()
	{
		return view('books.add-category');
	}

	public function add(Request $request)
	{
		$data = $request->all();

		$this->validator($data)->validate();

		Category::create($data);

		return redirect()->route('book-category')->with('successMessage', 'Category successfully added');
	}
}
