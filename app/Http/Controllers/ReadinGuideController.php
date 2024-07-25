<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReadinGuideController extends Controller
{
    public function servicePage(){
        return view('user/service');
    }

    public function readingGuide(){
        $readingGuideList = product::select('reading_guide')->groupBy('reading_guide')->get();
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

            $productList = Product::whereIn('name', $mostSoldProductIds->toArray())
                ->orderByRaw("FIELD(name, " . implode(',', $placeholders) . ")", $bindings)
                ->get();
        } else {
            $productList = collect();
        }
        return view ('user/readingGuide',with(['readingGuideList' => $readingGuideList,'productList' => $productList]));
    }

    public function readingGuideSearch($key)
    {
        $productList = product::where('reading_guide', $key)->get();
        $readingGuideList = product::select('reading_guide')->groupBy('reading_guide')->get();

        return view('user/readingGuide', ['productList' => $productList, 'readingGuideList' => $readingGuideList]);
    }

    public function readingGuideBookPage($key){
        $product = Product::select('products.*', 'r.max_rating_count', DB::raw('(SELECT COUNT(comment) FROM reactions WHERE product_id = ' . $key . ' AND comment != "") as total_comments'))
            ->leftJoin(DB::raw('(SELECT product_id, MAX(rating_count) as max_rating_count FROM reactions GROUP BY product_id) as r'), function ($join) {
                $join->on('products.id', '=', 'r.product_id');
            })
            ->where('products.id', $key)
            ->first();
        $readingGuide = product::where('id',$key)->select('reading_guide')->first()->reading_guide;
        $productList = product::where('reading_guide',$readingGuide)->get();
        return view('user/review',['product' => $product,'productList' => $productList]);
    }
}
