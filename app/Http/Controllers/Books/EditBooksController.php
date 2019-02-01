<?php

namespace App\Http\Controllers\Books;

use App\Models\Books\Books;
use App\Models\Books\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EditBooksController extends Controller
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

	public function showForm($bookId)
	{
		$book = Books::find($bookId);

		if (empty($book))
		{
			abort(404);
		}
		else
		{
			$categories = Category::all()->toArray();

			$data = [
				'book' => $book,
				'categories' => $categories
			];

			return view('books.edit-book-form', $data);
		}
	}

	public function update(Request $request)
	{
		$data = $request->all();
		$this->validator($data)->validate();

		$book = Books::find($data['book_id']);
		if (empty($book))
		{
			abort(404);
		}
		else
		{
			$addedOrSubtractedCopies = $data['number_of_copies'] - $book->number_of_copies;

			$data['remaining_copies'] += $addedOrSubtractedCopies;

			$book->category_id = $data['category_id'];
			$book->title = $data['title'];
			$book->author = $data['author'];
			$book->publisher = $data['publisher'];
			$book->published_date = $data['published_date'];
			$book->edition = $data['edition'];
			$book->isbn = $data['isbn'];
			$book->price = $data['price'];
			$book->purchasing_date = $data['purchasing_date'];
			$book->number_of_pages = $data['number_of_pages'];
			$book->number_of_copies = $data['number_of_copies'];
			$book->remaining_copies = $data['remaining_copies'];
			$book->shelf = $data['shelf'];

			$book->save();

			return redirect()->route('books-list')->with('successMessage', 'Book successfully updated');
		}
	}
}
