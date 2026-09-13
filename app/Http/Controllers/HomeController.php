<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;

class HomeController extends Controller
{
    public function index()
    {
        $featuredEvent = Event::where('ativo', true)->orderBy('data_evento', 'asc')->first();
        $events = Event::where('ativo', true)->orderBy('data_evento', 'asc')->take(3)->get();
        $posts = Post::orderBy('publicado_em', 'desc')->take(4)->get();

        return view('home', compact('featuredEvent', 'events', 'posts'));
    }
}
