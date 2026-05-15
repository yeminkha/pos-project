<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AccController extends Controller
{
    public function accEdit()
    {
        return view('admin/account/edit');
    }

    public function accUpdate(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required|max:20',
            'email' => 'sometimes|nullable|email|required_if:phone,null',
            'phone' => 'sometimes|nullable|numeric|required_if:email,null',
            'image' => 'sometimes|nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add image validation
        ])->validate();

        $data = [
            'name' => $request->name,
            'email' => $request->email ?? null,
            'phone' => $request->phone ?? null,
            'address' => $request->address ?? null,
            'gender' => $request->gender,
        ];


        // if ($request->hasFile('image')) {
        //     $image = $request->file('image');
        //     $oldImage = User::where('id', Auth::user()->id)->value('image');

        //     // Check if the old image exists before attempting to delete it
        //     if ($oldImage && Storage::exists('public/profile_images/' . $oldImage)) {
        //         // Delete old image
        //         Storage::delete('public/profile_images/' . $oldImage);
        //     }

        //     // Get new image name with a random number appended
        //     $newImage = $this->generateRandomImageName($image);

        //     try {
        //         // Save new image to storage
        //         $path = $image->storeAs('public/profile_images', $newImage);
        //         Log::info('Image stored at: ' . $path);

        //         $data['image'] = $newImage;
        //     } catch (\Exception $e) {
        //         Log::error('Failed to store image: ' . $e->getMessage());
        //     }
        // }
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $oldImage = User::where('id', Auth::user()->id)->value('image');

            // Check if the old image exists before attempting to delete it
            if ($oldImage && Storage::exists('public/profile_images/' . $oldImage)) {
                // Delete old image
                Storage::delete('public/profile_images/' . $oldImage);
            }

            // Get new image name with a random number appended
            $newImage = $this->generateRandomImageName($image);

            try {
                // Save new image to storage
                $path = $image->storeAs('public/profile_images', $newImage);
                Log::info('Image stored at: ' . $path);

                $data['image'] = $newImage;
            } catch (\Exception $e) {
                Log::error('Failed to store image: ' . $e->getMessage());
            }
        }


        User::where('id', Auth::user()->id)->update($data);

        return back();
    }

    public function passEdit()
    {
        return view('admin/account/password');
    }

    public function passUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'oldPassword' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The old password is incorrect.');
                    }
                },
            ],
            'newPassword' => 'required|min:8',
            'newPasswordConfirmation' => 'required|same:newPassword',
        ])->validate();

        User::where('id', Auth::user()->id)->update(['password' => Hash::make($request->oldPassword)]);
        return redirect()->route('passEdit')->with('success', 'Password updated successfully');
    }

    //user
    public function mainPage()
    {
        return view('user.acc.about');
    }

    public function accInfo()
    {
        $userInfo = User::where('id', Auth::user()->id)->first();
        return view('user.acc.accInfo');
    }

    private function generateRandomImageName($file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $random = rand(1000, 100000); // Adjust the range of the random number as needed

        return $filename . '_' . $random . '.' . $extension;
    }
}
