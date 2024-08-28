<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\arthur;
use App\Models\product;
use App\Models\category;
use App\Models\reaction;
use App\Models\mainCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isEmpty;

class allbookController extends Controller
{
    public function newBooks()
    {
        $list = Product::leftJoin(DB::raw('(SELECT product_id, COUNT(*) as comment_count, AVG(rating_count) as average_rating
                                    FROM reactions
                                    GROUP BY product_id) as reactions'), 'products.id', '=', 'reactions.product_id')
            ->orderBy('products.created_at', 'desc')
            ->get(['products.*', 'reactions.comment_count', 'reactions.average_rating']);

        return view('user/bookList', ['list' => $list, 'title' => 'အသစ်ထွက်စာအုပ်များ']);
    }

    public function mostSell()
    {
        $mostOrderName = order::select('product_name', DB::raw('count(*) as total'))
            ->groupBy('product_name')
            ->orderByDesc('total')
            ->get();

        // dd($mostOrderName);
        $mostSoldProductIds = $mostOrderName->pluck('product_name');
        $bindings = [];
        $placeholders = [];

        foreach ($mostSoldProductIds as $productName) {
            $bindings[] = $productName;
            $placeholders[] = '?';
        }

        $list = Product::whereIn('name', $mostSoldProductIds->toArray())
            ->orderByRaw("FIELD(name, " . implode(',', $placeholders) . ")", $bindings)
            ->get();

        // dd($mostSoldProduct);s

        return view('user/bookList', ['list' => $list, 'title' => 'အရောင်းရဆုံးစာအုပ်များ']);
    }

    public function editorFav()
    {

        $list = product::where('editor_choice', 'True')->get();
        return view('user/bookList', ['list' => $list, 'title' => 'Editor အဖွဲစိတ်ကြိုက်စာအုပ်များ']);
    }

    public function suya()
    {
        $list = product::where('reward', 'True')->get();
        return view('user/bookList', ['list' => $list, 'title' => 'စာပေဆုရစာအုပ်များ']);
    }

    public function classic()
    {
        $list = product::where('classic', 'True')->get();
        return view('user/bookList', ['list' => $list, 'title' => 'မြန်မာစာပေ ဂန္ထဝင်စာအုပ်များ']);
    }

    public function dropSearchList($key)
    {
        // dd($key);
        // $category = Category::join('products', 'categories.id', '=', 'products.category_name')
        //     ->select('categories.*')
        //     ->withCount('products')
        //     ->get();


        // $productCounts = Product::select('arthur', DB::raw('COUNT(*) as product_count'))
        //             ->groupBy('arthur')
        //             ->get();
        // dd($productCounts);

        switch ($key) {
            case 'cati':
                $title = 'စာအုပ်အမျိုးအစားများဖြင့် စာအုပ်စုစည်းမှု';
                $list = category::all();
                $mainList = mainCategory::all();
                $productCounts = Product::select('category_name', DB::raw('COUNT(*) as product_count'))
                    ->groupBy('category_name')
                    ->get();
                if (isEmpty($mainList)) {
                    $data = [
                        'title' => $title,
                        'list' => $list,
                        'mainList' => $mainList,
                        'productCounts' => $productCounts
                    ];
                    return view('user/dropList', $data);
                } else {
                    return back();
                }
                break;
            case 'arthur':
                $title = 'စာရေးဆရာအမည်ဖြင့် စာအုပ်စုစည်းမှု';
                $burmese = Arthur::select('name', 'id')
                    ->whereRaw("name REGEXP '[က-အ]+'")
                    ->get();
                $english = Arthur::select('name', 'id')
                    ->whereRaw("name REGEXP '[A-Za-z]+'")
                    ->get();

                $list = [['မြန်မာ အက္ခရာ (က မှ အ)' => $burmese], ['အင်္ဂလိပ် အက္ခရာ (A မှ Z)' => $english]];
                $mainList = [['name' => 'မြန်မာ အက္ခရာ (က မှ အ)'], ['name' => 'အင်္ဂလိပ် အက္ခရာ (A မှ Z)']];
                $productCounts = Product::select('arthur', DB::raw('COUNT(*) as product_count'))
                    ->groupBy('arthur')
                    ->get();
                // dd($productCounts);
                $arthurs = arthur::select('name')->distinct()->pluck('name')->toArray();
                if (isEmpty($productCounts)) {
                    $data = [
                        'title' => $title,
                        'list' => $list,
                        'mainList' => $mainList,
                        'productCounts' => $productCounts,
                        'arthurs' => $arthurs
                    ];
                    return view('user/arthurDrop', $data);
                } else {
                    return back();
                }

                break;

            default:
                # code...
                break;
        }
    }

    public function bookSearch($key)
    {
        $categoryName = category::select('name')->where('id', $key)->get();
        $categoryName = $categoryName[0]->name;
        $list = product::where('category_name', $key)->get();
        return view('user/bookList', ['list' => $list, 'title' => $categoryName]);
    }
    public function bookSearchMain($key)
    {
        $mainCategoryId = mainCategory::select('name')->where('id', $key)->get();
        $mainCategoryName = $mainCategoryId[0]->name;
        $subQuery = DB::table('reactions')
            ->select('product_id', DB::raw('AVG(rating_count) as average_rating'), DB::raw('COUNT(id) as comment_count'))
            ->groupBy('product_id');

        $list = DB::table('products')
            ->where('main_category_name', $key)
            ->leftJoinSub($subQuery, 'reactions', function ($join) {
                $join->on('products.id', '=', 'reactions.product_id');
            })
            ->select(
                'products.*',
                'reactions.average_rating',
                'reactions.comment_count'
            )
            ->get();

        return view('user/bookList', ['list' => $list, 'title' => $mainCategoryName]);
    }

    public function arthurSearch($key)
    {
        $id = product::where('arthur', $key)->select('id')->get();
        $list = product::where('arthur', $key)->get();
        return view('user/bookList', ['list' => $list, 'title' => $key, 'id' => $id]);
    }
    public function arthurSearchInput(Request $request)
    {
        $id = product::where('arthur', $request->arthur_name)->select('id')->get();
        $list = product::where('arthur', $request->arthur_name)->get();
        return view('user/bookList', ['list' => $list, 'title' => $request->arthur_name, 'id' => $id]);
    }

    public function book(Request $request)
    {
        $book = product::select('id')->where('name', $request->name)->first();


        if ($book == null) {
            return view('/user/noBook');
        } else {
            $bookId = product::select('id')->where('name', $request->name)->first()['id'];
            return redirect('/bookPage/' . $bookId);
        }
    }
}
