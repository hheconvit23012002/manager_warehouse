<?php

namespace App\Http\Controllers\WareHouse;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Account;
use App\Models\Category;
use App\Models\Center;
use App\Models\Product;
use App\Models\TaxProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    use ResponseTrait;
    public function index(Request $request){
        try {
            $userLogin = \session()->get("user");
            $centerId = $userLogin->centerId;
            $taxs = TaxProduct::beLongsToCenter($centerId)->get();
            $categories = Category::beLongsToCenter($centerId)->get();
            $products = Product::beLongsToCenter($centerId)->with("category","tax")->paginate(15);
            return view('warehouse.product.index',
                compact('products',
                'taxs',
                'categories'
                )
            );
        }catch (\Exception $e){
            return redirect()->route('error');
        }
    }

    public function store(Request $request){
        $path = '';
        $userLogin = \session()->get("user");
        $centerId = $userLogin->centerId;
        try {
            DB::beginTransaction();
            $category = $request->get("category") ?? null;
            $image = $request->file("image") ?? null;
            $tax = $request->get("tax") ?? null;
            if(!is_null($image)){
                $path = Storage::disk('public')->putFile("image",$image);
            }
            if(!is_numeric($category) && !is_null($category)){
                $category = (Category::create([
                    'center_id' => $centerId,
                    'name'=> $category
                ]))->id;
            }
            $taxInstance = TaxProduct::where('id', $tax)->first();
            if(is_null($taxInstance) && !is_null($tax)){
                $tax = (TaxProduct::create([
                    'number' => $tax,
                    'center_id'=> $centerId
                ]))->id;
            }

            Product::create([
                'name' => $request->get("name"),
                'code' => $request->get("code"),
                'measurement_unit' => $request->get("measurement_unit"),
                'price' => $request->get("price"),
                'image' => $path,
                'category_id' => (int) $category !== 0 ? (int) $category : null,
                'tax_id' => (int) $tax !== 0 ? (int) $tax : null,
                'center_id' => $centerId,
                'created_id' => $userLogin->id
            ]);

            DB::commit();
            return redirect()->back()->with('success','Success');
        }catch (\Exception $e){
            File::delete(public_path("storage/" . $path));
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Create fail :'.$error );
        }
    }

    public function get(Request $request,$staffId){
        try {
            $staff = Product::findOrFail($staffId);
            return $this->successResponse($staff, 'get_success');
        }catch (\Exception $e){
            return $this->errorResponse('error',500);
        }
    }

    public function update(Request $request){
        $path = '';
        $userLogin = \session()->get("user");
        $centerId = $userLogin->centerId;
        try {
            DB::beginTransaction();
            $category = $request->get("category");
            $image = $request->file("image") ?? null;
            $productId = $request->get("product_id");
            $product = Product::where("id", $productId)->first();
            $pathOld = $product->image;

            if(!is_numeric($category) && !is_null($category)){
                $category = (Category::create([
                    'center_id' => $centerId,
                    'name'=> $category
                ]))->id;
            }
            $tax = $request->get("tax");
            $taxInstance = TaxProduct::where('id', $tax)->first();
            if(is_null($taxInstance) && !is_null($tax)){
                $tax = (TaxProduct::create([
                    'number' => $tax,
                    'center_id'=> $centerId
                ]))->id;
            }

            $dataUpdate = [
                'name' => $request->get("name"),
                'code' => $request->get("code"),
                'measurement_unit' => $request->get("measurement_unit"),
                'price' => $request->get("price"),
                'category_id' => (int) $category !== 0 ? (int) $category : null,
                'tax_id' => (int) $tax !== 0 ? (int) $tax : null,
                'center_id' => $centerId,
                'created_id' => $userLogin->id
            ];

            if(!is_null($image)){
                $path = Storage::disk('public')->putFile("image",$image);
                $dataUpdate["image"] = $path;
            }
            Product::where('id',$productId)->update($dataUpdate);

            DB::commit();
            if($path !== ""){
                File::delete(public_path("storage/" . $pathOld));
            }
            return redirect()->back()->with('success','Success');
        }catch (\Exception $e){
            File::delete(public_path("storage/" . $path));
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Update fail :'.$error );
        }
    }

    public function delete(Request $request){
        $path = '';

        try {
            DB::beginTransaction();
            $productId = $request->get('product_id');
            Product::where('id', $productId)->delete();

            DB::commit();
            return redirect()->back()->with('success','Success');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Delete fail :'.$error );
        }
    }

}
