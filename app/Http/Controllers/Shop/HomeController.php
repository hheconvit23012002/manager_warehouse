<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Center;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    use ResponseTrait;
    public function index(Request $request){
        $categoryIds = $request->get("category") ?? [];
        $centerId = $request->get("center_id") ?? null;
        if(is_null($centerId)){
            $categoryIds = [];
        }
        $products = Product::beLongsToCenter($centerId)
            ->whereIn('category_id', $categoryIds)
            ->get();
        $centers = Center::where("type" ,Center::TYPE_WAREHOUSE)->get();
        $categories = Category::beLongsToCenter($centerId)->get();
        return view('shop.home',compact(
            'centers',
            'categories',
            'centerId',
            'products',
        ));
    }

    public function addToCart(Request $request){
        try {
            DB::beginTransaction();
            $userLogin = \session()->get('user');
            $requestId = $userLogin->centerId;
            $productId = $request->get('product_id');
            $sellerId = $request->get('seller_id');

            $cart = Cart::firstOrCreate([
                    'seller_id' => $sellerId,
                    'request_id' => $requestId,
                ]);
            $cart->addToCart($productId);
            DB::commit();
            return $this->successResponse([],'Cart added successfully');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return $this->errorResponse($error);
        }
    }

    public function getInfoCheckOut(Request $request, $sellerId){
        try {
            $userLogin = \session()->get('user');
            $requestId = $userLogin->centerId;
            $cart = Cart::with('products')
                ->where('seller_id', $sellerId)
                ->where('request_id', $requestId)
                ->first();
            $products = [];
            if(!is_null($cart)){
                $products = $cart->products;
            }
            $center = Center::where('id', $requestId)->firstOrFail();
            return $this->successResponse([
                'products' => $products,
                'center' => $center
            ]);
        }catch (\Exception $e){
            $error = Str::limit($e->getMessage(),40);
            return $this->errorResponse($error);
        }
    }

    public function checkout(Request $request){
        try {
            DB::beginTransaction();
            $userLogin = \session()->get('user');
            $requestId = $userLogin->centerId;
            $sellerId = $request->get('seller_id');
            $cart = Cart::with('products','products.tax')
                ->where('seller_id', $sellerId)
                ->where('request_id', $requestId)
                ->firstOrFail();
            $order = Order::create([
                'request_id' => $requestId,
                'shipping_address' => $request->get('shipping_address'),
                'seller_id' => $sellerId,
                'phone_number' => $request->get('phone_number'),
                'desc' => $request->get('desc'),
                'status' => Order::STATUS_PENDING
            ]);
            $cartDetail = [];
            foreach ($cart->products as $product){
                $cartDetail[] = [
                    'product_id' => $product->id,
                    'order_id' => $order->id,
                    'price' => $product->price,
                    'number' => $product->pivot->number,
                    'tax' => $product->tax->number ?? '0',
                ];
            }

            OrderDetail::insert($cartDetail);
            $cart->products()->detach();
            DB::commit();
            return redirect()->back()->with('success','success');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error',$error);
        }
    }
    //
}
