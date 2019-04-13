<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2019/4/13
 * Time: 22:50
 */

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class RecordAccessLog
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        $req = [
            'ip' => $request->getClientIp(),
            'url' => $request->fullUrl(),
            'data' => $request->all()
        ];
        Log::info("", ['request' => $req, 'response' => $response]);
    }

}