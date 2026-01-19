<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     * 
     * This page is accessible to everyone including guests.
     * Shows public information and statistics about the FarmTrack record management system.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        // Sample statistics - later we'll make these dynamic from database
        // These are public statistics that can be shown to visitors for transparency
        $stats = [
            'total_farmers' => 1250,
            'total_laborers' => 350, 
            'total_fisherfolks' => 180,
            'total_agriyouth' => 95,
            'total_barangays' => 15,
            'total_requests' => 45
        ];

        return view('welcome', compact('stats'));
    }
}
