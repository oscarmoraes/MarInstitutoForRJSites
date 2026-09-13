<?php

namespace App\Http\Controllers;

use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $categoriaSelecionada = request('categoria');

        $query = Post::query();
        if (! empty($categoriaSelecionada) && $categoriaSelecionada !== 'todas') {
            $query->where('categoria', $categoriaSelecionada);
        }

        $featuredPost = (clone $query)->where('destaque', true)->orderBy('publicado_em', 'desc')->first()
            ?? (clone $query)->orderBy('publicado_em', 'desc')->first();

        $posts = (clone $query)
            ->when($featuredPost, fn ($q) => $q->where('id', '!=', $featuredPost->id))
            ->orderBy('publicado_em', 'desc')
            ->get();

        $categories = Post::select('categoria')->distinct()->pluck('categoria');

        return view('noticias', compact('featuredPost', 'posts', 'categories', 'categoriaSelecionada'));
    }

    public function show($slug = 'manifesto-honorarios')
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        $relatedPosts = Post::where('id', '!=', $post->id)
            ->where('categoria', $post->categoria)
            ->orderBy('publicado_em', 'desc')
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $additionalPosts = Post::where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->orderBy('publicado_em', 'desc')
                ->take(3 - $relatedPosts->count())
                ->get();

            $relatedPosts = $relatedPosts->concat($additionalPosts);
        }

        return view('noticia-detalhe', compact('post', 'relatedPosts'));
    }
}
