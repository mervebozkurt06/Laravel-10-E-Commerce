@extends('admin')

@section('content')
    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">Order and Shipping Information</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Order and Shipping
                                        Information
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <div class="row">

                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="card">

                        <div class="card-header p-4">

                            @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger">{{ session('error') }}</div>
                            @endif
                            <div class="float-right"><h3 class="mb-0">Invoice #{{$order->id}}</h3>
                                Date: {{$order->created_at->diffForHumans()}}
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-sm-6">
                                    <h3 class="text-dark mb-1">{{$order->user->name}}</h3>

                                    <div>{{$order->user->name}}</div>
                                    <div>Email: {{$order->user->email}}</div>
                                    <div>Phone: {{$order->user->phone}}</div>
                                </div>
                                <div class="col-sm-6">
                                    <a href="{{route('download_pdf',['order_id'=>$order->id])}}">Download PDF</a>

                                </div>
                            </div>
                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>

                                    <tr>
                                        <th class="center">#</th>
                                        <th>Product</th>
                                        <th>Description</th>
                                        <th class="right">Unit Cost</th>
                                        <th class="center">Qty</th>
                                        <th class="right">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orderItems as $item)
                                        <tr>
                                            <td class="center">{{ $item->id }}</td>
                                            <td class="left strong">{{ $item->product->name }}</td>
                                            <td class="left">{{ $item->product->description }}</td>
                                            <td class="right">${{ $item->product->price }}</td>
                                            <td class="center">{{ $item->quantity }}</td>
                                            <td class="right">${{ $item->total }}</td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-4 col-sm-5">
                                </div>
                                <div class="col-lg-4 col-sm-5 ml-auto">
                                    <table class="table table-clear">
                                        <tbody>
                                        <tr>
                                            <td class="left">
                                                <strong class="text-dark">Total</strong>
                                            </td>
                                            <td class="right">
                                                <strong class="text-dark">${{$order->total}}</strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-white">
                            <p class="mb-0"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

