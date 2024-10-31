<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    public function orderPage()
    {
        return view('user/product/order');
    }
    public function order(Request $request)
    {
        // dd($request->all());

        $valiRule = $this->valiRule($request->all());

        $validator = Validator::make($request->all(), $valiRule);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $tempOrderListData = $request->session()->get('tempOrderList', []);

        $orderCode = random_int(10000, 100000000000);
        foreach ($tempOrderListData as $item) {
            $data = [
                'user_name' => $request->userName,
                'phone' => strval($request->phone),
                'address' => $request->address,
                'status' => 1,
                'product_name' => $item['name'],
                'quantity' => $item['quantity'],
                'price' => $item['price'],
                'total' => $item['total'],
                'image' => $item['image'],
                'orderCode' => $orderCode,
            ];
            if ($request->has('smileGift')) {
                $data['smile_gift'] = $request->smileGift;
            }
            if ($request->has('theme')) {
                $data['theme'] = $request->theme;
            }
            if ($request->has('email')) {
                $data['email'] = $request->email;
            }
            if ($request->has('message')) {
                $data['message'] = $request->message;
            }
            if ($request->has('wishLetter')) {
                $data['wish'] = $request->wishLetter;
            }

            order::create($data);
            if (session()->has('tempOrderList')) {
                // Now, remove 'tempOrderList' from session after order confirmation
                session()->forget('tempOrderList');
            }
        }


        return redirect()->route('homePage');
    }


    public function orderListPage()
    {
        $groupList = Order::select('created_at', 'phone', 'user_name', 'status', 'orderCode', 'smile_gift')
            ->groupBy('created_at', 'phone', 'user_name', 'status', 'orderCode', 'smile_gift')
            ->orderBy('created_at', 'asc')
            ->paginate(5);

        $orderList = [];

        foreach ($groupList as $group) {
            $orders = Order::where('phone', $group->phone)
                ->where('created_at', $group->created_at)
                ->get();

            $orderList[] = $orders;
        }



        // dd($groupList);

        return view('admin.order.listGroup', ['groupList' => $groupList, 'orderList' => $orderList]);
    }

    public function seeOrderPage(Request $request, $key)
    {
        $orderLists = order::where('orderCode', $key)->get();
        $products = product::get();

        return view('admin.order.list', ['orderLists' => $orderLists, 'products' => $products]);
    }

    public function orderStatusChange(Request $request)
    {
        // logger($request);
        order::where('orderCode', $request->orderCode)->update(['status' => $request->status]);
        return response()->json(['success' => true]);
    }

    public function orderedBookPage()
    {
        $groupList = Order::selectRaw('created_at, phone, status, orderCode, SUM(quantity) as total_quantity, SUM(total) as total_amount')
            ->groupBy('created_at', 'phone', 'status', 'orderCode')
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        foreach ($groupList as $group) {
            if ($group->phone == Auth::user()->phone) {
                $orderList[] = $group;
            }
        }


        return view('user.acc.orderedBook', ['orderList' => $orderList]);
    }

    public function orderDetail($key)
    {
        $vouncher = order::where('orderCode', $key)->get();
        return view('user.acc.vouncher', ['vouncher' => $vouncher]);
    }


    private function valiRule($requestData)
    {
        $valiRule = [
            'userName' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'string', 'email', 'max:255'],
            'phone' => ['numeric', 'digits_between:1,15', 'required'],
            'address' => ['string', 'required'],
        ];

        if (isset($requestData['smileGift'])) {
            $valiRule['theme'] = ['required'];
        }
        if (isset($requestData['theme'])) {
            $valiRule['smileGift'] = ['required'];
        }

        return $valiRule;
    }
}
