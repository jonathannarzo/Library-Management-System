<?php

namespace App\Http\Controllers\Books;

use App\User;
use App\Models\Books\Books;
use App\Models\Books\Issued;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class BorrowBooksController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'book_id' => ['required', 'integer'],
			'member_id' => ['required', 'integer'],
			'number_of_copies' => ['required', 'integer','min:1'],
			'date_issued' => ['required','date_format:Y-m-d'],
			'due_date' => ['required','date_format:Y-m-d','after_or_equal:date_issued'],
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
			$data = [];
			$data['book'] = $book;
			$data['members'] = User::all()->toArray();

			return view('books.borrow-book', $data);
		}
	}

	public function add(Request $request)
	{
		$data = $request->all();

		$book = Books::find($data['book_id']);

		if (empty($book))
		{
			abort(404);
		}
		else
		{
			if ($book->remaining_copies >= $data['number_of_copies'])
			{
				$this->validator($data)->validate();

				DB::beginTransaction();
				try
				{
					Issued::create($data);

					$book->remaining_copies = $book->remaining_copies - $data['number_of_copies'];
					$book->save();

					DB::commit();
				}
				catch (Exception $e)
				{
					DB::rollBack();	
				}

				return redirect()->back()->with('successMessage', 'Book successfully issued');
			}
			else
			{
				return redirect()->route('borrow-form')->with('errorMessage', 'The number of books left is not enough');
			}
		}
	}
}
