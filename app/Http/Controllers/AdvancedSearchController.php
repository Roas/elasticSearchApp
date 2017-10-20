<?php

namespace App\Http\Controllers;

use Elasticsearch\ClientBuilder;
use Illuminate\Http\Request;

class AdvancedSearchController extends Controller
{
    public function index()
    {
        return view('advancedsearch');
    }

    public function result(Request $request)
    {
        $client = ClientBuilder::create()->build();
        $params = [
            'body' => [
                'query' => [
                    'bool' => [
                        'must' => [
                            ['match' => [
                                'title' => $request->input('title')
                            ]
                            ],
                            ['match' => [
                                'text' => $request->input('text')
                            ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
        if ($request->input('title') == null && $request->input('text') == null) {
            return view('advancedsearchnoquery');
        }
        if ($request->input('title') == null) {
            $params = [
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => [
                                ['match' => [
                                    'text' => $request->input('text')
                                ]
                                ]
                            ]
                        ]
                    ]
                ]
            ];
        }
        if ($request->input('text') == null) {
            $params = [
                'body' => [
                    'query' => [
                        'bool' => [
                            'must' => [
                                ['match' => [
                                    'title' => $request->input('title')
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
        return view('advancedsearch', compact('results'));
    }
}
