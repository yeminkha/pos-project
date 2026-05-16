<?php

namespace App\Http\Controllers;

use App\Models\mainCategory;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class MainCategoryController extends Controller
{
    public function categoryCreatePage()
    {
        $list = mainCategory::get();
        // dd($list);
        return view('admin.category.create', ['list' => $list]);
    }

    public function mainCategoryCreate(Request $request)
    {
        // dd($request->all());

        // dd($request->main_category_image);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
        ])->validate();



        $image = $request->file('image');
        // Save the image to the storage (you might want to use storage disk like 'public' or 's3')
        $categoryData = [
            'name' => $request->name,
        ];

if ($request->hasFile('image')) {
    try {
        // ၁။ Cloudinary ပေါ်တင်မယ် (folder နာမည်ကို 'mainCategory' လို့ ပေးထားပါတယ်)
        $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
            'folder' => 'mainCategory'
        ]);

        // ၂။ Cloudinary ကပေးတဲ့ Secure URL ကို သိမ်းမယ်
        // ဒါမှမဟုတ် ပုံနာမည်ပဲ သိမ်းချင်ရင် $uploadedFile->getPublicId() ကို သုံးနိုင်ပါတယ်
        $categoryData['image'] = $uploadedFile->getSecurePath();

        Log::info('Category Image uploaded to Cloudinary: ' . $categoryData['image']);
    } catch (\Exception $e) {
        Log::error('Cloudinary Upload Error: ' . $e->getMessage());
    }
}

        mainCategory::create($categoryData);

        return redirect()->route('categoryCreatePage');
    }

    public function mainCategoryEditPage($id)
    {
        $mainCategory = mainCategory::where('id', $id)->first();
        // dd($mainCategory->image);
        return view('admin/category/edit', ['mainCategory' => $mainCategory]);
    }

    public function mainCategoryUpdate(Request $request)
    {

        $validation = Validator::make($request->all(), [
            'image' => ['image', 'mimes:jpeg,png,jpg,gif'],
            'name' => ['required', 'string', 'max:255']
        ])->validate();

        $image = $request->file('image');
        //get old image name
        $oldImage = mainCategory::where('id', $request->id)->select('image')->first()->image;
        //delete old image
        if($oldImage != null){
            Storage::delete('public/mainCategory/' . $oldImage);
        }

        $data = [
            'name' => $request->name,
        ];

        //get new image
        if ($image != null) {
            $newImage = $request->image->getClientOriginalName();
            $image->storeAs('public/mainCategory', $newImage);
            $data['image'] =  $newImage;
        }


        mainCategory::where('id', $request->id)->update($data);
        return redirect()->route('categoryListPage');
    }

    public function mainCategoryDelete(Request $request)
    {
        // logger($request->id);
        //get old image name
        $oldImage = mainCategory::where('id', $request->id)->select('image')->first()->image;
        //delete old image
        if($oldImage != null){
            Storage::delete('public/mainCategory/' . $oldImage);
        }
        mainCategory::where('id', $request->id)->delete();
    }
}
