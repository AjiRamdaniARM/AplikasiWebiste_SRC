<?php

namespace App\Http\Controllers;

use App\Models\Vourcher;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class voucherController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'code' => 'required|string|max:255|min:1',
                'diskon' => 'required|integer|min:1|max:100',
                'valid_from' => 'required|date_format:Y-m-d',
                'valid_until' => 'required|date_format:Y-m-d',
            ]);
            Vourcher::create($validatedData);

            $response = [
                'message' => 'Voucher created successfully!',
                'data' => $validatedData,
            ];

            $delay = 2;
            $redirectUrl = route('dashboard');

            return response()
                ->redirectTo($redirectUrl)
                ->with('success', $validatedData)
                ->withDelay($delay * 1000);

        } catch (ValidationException $e) {
            return response([
                'message' => 'Validation failed.',
                'errors' => $e->validator->errors()->toArray(),
            ], 400); // Bad request status code
        }
    }
}
