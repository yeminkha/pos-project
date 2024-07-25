<?php

namespace App\Http\Controllers;

use App\Models\category;
use App\Models\mainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    public function categoryCreate(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'main_category' => 'required',
            'category' => 'required|string|max:220'
        ])->validate();

        category::create([
            'main_category_id' => $request->main_category,
            'name' => $request->category
        ]);

        return redirect()->route('categoryCreatePage');
    }

    public function categoryListPage()
    {
        $categoryList = Category::join('main_categories', 'main_categories.id', '=', 'categories.main_category_id')
            ->select('main_categories.name as main_category_name', 'categories.*', 'main_categories.image')
            ->paginate(5);
        $mainCategoryList = mainCategory::paginate(5);

        return view('admin.category.list', [
            'categoryList' => $categoryList,
            'mainCategoryList' => $mainCategoryList
        ]);
    }

    public function categoryEditPage($key)
    {
        $list = mainCategory::all();
        $category = category::where('id', $key)
            ->first();
            // dd($category);
        return view('admin/category/mainEdit', ['category' => $category, 'list' => $list]);
    }

    public function categoryUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'main_category' => 'required',
            'category' => 'required|string|max:220'
        ])->validate();

        // dd($request->all());
        category::where('id',$request->categoryId)->update([
            'main_category_id' => $request->main_category,
            'name' => $request->category
        ]);

        return redirect()->route('categoryListPage');
    }

    public function categoryDelete(Request $request)
    {
        category::where('id', $request->id)->delete();
    }
}
