<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReadXMLController extends Controller
{
    public function index() {
        $xml = XmlParser::load(asset('XML/wiki.xml'));
        $wiki = $xml->parse([
            'title' => ['uses' => 'page.title'],
            'text' => ['page.text']
        ]);

        dd($wiki);
    }
}
