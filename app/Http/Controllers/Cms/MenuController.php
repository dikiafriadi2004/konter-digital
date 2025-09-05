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
            ->with('childrenRecursive')
            ->orderBy('order')
            ->get();

        return view('cms.menus.index', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'type'      => 'required|string|in:home,blog,blog_detail,contact,privacy,about,custom',
            'url'       => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $data = [
            'title'     => $request->title,
            'type'      => $request->type,
            'parent_id' => $request->parent_id ?: null,
        ];

        $data['url'] = $request->type !== 'custom'
            ? $this->getUrlFromType($request->type)
            : $request->url;

        // set order terakhir berdasarkan parent
        $lastOrder = Menu::where('parent_id', $data['parent_id'])->max('order') ?? 0;
        $data['order'] = $lastOrder + 1;

        Menu::create($data);

        return back()->with('success', 'Menu created successfully.');
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'title'     => 'required|string|max:255',
            'type'      => 'required|string|in:home,blog,blog_detail,contact,privacy,about,custom',
            'url'       => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
        ]);

        $data = [
            'title'     => $request->title,
            'type'      => $request->type,
            'parent_id' => $request->parent_id ?: null,
        ];

        $data['url'] = $request->type !== 'custom'
            ? $this->getUrlFromType($request->type)
            : $request->url;

        $menu->update($data);

        return back()->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $this->deleteChildren($menu);
        $menu->delete();

        return back()->with('success', 'Menu deleted successfully.');
    }

    public function reorder(Request $request)
    {
        if (!$request->has('menus')) {
            return response()->json([
                'success' => false,
                'message' => 'No menu data received'
            ], 400);
        }

        DB::beginTransaction();
        try {
            $menus = $request->input('menus');
            $this->saveOrder($menus, null);

            DB::commit();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }

    private function saveOrder(array $menus, $parentId = null)
    {
        foreach ($menus as $index => $menuData) {
            $menu = Menu::find($menuData['id']);
            if (!$menu) continue;

            $menu->update([
                'order'     => $index + 1,
                'parent_id' => $parentId === null ? null : $parentId,
            ]);

            if (!empty($menuData['children']) && is_array($menuData['children'])) {
                $this->saveOrder($menuData['children'], $menu->id);
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
            'privacy'     => '/privacy',
            'about'       => '/about',
            default       => null,
        };
    }
}
