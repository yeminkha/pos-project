<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\order;
use App\Models\arthur;
use App\Models\product;
use App\Models\category;
use App\Models\mainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function loginPage()
    {
        return view('login');
    }

    public function registerPage()
    {
        return view('register');
    }
    public function homePage()
    {

        $mostOrderId = Order::select('product_name', DB::raw('count(*) as total'))
            ->groupBy('product_name')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        $mostSoldProductIds = $mostOrderId->pluck('product_name');

        if ($mostSoldProductIds->isNotEmpty()) {
            $bindings = [];
            $placeholders = [];

            foreach ($mostSoldProductIds as $productName) {
                $bindings[] = $productName;
                $placeholders[] = '?';
            }

            $mostSoldProducts = Product::whereIn('name', $mostSoldProductIds->toArray())
                ->orderByRaw("FIELD(name, " . implode(',', $placeholders) . ")", $bindings)
                ->get();
        } else {
            $mostSoldProducts = collect();
        }



        $newProducts = Product::orderBy('created_at', 'desc')->limit(12)->get();

        $topRatedProductId = DB::table('reactions')
            ->select('product_id', DB::raw('AVG(rating_count) as average_rating'))
            ->groupBy('product_id')
            ->orderByDesc('average_rating')
            ->limit(10)
            ->get();

        if ($topRatedProductId->isNotEmpty()) {
            $orderedProductIds = $topRatedProductId->pluck('product_id')->toArray(); // Corrected to 'product_id'

            $topRatedProducts = Product::whereIn('id', $orderedProductIds)
                ->orderByRaw("FIELD(id, " . implode(',', $orderedProductIds) . ")")
                ->get();
        } else {
            $topRatedProducts = collect(); // or any default value you prefer
        }


        // dd($topRatedProducts);
        $mainCategory = mainCategory::get();
        $mainCategoryList = $mainCategory;
        $categoryList = category::get();
        $arthurList = product::select('arthur')->groupBy('arthur')->orderBy('arthur', 'desc');
        $editorChoiceProducts = product::where('editor_choice', 'True')->orderBy('created_at', 'desc')->get();



        return view('user/userhomePage')->with([
            'mostSoldProducts' => $mostSoldProducts,
            'newProducts' => $newProducts,
            'topRatedProducts' => $topRatedProducts,
            'editorChoiceProducts' => $editorChoiceProducts,
            'mainCategory' => $mainCategory,
            'mainCategoryList' => $mainCategoryList,
            'categoryList' => $categoryList,
            'arthurList' => $arthurList
        ]);
    }

    public function dashboard()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'user') {
                return redirect()->route('homePage');
            } elseif (Auth::user()->role == 'admin') {
                return redirect()->route('categoryCreatePage');
            }
        } else {
            return redirect()->route('homePage');
        }
    }

    private function implodeWithBindings($array)
    {
        return implode(',', array_fill(0, count($array), '?'));
    }
}
