<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Parsedown;
use Symfony\Component\HttpKernel\Client;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function result(Request $request)
    {
        if ($request->input('query') == null) {
            return view('noquery');
        }
        $client = ClientBuilder::create()->build();

        $params = [
            'index' => 'nfl',
            'size' => 5,
            'body' => [
                'query' => 
            ]
        ];

        $params = [
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $request->input('query'),
                        'fields' => ['title', 'text'],
                    ],
                ]
            ]
        ];

        $response = $client->search($params);
        $results = $response['hits']['hits'];
        return view('welcome', compact('results'));
    }

    public function article($id)
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'index' => 'wikipedia',
            'type' => 'wikipedia pagina',
            'id' => $id
        ];

        $article = $client->get($params);
        $parsedown = new Parsedown();
        $title = $parsedown->text($article['_source']['title']);
        $text = $parsedown->text($article['_source']['text']);
        return view('article', compact('title', 'text'));
    }
}
