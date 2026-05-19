<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\CartAddRequest;
use App\Http\Requests\RemoveCartItemRequest;
use App\Http\Resources\ShoppingCartResource;
use App\Models\Item;
use App\Models\ShoppingCart;
use App\Models\ShoppingCartItems;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Number;
use Throwable;

class ShoppingCartController extends Controller
{

    use AuthorizesRequests;

    public function index(Request $request)
    {
        $userId = $request->user()->id;

        $cart = ShoppingCart::with('items')
            ->where('user_id', $userId)
            ->first();

        if (!$cart) {
            $cart = ShoppingCart::create([
                'user_id' => $userId,
                'status'  => 'clear'
            ]);

            $cart->load('items');
        }

        return new ShoppingCartResource($cart);
    }

    public function addToCart(CartAddRequest $request)
    {
        $validated = $request->validated();

        if((int) $request->user()->id !== (int) $validated['user_id']){
            return response()->json([
                'success' => false,
                'msg' => "Requisição inválida para este usuário."
            ], 403);
        }

        $item = Item::findOrFail($validated['item']);
        $itemSupply = $item->itemSupply;

        if((int) $request->user()->id === (int) $item->user_id){
            return response()->json([
                'success' => false,
                'msg' => "Você não pode colocar seu próprio item no seu carrinho"
            ], 403);
        }

        $qtdDisponivel = $itemSupply->quantity_available - $itemSupply->used;

        if($qtdDisponivel < $validated['quantity']){
            return response()->json([
                'success' => false,
                'msg' => "A quantidade disponivel para este item é {$qtdDisponivel}"
            ], 400);
        }

        try{
            ShoppingCartItems::updateOrCreate(
                [
                    'cart_id' => $request->user()->shoppingCart->id,
                    'item_id' => $validated['item']
                ],
                [
                    'quantity' => $validated['quantity'],
                    'price'    => $item->price * $validated['quantity']
                ]
            );
        }catch(Throwable $th){
            return response()->json([
                'success' => false,
                'msg'     => 'Erro ao modificar o carrinho.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg'     => 'Carrinho atualizado.'
        ], 201);
    }

    public function remove(RemoveCartItemRequest $request)
    {
        $validated = $request->validated();


        $itemOnCart = ShoppingCartItems::where('item_id', $validated['cart_item'])
                                ->where('cart_id', $request->user()->shoppingCart->id)
                                ->first();

        try {
            $itemOnCart->delete();
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'msg' => "Erro ao deletar item, tente novamente mais tarde."
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg'     => "Item removido do carrinho com sucesso."
        ]);
    }
}
