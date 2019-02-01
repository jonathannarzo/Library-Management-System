<?php

namespace App\Http\Controllers\Books;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Books\Books;
use App\Models\Books\Category;

class AddBooksController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'category_id' => ['required', 'integer'],
			'title' => ['required'],
			'author' => ['required'],
			'publisher' => ['required'],
			'published_date' => ['required','date_format:Y-m-d'],
			'edition' => ['required'],
			'isbn' => ['required', 'integer'],
			'price' => ['required', 'numeric'],
			'purchasing_date' => ['required', 'date_format:Y-m-d'],
			'number_of_pages' => ['required', 'integer'],
			'number_of_copies' => ['required', 'integer'],
			'remaining_copies' => ['required', 'integer'],
			'shelf' => ['required'],
		]);
	}

	public function showForm()
	{
		$categories = Category::all()->toArray();

		$data = [
			'categories' => $categories
		];

		return view('books.add-form', $data);
	}

	public function add(Request $request)
	{
		$data = $request->all();
		$data['remaining_copies'] = $data['number_of_copies'];

		$this->validator($data)->validate();

		Books::create($data);

		return redirect()->route('books-list')->with('successMessage', 'Book successfully saved');
	}
}
