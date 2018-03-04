@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h3><a href="{{route('site.index')}}">Add/Remove Site</a></h3>
                    <h3><a href="{{route('warehouseInventory')}}">Add to Warehouse</a></h3>
                    <h3><a href="{{route('warehouseStock')}}">Generate Report</a></h3>
                    <h3><a href="{{route('logwarehouseStock')}}">Generate Detailed Report</a></h3>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
