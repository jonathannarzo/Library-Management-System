<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('category_id');
			$table->text('title');
			$table->text('author');
			$table->text('publisher');
			$table->date('published_date');
			$table->string('edition', 128);
			$table->string('dewey', 64)->nullable();
			$table->string('isbn', 64)->nullable();
			$table->decimal('price', 10, 2);
			$table->date('purchasing_date');
			$table->integer('number_of_pages')->nullable();
			$table->integer('number_of_copies');
			$table->integer('remaining_copies');
			$table->string('shelf', 128);
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('books');
	}
}
