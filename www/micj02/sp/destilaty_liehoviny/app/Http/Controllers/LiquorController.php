<?php

namespace App\Http\Controllers;

use App\Models\Liquor;
use Illuminate\Http\Request;

class LiquorController extends Controller
{
    public function index(Request $request) {
        $category = $request->input('category') + 0;
        if ($category) {
            $liquors = Liquor::where('category', $category)->paginate(4);
        }
        else {
            $liquors = Liquor::paginate(4);
        }

        $carousel_liquors = Liquor::inRandomOrder()->limit(5)->get();
        return view('liquor.index', compact('liquors'), compact('carousel_liquors'));
    }

    public function show(Liquor $liquor) {
//        $categories = Liquor::groupBy('category')->pluck('category');
        return view('liquor.show', compact('liquor'));
    }
}
