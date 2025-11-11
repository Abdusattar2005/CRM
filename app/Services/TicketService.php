<?php
namespace App\Services;

use App\Repositories\TicketRepositoryInterface;
use App\Models\Customer;
use Carbon\Carbon;

class TicketService
{
    private TicketRepositoryInterface $repo;

    public function __construct(TicketRepositoryInterface $repo)
    {
        $this->repo = $repo;
    }

    public function createTicket(array $data)
    {
        $customer = Customer::firstOrCreate(
            ['phone' => $data['phone']],
            ['name' => $data['name'], 'email' => $data['email'] ?? null]
        );

        $since = Carbon::now()->subDay();
        $exists = $customer->tickets()->where('created_at','>=',$since)->exists();
        if ($exists) {
            throw new \Exception('One ticket per 24 hours is allowed for this phone/email.');
        }

        $ticket = $this->repo->create([
            'customer_id' => $customer->id,
            'subject' => $data['subject'],
            'body' => $data['body'],
            'status' => 'new'
        ]);

        if (!empty($data['files']) && is_array($data['files'])) {
            foreach ($data['files'] as $file) {
                try {
                    $ticket->addMedia($file->getRealPath())->usingFileName($file->getClientOriginalName())->toMediaCollection('files');
                } catch (\Exception $e) {
                    // ignore file attach errors in skeleton
                }
            }
        }

        return $ticket->fresh('customer');
    }
}
