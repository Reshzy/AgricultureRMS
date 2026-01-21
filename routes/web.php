<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Models\Enrollment;
use App\Models\News;

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Static pages
Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

// Contact form submission
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Public News
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

// Pending approval page - accessible to authenticated users
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->get('/pending-approval', function () {
    return view('auth.pending-approval');
})->name('pending-approval');

// Admin routes - requires authentication and admin access
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
    'admin',
])->group(function () {
    Route::get('/dashboard', function () {
        try {
            // Get statistics
            $totalEnrollments = Enrollment::count();
            $pendingDrafts = Enrollment::where('status', 'draft')->count();
            $uniqueBarangays = Enrollment::whereNotNull('address_barangay')
                ->where('address_barangay', '!=', '')
                ->distinct()
                ->count('address_barangay');

            // Get enrollments by barangay
            $enrollmentsByBarangay = Enrollment::selectRaw('address_barangay, COUNT(*) as count')
                ->whereNotNull('address_barangay')
                ->where('address_barangay', '!=', '')
                ->groupBy('address_barangay')
                ->orderByDesc('count')
                ->limit(10)
                ->get();

            // Get recent enrollments
            $recentEnrollments = Enrollment::orderByDesc('created_at')->limit(6)->get();

            // Get recent news
            $recentNews = News::orderByDesc('created_at')->limit(5)->get();

            // Get registration statistics
            $registeredCount = Enrollment::whereNotNull('user_id')->count();
            $notRegisteredCount = Enrollment::whereNull('user_id')->count();
        } catch (\Exception $e) {
            // Fallback values if database queries fail
            $totalEnrollments = 0;
            $pendingDrafts = 0;
            $uniqueBarangays = 0;
            $enrollmentsByBarangay = collect();
            $recentEnrollments = collect();
            $recentNews = collect();
            $registeredCount = 0;
            $notRegisteredCount = 0;
        }

        return view('admin.dashboard', compact(
            'totalEnrollments',
            'pendingDrafts',
            'uniqueBarangays',
            'enrollmentsByBarangay',
            'recentEnrollments',
            'recentNews',
            'registeredCount',
            'notRegisteredCount'
        ));
    })->name('dashboard');

    // Admin News Management
    Route::get('/admin/news', [NewsController::class, 'adminIndex'])->name('admin.news.index');
    Route::get('/admin/news/create', [NewsController::class, 'create'])->name('admin.news.create');
    Route::post('/admin/news', [NewsController::class, 'store'])->name('admin.news.store');
    Route::get('/admin/news/{news}/edit', [NewsController::class, 'edit'])->name('admin.news.edit');
    Route::put('/admin/news/{news}', [NewsController::class, 'update'])->name('admin.news.update');
    Route::delete('/admin/news/{news}', [NewsController::class, 'destroy'])->name('admin.news.destroy');

    // Admin Email Management
    Route::get('/admin/emails', [ContactController::class, 'index'])->name('admin.emails.index');
    Route::get('/admin/emails/search', [ContactController::class, 'search'])->name('admin.emails.search');
    Route::get('/admin/emails/{contactMessage}', [ContactController::class, 'show'])->name('admin.emails.show');

    // Enrollments
    Route::get('/admin/enrollments', [EnrollmentController::class, 'index'])->name('admin.enrollments.index');
    Route::get('/admin/enrollments/create', [EnrollmentController::class, 'create'])->name('admin.enrollments.create');
    Route::post('/admin/enrollments', [EnrollmentController::class, 'store'])->name('admin.enrollments.store');
    Route::get('/admin/enrollments/{enrollment}', [EnrollmentController::class, 'show'])->name('admin.enrollments.show');
    Route::get('/admin/enrollments/{enrollment}/edit', [EnrollmentController::class, 'edit'])->name('admin.enrollments.edit');
    Route::get('/admin/enrollments/{enrollment}/pdf', [EnrollmentController::class, 'exportPdf'])->name('admin.enrollments.pdf');
    Route::put('/admin/enrollments/{enrollment}', [EnrollmentController::class, 'update'])->name('admin.enrollments.update');
    Route::delete('/admin/enrollments/{enrollment}', [EnrollmentController::class, 'destroy'])->name('admin.enrollments.destroy');

    // User Management
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.destroy');
});
