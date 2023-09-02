@extends('dashboard')

@section('content')

    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">
            <!-- ============================================================== -->
            <!-- pageheader -->
            <!-- ============================================================== -->
            <div class="row">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="page-header">
                        <h2 class="pageheader-title">ShopCart List</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ShopCart List</li>
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

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered first">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                        <th>Edit Cart</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($datalist as $data)
                                        <tr>
                                            <td>{{ $data->id  }}</td>
                                            <td>{{ $data->product->name }}</td>
                                            <td>{{ $data->product->category->name }}</td>
                                            <td>{{ $data->product->price }}</td>
                                            <td>{{ $data->quantity }}</td>
                                            <td>
                                                @if($data->product->image!=null)
                                                    <img src="{{ Storage::url($data->product->image)}}" width="50px">
                                                @endif
                                            </td>
                                            <td>
                                                <form action="{{ route('product_destroy',$data->id) }}" method="POST">
                                                    @csrf
                                                    <a class="badge badge-danger"
                                                       href="{{ route('shopcart_destroy',['id' =>$data->id]) }}"
                                                       onclick="return confirm('Are you sure?')"> <i
                                                            class="fas fa-trash-alt"></i></a></a>
                                                </form>
                                            </td>
                                            <td>
                                                <form action="{{ route('shopcart_update',[ 'id' => $data->id] ) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('PUT')
                                                    <span class="text-uppercase">QTY: </span>
                                                    <input class="input" name="quantity" type="number"
                                                           value="{{$data->quantity}}">
                                                    <button type="submit" class="badge badge-pill badge-warning">
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
                                        <th>Product</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                        <th>Edit Cart</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>

                        <div class="card-footer">
                            <a class="badge badge-pill  badge-success" href="{{ route('order_index') }}">
                                Place Order</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>

@endsection
