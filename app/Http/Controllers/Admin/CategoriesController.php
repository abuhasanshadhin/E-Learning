<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Brian2694\Toastr\Facades\Toastr;

class CategoriesController extends Controller
{
    public function allCategory()
    {
        return view('admin.category.categories', [
            'categories' => Category::latest()->get()
        ]);
    }

    public function addCategoryForm()
    {
        return view('admin.category.add');
    }

    public function saveCategoryInfo(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $categoryData = $request->all();
        $uploadedImagePath = imageUpload($request, 'image', 'uploads', 270, 90);
        $categoryData['image'] = $uploadedImagePath;
        Category::create($categoryData);

        Toastr::success('Category Saved Successfully', 'Save');
        return redirect()->route('admin.all-category');
    }

    public function editCategory($id)
    {
        return view('admin.category.edit', [
            'category' => Category::find($id)
        ]);
    }

    public function updateCategory(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'image' => 'mimes:jpg,jpeg,png|max:2048'
        ]);

        $old_data = Category::find($request->id);

        $old_data->title = $request->title;
        if (isset($request->image)) {
            if (file_exists($old_data->image)) {
                unlink($old_data->image);
            }
            $uploadedImagePath = imageUpload($request, 'image', 'uploads', 270, 90);
            $old_data->image = $uploadedImagePath;
        }
        $old_data->save();

        Toastr::info('Category Updated Successfully', 'Update');
        return redirect()->route('admin.all-category');
    }

    public function deleteCategory(Request $request)
    {
        $category = Category::find($request->id);
        if (file_exists($category->image)) {
            unlink($category->image);
        }
        $category->delete();

        Toastr::success('Category Deleted Successfully', 'Delete');
        return redirect()->route('admin.all-category');
    }

}
