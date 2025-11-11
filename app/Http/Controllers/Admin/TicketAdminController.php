<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketAdminController extends Controller
{
    public function index(Request $request)
    {
        $filters = $request->only(['status','from','to','email','phone']);
        $tickets = Ticket::with('customer')
            ->when($filters['status'] ?? false, fn($q,$v)=>$q->where('status',$v))
            ->when($filters['from'] ?? false, fn($q,$v)=>$q->whereDate('created_at','>=',$v))
            ->when($filters['to'] ?? false, fn($q,$v)=>$q->whereDate('created_at','<=',$v))
            ->orderBy('created_at','desc')
            ->paginate(15);

        return view('admin.tickets.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        $ticket->load('customer');
        return view('admin.tickets.show', compact('ticket'));
    }

    public function updateStatus(Request $request, Ticket $ticket)
    {
        $request->validate(['status'=>'required|in:new,in_progress,processed']);
        $ticket->status = $request->input('status');
        if ($ticket->status === 'processed') {
            $ticket->manager_replied_at = now();
        }
        $ticket->save();
        return back()->with('success','Status updated');
    }
}
