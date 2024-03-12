<?php

namespace App\Http\Controllers;

use App\Models\Workstation;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    public function home()
    {
        $workstations = Workstation::all();
        return view('home')->with('workstations', $workstations);
    }
}
