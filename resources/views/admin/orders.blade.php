@extends('layout.app')

@section('content')
    <table class="table table-responsive">
        <thead class="text-center">
            <tr>
                <th scope="col" width="5.11%">#</th>
                <th scope="col" width="12.11%">Img</th>
                <th scope="col" width="14.11%">Title</th>
                <th scope="col" width="14.11%">Description</th>
                <th scope="col" width="11.11%">Category</th>
                <th scope="col" width="11.11%">Subcategory</th>
                <th scope="col" width="10.11%">Price</th>
                <th scope="col" width="10.11%">Stock</th>
                <th scope="col" width="11.11%">Action</th>
            </tr>
        </thead>
        <tbody id="dataTbl" class="text-center"></tbody>
    </table>
@endsection
