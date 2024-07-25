<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TempOrderListController extends Controller
{

    public function getCart(Request $request)
    {

        // Retrieve input data
        $totalAmount = $request->input('total');
        $quantity = $request->input('quantity');
        $productId = $request->input('productId');
        $productImage = $request->input('image');
        $productName = $request->input('name');
        $productPrice = $request->input('price');

        // Retrieve the existing cart data from the session or initialize an empty array
        $tempOrderListData = $request->session()->get('tempOrderList', []);

        $productExists = false;
        foreach ($tempOrderListData as  &$item) {
            if ($item['productId'] == $productId) {
                // Uncomment the line below to update the quantity
                $item['quantity'] += $quantity;

                // Set $productExists to true since the product exists in the cart
                $productExists = true;


                // Exit the loop since we found the product
                break;
            }
        }

        // If the product is not found in the cart, add it as a new item
        if ($productExists == false) {
            $newItem = [
                'total' => $totalAmount,
                'productId' => $productId,
                'quantity' => $quantity,
                'image' => $productImage,
                'name' => $productName,
                'price' => $productPrice,
                'voucherCode' => random_int(10000, 100000000000),
            ];
            // Add the new item to the cart data
            array_push($tempOrderListData, $newItem);
            logger($tempOrderListData);
        }

        // Store the updated cart data in the session
        $request->session()->put('tempOrderList', $tempOrderListData);

        // Redirect to the book page with the product ID
        return redirect()->route('bookPage', ['id' => $productId]);
    }


    public function deleteTempList(Request $request)
    {
        // Retrieve the voucherCode from the request
        $voucherCode = $request->input('voucherCode');

        // Retrieve the temporary order list from the session
        $tempOrderList = $request->session()->get('tempOrderList', []);

        // Loop through the temporary order list to find the item with the matching voucher code
        foreach ($tempOrderList as $index => $item) {
            if ($item['voucherCode'] == $voucherCode) {
                // Remove the item with the matching voucher code
                unset($tempOrderList[$index]);

                // Update the session with the modified temporary order list
                $request->session()->put('tempOrderList', $tempOrderList);

                // Return a JSON response indicating success
                return response()->json(['success' => true]);
            }
        }

        // If the voucherCode doesn't exist in the list, return a JSON response indicating failure
        return response()->json(['success' => false, 'message' => 'Invalid voucherCode']);
    }

    public function tempOrderListPage()
    {
        return view('user/product/orderList');
    }

    public function updateSessionData(Request $request)
    {
        // Remove existing 'tempOrderList' session data
        $request->session()->forget('tempOrderList');

        // Retrieve items from the request
        $items = $request->items;

        // Initialize an empty array to store new items
        $tempOrderListData = [];

        // Iterate over each item and add it to the new items array
        foreach ($items as $item) {
            $tempOrderListData[] = $item;
        }

        // Store the new items array in the session
        $request->session()->put('tempOrderList', $tempOrderListData);

        // Return a JSON response indicating success
        return response()->json(['success' => true]);
    }
}
