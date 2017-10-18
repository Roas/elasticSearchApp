<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReadXMLController extends Controller
{
    public function index()
    {
        $xml = simplexml_load_file("../XML/littlewiki.xml");

        dd($xml);
    }
}
