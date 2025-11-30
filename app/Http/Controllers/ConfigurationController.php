<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    public function championship()
    {
        return view('championship.configuration.championship');
    }
    public function teams()
    {
        return view('championship.configuration.teams');
    }

    public function series()
    {
        return view('championship.configuration.series');
    }
}
