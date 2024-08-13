<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class UtilitiesController extends Controller
{
    public function upload(Request $request)
    {
        try {
            if ($request->hasFile('path')) {
                $file = $request->file('path');
                $fileName = uniqid().time().'.'.$file->getClientOriginalExtension();
                $file->move('tmp/uploads/', $fileName);

                return response()->json($fileName);
            }

            return '';
        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    public function reverse(Request $request)
    {
        try {
            $payLoad = json_decode($request->getContent());
            File::delete(public_path().'/tmp/uploads/'.$payLoad);

            return response()->json($payLoad);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ]);
        }
    }
}
