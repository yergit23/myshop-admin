<?php

namespace App\Http\Controllers\API\Order;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Order\StoreRequest;
use App\Http\Resources\Order\OrderResource;
use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();

        $password = Hash::make('123123123');

        $user = User::firstOrCreate([
            'email' => $data['email']
        ], [
            'name' => $data['name'],
            'address' => $data['address'],
            'password' => $password
        ]);

        $order = Order::create([
            'products' => json_encode($data['products']),
            'user_id' => $user->id,
            'total_price' => $data['total_price']
        ]);

        return new OrderResource($order);
    }
}
