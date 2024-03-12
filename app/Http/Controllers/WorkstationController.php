<?php

namespace App\Http\Controllers;

use App\Models\Workstation;

class WorkstationController extends Controller
{
    public function index()
    {
        $workstations = Workstation::all();
        return view('home')->with('workstations', $workstations);
    }

    public function show(Workstation $workstation)
    {
        return view('workstation')->with('workstation', $workstation);
    }
}
