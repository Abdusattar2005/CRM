<?php
namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'customer' => [
                'id' => $this->customer->id,
                'name' => $this->customer->name,
                'phone' => $this->customer->phone,
                'email' => $this->customer->email,
            ],
            'subject' => $this->subject,
            'body' => $this->body,
            'status' => $this->status,
            'manager_replied_at' => $this->manager_replied_at,
            'files' => $this->getMedia('files')->map(fn($m) => $m->getFullUrl()),
            'created_at' => $this->created_at,
        ];
    }
}
