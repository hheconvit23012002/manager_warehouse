<?php

namespace App\Http\Controllers\WareHouse;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Center;
use App\Models\HistoryAddNumberProduct;
use App\Models\Product;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HistoryAddNumberProductController extends Controller
{
    use ResponseTrait;

    public function index(){
        try {
            $userLogin = Auth::user();
            $centerId = $userLogin->center_id;
            $historyQuery = HistoryAddNumberProduct::query();
            $productQuery = Product::query();
            if($userLogin->position === Staff::POSITION_ADMIN_WAREHOUSE){
                $historyQuery = $historyQuery->whereHas(
                    'product', fn($query) => $query->where('center_id', $centerId)
                )->with('product.center');
                $productQuery = $productQuery->beLongsToCenter($centerId);
            }
            $histories = $historyQuery->latest()->paginate(15);
            $products = $productQuery->get();
            return view('warehouse.history.add_product',
                compact('histories',
                    'products',
                )
            );
        }catch (\Exception $e){
            return redirect()->route('error');
        }
    }

    public function addNumberProduct(Request $request){
        try {
            DB::beginTransaction();
            $productId = $request->get('product_id');
            $number = $request->get('number');
            $product = Product::query()->where('id', $productId)->firstOrFail();
            $startMonth = now()->startOfMonth();
            $endMonth = now()->endOfMonth();
            $numberInMonth = HistoryAddNumberProduct::query()
                ->whereHas('product', fn($q) => $q->where('center_id',$product->center_id) )
                ->whereBetween('created_at',[ $startMonth, $endMonth])
                ->count('id');
            $month = now()->month < 10 ? "0". now()->month : now()->month;
            $code = now()->year . $month . $this->formatNumberHistory($numberInMonth+1);
            HistoryAddNumberProduct::create([
                'product_id' => $productId,
                'number' => $number,
                'price' => $product->price,
                'code' => $code,
            ]);
            $product->number = $product->number + $number;
            $product->save();
            DB::commit();
            return redirect()->back()->with('success','Add success' );
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Add fail :'.$error );
        }
    }
    //
}
