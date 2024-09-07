@extends('layout')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
  
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}999
                        </div>
                    @endif
  
                    You are Logged In
                </div>
            </div>
            <div class="row" style="padding-top: 60px"><center> <a href="{{ route('screenone') }}" > Screen 1:</a></center></div>
    <div class="row" style="padding-top: 20px"><center> <a href="{{ route('screentwo') }}" > Screen 2:</a></center></div>
    <div class="row" style="padding-top: 20px"><center> <a href="{{ route('screenthree') }}" > Screen 3:</a></center></div>
    <div class="row" style="padding-top: 20px"><center> <a href="{{ route('screenfour') }}" > Screen 4:</a></center></div>
        </div>
        
    </div>
</div>
@endsection