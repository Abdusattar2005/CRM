<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTicketRequest extends FormRequest
{
    public function authorize() { return true; }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => ['required','string','max:16','regex:/^\\+?[1-9]\d{1,14}$/'],
            'subject' => 'required|string|max:255',
            'body' => 'required|string',
            'files.*' => 'file|max:5120',
        ];
    }
}
