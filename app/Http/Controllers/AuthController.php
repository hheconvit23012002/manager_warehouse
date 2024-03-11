<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Traits\ResponseTrait;
use App\Models\Account;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    use ResponseTrait;
    public function login(Request $request){
        try {
            return view("auth.login");
        }catch (\Exception $e){
            return redirect()->route("error");
        }
    }

    public function processLogin(Request $request){
        try {
            $username = $request->get("username");
            $password = $request->get("password");
            $user = Account::with("staff")->where('username', $username)
                ->firstOrFail();
            if (!Hash::check($password, $user->password) || $user->status === Account::STATUS_BLOCK) {
                throw new \Exception('Login failed');
            }


            $user->position = $user->staff->position;
            $user->centerId = $user->staff->center_id;
            $user->avatar = $user->staff->avatar;

            if (isset($user)) {
                Session::put("user", $user);
//                Auth::login($user);
            }

            if($user->position === Staff::POSITION_ADMIN_WAREHOUSE){
                return redirect()->route("admin.web.product.index");
            }else if($user->position === Staff::POSITION_ADMIN_SHOP){
                return redirect()->route("home");
            }else if($user->position === Staff::POSITION_SUPPER_ADMIN){
                return redirect()->route("admin.web.staff.index");
            }
        }catch(\Exception $e){
            return redirect()->back()->with("error", "Login failed");
        }
    }

    public function logout(){
        try {
            Session::forget('user');
            return redirect()->route('login');
        }catch (\Exception $e){
            return redirect()->route("error");
        }
    }
    //
}
