<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;

AbstractPaginator::useBootstrap();


class SanPhamController extends Controller
{
    public function __construct()
    {
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
    }
    function index()
    {
        $spnoibat = DB::table("sanpham")
            ->where("hot", "=", "1")
            ->where("anhien", "=", "1")
            ->orderBy("soluotxem", "desc")
            ->limit(10)
            ->get();
        $spxemnhieu = DB::table("sanpham")
            ->orderByDesc("soluotxem")
            ->limit(10)
            ->get();
        return view('home', ['spnoibat' => $spnoibat, 'spxemnhieu' => $spxemnhieu]);
    }
    function cuahang()
    {
        $perpage = 12;
        $spshop = DB::table('sanpham')
            ->where('anhien', '=', 1)
            ->paginate($perpage);
        $dsloai = DB::table('loai')
            ->orderBy('thutu', 'asc')
            ->get();
        return view('shop', ['spshop' => $spshop, 'dsloai' => $dsloai]);
    }
    function download()
    {
        return view("download");
    }
    function chitiet($id = 0)
    {
        $chitiet = DB::table('sanpham')->where('id_sp', '=', $id)->first();
        $splienquan = DB::table('sanpham')
            ->where('id_loai', '=', $chitiet->id_loai)
            ->where('tinhchat', '=', $chitiet->tinhchat)
            ->orderByDesc("ngay")
            ->limit(4)
            ->get()->except($chitiet->id_sp);
        return view('chitiet', ['sp' => $chitiet, 'splienquan' => $splienquan]);
    }
    function sptrongloai($idloai = 0)
    {
        $perpage = 12;
        $listsp = DB::table('sanpham')
            ->where('id_loai', '=', $idloai)
            ->where('anhien', '=', 1)
            ->paginate($perpage);
        $tenloai = DB::table('loai')
            ->where('id_loai', '=', $idloai)->value('ten_loai');
        return view('sptrongloai', ['id' => $idloai, 'tenloai' => $tenloai, 'listsp' => $listsp]);
    }
    function timkiem(Request $keysearches)
    {
        $perpage = 12;
        $key = $keysearches->input('keysearches');
        $keyword = "%{$key}%";

        $countTotalProduct =  DB::table('sanpham')
            ->where('ten_sp', 'LIKE', $keyword)
            ->where('anhien', '=', 1)
            ->count();

        $sp = DB::table('sanpham')
            ->where('ten_sp', 'LIKE', $keyword)
            ->where('anhien', '=', 1)
            ->paginate($perpage);

        return view('spTimKiem', ['check' => $countTotalProduct, 'amount' => $countTotalProduct, 'listsp' => $sp, 'keysearch' => $key]);
    }

    function themgiohang(Request $request)
    {
        $id_product = $request->input('id_product');
        $amount = $request->input('amount');

        if ($request->session()->exists('cart') == false) {
            $cart = [];
        } else {
            $cart = $request->session()->get('cart');
        }

        $index = array_search($id_product, array_column($cart, 'id_sp'));

        if ($index !== false) {
            $cart[$index]['soluong'] += $amount;
        } else {
            $cart[] = ['id_sp' => $id_product, 'soluong' => $amount];
        }

        $request->session()->put('cart', $cart);
        // $request->session()->forget('cart');
        return redirect('/hiengiohang');
    }
    function hiengiohang(Request $request)
    {
        $cart =  $request->session()->get('cart');
        return view('giohang', ['productCart' => $cart]);
    }
    function xoasptronggio(Request $request, $id_sp = 0)
    {
        $cart =  $request->session()->get('cart');
        $index = array_search($id_sp, array_column($cart, 'id_sp'));
        if ($index != '') {
            array_splice($cart, $index, 1);
            $request->session()->put('cart', $cart);
        }
        return redirect('/hiengiohang');
    }

    function xoagiohang(Request $request)
    {
        $request->session()->forget('cart');
        return redirect('/');
    }
    function hienform()
    {
        return view('thanhtoan');
    }

    function thanhtoan(Request $request)
    {
        if ($request->session()->exists('cart') == false) { //chưa có cart trong session  
            Session::flash('loi', 'Chưa có sản phẩm nào trong giỏ hàng!');
            // $request->session()->flash('thongbao', 'Chưa có sản phẩm nào trong giỏ hàng');
            return redirect("/thongbao");
        }
        $ho_ten = $request->post('ho_ten');
        $dia_chi = $request->post('dia_chi');
        $dien_thoai = $request->post('dien_thoai');
        $email = $request->post('email');
        $id_dh = DB::table('donhang')->insertGetId([
            'ho_ten' => $ho_ten, 'dia_chi' => $dia_chi, 'dien_thoai' => $dien_thoai, 'email' => $email
        ]);

        $cart =  $request->session()->get('cart');
        foreach ($cart as $c) {
            $id_sp = $c['id_sp'];
            $soluong = $c['soluong'];
            $gia = DB::table('sanpham')->where('id_sp', '=', $id_sp)->value('gia');
            DB::table('donhangchitiet')->insert([
                'id_dh' => $id_dh, 'id_sp' => $id_sp, 'so_luong' => $soluong, 'gia' => $gia
            ]);
        }
        $request->session()->forget('cart');
        Session::flash('thanhcong', 'Cảm ơn bạn! Đơn hàng đã ghi nhận!');
        // $request->session()->flash('thongbao', 'Cảm ơn bạn! Đơn hàng đã ghi nhận');
        return redirect('/thongbao');
    }
    function thongbao()
    {
        return view('thongbao');
    }
}
