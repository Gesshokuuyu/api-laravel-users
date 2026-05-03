<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\ItemResource;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
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
}
