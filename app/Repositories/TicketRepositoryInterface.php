<?php
namespace App\Repositories;

use App\Models\Ticket;

interface TicketRepositoryInterface
{
    public function create(array $data): Ticket;
    public function find(int $id): ?Ticket;
    public function list(array $filters, int $perPage = 15);
}
