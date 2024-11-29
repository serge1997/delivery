<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddressRequest;
use App\Main\Address\Actions\AddressCreate;
use App\Main\Address\Actions\AddressList;
use App\Traits\HttpResponse;
use Exception;
use Illuminate\Http\Request;
use Psr\Container\ContainerInterface;

class AddressController extends Controller
{
    use HttpResponse;
    public function __construct(
        private ContainerInterface $container
    ){}

    public function index()
    {
        try{
            /** @var AddressList $addressList */
            $addressList = $this->container->get(AddressList::class);
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Erreur: {$e->getMessage()}"), 500);
        }
    }

    public function store(AddressRequest $request)
    {
        try{
            /** @var AddressCreate $addressCreate */
            $addressCreate = $this->container->get(AddressCreate::class);
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Erreur: {$e->getMessage()}"), 500);
        }
    }

    public function show(int $id)
    {
        try{
            /** @var AddressList $addressList */
            $addressList = $this->container->get(AddressList::class);
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Erreur: {$e->getMessage()}"), 500);
        }
    }

    public function search(Request $request)
    {
        try{
            /** @var AddressList $addressList */
            $addressList = $this->container->get(AddressList::class);
        }catch(Exception $e){
            return response()
                ->json($this->errorResponse("Erreur: {$e->getMessage()}"), 500);
        }
    }
}
