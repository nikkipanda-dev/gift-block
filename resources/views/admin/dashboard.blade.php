@extends('layout.app')

@section('content')
    <a href="{{ route('admin.products.index') }}">Products</a>
    <a href="{{ route('admin.orders.index') }}">Orders</a>
@endsection
