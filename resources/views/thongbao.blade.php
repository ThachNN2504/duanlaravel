@extends('layout')
@section('noidungchinh')
    
    @if (session('loi'))
        <div class="alert alert-danger" role="alert">
            {{ session('loi') }}
        </div>
    @endif

    @if (session('thanhcong'))
        <div class="alert alert-success" role="alert">
            {{ session('thanhcong') }}
        </div>
    @endif
@endsection
