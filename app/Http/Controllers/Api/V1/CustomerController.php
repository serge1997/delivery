<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Main\Customer\Actions\CustomerCreate;
use App\Main\Customer\Actions\CustomerList;
use App\Main\Customer\Actions\CustomerUpdate;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class CustomerController extends Controller
{
    use HttpResponse;

    public function __construct(
        private ContainerInterface $container
    ){}

    public function index()
    {

    }
    public function store(CustomerRequest $request)
    {
        try{
            /** @var CustomerCreate $customerCreate */
            $customerCreate = $this->container->get(CustomerCreate::class);
            $response = $customerCreate->run($request);
            $message = "Votre compte a été creé avec succes. Realizer votre connexion por continuer.";
            return response()
                ->json($this->successResponse($message, $response));

        }catch(Exception $e){
            return response()
            ->json($this->errorResponse("Error {$e->getMessage()}"), 500);
        }
    }

    public function show(int $id)
    {
        try{
            /** @var CustomerList $customerList */
            $customerList = $this->container->get(CustomerList::class);
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error {$e->getMessage()}"), 500);
        }
    }

    public function update(CustomerRequest $request)
    {
        try{
            /** @var CustomerUpdate $customerUpdate */
            $customerUpdate = $this->container->get(CustomerUpdate::class);

        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Error {$e->getMessage()}"), 500);
        }
    }
}
