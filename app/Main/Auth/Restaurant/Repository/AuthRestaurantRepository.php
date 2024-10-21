<?php
namespace App\Main\Auth\Restaurant\Repository;

use App\Main\Auth\Restaurant\Exception\AuthRestaurantException;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;

class AuthRestaurantRepository implements AuthRestaurantRepositoryInterface
{
    public function login($request)
    {
        $restaurant = Restaurant::where('phone', $request->phone)->first();
        if(!$restaurant || !Hash::check($request->password, $restaurant->password)){
            throw new AuthRestaurantException("les données sont invalides");
        }
        $request->session()->put('auth_restaurant', $restaurant->id);
        $token = $restaurant->createToken('browser')->plainTextToken;
        return $token;
    }
    public function logout()
    {

    }
}
