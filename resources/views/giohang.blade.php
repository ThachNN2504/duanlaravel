@extends('layout')

@section('noidungchinh')

    <section class="h-100" style="background-color: #eee;">
        <div class="container h-100 py-5">

            <div class="row d-flex justify-content-center h-100">
                <div class="col-12">

                    <div class="d-flex  align-items-center mb-4">
                        <h2 class=" mb-0 text-black">Giỏ hàng của bạn</h2>
                        @if (!$productCart)
                            <h2 class="mb-0 text-black" id="reminder">: Bạn chưa thêm sản phẩm nào vào
                                giỏ.</h2>
                        @endif
                    </div>
                    @if ($productCart)
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" class="col-2"></th>
                                    <th scope="col" class="col-4">Tên sản phẩm</th>
                                    <th scope="col" class="col-1">Số lượng</th>
                                    <th scope="col" class="col-2">Đơn giá</th>
                                    <th scope="col" class="col-2">Thành tiền</th>
                                    <th scope="col" class="col-1"></th>
                                </tr>
                            </thead>
                            <tbody>

                                @php
                                    $tongtien = 0;
                                    $tongsoluong = 0;
                                @endphp
                                @if ($productCart)
                                    @foreach ($productCart as $product)
                                        @php

                                            $id_sp = $product['id_sp'];
                                            $soluong = $product['soluong'];

                                            $ten_sp = DB::table('sanpham')
                                                ->where('id_sp', '=', $id_sp)
                                                ->value('ten_sp');
                                            $gia = DB::table('sanpham')
                                                ->where('id_sp', '=', $id_sp)
                                                ->value('gia');
                                            $hinh = DB::table('sanpham')
                                                ->where('id_sp', '=', $id_sp)
                                                ->value('hinh');

                                            $thanhtien = $gia * $soluong;
                                            $tongtien += $thanhtien;
                                            $tongsoluong += $soluong;
                                            $thanhtien = number_format($thanhtien, 0, ',', '.');
                                            $gia = number_format($gia, 0, ',', '.');
                                        @endphp

                                        <tr class="">
                                            <th>
                                                <img src="{{ $hinh }}" class="img-fluid rounded-3"
                                                    alt="{{ $ten_sp }}">
                                            </th>
                                            <td>
                                                <h3 class=" mb-2">{{ $ten_sp }}</h3>
                                            </td>
                                            <td>
                                                <div class="col-md-1 col-lg-2 col-xl-2 d-flex align-items-center">

                                                    <p class="h1 cart_amount_product"
                                                        style="margin: 0px;padding: 0px 10px;">
                                                        {{ $product['soluong'] }}</p>

                                                </div>
                                            </td>
                                            <td>
                                                <h3 class="mb-0 cart_price_product">
                                                    {{ $gia }}
                                                    VNĐ</h3>
                                            </td>
                                            <td>
                                                <h3 class="mb-0 cart_price_product">
                                                    {{ $thanhtien }}
                                                    VNĐ</h3>
                                            </td>
                                            <td>
                                                <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                                                    <a href="/xoasptronggio/{{ $id_sp }}"
                                                        class="text-danger open_popup">X</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>

                        <div class="col-12 d-flex justify-content-between align-items-center" id="btn_payment">

                            <div>
                                <a onclick="history.back()">Quay lại</a>
                                <a href="/xoagiohang">Xóa giỏ hàng</a>
                                <a href="/luudon">Thanh toán</a>
                            </div>
                            <h2>Tổng tiền: {{ number_format($tongtien, 0, ',', '.') }}</h2>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </section>
    <script type="text/javascript">
        window.scrollTo(0, 245)
    </script>
@endsection()
