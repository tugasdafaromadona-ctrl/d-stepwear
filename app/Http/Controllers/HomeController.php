<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Inertia\Inertia;
use Inertia\Response;

class HomeController extends Controller
{
    public function index(): Response
    {
        return Inertia::render('Home', [
            'featured' => Product::with('category')
                ->where('is_featured', true)
                ->latest()
                ->take(4)
                ->get(),
            'categories' => Category::withCount('products')->orderBy('name')->get(),
        ]);
    }
}
