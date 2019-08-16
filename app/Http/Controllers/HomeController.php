<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use OpenApi\Annotations\OpenApi as OA;

/**
 * @OA\Info(title="My First API", version="0.1")
 */
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
            'user' => Str::random(6),
            'time' => Carbon::now()->toDateTimeLocalString()
        ]);
    }

    public function getSession(Request $request)
    {
        $user = session('user');
        $time = session('time');
        $data = [
            'user' => $user,
            'time' => $time
        ];
        if ($request->input('error')) {
            throw new \LogicException("参数不正确", 422);
        }
        return response(json_encode($data));
    }

    public function coupdate()
    {
        $rows = DB::update('update sku_inventory set quantity=quantity-1 where sku=1 and quantity > 0');
        return response(['code' =>0 ,'data' => $rows]);
    }

    public function coupdate2()
    {
        $inventory = DB::table('sku_inventory')->where('sku', 1)->first();
        $rows = 0;
        if ($inventory->quantity > 0) {
            $rows = DB::update('update sku_inventory set quantity=quantity-1 where sku=1');
        }
        return response(['code' =>0 ,'data' => $rows]);
    }

    /**
     * @OA\Get(
     *     path="/api/resource.json",
     *     @OA\Response(response="200", description="An example resource")
     * )
     */
    public function getResource()
    {
        $data = [
            'code' => 200,
            'message' => 'An example resource'
        ];
        return response($data);
    }
}
