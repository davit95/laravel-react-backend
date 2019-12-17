<?php

namespace App\Http\Controllers;

use App\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function uploadImage(Request $request, $avatar = '')
    {
        if ($image = $request->file('file')) {
            $avatar = Str::random(20).".".$image->getClientOriginalExtension();
            $image->move(public_path().'/images/profile', $avatar);
        }
        return response()->json(compact('avatar'));
    }
}
