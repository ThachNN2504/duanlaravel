<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\dangKyValid;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;

class ThanhvienController extends Controller
{
    public function __construct()
    {
        // $cart = session()->get('cart');
        // dd($cart);
        $this->middleware(function ($request, $next) {
            $amount = 0;
            // $user_id = session('user_id');
            if (session::exists('cart')) {
                $cart = $request->session()->get('cart');
                // dd($cart);
                foreach ($cart as  $value) {
                    $amount = $amount + $value['soluong'];
                }
            }
            View::share('product_cart', $amount);
            return $next($request);
        });
        // if (session::exists('cart')) {
        //     $cart = session()->get('cart');
        //     dd($cart);
        //     foreach ($cart as  $value) {
        //         $amount = $amount + $value['soluong'];
        //     }
        // }
    }
    function dangnhap()
    {
        return view('dangnhap');
    }
    function dangnhap_(Request $request)
    {
        if (auth()->guard('web')
            ->attempt(['email' => $request['email'], 'password' => $request['matkhau']])
        ) {
            $user = auth()->guard('web')->user();
            return redirect("/download");
        } else return back()->with('thongbao', 'Email, Password không đúng');
    }
    function thoat()
    {
        auth()->guard('web')->logout();
        return redirect('/dangnhap')->with('thongbao', 'Bạn đã thoát thành công');
    }
    function dangky()
    {
        return view('dangky');
    }
    function dangky_(dangKyValid $request)
    {
        //tiếp nhận dữ liệu từ form
        $email = strtolower(trim(strip_tags($request['email'])));
        $ho = trim(strip_tags($request['ho']));
        $ten = trim(strip_tags($request['ten']));
        $mk1 = trim(strip_tags($request['mk1']));
        $mk2 = trim(strip_tags($request['mk2']));
        $dc = trim(strip_tags($request['diachi']));
        $dt = trim(strip_tags($request['dienthoai']));
        //lưu vào db
        $id_user = DB::table('users')->insertGetId([
            'email' => $email, 'ho' => $ho, 'ten' => $ten, 'diachi' => $dc, 'dienthoai' => $dt,
            'password' => Hash::make($mk1)
        ]);

        if (auth()->guard('web')->attempt(['email' => $email, 'password' => $mk1])) {
            // gửi mail
            $user = auth()->guard('web')->user();
            event(new Registered($user));
            return redirect('/camon')->with('thongbao', "Đăng ký hoàn tất!");
        } else return back()->with('thongbao', 'Đăng ký không thành công');
    }
    function camon()
    {

        return view('camon');
    }
}
