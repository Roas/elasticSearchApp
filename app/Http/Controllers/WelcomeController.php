<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function result(Request $request) {
        return view('welcome');
    }

    public function test()
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'my_index',
            'type' => 'my_type',
            'id' => 'my_id',
            'body' => ['testField' => 'abc']
        ];

        $response = $client->index($params);
        dd($response);
    }

    public function gettest($id) {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'wikipedia',
            'type' => 'wikipedia pagina',
            'id' => $id
        ];

        $response = $client->get($params);
        dd($response);
    }

    public function deletetest() {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => '1',
            'type' => 'wikipedia pagina',
            'id' => '1'
        ];

        $response = $client->delete($params);
        dd($response);
    }
}
