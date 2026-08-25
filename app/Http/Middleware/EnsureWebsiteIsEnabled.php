<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureWebsiteIsEnabled
{
    /**
     * Paths that must remain reachable while the public site is disabled.
     *
     * @var list<string>
     */
    protected array $except = [
        'onr_adm',
        'onr_adm/*',
        'livewire/*',
    ];

    /**
     * Block public routes when website_enabled is off.
     *
     * Filament boolean parameters store Y/N; also accept true/1 for safety.
     * Authenticated users can still browse the public site.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->is($this->except)) {
            return $next($request);
        }

        if ($request->user()) {
            return $next($request);
        }

        if (! $this->isWebsiteEnabled()) {
            return response()
                ->view('maintenance', [], 503)
                ->header('Retry-After', '3600');
        }

        return $next($request);
    }

    /**
     * Whether the public website should be reachable.
     */
    protected function isWebsiteEnabled(): bool
    {
        $value = strtolower(trim((string) getParameterValue('website_enabled')));

        return in_array($value, ['y', 'true', '1'], true);
    }
}
