<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Parsedown;
use Symfony\Component\HttpKernel\Client;

class WelcomeController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function result()
    {
        $query = Input::get('query');
        if ($query == null) {
            return view('noquery');
        }
        $client = ClientBuilder::create()->build();
        $params = [
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title', 'text'],
                    ],
                ]
            ]
        ];

        $response = $client->search($params);
        $results = $response['hits']['hits'];
        $took = $response['took'];
        $total = $response['hits']['total'];
        return view('welcome', compact('results', 'took', 'total'));
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
