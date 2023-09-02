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
                        <h2 class="pageheader-title">Category List</h2>
                        <div class="page-breadcrumb">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Category List</li>
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
                                <a class="badge badge-pill  badge-success" href="{{ route('category_create') }}">
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
                                        <th>Name</th>
                                        @can('view', $roleManager)
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id  }}</td>
                                            <td>{{ $category->name }}</td>
                                            @can('view', $roleManager)
                                                <td>
                                                    <a class="badge badge-info"
                                                       href="{{ route('category_show',['id' =>$category->id]) }}">
                                                        <i class="fas fa-list"></i></a>
                                                    <a class="badge badge-pill badge-warning"
                                                       href="{{ route('category_edit',['id' =>$category->id]) }}">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <a class="badge badge-danger"
                                                       href="{{ route('category_destroy',['id' =>$category->id]) }}">
                                                        <i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            @endcan
                                        </tr>
                                    @endforeach

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        @can('view', $roleManager)
                                            <th>Action</th>
                                        @endcan
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

@endsection
