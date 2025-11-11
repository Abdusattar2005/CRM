<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Models\Ticket;

class StatisticsController extends Controller
{
    public function index()
    {
        $now = Carbon::now();
        $day = Ticket::where('created_at', '>=', $now->copy()->subDay())->count();
        $week = Ticket::where('created_at', '>=', $now->copy()->subWeek())->count();
        $month = Ticket::where('created_at', '>=', $now->copy()->subMonth())->count();
        return response()->json(['data' => compact('day','week','month')]);
    }
}
