<?php

namespace App\Http\Controllers\Books;

use App\Models\Books\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class EditCategoryController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}
	
	protected function validator(array $data)
	{
		return Validator::make($data, [
			'category_id' => ['required', 'integer'],
			'category' => ['required'],
			'description' => ['required']
		]);
	}

	public function showForm($categoryId)
	{
		$category = Category::find($categoryId);

		if (empty($category))
		{
			abort(404);
		}
		else
		{
			$data = [];
			$data['category'] = $category;

			return view('books.edit-category', $data);
		}
	}

	public function update(Request $request)
	{
		$data = $request->all();
		$this->validator($data)->validate();

		$category = Category::find($data['category_id']);
		if (empty($category))
		{
			abort(404);
		}
		else
		{
			$category->category = $data['category'];
			$category->description = $data['description'];
			$category->save();

			return redirect()->back()->with('successMessage', 'Category successfully updated');
		}
	}
}
