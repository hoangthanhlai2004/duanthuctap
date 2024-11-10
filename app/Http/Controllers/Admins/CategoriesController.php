<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $listCategories = Categories::get();
        return view('admins.categories.index', compact('listCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->isMethod('POST')) {
            $params = $request->except('_token');
            Categories::create($params);

            return redirect()->route('categories.index')->with('success', 'Thêm danh mục thành công');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $Cate = Categories::query()->findOrFail($id);
        if (!$Cate) {
            return redirect()->route('categories.index');
        }

        return view('admins.categories.update', compact('Cate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->isMethod('PUT')) {
            $params = $request->except('_token', '_method');

            $Cate = Categories::findOrFail($id);
            $Cate->update($params);

            return redirect()->route('categories.index')->with('success', 'Cập nhật danh mục thành công');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $Cate = Categories::findOrFail($id);

        if ($Cate) {

            $Cate->delete();

            return redirect()->route('categories.index')->with('success', 'Xóa danh mục thành công!');
        }
    }
    public function trash()
    {
        $listCategories = Categories::onlyTrashed()->get();
        return view('admins.categories.trash',compact('listCategories'));
    }

    public function restore($id)
    {
        Categories::withTrashed()->where('id',$id)->restore();
        return redirect()->route('categories.index')->with('success', 'Khôi phục danh mục thành công');;
    }
    public function forceDelete($id) {
        Categories::withTrashed()->where('id',$id)->forceDelete();
        return redirect()->route('categories.trash')->with('success', 'Xóa danh mục thành công');;
    }
}
