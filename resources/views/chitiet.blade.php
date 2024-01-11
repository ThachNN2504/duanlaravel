@extends('layout')

@section('noidungchinh')
    <div class='container'>
        <div class="row detail_product">
            <img class="col-sm-6 mt-4" src="{{ $sp->hinh }}" alt="Hình sản phẩm">
            <div class="col-sm-6 mt-4 product_info">
                <h1 class="tittle"> {{ $sp->ten_sp }} </h1>
                <div class="mt-3">
                    <span class="price_discout text-danger">Khuyến mãi: </span>
                    <span class="price_discout text-danger">{{ number_format($sp->gia_km, 0, ',', '.') }} VNĐ</span>
                </div>
                <div class="mt-3">
                    <span class="text_content">Giá chính: </span>
                    <del class="text_content">{{ number_format($sp->gia, 0, ',', '.') }}VNĐ</del>
                </div>

                <div class="mt-3">
                    <span class="text_content">Ngày cập nhật: </span>
                    <span class="text_content">{{ date('d/m/Y', strtotime($sp->ngay)) }}</span>
                </div>
                <form class="form_search" action="{{ url('themgiohang') }}" method="post">
                    @csrf
                    <div class="mt-3">
                        <span class="text_content">Số lượng: </span>
                        <input class="text_content" size="4" type="number" name="amount" id="amount"
                            min="1" max="50" value="1">
                    </div>
                    <div class="mt-3">
                        <input name="id_product" type="hidden" value=" {{ $sp->id_sp }}">
                        <button type="submit" class='btn btn-primary btn_product text_content'>Thêm
                            vào giỏ</button>
                    </div>
                </form>
                <button onclick='history.back()' class='btn btn-success btn_product text_content'>Trở lại</button>
            </div>
        </div>
    </div>
    {{-- Box Comments --}}
    {{-- <section style="background-color: #f7f6f6;">
        <div class="container my-5 py-5 text-dark">
            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="text-dark mb-0">Unread comments ({{ COUNT($comment) }})</h4>
                        <div class="card">
                            <div class="card-body p-2 d-flex align-items-center">
                                <h6 class="text-primary fw-bold small mb-0 me-1">Comments "ON"</h6>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked />
                                    <label class="form-check-label" for="flexSwitchCheckChecked"></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex flex-start">
                                <img class="rounded-circle shadow-1-strong me-3"
                                    src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(14).webp" alt="avatar"
                                    width="40" height="40" />
                                <div class="w-100">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h6 class="text-primary fw-bold mb-0">
                                            t_anya
                                            <span class="text-dark ms-2"><span class="text-primary">@macky_lones</span>
                                                <span class="text-primary">@rashida_jones</span> Thanks
                                            </span>
                                        </h6>
                                        <p class="mb-0">4 days ago</p>
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <p class="small mb-0" style="color: #aaa;">
                                            <a href="#!" class="link-grey">Remove</a> •
                                            <a href="#!" class="link-grey">Reply</a> •
                                            <a href="#!" class="link-grey">Translate</a>
                                        </p>
                                        <div class="d-flex flex-row">
                                            <i class="far fa-check-circle text-primary"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <div class="container">
        <h4 class="text_content text-center mt-5"> Sản phẩm liên quan</h4>
        <div class="container mt-3">
            <div class="row row-cols-1 row-cols-md-4 g-4">
                @foreach ($splienquan as $sp)
                    <div class="col mt-3">
                        <div class="sp">
                            <a href="/sp/{{ $sp->id_sp }}">
                                <img width="100%" style="height: 165px; max-height: 165px" src="{{ $sp->hinh }}"
                                    alt="">
                            </a>

                            <div class="container">
                                <a href="/sp/{{ $sp->id_sp }}">
                                    <h2>
                                        {{ $sp->ten_sp }}
                                    </h2>
                                </a>
                                <p class="h4"><del>{{ number_format($sp->gia, 0, ',', '.') }} VNĐ</del></p>
                                <p class="h2">
                                    <b class="text-danger">
                                        {{ number_format($sp->gia_km, 0, ',', '.') }} VNĐ
                                    </b>
                                </p>

                            </div>
                            <div class="container btn_sp">
                                <button type="button" class="btn btn-success"><a href="#">Chọn</a></button>
                                <button class="btn btn-info "><a href="/sp/{{ $sp->id_sp }}">Xem</a></button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <script type="text/javascript">
        window.scrollTo(0, 100)
    </script>
@endsection()
