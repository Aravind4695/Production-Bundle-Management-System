<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

class BundleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       
        return [

            'bundle_no' => [
                'required',
                'string',
                'max:50',
                'unique:production_bundles,bundle_no,' . $this->route('bundle')
            ],

            'buyer_id' => [
                'required',
                'exists:buyers,id'
            ],

            'style_id' => [
                'required',
                'exists:styles,id'
            ],

            'line_id' => [
                'required',
                'exists:sewing_lines,id'
            ],

            'color' => [
                'required',
                'string',
                'max:100'
            ],

            'size' => [
                'required',
                'string',
                'max:50'
            ],

            'quantity' => [
                'required',
                'integer',
                'min:1'
            ],

            'completed_qty' => [
                'required',
                'integer',
                'min:0'
            ],

            'rejected_qty' => [
                'required',
                'integer',
                'min:0'
            ],

            'operator_name' => [
                'required',
                'string',
                'max:100'
            ],

            'production_date' => [
                'required',
                'date',
                'before_or_equal:today'
            ],

            'remarks' => [
                'nullable',
                'string'
            ]

        ];
    }

    public function messages(): array
    {
        return [

            'bundle_no.required' => 'Bundle Number is required.',

            'bundle_no.unique' => 'Bundle Number already exists.',

            'buyer_id.required' => 'Please select a buyer.',

            'style_id.required' => 'Please select a style.',

            'line_id.required' => 'Please select a sewing line.',

            'quantity.min' => 'Quantity must be greater than zero.',

            'production_date.before_or_equal' =>
                'Production date cannot be a future date.'

        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {

            $quantity = $this->quantity;

            $completed = $this->completed_qty;

            $rejected = $this->rejected_qty;

            if ($completed > $quantity) {

                $validator->errors()->add(
                    'completed_qty',
                    'Completed Quantity cannot exceed Quantity.'
                );

            }

            if ($rejected > $quantity) {

                $validator->errors()->add(
                    'rejected_qty',
                    'Rejected Quantity cannot exceed Quantity.'
                );

            }

            if (($completed + $rejected) > $quantity) {

                $validator->errors()->add(
                    'completed_qty',
                    'Completed + Rejected cannot exceed Quantity.'
                );

            }

        });
    }
}
