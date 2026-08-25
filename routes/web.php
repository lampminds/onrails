<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\StoreController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/store', [StoreController::class, 'index'])->name('store');

Route::get('/store/product/{product:slug}', [StoreController::class, 'show'])->name('store.product');

Route::get('/page/{slug}', [PageController::class, 'show'])->name('page.show');

// Legacy / mistaken public URLs → current routes (menus, bookmarks, old links)
Route::redirect('/productos', '/store', 301);
Route::redirect('/products', '/store', 301);
Route::redirect('/contact', '/page/contacto', 301);
Route::redirect('/contacto', '/page/contacto', 301);
Route::redirect('/about', '/page/sobre-nosotros', 301);
Route::redirect('/sobre-nosotros', '/page/sobre-nosotros', 301);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::fallback(function (Request $request) {

    if ($request->query('__blocked_php')) {
        Log::channel('security')->warning('Blocked PHP execution attempt', [
            'ip'         => $request->ip(),
            'uri'        => $request->getRequestUri(),
            'path'       => $request->path(),
            'method'     => $request->method(),
            'user_agent' => $request->userAgent(),
        ]);

        abort(404);
    }

    abort(404);
});

