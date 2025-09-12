<?php

namespace App\Http\Controllers;

use App\Models\Goods;
use Illuminate\Http\Request;

class GoodsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $goods = Goods::with('user')->get();
        return view('goods.index', compact('goods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('goods.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'goods_name' => 'required|string|max:100',
            'price'      => 'required|integer|min:0',
            'image_path' => 'required|image|max:10240',
        ]);

        $data = $request->only(['goods_name', 'price']);
        $data['image_path'] = $request->file('image_path')->store('goods_images', 'public');

        $item = $request->user()->goods()->create($data);
        return redirect()->route('goods.index')->with('success', 'Goods created successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Goods $goods)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Goods $goods)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Goods $goods)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Goods $good)
    {
        $good->forceDelete();


        return redirect()
            ->route('goods.index');
    }
}
