<?php
/**
 * Created by PhpStorm.
 * User: lhui1
 * Date: 2019/8/16
 * Time: 22:22
 */

namespace App\Http\Controllers;

/**
 * Restful Api接口访问入口
 *
 * Class DocController
 * @package App\Http\Controllers
 */
class DocController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function index()
    {
        $openapi = \OpenApi\scan(app_path());
        $doc = $openapi->toJson();
        return response($doc, 200, ['Content-Type' => 'application/json']);
    }

}