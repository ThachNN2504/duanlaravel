@extends('layout')
@section('noidungchinh')
    <div class="container mt-5">


        <form style="font-size: 20px" action="thanhtoan" method="post" class="col-6 border rounded-3 p-3">
            @csrf
            <div class="mb-3 form-ground">
                <label for="fullname">Họ và tên:</label>
                <input type="text" name="ho_ten" id="fullname" class="form-control">
            </div>
            <div class="mb-3 form-ground">
                <label for="location">Địa chỉ:</label>
                <input type="text" name="dia_chi" id="location" class="form-control">
            </div>
            <div class="mb-3 form-ground">
                <label for="email">Email:</label>
                <input type="text" name="email" id="email" class="form-control">
            </div>
            <div class="mb-3 form-ground">
                <label for="phone">Số điện thoại:</label>
                <input type="text" name="dien_thoai" id="phone" class="form-control">
            </div>
            <button style="font-size: 20px" class="btn btn-primary">Thanh toán</button>
        </form>
        <div>

        </div>
    </div>
@endsection
