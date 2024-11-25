<?php
namespace App\Main\Auth\Customer\Repository;

use App\Main\Auth\Customer\Exception\AuthCustomerException;
use App\Models\Customer;
use Illuminate\Support\Facades\Hash;

final class AuthCustomerRepository implements AuthCustomerRepositoryInterface
{

    public function login($request, ?Customer $customer)
    {

        if (!$customer || !Hash::check($request->password, $customer->password)){
            throw new AuthCustomerException("les données sont invalides");
        }
        $request->session()->put('auth_customer', $customer->id);
        $token = $customer->createToken('browser', ['role:customer'])->plainTextToken;
        $data = [
            'id' => $customer->id,
            'token' => $token,
            'name' => $customer->name,
            'role' => 'customer'
        ];
        return $data;
    }
    public function logout($request)
    {

    }
}
