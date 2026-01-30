<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

class PolicyController extends Controller
{
    /**
     * Display the privacy policy page.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function policy()
    {
        $path = resource_path('markdown/policy.md');

        if (! is_readable($path)) {
            abort(404);
        }

        $policy = Str::markdown(file_get_contents($path));

        return view('policy', ['policy' => $policy]);
    }

    /**
     * Display the terms of service page.
     *
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function terms()
    {
        $path = resource_path('markdown/terms.md');

        if (! is_readable($path)) {
            abort(404);
        }

        $terms = Str::markdown(file_get_contents($path));

        return view('terms', ['terms' => $terms]);
    }
}
