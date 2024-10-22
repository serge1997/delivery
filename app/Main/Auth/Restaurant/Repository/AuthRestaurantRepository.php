<?php
namespace App\Main\Auth\Restaurant\Repository;

use App\Main\Auth\Restaurant\Exception\AuthRestaurantException;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Hash;
use stdClass;

class AuthRestaurantRepository implements AuthRestaurantRepositoryInterface
{
    public function __construct(private stdClass $authEntity)
    {}

    public function login($request)
    {
        $restaurant = Restaurant::where('phone', $request->phone)->first();
        if(!$restaurant || !Hash::check($request->password, $restaurant->password)){
            throw new AuthRestaurantException("les données sont invalides");
        }
        $request->session()->put('auth_restaurant', $restaurant->id);
        $token = $restaurant->createToken('browser', ['role:restaurant'])->plainTextToken;
        $data = [
            'token' => $token,
            'name' => $restaurant->name,
            'latidute' => $restaurant->latitude,
            'longitude' => $restaurant->longitude,
            'role' => 'restaurant'
        ];
        return $data;
    }
    public function logout($request)
    {
        $request->session()->forget('auth_restaurant');
        $request->user()->currentAccessToken()->delete();
    }
}
