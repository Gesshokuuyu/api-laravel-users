<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use App\Models\ItemSupply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Throwable;

class ItemController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $items = Item::paginate(20);
        return ItemResource::collection($items);
    }

    public function search(Request $request)
    {
        $query = $request->query("filter");

        if(!$query  || strlen($query) < 2  || strlen($query) > 100){
            return response()
                ->json([
                    'success' => false,
                    'msg' => 'Informe um parametro de busca válido'
                ], 400);
        }

        $items = Item::where(function ($q) use ($query){
            $q->where('code', 'like', '%' . $query . '%')
              ->orWhere('name', 'like', '%' . $query . '%');
        })->paginate(20);

        return ItemResource::collection($items);
    }

    public function show(Item $item)
    {
        return new ItemResource($item);
    }

    public function create(ItemRequest $request)
    {
        $this->authorize('create',  Item::class);

        $validated = $request->validated();
        $validated = $request->safe()->only(['name', 'code', 'description', 'price', 'stock']);

        try{
            $item = Item::create([
                'name'              => $validated['name'],
                'code'              => $validated['code'],
                'description'       => $validated['description'],
                'price'             => $validated['price'],
                'user_id'           => $request->user()->id
            ]);

            ItemSupply::create([
                "quantity_available"  => $validated['stock'],
                "item_id"           => $item->id
            ]);
        }catch(Throwable $th){
            return response()->json([
                'success' => false,
                'msg'     => 'Ocorreu um erro ao cadastrar o item, tente novamente mais tarde.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'msg'     => 'Item criado com sucesso.'
        ]);
    }
}
