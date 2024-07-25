<?php

namespace App\Http\Controllers;

use App\Models\arthur;
use App\Models\product;
use App\Models\category;
use App\Models\reaction;
use App\Models\mainCategory;
use Illuminate\Http\Request;
use App\Models\tempOrderList;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function productCreatePage()
    {
        // $mainCategories = Product::select('main_category_name')->distinct()->pluck('main_category_name')->toArray();
        // $categories = Product::select('category_name')->distinct()->pluck('category_name')->toArray();
        $mainCategories = mainCategory::all();
        $categories = category::all();
        $arthurs = arthur::select('name')->distinct()->pluck('name')->toArray();
        $readingGuides = product::select('reading_guide')->distinct()->pluck('reading_guide')->toArray();
        $bookSizes = product::select('size')->distinct()->pluck('size')->toArray();
        return view('admin.product.create')->with([
            'mainCategories' => $mainCategories,
            'categories' => $categories,
            'readingGuides' => $readingGuides,
            'bookSizes' => $bookSizes,
            'arthurs' => $arthurs,
        ]);
    }

    public function productCreate(Request $request)
    {
        $this->vali($request);

        $image = $request->file('image');
        // Save the image to the storage (you might want to use storage disk like 'public' or 's3')
        $image->storeAs('public/books', $request->image->getClientOriginalName());

        $sideImage1 = $request->file('sideImage1');
        if ($request->hasFile('sideImage1')) {
            $sideImage1->storeAs('public/books', $request->sideImage1->getClientOriginalName());
        }

        $sideImage2 = $request->file('sideImage2');
        if ($request->hasFile('sideImage2')) {
            $sideImage2->storeAs('public/books', $request->sideImage2->getClientOriginalName());
        }


        $productData = $this->data($request);

        arthur::create(['name' => $request->arthur]);

        product::create($productData);

        return redirect()->route('productCreatePage');
    }

    public function productListPage()
    {
        $productList = product::paginate(5);
        return view('admin.product.list')->with(['productList' => $productList]);
    }

    public function productEditPage(Request $request, $key)
    {
        $product = product::where('id', $key)->first();
        // $mainCategories = Product::select('main_category_name')->distinct()->pluck('main_category_name')->toArray();
        // $categories = Product::select('category_name')->distinct()->pluck('category_name')->toArray();
        $mainCategories  = mainCategory::get();
        $categories = category::get();
        $readingGuides = product::select('reading_guide')->distinct()->pluck('reading_guide')->toArray();
        $bookSize = product::select('size')->distinct()->pluck('size')->toArray();
        return view('admin/product/edit')->with([
            'product' => $product,
            'mainCategories' => $mainCategories,
            'categories' => $categories,
            'readingGuides' => $readingGuides,
            'bookSize' => $bookSize
        ]);
    }

    public function productUpdate(Request $request)
    {
        $this->vali($request);

        // Usage for the main image
        $this->updateImage($request, 'image');

        // Usage for sideImage1
        $this->updateImage($request, 'sideImage1');

        $this->updateImage($request, 'sideImage2');

        $productData = $this->data($request);

        product::where('id', $request->productId)->update($productData);
        return redirect()->route('productListPage');
    }

    public function productDelete(Request $request)
    {
        // logger($request->id);
        //get old image name
        $oldImage = product::where('id', $request->id)->select('image')->first()->image;
        //delete old image
        Storage::delete('public/books/' . $oldImage);
        product::where('id', $request->id)->delete();
    }

    public function bookPage($id)
    {
        $product = Product::select('products.*', 'r.max_rating_count', DB::raw('(SELECT COUNT(comment) FROM reactions WHERE product_id = ' . $id . ' AND comment != "") as total_comments'))
            ->leftJoin(DB::raw('(SELECT product_id, AVG(rating_count) as max_rating_count FROM reactions GROUP BY product_id) as r'), function ($join) {
                $join->on('products.id', '=', 'r.product_id');
            })
            ->where('products.id', $id)
            ->first();


        // dd($product);
        $comments = Reaction::where('reactions.product_id', $id)
            ->whereNotNull('reactions.comment')
            ->where('reactions.comment', '!=', '') // Exclude empty strings
            ->join('users', 'reactions.user_id', '=', 'users.id')
            ->select('reactions.comment', 'reactions.rating_count', 'reactions.created_at', 'users.name as user_name', 'users.image')
            ->get();


        // dd($comments);
        $arthur = $product->arthur;
        $suggest = product::where('arthur', $arthur)->get();
        // if (Auth::check()) {
        //     $tempOrderList = tempOrderList::where('user_id', Auth::user()->id)->get();
        //     dd($tempOrderList);
        // } else {
        //     $tempOrderList = null;
        // }
        // dd($suggest);
        $productData = [
            'product' => $product,
            'suggest' => $suggest,
            'comments' => $comments,
            'tempOrderList' => null
        ];


        if(session('tempOrderList')){
            $tempOrderList = session('tempOrderList');
            $productData['tempOrderList'] = $tempOrderList;
        }
        return view('user.product.main')->with($productData);
    }

    private function vali($request)
    {
        $valirules = [
            'name' => ['required', 'string', 'max:255'],
            'image' => ['image', 'mimes:jpeg,png,jpg,gif'],
            'sideImage1' => ['image', 'mimes:jpeg,png,jpg,gif'],
            'sideImage2' => ['image', 'mimes:jpeg,png,jpg,gif'],
            'arthur' => ['required', 'string', 'max:255'],
            'mainCategoryId' => ['required', 'string', 'max:255'],
            'categoryId' => ['required', 'string', 'max:255'],
            'readingGuide' => ['required', 'string', 'max:255'],
            'pages' => ['required'],
            'printRecord' => ['required', 'string', 'max:255'],
            'size' => ['required', 'string', 'max:255'],
            'inStock' => ['required'],
            'price' => ['required'],
        ];

        // Check if the request contains an ID (indicating an update operation)
        if ($request->has('productId')) {
            // For updating: image is not required
            $valirules['image'] = ['image', 'mimes:jpeg,png,jpg,gif'];
        } else {
            // For creation: image is required
            $valirules['image'] = ['required', 'image', 'mimes:jpeg,png,jpg,gif'];
        }

        $validator = Validator::make($request->all(), $valirules)->validate();
    }

    //image store
    private function updateImage($request, $fieldName)
    {
        if ($request->hasFile($fieldName)) {
            // Retrieves the uploaded image file
            $image = $request->file($fieldName);

            // Retrieves the name of the old image from the database
            $oldImage = product::where('id', $request->productId)->select($fieldName)->first()->$fieldName;

            // Deletes the old image file from storage
            Storage::delete('public/books/' . $oldImage);

            // Retrieves the original name of the new image file
            $newImage = $request->$fieldName->getClientOriginalName();

            // Stores the new image file in the storage directory
            $image->storeAs('public/books', $newImage);
        }
    }

    private function data($request)
    {
        $data = [
            'name' => $request->name,
            'arthur' => $request->arthur,
            'main_category_name' => $request->mainCategoryId,
            'category_name' => $request->categoryId,
            'reading_guide' => $request->readingGuide,
            'pages' => $request->pages,
            'print_record' => $request->printRecord,
            'size' => $request->size,
            'in_stock' => $request->inStock,
            'price' => $request->price,
            'reward' => $request->reward,
            'classic' => $request->classic,
            'editor_choice' => $request->editorChoice
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->image->getClientOriginalName();
        }


        // Handle sideImage1 file
        if ($request->hasFile('sideImage1')) {
            $data['sideImage1'] = $request->sideImage1->getClientOriginalName();
        }

        // Handle sideImage2 file
        if ($request->hasFile('sideImage2')) {
            $data['sideImage2'] = $request->sideImage2->getClientOriginalName();
        }

        if ($request->description) {
            $data['description'] = $request->description;
        } else {
            $data['description'] = '.....';
        }

        return $data;
    }
}
