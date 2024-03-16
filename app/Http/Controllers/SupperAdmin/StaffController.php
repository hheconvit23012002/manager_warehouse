<?php

namespace App\Http\Controllers\SupperAdmin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Account;
use App\Models\Center;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class StaffController extends Controller
{
    use ResponseTrait;
    public function index(Request $request){
        try {
            $staff = Staff::query()->paginate(15);
            $positions = Staff::LIST_PERMISSION_WHEN_CREATE_STAFF;
            $center = Center::query()->get();
            return view('supper_admin.staff.index',
                compact('staff',
                    'positions',
                    'center',
                )
            );
        }catch (\Exception $e){
            return redirect()->route('error');
        }
    }

    public function store(Request $request){

        try {
            DB::beginTransaction();
            $password = $request->get('password') ?? '';
            $spAdmin = $request->get('supper_admin') ?? null;
            $centerId = $request->get('center');
            $center = Center::where('id', $centerId)->first();
            $position = '';
            if(!is_null($spAdmin)){
                $position = Staff::POSITION_SUPPER_ADMIN;
                $centerId = null;
            }else{
                if($center->type === Center::TYPE_WAREHOUSE){
                    $position = Staff::POSITION_ADMIN_WAREHOUSE;
                }
                else if($center->type === Center::TYPE_SHOP){
                    $position = Staff::POSITION_ADMIN_SHOP;
                }
            }


            $staff = Staff::create([
                'name'=> $request->get('name'),
                'code'=> $request->get('code'),
                'email'=> $request->get('email'),
                'position' => $position,
                'phone_number'=> $request->get('phone_number'),
                'center_id' => $centerId,
                'username' => $request->get('username'),
                'password' => Hash::make($password),
                'status' => Staff::STATUS_ACTIVE,
            ]);

            DB::commit();
            return redirect()->back()->with('success','Success');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Create fail :'.$error );
        }
    }

    public function get(Request $request,$staffId){
        try {
            $staff = Staff::findOrFail($staffId);
            return $this->successResponse($staff, 'get_success');
        }catch (\Exception $e){
            return $this->errorResponse('error',500);
        }
    }

    public function update(Request $request){
        $path = '';

        try {
            DB::beginTransaction();
            $staffId = $request->get('staff_id');
            $password = $request->get('password') ?? '';
            $spAdmin = $request->get('supper_admin') ?? null;
            $centerId = $request->get('center');
            $position = '';
            if(!is_null($spAdmin)){
                $position = Staff::POSITION_SUPPER_ADMIN;
                $centerId = null;
            }else{
                $center = Center::where('id', $centerId)->first();

                if($center->type === Center::TYPE_WAREHOUSE){
                    $position = Staff::POSITION_ADMIN_WAREHOUSE;
                }
                else if($center->type === Center::TYPE_SHOP){
                    $position = Staff::POSITION_ADMIN_SHOP;
                }
            }

            $dataUpdate = [
                'name'=> $request->get('name'),
                'code'=> $request->get('code'),
                'email'=> $request->get('email'),
                'position' => $position,
                'phone_number'=> $request->get('phone_number'),
                'center_id' => $centerId,
                'username' => $request->get('username'),

            ];
            if(!is_null($password) && $password !== ''){
                $dataUpdate['password'] = Hash::make($password);
            }

            Staff::where('id', $staffId)->update($dataUpdate);

            DB::commit();
            return redirect()->back()->with('success','Success');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Update fail :'.$error );
        }
    }

    public function delete(Request $request){
        $path = '';

        try {
            DB::beginTransaction();
            $staffId = $request->get('staff_id');
            Staff::where('id', $staffId)->delete();

            DB::commit();
            return redirect()->back()->with('success','Success');
        }catch (\Exception $e){
            DB::rollBack();
            $error = Str::limit($e->getMessage(),40);
            return redirect()->back()->with('error','Delete fail :'.$error );
        }
    }

    public function exactParam($request){
        return $request;
    }
}
