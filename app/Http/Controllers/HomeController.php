<?php

namespace App\Http\Controllers;

use App\Models\Enrollment;

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
        // Calculate active farmers (submitted enrollments)
        $activeFarmers = Enrollment::where('status', 'submitted')->count();

        // Calculate new farmers (created in last 30 days)
        $newFarmers = Enrollment::where('created_at', '>=', now()->subDays(30))->count();

        // Calculate growth rate (current month vs previous month)
        $currentMonthStart = now()->startOfMonth();
        $currentMonthEnd = now()->endOfMonth();
        $previousMonthStart = now()->subMonth()->startOfMonth();
        $previousMonthEnd = now()->subMonth()->endOfMonth();

        $currentMonthCount = Enrollment::whereBetween('created_at', [$currentMonthStart, $currentMonthEnd])->count();
        $previousMonthCount = Enrollment::whereBetween('created_at', [$previousMonthStart, $previousMonthEnd])->count();

        // Calculate growth rate percentage
        if ($previousMonthCount > 0) {
            $growthRate = (($currentMonthCount - $previousMonthCount) / $previousMonthCount) * 100;
        } else {
            // If no enrollments in previous month, show 0% or handle as needed
            $growthRate = $currentMonthCount > 0 ? 100 : 0;
        }

        // Sample statistics - later we'll make these dynamic from database
        // These are public statistics that can be shown to visitors for transparency
        $stats = [
            'total_farmers' => 1250,
            'total_laborers' => 350,
            'total_fisherfolks' => 180,
            'total_agriyouth' => 95,
            'total_barangays' => 15,
            'total_requests' => 45,
        ];

        return view('welcome', compact('stats', 'activeFarmers', 'newFarmers', 'growthRate'));
    }
}
