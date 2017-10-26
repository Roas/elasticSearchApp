<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AdvancedSearchController extends Controller
{
    public function index()
    {
        return view('advancedsearch');
    }

    public function result()
    {
        $title = Input::get('title');
        $text = Input::get('text');
        $client = ClientBuilder::create()->build();
        $params = [
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            ['match' => [
                                'title' => $title
                            ]
                            ],
                            ['match' => [
                                'text' => $text
                            ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        if ($title == null && $text == null) {
            return view('advancedsearchnoquery');
        }
        if ($title == null) {
            $params = [
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => [
                                ['match' => [
                                    'text' => $text
                                ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }
        if ($text == null) {
            $params = [
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => [
                                ['match' => [
                                    'title' => $title
                                ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }

        $response = $client->search($params);
        $results = $response['hits']['hits'];
        foreach ($results as $key => $result) {
            $results[$key]['tags'] = $this->tag_contents($results[$key]["_source"]["text"], "[[Categorie:", "]]");
            $results[$key]['tags2'] = $this->tag_contents($results[$key]["_source"]["text"], "[[categorie:", "]]");
        }
        $took = $response['took'];
        $total = $response['hits']['total'];
        return view('advancedsearch', compact('results', 'took', 'total'));
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
}
