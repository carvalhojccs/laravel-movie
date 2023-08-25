<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cast;
use App\Models\Movie;
use App\Models\Serie;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class IndexAdminController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(): View
    {
        $users = User::all();
        $movies = Movie::all();
        $series = Serie::all();
        $casts = Cast::all();

        return view('admin.index', compact('users', 'movies', 'series', 'casts'));
    }
}
