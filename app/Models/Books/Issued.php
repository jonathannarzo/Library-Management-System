<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;
use App\Models\Books\Books;
use App\User;

class Issued extends Model
{
	protected $table = 'books_issued';

	protected $fillable = [
		'book_id',
		'member_id',
		'number_of_copies',
		'date_issued',
		'due_date',
		'date_returned'
	];

	protected $with = ['books'];

	public function books()
	{
		return $this->hasOne(Books::class, 'id', 'book_id');
	}

}
