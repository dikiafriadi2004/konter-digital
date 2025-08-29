<?php

namespace App\Http\Controllers\Cms;

use App\Models\Cms\Menu;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Cms\Page;
use Illuminate\Support\Facades\DB;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::whereNull('parent_id')
            ->with('childrenRecursive')
            ->orderBy('order')
            ->get();

        return view('cms.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'type'       => 'required|string|in:home,blog,blog_detail,contact,privacy,about,custom',
            'url'        => 'nullable|string|max:255',
            'parent_id'  => 'nullable|exists:menus,id',
        ]);

        $data = [
            'title'     => $request->title,
            'type'      => $request->type,
            'parent_id' => $request->parent_id, // simpan parent
        ];

        if ($request->type !== 'custom') {
            $data['url'] = $this->getUrlFromType($request->type);
        } else {
            $data['url'] = $request->url;
        }

        // hitung order terakhir dari parent
        $lastOrder = Menu::where('parent_id', $request->parent_id)->max('order');
        $data['order'] = is_null($lastOrder) ? 0 : $lastOrder + 1;

        Menu::create($data);

        return back()->with('success', 'Menu created successfully.');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title'      => 'required|string|max:255',
            'type'       => 'required|string|in:home,blog,blog_detail,contact,privacy,about,custom',
            'url'        => 'nullable|string|max:255',
            'parent_id'  => 'nullable|exists:menus,id|not_in:' . $menu->id, // jangan bisa jadi anak sendiri
        ]);

        $data = [
            'title'     => $request->title,
            'type'      => $request->type,
            'parent_id' => $request->parent_id,
        ];

        if ($request->type !== 'custom') {
            $data['url'] = $this->getUrlFromType($request->type);
        } else {
            $data['url'] = $request->url;
        }

        $menu->update($data);

        return back()->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        // hapus semua anak secara rekursif
        $this->deleteChildren($menu);
        $menu->delete();

        return back()->with('success', 'Menu deleted successfully.');
    }

    public function reorder(Request $request)
    {
        $menus = $request->input('menus');
        if (!$menus || !is_array($menus)) {
            return response()->json(['success' => false, 'message' => 'Invalid data']);
        }

        $this->saveOrder($menus, null);

        return response()->json(['success' => true, 'message' => 'Menu berhasil diurutkan']);
    }

    private function saveOrder(array $menus, $parentId = null)
    {
        foreach ($menus as $index => $menu) {
            Menu::where('id', $menu['id'])->update([
                'order' => $index + 1,
                'parent_id' => $parentId,
            ]);

            if (!empty($menu['children'])) {
                $this->saveOrder($menu['children'], $menu['id']);
            }
        }
    }


    private function deleteChildren(Menu $menu)
    {
        foreach ($menu->children as $child) {
            $this->deleteChildren($child);
            $child->delete();
        }
    }

    private function getUrlFromType(string $type): ?string
    {
        return match ($type) {
            'home'        => '/',
            'blog'        => '/blog',
            'blog_detail' => '/blog/{slug}',
            'contact'     => '/contact',
            'privacy'     => '/privacy-policy',
            'about'       => '/about-us',
            default       => null,
        };
    }
}
