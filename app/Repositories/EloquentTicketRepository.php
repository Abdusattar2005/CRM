<?php
namespace App\Repositories;

use App\Models\Ticket;

class EloquentTicketRepository implements TicketRepositoryInterface
{
    public function create(array $data): Ticket
    {
        return Ticket::create($data);
    }

    public function find(int $id): ?Ticket
    {
        return Ticket::with('customer')->find($id);
    }

    public function list(array $filters, int $perPage = 15)
    {
        $q = Ticket::with('customer');
        if (!empty($filters['status'])) {
            $q->where('status', $filters['status']);
        }
        if (!empty($filters['from'])) {
            $q->whereDate('created_at', '>=', $filters['from']);
        }
        if (!empty($filters['to'])) {
            $q->whereDate('created_at', '<=', $filters['to']);
        }
        return $q->orderBy('created_at','desc')->paginate($perPage);
    }
}
