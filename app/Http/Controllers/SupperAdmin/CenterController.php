<?php

namespace App\Http\Controllers\SupperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CenterController extends Controller
{
    use ResponseTrait;
    public function index(Request $request){
        try {
            $centers = Center::query()->paginate(15);
            $types = Center::LIST_TYPE;
            return view('supper_admin.center.index',
                compact('centers',
                    'types',
                )
            );
        }catch (\Exception $e){
            return redirect()->route('error');
        }
    }

    public function store(Request $request){
        $path = '';
        try {
            DB::beginTransaction();
            $logo = $request->file('logo');
            if(isset($logo)){
                $path = Storage::disk('public')->putFile("logo",$logo);
            }

            Center::create([
                'name'=> $request->get('name'),
                'zip_code'=> $request->get('code'),
                'address'=> $request->get('address'),
                'address2'=> $request->get('address2'),
                'email'=> $request->get('email'),
                'type' => $request->get('type'),
                'logo'=> $path,
                'phone_number'=> $request->get('phone_number'),
                'bank_account_number'=> $request->get('bank_account_number'),
                'bank_account_mame'=> $request->get('bank_account_mame'),
                'tax_code'=> $request->get('tax_code'),
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
            $center = Center::findOrFail($staffId);
            return $this->successResponse($center, 'get_success');
        }catch (\Exception $e){
            return $this->errorResponse('error',500);
        }
    }

    public function update(Request $request){
        $path = '';
        try {
            DB::beginTransaction();
            $logo = $request->file('logo');
            $centerId = $request->get('center_id');
            $dataUpdate = [
                'name'=> $request->get('name'),
                'zip_code'=> $request->get('code'),
                'address'=> $request->get('address'),
                'address2'=> $request->get('address2'),
                'email'=> $request->get('email'),
                'type' => $request->get('type'),
                'phone_number'=> $request->get('phone_number'),
                'bank_account_number'=> $request->get('bank_account_number'),
                'bank_account_mame'=> $request->get('bank_account_mame'),
                'tax_code'=> $request->get('tax_code'),
            ];
            if(isset($logo)){
                $path = Storage::disk('public')->putFile("logo",$logo);
                $dataUpdate['logo'] = $path;
            }

            $center = Center::where("id",$centerId)->firstOrFail();
            $oldPath = $center->logo;

            Center::where("id",$centerId)->update($dataUpdate);

            DB::commit();
            if($path !== ""){
                File::delete(public_path("storage/" . $oldPath));
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
        try {
            DB::beginTransaction();
            $centerId = $request->get('center_id');
            Center::where('id', $centerId)->delete();
            DB::commit();
            return redirect()->back()->with('success','Success');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Delete fail :'.$error );
        }
    }
    //
}
