<?php

namespace App\Providers;

use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Vite::prefetch(concurrency: 3);

        // Pesan sukses (flash) tersedia di semua halaman Vue sebagai $page.props.flash
        Inertia::share('flash', fn () => [
            'success' => session('success'),
        ]);
    }
}
