<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTicketStatusRequest extends FormRequest
{
    public function authorize() { return auth()->check() && auth()->user()->hasAnyRole(['manager','admin']); }

    public function rules()
    {
        return [ 'status' => 'required|in:new,in_progress,processed' ];
    }
}
