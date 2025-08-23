<?php

namespace App\Http\Controllers\Cms;

use App\Models\Cms\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')
            ->orderBy('order')
            ->with('children')
            ->get();

        return view('cms.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'url'   => 'required|string',
        ]);

        // hitung order terakhir
        $lastOrder = Menu::max('order') ?? 0;

        Menu::create([
            'title' => $request->title,
            'url'   => $request->url,
            'parent_id' => $request->parent_id ?? null,
            'order' => $lastOrder + 1,
        ]);

        return back()->with('success', 'Menu berhasil ditambahkan');
    }

    public function edit(Menu $menu)
    {
        return view('cms.menus.edit', compact('menu'));
    }

    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);
        $menu->update([
            'title' => $request->title,
            'url' => $request->url,
        ]);

        return response()->json(['status' => 'success']);
    }


    public function destroy(Menu $menu)
    {
        $menu->delete();
        return back()->with('success', 'Menu berhasil dihapus');
    }

    public function updateOrder(Request $request)
    {
        $order = $request->input('order');

        foreach ($order as $item) {
            Menu::where('id', $item['id'])
                ->update(['order' => $item['position']]);
        }

        return response()->json(['status' => 'success']);
    }
}
