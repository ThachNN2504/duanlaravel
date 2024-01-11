<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;


class UserController extends Controller
{
    function chenuser()
    {
        DB::table('users')->insert([
            'ho' => 'Đỗ Đạt', 'ten' => 'Cao', 'password' => bcrypt('hehe'), 'diachi' => '',
            'email' => 'dodatcao@gmail.com', 'dienthoai' => '0918765238',
            'hinh' => '', 'vaitro' => 1, 'trangthai' => 0
        ]);
        DB::table('users')->insert([
            'ho' => 'Mai Anh', 'ten' => 'Tới', 'password' => bcrypt('hehe'), 'diachi' => '',
            'email' => 'maianhtoi@gmail.com', 'dienthoai' => '098532482',
            'hinh' => '', 'vaitro' => 0, 'trangthai' => 0
        ]);
        DB::table('users')->insert([
            'ho' => 'Đào Kho', 'ten' => 'Báu', 'password' => bcrypt('hehe'), 'diachi' => '',
            'email' => 'daokhobau@gmail.com', 'dienthoai' => '097397392',
            'hinh' => '', 'vaitro' => 1, 'trangthai' => 1
        ]);
    }
}
