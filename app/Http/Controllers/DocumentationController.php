<?php

namespace App\Http\Controllers;

use App\Models\DocumentationCategory;
use App\Models\DocumentationPhoto;

class DocumentationController extends Controller
{
    public function index()
    {
        $categories = DocumentationCategory::where('is_active', true)
            ->with(['photos' => function ($query) {
                $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
            }])
            ->orderBy('sort_order', 'asc')
            ->orderBy('id', 'desc')
            ->get();

        $allPhotos = DocumentationPhoto::whereHas('category', function ($query) {
            $query->where('is_active', true);
        })
        ->with('category')
        ->orderBy('sort_order', 'asc')
        ->orderBy('id', 'desc')
        ->get();

        return view('documentation.index', compact('categories', 'allPhotos'));
    }

    public function show($slug)
    {
        $category = DocumentationCategory::where('slug', $slug)
            ->where('is_active', true)
            ->with(['photos' => function ($query) {
                $query->orderBy('sort_order', 'asc')->orderBy('id', 'desc');
            }])
            ->firstOrFail();

        return view('documentation.show', compact('category'));
    }
}
