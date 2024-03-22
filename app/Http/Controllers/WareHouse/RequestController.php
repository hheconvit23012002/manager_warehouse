<?php

namespace App\Http\Controllers\WareHouse;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Cart;
use App\Models\Center;
use App\Models\HistoryRequest;
use App\Models\Order;
use App\Models\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class RequestController extends Controller
{
    use ResponseTrait;
    //
    public function index(Request $request){
        try {
            $userLogin = Auth::user();
            $sellerId = $userLogin->center_id;
            $requestQuery = Order::with('products','requester');
            if($userLogin->position === Staff::POSITION_ADMIN_WAREHOUSE){
                $requestQuery = $requestQuery->where('seller_id', $sellerId);
            }

            $requests = $requestQuery
                ->paginate(15);
            $status = Order::STATUS_LIST;
            return view('warehouse.request.index',[
                    'requests' => $requests,
                    'centerId' => $sellerId,
                    'status' => $status
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
    public function getProcessRequestById(Request $request,$requestId){
        try {
            $process = HistoryRequest::
                where('request_id', $requestId)
                ->get();
            return $this->successResponse([
                'process' => $process,
            ]);
        }catch (\Exception $e){
            return $this->errorResponse('error',500);
        }
    }

    public function changeStatus(Request $request){
        $path = '';

        try {
            DB::beginTransaction();
            $requestId = $request->get('request_id');
            $status = $request->get('status');
            $dataUpdateStatus = [
                'shipping_address' => $request->get('shipping_address'),
                'phone_number' => $request->get('phone_number'),
                'estimated_delivery_date' => $request->get('estimated_delivery_date'),
                'status' => $status
            ];
            $file = $request->file('file') ?? null;
            if(!is_null($file)){
                $path = Storage::disk('public')->putFile("request",$file);
            }
            $dataHistory = [
                'desc' => $request->get('desc'),
                'status' => $status,
                'request_id' =>$requestId,
                'file' => $path,
            ];
            Order::where('id', $requestId)->update($dataUpdateStatus);
            HistoryRequest::create($dataHistory);
            DB::commit();
            return redirect()->back()->with('success','success');
        }catch (\Exception $e){
            File::delete(public_path("storage/" . $path));
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error',$error);
        }
    }

    public function exportPdf(Request $request, $orderId){
        try {
            $now = now()->format('d.m.Y');
            $order = Order::with('products', 'requester', 'seller')
                ->where('id', $orderId)->firstOrFail();
            $pdf = Pdf::loadView('warehouse.request.exportPdf', [
                'order' => $order,
                'now' => $now,
            ]);
            return $pdf->download('itsolutionstuff.pdf');
        }catch (\Exception $e){
            dd($e);
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error',$error);
        }
    }
}
