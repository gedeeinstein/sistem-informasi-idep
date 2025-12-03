<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;

/**
 * Class ActivityLogController
 *
 * Controller for viewing activity logs.
 *
 * @package App\Http\Controllers\Admin
 */
class ActivityLogController extends Controller
{
    /**
     * Display a listing of activity logs.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Ambil semua log aktivitas
        $logs = Activity::latest()->paginate(10);

        return view('logs.index', compact('logs'));
    }

    /**
     * Display the specified activity log.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        // Ambil detail log berdasarkan ID
        $log = Activity::findOrFail($id);

        return view('logs.show', compact('log'));
    }
}
