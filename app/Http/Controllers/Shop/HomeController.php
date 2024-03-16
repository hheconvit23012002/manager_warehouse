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
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    use ResponseTrait;
    public function index(Request $request){
        $userLogin = Auth::user();
        $categoryIds = $request->get("category") ?? [];
        $centerId = $request->get("center_id") ?? null;
        if(is_null($centerId)){
            $categoryIds = [];
        }
        $productQuery = Product::beLongsToCenter($centerId);
        if(count($categoryIds) > 0 ){
            $productQuery = $productQuery->whereIn('category_id', $categoryIds);
        }
        $products = $productQuery->get();
        $centers = Center::where("type" ,Center::TYPE_WAREHOUSE)->get();
        $categories = Category::beLongsToCenter($centerId)->get();
        $cart = Cart::with('products')
            ->where('seller_id', $centerId)
            ->where('request_id', $userLogin->center_id)
            ->first();
        $productHasAdd = ($cart->products ?? new Collection())->pluck('id')->toArray() ;
        foreach ($products as $product){
            if(in_array($product->id, $productHasAdd)){
                $productPivot = $cart->products->where('id', $product->id)->first();
                $product->hasAdd = $productPivot->pivot->number;
            }
        }
        return view('shop.home',compact(
            'centers',
            'categories',
            'centerId',
            'products',
        ));
    }

    public function changeCart(Request $request){
        try {
            DB::beginTransaction();
            $userLogin = Auth::user();
            $requestId = $userLogin->center_id;
            $productId = $request->get('product_id');
            $number = $request->get('number');
            $sellerId = $request->get('seller_id');

            $cart = Cart::firstOrCreate([
                    'seller_id' => $sellerId,
                    'request_id' => $requestId,
                ]);
            $number = $cart->changeCart($productId, $number);
            DB::commit();
            return $this->successResponse([
                'number' => $number
            ],'Cart added successfully');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return $this->errorResponse($error);
        }
    }

    public function enterNumberProduct(Request $request){
        try {
            DB::beginTransaction();
            $userLogin = Auth::user();
            $requestId = $userLogin->center_id;
            $productId = $request->get('product_id');
            $number = $request->get('number');
            $sellerId = $request->get('seller_id');
            $cart = Cart::where('seller_id', $sellerId)->where('request_id', $requestId)
                ->firstOrFail();

            $number = $cart->enterNumberProduct($productId, $number);
            DB::commit();
            return $this->successResponse([
                'number' => $number
            ],'Cart added successfully');
        }catch (\Exception $e){
            dd($e);
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
