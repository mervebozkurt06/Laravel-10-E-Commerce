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
                        <h2 class="pageheader-title">All Product List</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">All Product List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif

                    <div class="card">
                        <h5 class="card-header">
                            @can('create', $roleManager)
                                <a class="badge badge-pill  badge-success" href="{{ route('product_create') }}">
                                    <i class="fas fa-plus"></i>
                                    New</a>
                            @endcan
                        </h5>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        @can('update', $roleManager)
                                            <th>Action</th>
                                        @endcan
                                        <th>Add to Cart</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td>{{ $product->id  }}</td>
                                            <td><img src="{{ Storage::url($product->image)}}" width="50px"></td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>{{ $product->category->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            @can('update', $roleManager)
                                                <td>
                                                    <a class="badge badge-pill badge-warning"
                                                       href="{{ route('product_edit',['id' =>$product->id]) }}">
                                                        <i class="fas fa-pencil-alt"></i>

                                                    </a>
                                                    <a class="badge badge-danger"
                                                       href="{{ route('product_destroy',$product->id) }}">
                                                        <i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            @endcan
                                            <td>
                                                <form action="{{ route('shopcart_store',[ 'id' => $product->id] ) }}"
                                                      method="POST">
                                                    @csrf
                                                    <span class="text-uppercase">QTY: </span>
                                                    <input class="input" name="quantity" type="number" value="1">
                                                    <button type="submit" class="badge badge-success">
                                                        <i class="fas fa-cart-plus"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Image</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        @can('update', $roleManager)
                                            <th>Action</th>
                                        @endcan
                                        <th>Add to Cart</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection
