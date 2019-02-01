<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBooksIssuedTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('books_issued', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('member_id');
			$table->integer('book_id');
			$table->integer('number_of_copies');
			$table->date('date_issued');
			$table->date('due_date');
			$table->date('date_returned')->nullable();
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
		Schema::dropIfExists('books_issued');
	}
}
