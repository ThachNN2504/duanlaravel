@extends('layout')

@section('noidungchinh')

    @if ($check < 1)
        <div class="container">
            <h4 class="text_content text-center mt-5"> Không tìm thấy sản phẩm có tên {{ $keysearch }}</h4>
        </div>
    @else
        <div class="container">
            <h4 class="text_content text-center mt-5"> Có {{ $amount }} sản phẩm tìm kiếm có tên:
                {{ $keysearch }}</h4>
            <div class="container mt-3">
                <div class="row row-cols-1 row-cols-md-4 g-4">
                    @foreach ($listsp as $sp)
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
                                    <form class="form_search container btn_sp" action="{{ url('themgiohang') }}"
                                        method="post">
                                        @csrf
                                        <input type="hidden" name="amount" value="1">
                                        <input name="id_product" type="hidden" value=" {{ $sp->id_sp }}">
                                        <button type="submit" class='btn btn-success'><a
                                                style="color: black">Chọn</a></button>
                                    </form>
                                    <button class="btn btn-info "><a href="/sp/{{ $sp->id_sp }}">Xem</a></button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                {{-- Nav controll product --}}
                <div class='p-2 nagigation_list'> {{ $listsp->withQueryString()->links() }} </div>

            </div>

        </div>
        <script type="text/javascript">
            window.scrollTo(0, 125)
        </script>
    @endif
@endsection
