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
        foreach($results as $key => $result) {
            $results[$key]['tags'] = $this->tag_contents($results[$key]["_source"]["text"], "[[Categorie:", "]]");
            $results[$key]['tags2'] = $this->tag_contents($results[$key]["_source"]["text"], "[[categorie:", "]]");
        }
        $took = $response['took'];
        $total = $response['hits']['total'];
//        dd($results);
        return view('welcome', compact('results', 'took', 'total'));
    }

    private function tag_contents($string, $tag_open, $tag_close)
    {
        foreach (explode($tag_open, $string) as $key => $value) {
            if (strpos($value, $tag_close) !== FALSE) {
                $result[] = substr($value, 0, strpos($value, $tag_close));;
            }
        }
        if (isset($result)) {
            return $result;
        } else {
            return null;
        }
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
