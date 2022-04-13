<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Parrain;

/**
 * Class DashboardController.
 */
class DashboardController extends Controller
{
    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $parrains = Parrain::all();

        // dd($parrains);
        return view('backend.dashboard', ['parrains' => $parrains]);
    }
}
