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
                        <h2 class="pageheader-title">My Orders</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">My Orders</li>
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
                            <a class="pt-2 d-inline-block" href="index.html">Concept</a>


                        </div>
                        <div class="card-body">

                            <div class="table-responsive-sm">
                                <table class="table table-striped">
                                    <thead>

                                    <tr>
                                        <th class="center">#</th>
                                        <th>Name/Surname</th>
                                        <th>Phone/Email</th>
                                        <th class="right">Total</th>
                                        <th class="center">Detail</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($orders as $item)
                                        <tr>
                                            <td class="center">{{ $item->id }}</td>
                                            <td class="left strong">{{ $item->name }} {{ $item->surname }}</td>
                                            <td class="left">{{ $item->phone }} {{ $item->email }}</td>
                                            <td class="right">${{ $item->total }}</td>
                                            <td class="right">
                                                <a class="badge badge-pill badge-primary"
                                                   href="{{ route('order_show',['id' =>$item->id]) }}">
                                                    <i class="fas fa-eye"></i>

                                                </a></td>
                                        </tr>
                                    @endforeach


                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="card-footer bg-white">
                            <p class="mb-0">2983 Glenview Drive Corpus Christi, TX 78476</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection

