@extends('layout')
@section('content')
    <div class="container">
        <div class="row">
            <h2> <a href="{{ route('dashboard') }}" class="pull-left">Dashboard</a></h2>
        </div>
        <h2>A. All products along with their category names and supplier names.</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Category Name</th>
                    <th>Supplier Name</th>
                </tr>
            </thead>
            <tbody>
                @if(count($data)>0)
                @foreach($data as $row)
                <tr>
                    <td>{{ $row->product_name}}</td>
                    <td>{{ $row->category_name}}</td>
                    <td>{{ $row->supplier_name}}</td>

                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="3">No data found</td>
                </tr>
                @endif
            </tbody>
        </table>
        {{ $data->links('pagination::bootstrap-4') }}
    </div>
    @endsection