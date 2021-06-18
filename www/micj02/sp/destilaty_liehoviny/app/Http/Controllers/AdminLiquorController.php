<?php

namespace App\Http\Controllers;

use App\Models\Liquor;
use Illuminate\Http\Request;


class AdminLiquorController extends BaseCartController
{

    public function __construct()
    {
        $this->middleware('admin');
    }


    public function index(Request $request) {
        $liquors = Liquor::paginate(4);
        return view('admin_liquor.index', compact(['liquors']));
    }

    public function show(Liquor $liquor, Request $request) {
        $cart = $this->get_or_create_cart($request);
        return view('liquor.show', compact(['liquor', 'cart']));
    }

    public function create(Liquor $liquor)
    {
        return view('admin_liquor.create', compact(['liquor']));
    }

    public function edit(Liquor $liquor)
    {
        return view('admin_liquor.edit', compact(['liquor']));
    }

    public function store(Request $request)
    {
        $liquor_data = $request->validate([
            'name' => ['required', 'max:255'],
            'image' => ['required', 'image'],
            'category' => ['required', 'integer'],
            'volume' => ['required', 'numeric'],
            'alcohol_percentage' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);

        $imagePath = request('image')->store('image/liquor', 'public');
        $liquor_data['image'] = "storage/{$imagePath}";
        Liquor::create($liquor_data);
        return redirect('/admin/liquors');
    }

    public function update(Liquor $liquor, Request $request)
    {

        $liquor_data = $request->validate([
            'name' => ['required', 'max:255'],
            'image' => 'image',
            'category' => ['required', 'integer'],
            'volume' => ['required', 'numeric'],
            'alcohol_percentage' => ['required', 'numeric'],
            'price' => ['required', 'numeric'],
        ]);
        if (array_key_exists('image', $liquor_data) && $liquor_data['image'])
        {
            $imageName = time().'.'.$request->image->extension();

            $request->image->move(public_path('images'), $imageName);
        } else {
            $imageName = $liquor->image;
        }
        $liquor_data['image'] = $imageName;


        $liquor->update($liquor_data);
        return redirect('/admin/liquors');
    }

    public function delete(Liquor $liquor)
    {
        $liquor->delete();
        return redirect('/admin/liquors');
    }
}
