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
                        <h2 class="pageheader-title">Product List</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Product List</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Product Create</li>
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
                        <h5 class="card-header">New Product</h5>
                        <div class="card-body">

                            <form action="{{ route('product_store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">Name</label>
                                    <input id="inputText3" type="text" name="name" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">Description</label>
                                    <input id="inputText3" type="text" name="description" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label for="inputText3" class="col-form-label">Price</label>
                                    <input id="inputText3" type="number" name="price" class="form-control">
                                </div>

                                <div class="form-group">
                                    <label  class="col-form-label">Image Input</label>
                                    <div class="custom-file mb-3">
                                        <input type="file" name="image" class="custom-file-input" id="customFile">
                                        <label class="custom-file-label" for="customFile">Click Here</label>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="input-select">Choose a Category</label>
                                    <select class="form-control" id="input-select" name="category_id"
                                            id="categories">
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                <div class="form-group row text-right">
                                    <div class="col col-sm-10 col-lg-9 offset-sm-1 offset-lg-0">
                                        <button type="submit" class="btn btn-rounded btn-success"><i class="fas fa-check"></i></button>

                                        <a class="btn btn-rounded btn-light" href="{{ route('product') }}"><i class="fas fa-window-close"></i></a>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>
        </div>

@endsection


