<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = \App\Models\Article::where('is_published', true)
                            ->latest()
                            ->paginate(9);

        return view('article.index', compact('articles'));
    }

    public function show($slug)
    {
        $article = \App\Models\Article::where('slug', $slug)
                            ->where('is_published', true)
                            ->firstOrFail();

        $article->increment('views');

        $popularArticles = \App\Models\Article::where('is_published', true)
                            ->orderBy('views', 'desc')
                            ->orderBy('id', 'desc')
                            ->take(5)
                            ->get();

        $comments = $article->approvedComments()->latest()->get();

        return view('article.show', compact('article', 'popularArticles', 'comments'));
    }

    public function storeComment(Request $request, $slug)
    {
        $article = \App\Models\Article::where('slug', $slug)
                            ->where('is_published', true)
                            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'comment' => 'required|string|max:2000',
        ]);

        $article->comments()->create([
            'name' => $request->name,
            'email' => $request->email,
            'comment' => $request->comment,
            'is_approved' => false,
        ]);

        return back()->with('comment_success', true);
    }
}
