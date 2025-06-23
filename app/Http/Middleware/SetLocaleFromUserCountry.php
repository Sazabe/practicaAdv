<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromUserCountry
{

    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::guard('admin')->user()
            ?? Auth::guard('manager')->user()
            ?? Auth::guard('front')->user();
        // Obtenemos el ISO del país
        $countryIso = $user?->country?->iso ?? 'en';
        // Cargar el array desde lang/iso_map.php
        $isoToLocale = include resource_path('lang/iso_map.php');
        // Determinar el locale a usar (por ejemplo 'es' o 'en')
        $locale = $isoToLocale[$countryIso] ?? 'en';

        // Comprobamos si existe una carpeta de traducción para ese ISO
        if (File::exists(resource_path("lang/{$locale}"))) {
            App::setLocale($locale);
        } else {
            // No hay traducción, usar inglés por defecto
            App::setLocale('en');
            // Guardar en la sesión que no hay traducción (puedes mostrarlo luego en el recurso)
            session()->flash('missing_locale', $locale);
        }
        return $next($request);
    }
}
/*      Una forma de hacerlos
        $defaultLocale = 'es';
        $locale = $defaultLocale;
        if ($user && $user->country && $user->country->iso2) {
            $locale = match (strtoupper($user->country->iso2)) {
            'ES' => 'es',
            'US', 'GB' => 'en',
            default => $defaultLocale,
        };
        App::setLocale($locale);


        Cadena de if para set locale demasiado larga, se puede hacer más simple
        if ($user && $user->country_id && $user->country && $user->country->iso) {
            $locale = strtolower($user->country->iso); // Usar el campo ISO del país como idioma
            // Validar si tenemos traducciones para ese idioma
            if (in_array($locale, ['es', 'en'])) {
                App::setLocale($locale);
            } else {
                App::setLocale('en'); // fallback
            }
        } else {
            App::setLocale('en'); // fallback si no hay usuario o país
        }*/