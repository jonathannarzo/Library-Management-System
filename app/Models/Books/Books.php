<?php

namespace App\Models\Books;

use Illuminate\Database\Eloquent\Model;
use App\Models\Books\Category;

class Books extends Model
{
	protected $table = 'books';

	protected $fillable = [
		'category_id',
		'title',
		'author',
		'publisher',
		'published_date',
		'edition',
		'isbn',
		'price',
		'purchasing_date',
		'number_of_pages',
		'number_of_copies',
		'remaining_copies',
		'shelf'
	];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
