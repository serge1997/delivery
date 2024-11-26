<?php
namespace App\Http\Controllers\Api\V1;

use App\Traits\HttpResponse;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\AuthCustomerRequest;
use App\Main\Auth\Customer\Actions\AuthCustomerLogin;
use App\Main\Auth\Customer\Actions\AuthCustomerLogout;
use Exception;

class AuthCustomerController extends Controller
{
    use HttpResponse;
    public function __construct(
        private ContainerInterface $container
    ){}

    public function login(AuthCustomerRequest $request)
    {
        try{
            /** @var AuthCustomerLogin $authCustomerLogin */
            $authCustomerLogin = $this->container->get(AuthCustomerLogin::class);
            $response = $authCustomerLogin->auth($request);
            return response()
                ->json($this->successResponse('customer login', $response));
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Erreur: {$e->getMessage()}"), 500);
        }
    }
    public function logout(Request $request)
    {
        try{
            /** @var AuthCustomerLogout $authCustomerLogout */
            $authCustomerLogout = $this->container->get(AuthCustomerLogout::class);
            $authCustomerLogout->run($request);
            return response()
                ->json($this->successResponse("logout done successfuly"));

        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Erreur: {$e->getMessage()}"), 500);
        }
    }
}
