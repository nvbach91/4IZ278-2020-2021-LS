<?php

namespace App\Http\Controllers;

use App\Models\Liquor;
use Illuminate\Http\Request;

class LiquorController extends BaseCartController
{
    public function index(Request $request) {
        $cart = $this->get_or_create_cart($request);
        $category = $request->input('category') + 0;
        if ($category) {
            $liquors = Liquor::where('category', $category)->paginate(4);
        }
        else {
            $liquors = Liquor::paginate(4);
        }

        $carousel_liquors = Liquor::inRandomOrder()->limit(5)->get();
        return view('liquor.index', compact(['liquors', 'carousel_liquors', 'cart']));
    }

    public function show(Liquor $liquor, Request $request) {
        $cart = $this->get_or_create_cart($request);
        return view('liquor.show', compact(['liquor', 'cart']));
    }

    public function edit(Liquor $liquor)
    {
        return view('liquor.show', compact(['liquor', 'cart']));
    }

    public function delete(Liquor $liquor)
    {
        return view('liquor.show', compact(['liquor', 'cart']));
    }
}
