<?php

namespace App\Http\Controllers\WareHouse;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Cart;
use App\Models\Center;
use App\Models\Order;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    use ResponseTrait;
    //
    public function index(Request $request){
        try {
            $userLogin = \session()->get("user");
            $sellerId = $userLogin->centerId;
            $requests = Order::with('products','requester')->where('seller_id', $sellerId)
                ->paginate(15);
            return view('warehouse.request.index',[
                    'requests' => $requests,
                    'centerId' => $sellerId
                ]
            );
        }catch (\Exception $e){
            return redirect()->route('error');
        }
    }

    public function get(Request $request,$requestId){
        try {
            $order = Order::with('products')
                ->where('id', $requestId)
                ->first();
            return $this->successResponse([
                'order' => $order,
            ]);
        }catch (\Exception $e){
            return $this->errorResponse('error',500);
        }
    }

    public function changeStatus(Request $request){
        try {
            DB::beginTransaction();
            $userLogin = \session()->get("user");
            $sellerId = $userLogin->centerId;
            $requestId = $request->get('request_id');
            $dataUpdate= [
                'shipping_address' => $request->get('shipping_address'),
                'phone_number' => $request->get('phone_number'),
                'desc' => $request->get('desc'),
                'estimated_delivery_date' => $request->get('estimated_delivery_date'),
            ];
            if(($request->get('submit')?? null) === Order::STATUS_REJECT){
                $dataUpdate['status'] = Order::STATUS_REJECT;
            }else{
                $dataUpdate['status'] = Order::STATUS_ACCEPT;
            }
            Order::where('id', $requestId)->where('seller_id',$sellerId)->update($dataUpdate);
            DB::commit();
            return redirect()->back()->with('success','success');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error',$error);
        }
    }

    public function exportPdf(Request $request, $orderId){
        try {
            $userLogin = \session()->get("user");
            $sellerId = $userLogin->centerId;
            $order = Order::with('products')
                ->where('seller_id',$sellerId)
                ->where('id', $orderId)->firstOrFail();
            $pdf = Pdf::loadView('warehouse.request.exportPdf', [
                'order' => $order
            ]);
            return $pdf->download('itsolutionstuff.pdf');
        }catch (\Exception $e){
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error',$error);
        }
    }
}
