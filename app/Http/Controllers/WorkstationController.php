<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkstationController extends Controller
{
    public function show(string $id)
    {
        return view('workstation.show', ['id' => $id]);
    }
}
