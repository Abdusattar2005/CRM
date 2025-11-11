<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Resources\TicketResource;
use App\Services\TicketService;

class TicketController extends Controller
{
    private TicketService $service;

    public function __construct(TicketService $service)
    {
        $this->service = $service;
    }

    public function store(StoreTicketRequest $request)
    {
        $ticket = $this->service->createTicket($request->validated());
        return (new TicketResource($ticket))->response()->setStatusCode(201);
    }

    public function index()
    {
        return response()->json(['message' => 'not implemented in skeleton']);
    }

    public function show($id)
    {
        return response()->json(['message' => 'not implemented in skeleton']);
    }

    public function updateStatus($id)
    {
        return response()->json(['message' => 'not implemented in skeleton']);
    }
}
