<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function teste()
    {
        return response()->json(['teste' => 'teste']);
    }
}
