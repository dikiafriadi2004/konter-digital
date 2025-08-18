<?php

namespace App\Http\Controllers\Cms;

use App\Models\Cms\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    // List Pages
    public function index()
    {
        $pages = Page::paginate(10);
        return view('cms.pages.index', compact('pages'));
    }

    // Show form create page
    public function create()
    {
        return view('cms.pages.create');
    }

    // Store new page
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:pages,slug',
            'body'  => 'nullable|string',
        ]);

        Page::create($request->all());

        return redirect()->route('cms.pages.index')->with('success', 'Page created successfully.');
    }

    // Show form edit
    public function edit(Page $page)
    {
        return view('cms.pages.edit', compact('page'));
    }

    // Update page
    public function update(Request $request, Page $page)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug'  => 'required|string|max:255|unique:pages,slug,' . $page->id,
            'body'  => 'nullable|string',
        ]);

        $page->update($request->all());

        return redirect()->route('cms.pages.index')->with('success', 'Page updated successfully.');
    }

    // Soft delete
    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('cms.pages.index')->with('success', 'Page moved to trash.');
    }

    // Trash pages
    public function trash()
    {
        $pages = Page::onlyTrashed()->paginate(10);
        return view('cms.pages.trash', compact('pages'));
    }

    // Restore page
    public function restore($id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $page->restore();
        return redirect()->route('cms.pages.trash')->with('success', 'Page restored successfully.');
    }

    // Force delete page
    public function forceDelete($id)
    {
        $page = Page::onlyTrashed()->findOrFail($id);
        $page->forceDelete();
        return redirect()->route('cms.pages.trash')->with('success', 'Page permanently deleted.');
    }
}
