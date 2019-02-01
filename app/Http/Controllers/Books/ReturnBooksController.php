<?php

namespace App\Http\Controllers\Books;

use App\User;
use App\Models\Books\Issued;
use App\Models\Books\Books;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use DB;

class ReturnBooksController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'issued_id' => ['required','integer'],
			'date_returned' => ['required','date_format:Y-m-d'],
		]);
	}

	public function showForm($issuedId)
	{
		$issued = Issued::find($issuedId);

		if (empty($issued))
		{
			abort(404);
		}
		else
		{
			$book = Books::find($issued->book_id);

			if (empty($book))
			{
				abort(404);
			}
			else
			{
				$data = [];
				$data['issued'] = $issued;
				$data['book'] = $book;
				$data['members'] = User::findMany([$issued->member_id])->toArray();

				return view('books.return-book', $data);
			}
		}
	}

	public function return(Request $request)
	{
		$data = $request->all();

		$issued = Issued::find($data['issued_id']);

		if (empty($issued))
		{
			abort(404);
		}
		else
		{
			$book = Books::find($issued->book_id);

			if (empty($book))
			{
				abort(404);
			}
			else
			{
				$this->validator($data)->validate();

				DB::beginTransaction();
				try
				{
					if ($issued->number_of_copies >= $data['number_of_copies'])
					{
						$issued->date_returned = $data['date_returned'];
						$issued->save();
					}

					$book->remaining_copies = $book->remaining_copies + $data['number_of_copies'];
					$book->save();

					DB::commit();
				}
				catch (Exception $e)
				{
					DB::rollBack(); 
				}

				return redirect()->route('issued-books')->with('successMessage', 'Book successfully returned');
			}
		}
	}
}
