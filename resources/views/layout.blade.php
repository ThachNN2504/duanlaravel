<html>

<head>
    <title>@yield('tittle')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>
    <header class="col-12 st">
        <a class="col-1" href="/"><img src="/images/logo.png" alt=""></a>
        <div class="nav_main_box col-6">
            <ul class="nav nav_main" style="margin-bottom: 25px">
                <li><a href="/">Trang chủ</a></li>
                <li><a href="/cuahang">Danh mục</a></li>
                <li><a href="#">Cửa hàng</a></li>
                <li><a href="#">Liên hệ</a></li>
            </ul>
        </div>

        <div class="cart col-3">
            <form class="form_search col-6" action="{{ route('products_search') }}" method="get">
                <input name="keysearches" class="form-control keysearches" type="text" placeholder="Tìm kiếm...">
                <input name="page" type="hidden" value="1">
            </form>
            {{-- <a class="d-flex justify-content-center align-item-center" href="/cart">
                <p>Giỏ hàng ()</p>
            </a> --}}
            <div class="col-6">
                <button type="button" class="btn btn-primary position-relative end-0 button"
                    onclick="window.location.href ='/hiengiohang' ">
                    Giỏ hàng
                    <span style="color:white;"
                        class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-secondary">
                        {{ $product_cart }}</span>
                </button>
            </div>
        </div>
        <div id="userinfo" class="col-2">
            @if (Auth::check())
                Chào {{ Auth::user()->ho }} {{ Auth::user()->ten }}!
                <a href="/thoat">Thoát</a>
            @else
                Chào bạn !
                <a href="/dangnhap">Đăng nhập</a>
            @endif
        </div>
    </header>




    <main>
        @yield('noidungchinh')
    </main>

    <footer class="bg-dark">
        <div class="footer_content">
            <p class="h1 text-white project">Tech Chain:</p>
            <a href="https://www.instagram.com/dr_strange425">
            </a>
        </div>
    </footer>
</body>

</html>
