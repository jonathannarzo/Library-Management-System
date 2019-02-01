<?php

namespace App\Http\Controllers;

use App\Models\Books\Books;
use App\Models\Books\Issued;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class DashboardController extends Controller
{
	public function __construct()
	{
		$this->middleware('roles:admin,librarian');
	}

	public function index()
	{
		$data = [];
		$data['new_books'] = $this->getNewBooksCount();
		$data['issued_books'] = $this->getIssuedBooks();
		$data['today_due_books'] = $this->getTodayDueBooks();
		$data['due_books'] = $this->getDueBooks();

		return view('dashboard.index', $data);
	}

	private function getNewBooksCount()
	{
		$date = Carbon::today()->subDays(30);
		$date = date($date);
		$count = Books::where('created_at', '>=', $date)->count();
		return $count;
	}

	private function getIssuedBooks()
	{
		$date = Carbon::today();
		$date = date($date);
		$count = Issued::where('date_returned', null)->where('due_date', '>', $date)->count();
		return $count;
	}

	private function getTodayDueBooks()
	{
		$date = Carbon::today();
		$date = date($date);
		$count = Issued::where('due_date', $date)->count();
		return $count;
	}

	private function getDueBooks()
	{
		$date = Carbon::today();
		$date = date($date);
		$count = Issued::where('due_date', '<', $date)->count();
		return $count;
	}

	public function getIssuedPerDay()
	{
		$db_raw_total = DB::raw('COUNT(id) AS total');
		$result = Issued::groupBy('date_issued')->select('date_issued', $db_raw_total)->get();
		
		$dates = [];
		$total = [];

		foreach ($result as $item)
		{
			$dates[] = $item->date_issued;
			$total[] = $item->total;
		}

		$data = [
			'labels' => $dates,
			'datas' => $total,
			'max' => max($total)
		];

		return json_encode($data);
	}

	public function getIssuedPerMonth()
	{
		$db_raw_month = DB::raw('DATE_FORMAT(date_issued, "%Y-%m") AS month');
		$db_raw_total = DB::raw('COUNT(id) AS total');
		$result = Issued::groupBy('month')->select($db_raw_month, $db_raw_total)->get();

		$dates = [];
		$total = [];

		foreach ($result as $item)
		{
			$dates[] = $item->month;
			$total[] = $item->total;
		}

		$data = [
			'labels' => $dates,
			'datas' => $total,
			'max' => max($total)
		];

		return json_encode($data);
	}
}
