<?php

namespace App\Http\Controllers;

use App\Models\mainCategory;
use Illuminate\Http\Request;
use Livewire\Attributes\Validate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Log;

class MainCategoryController extends Controller
{
    public function categoryCreatePage()
    {
        $list = mainCategory::get();
        // dd($list);
        return view('admin.category.create', ['list' => $list]);
    }

    //     public function mainCategoryCreate(Request $request)
    //     {
    //         // dd($request->all());

    //         // dd($request->main_category_image);
    //         $validator = Validator::make($request->all(), [
    //             'name' => 'required|string|max:255',
    //             'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
    //         ])->validate();



    //         $image = $request->file('image');
    //         // Save the image to the storage (you might want to use storage disk like 'public' or 's3')
    //         $categoryData = [
    //             'name' => $request->name,
    //         ];

    // if ($request->hasFile('image')) {
    //     try {
    //         // ၁။ Cloudinary ပေါ်တင်မယ် (folder နာမည်ကို 'mainCategory' လို့ ပေးထားပါတယ်)
    //         $uploadedFile = Cloudinary::upload($request->file('image')->getRealPath(), [
    //             'folder' => 'mainCategory'
    //         ]);

    //         // ၂။ Cloudinary ကပေးတဲ့ Secure URL ကို သိမ်းမယ်
    //         // ဒါမှမဟုတ် ပုံနာမည်ပဲ သိမ်းချင်ရင် $uploadedFile->getPublicId() ကို သုံးနိုင်ပါတယ်
    //         $categoryData['image'] = $uploadedFile->getSecurePath();

    //         Log::info('Category Image uploaded to Cloudinary: ' . $categoryData['image']);
    //     } catch (\Exception $e) {
    //         Log::error('Cloudinary Upload Error: ' . $e->getMessage());
    //     }
    // }

    //         mainCategory::create($categoryData);

    //         return redirect()->route('categoryCreatePage');
    //     }



    public function mainCategoryCreate(Request $request)
    {
        // 1. Validate request
        Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ])->validate();

        // 2. Prepare data
        $categoryData = [
            'name' => $request->name,
        ];

        try {

            // 3. Check and upload image
            if ($request->hasFile('image')) {

                $uploadedFile = Cloudinary::upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'mainCategory'
                    ]
                );

                // 4. Save Cloudinary secure URL
                $categoryData['image'] = $uploadedFile->getSecurePath();

                Log::info('Category Image uploaded successfully: ' . $categoryData['image']);
            } else {

                // safety fallback (should not happen because required validation)
                return back()->withErrors([
                    'image' => 'Image is required'
                ]);
            }

            // 5. Save DB only if everything OK
            mainCategory::create($categoryData);

            return redirect()
                ->route('categoryCreatePage')
                ->with('success', 'Main category created successfully');
        } catch (\Exception $e) {

            Log::error('Cloudinary Upload Error: ' . $e->getMessage());

            return back()->withErrors([
                'image' => 'Image upload failed. Please try again.'
            ]);
        }
    }


    public function mainCategoryEditPage($id)
    {
        $mainCategory = mainCategory::where('id', $id)->first();
        // dd($mainCategory->image);
        return view('admin/category/edit', ['mainCategory' => $mainCategory]);
    }

    // public function mainCategoryUpdate(Request $request)
    // {

    //     $validation = Validator::make($request->all(), [
    //         'image' => ['image', 'mimes:jpeg,png,jpg,gif'],
    //         'name' => ['required', 'string', 'max:255']
    //     ])->validate();

    //     $image = $request->file('image');
    //     //get old image name
    //     $oldImage = mainCategory::where('id', $request->id)->select('image')->first()->image;
    //     //delete old image
    //     if($oldImage != null){
    //         Storage::delete('public/mainCategory/' . $oldImage);
    //     }

    //     $data = [
    //         'name' => $request->name,
    //     ];

    //     //get new image
    //     if ($image != null) {
    //         $newImage = $request->image->getClientOriginalName();
    //         $image->storeAs('public/mainCategory', $newImage);
    //         $data['image'] =  $newImage;
    //     }


    //     mainCategory::where('id', $request->id)->update($data);
    //     return redirect()->route('categoryListPage');
    // }


    public function mainCategoryUpdate(Request $request)
    {
        // 1. Validate
        Validator::make($request->all(), [
            'id' => 'required|exists:main_categories,id',
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ])->validate();

        // 2. Find category
        $category = mainCategory::findOrFail($request->id);

        $data = [
            'name' => $request->name,
        ];

        try {

            // 3. If new image uploaded
            if ($request->hasFile('image')) {

                // OPTIONAL: old image delete (only if you saved public_id before)
                // if ($category->image_public_id) {
                //     Cloudinary::destroy($category->image_public_id);
                // }

                // Upload new image
                $uploadedFile = Cloudinary::upload(
                    $request->file('image')->getRealPath(),
                    [
                        'folder' => 'mainCategory'
                    ]
                );

                $data['image'] = $uploadedFile->getSecurePath();
            }

            // 4. Update DB
            $category->update($data);

            return redirect()
                ->route('categoryListPage')
                ->with('success', 'Main category updated successfully');
        } catch (\Exception $e) {

            Log::error('Main Category Update Error: ' . $e->getMessage());

            return back()->withErrors([
                'image' => 'Failed to update category'
            ]);
        }
    }



    public function mainCategoryDelete(Request $request)
    {
        // logger($request->id);
        //get old image name
        $oldImage = mainCategory::where('id', $request->id)->select('image')->first()->image;
        //delete old image
        if ($oldImage != null) {
            Storage::delete('public/mainCategory/' . $oldImage);
        }
        mainCategory::where('id', $request->id)->delete();
    }
}
