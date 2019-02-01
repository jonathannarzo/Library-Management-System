<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return redirect('login');
});

Auth::routes();

Route::prefix('dashboard')->group(function () {
	
	Route::get('/', 'DashboardController@index')->name('dashboard');
	Route::get('/issued-per-day', 'DashboardController@getIssuedPerDay')->name('issued-per-day');
	Route::get('/issued-per-month', 'DashboardController@getIssuedPerMonth')->name('issued-per-month');

});

Route::prefix('books')->group(function () {

	Route::get('/list', 'Books\BooksController@booksList')->name('books-list');
	Route::get('/add-form', 'Books\AddBooksController@showForm')->name('add-books-form');
	Route::post('/add-book', 'Books\AddBooksController@add')->name('add-books');

	Route::get('/edit-book/{bookId}', 'Books\EditBooksController@showForm')->name('edit-book');
	Route::put('/update-book', 'Books\EditBooksController@update')->name('update-book');

	Route::get('/borrow-form/{bookId}', 'Books\BorrowBooksController@showForm')->name('borrow-form');
	Route::post('/borrow', 'Books\BorrowBooksController@add')->name('borrow-books');
	
	Route::get('/issued', 'Books\IssuedBooksController@issuedList')->name('issued-books');

	Route::get('/return/{issuedId}', 'Books\ReturnBooksController@showForm')->name('return-books-form');
	Route::post('/return-books', 'Books\ReturnBooksController@return')->name('return-books');
	
	Route::get('/category', 'Books\CategoryController@categoryList')->name('book-category');
	Route::get('/category-form', 'Books\AddCategoryController@showForm')->name('add-book-category-form');
	Route::post('/add-category', 'Books\AddCategoryController@add')->name('add-books-category');

	Route::get('/edit-category/{categoryId}', 'Books\EditCategoryController@showForm')->name('edit-book-category');
	Route::put('/update-category', 'Books\EditCategoryController@update')->name('update-book-category');

});

Route::prefix('members')->group(function () {

	Route::get('/list', 'Members\MembersController@membersList')->name('members-list');
	Route::get('/add-form', 'Members\AddMembersController@showForm')->name('add-members-form');
	Route::post('/add-member', 'Members\AddMembersController@add')->name('add-member');

	Route::get('/edit-form/{userId}', 'Members\EditMembersController@showForm')->name('edit-member-form');
	Route::put('/update-member', 'Members\EditMembersController@update')->name('update-member');

	Route::get('/change-password/{userId}', 'Members\ChangePasswordController@showForm')->name('edit-password-form');
	Route::put('/change-password', 'Members\ChangePasswordController@update')->name('change-password');

});

Route::prefix('roles')->group(function () {

	Route::get('/list', 'Roles\RolesController@rolesList')->name('roles-list');
	Route::get('/add-form', 'Roles\AddRolesController@showForm')->name('add-roles-form');
	Route::post('/add-role', 'Roles\AddRolesController@add')->name('add-role');

});
