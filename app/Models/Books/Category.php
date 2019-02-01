<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;
use App\Models\Books\Books;

class Category extends Model
{
	protected $table = 'books_category';

	protected $fillable = [
		'category',
		'description'
	];

	public function books()
	{
		return $this->hasMany(Books::class, 'id', 'category_id');
	}
}
