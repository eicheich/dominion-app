<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        return view('client.landingpage');
    }

    public function show($id)
    {
        return view('client.product.show');
    }
}