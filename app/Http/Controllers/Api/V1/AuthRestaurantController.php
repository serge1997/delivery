<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRestaurantRequest;
use App\Main\Auth\Restaurant\Actions\AuthRestaurantLogin;
use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class AuthRestaurantController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    )
    {

    }
    public function login(AuthRestaurantRequest $request)
    {
        try{
            /** @var AuthRestaurantLogin $authRestaurantLogin */
            $authRestaurantLogin = $this->container->get(AuthRestaurantLogin::class);
            $response = $authRestaurantLogin->auth($request);
            dd($response);
            return response()
                ->json($this->successResponse("Login effectué avec succes",$response));
        }catch( \Exception $e ){
            return response()
                ->json($this->errorResponse("Error: {$e->getMessage()}"), 500);
        }
    }
}
