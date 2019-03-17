<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function setSession()
    {
        session([
            'user' => Str::random(6)],
            'time' => Carbon::now()->toDateTimeLocalString()
        ]);
    }

    public function getSession()
    {
        $user = session('user');
        $time = session('time');
        $data = [
            'user' => $user,
            'time' => $time
        ];
        return response(json_encode($data));
    }
}
