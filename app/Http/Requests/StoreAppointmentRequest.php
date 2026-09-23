<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules()
    {
        return [
            'service_id' => 'required|exists:services,id',
            'provider_id' => 'required|exists:service_providers,id',
            'booking_date' => 'required|date|after_or_equal:today',
         'booking_time' => 'required|date_format:H:i',
         'status' => 'nullable|in:pending,confirmed,processing,completed,cancelled',
        ];
    }

    public function messages()
    {
        return [
            'service_id.required' => 'Please select a service.',
            'service_id.exists' => 'Selected service does not exist.',

            'provider_id.required' => 'Please select a provider.',
            'provider_id.exists' => 'Selected provider does not exist.',

            'booking_date.required' => 'Please select a booking date.',
            'booking_date.after_or_equal' => 'Booking date cannot be in the past.',

            'booking_time.required' => 'Please select a booking time.',
            'booking_time.date_format' => 'Please enter a valid time.',

            
        ];
    }
}