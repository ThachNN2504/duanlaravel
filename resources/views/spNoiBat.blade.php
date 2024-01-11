<h2 class="text-center h1 text-uppercase m-5"> Sản phẩm nổi bật</h2>
<div class="container">
    <div class="row row-cols-1 row-cols-md-4 g-4">
        @foreach ($spnoibat as $sp)
        <div class="col mt-3">
            <div class="sp">
                <a href="/sp/{{ $sp->id_sp }}">
                    <img width="100%" style="height: 165px; max-height: 165px" src="{{ $sp->hinh }}" alt="">
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
                    <form class="form_search container btn_sp" action="{{ url('themgiohang') }}" method="post">
                        @csrf
                        <input type="hidden" name="amount"  value="1">
                        <input name="id_product" type="hidden" value=" {{ $sp->id_sp }}">
                        <button type="submit" class='btn btn-success'><a style="color: black">Chọn</a></button>
                    </form>
                    <button class="btn btn-info "><a href="/sp/{{ $sp->id_sp }}">Xem</a></button>
                </div>
            </div>
        </div>
    @endforeach
    </div>
</div>
