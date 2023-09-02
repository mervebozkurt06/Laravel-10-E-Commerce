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
                <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="mb-0">Billing address</h4>
                                </div>
                                <div class="card-body">


                                    <form action="{{route('order_store')}}" method="POST">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label for="firstName">First name</label>
                                                <input type="text" name="name" value="{{ auth()->user()->name }}"
                                                       class="form-control" id="firstName" placeholder="" value=""
                                                       required="">
                                                <div class="invalid-feedback">
                                                    Valid first name is required.
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label for="lastName">Last name</label>
                                                <input type="text" name="surname" value="{{ auth()->user()->surname }}"
                                                       class="form-control" id="lastName" placeholder="" value=""
                                                       required="">
                                                <div class="invalid-feedback">
                                                    Valid last name is required.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label>Phone<small class="text-muted">(999) 999-9999 </small></label>
                                            <input type="text" class="form-control phone-inputmask" name="phone"
                                                   id="xphone-mask" im-insert="true">
                                            <div class="invalid-feedback">
                                                Please enter a valid phone number for shipping updates.
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="email">Email <span class="text-muted">(Optional)</span></label>
                                            <input type="text" name="email" value="{{ auth()->user()->email }}"
                                                   class="form-control email-inputmask" id="email-mask"
                                                   im-insert="true">
                                            <div class="invalid-feedback">
                                                Please enter a valid email address for shipping updates.
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="address">Address</label>
                                            <input type="text" name="address" class="form-control" id="address"
                                                   placeholder="Address" required="">
                                            <div class="invalid-feedback">
                                                Please enter your shipping address.
                                            </div>
                                        </div>
                                        <div hidden class="mb-3">
                                            <label for="address">Address</label>
                                            <input type="text" name="total" value="{{$total}}" class="form-control" id="address"
                                                   placeholder="Address" required="">
                                            <div class="invalid-feedback">
                                                Please enter your shipping address.
                                            </div>
                                        </div>

                                        <hr class="mb-4">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Continue to
                                            checkout
                                        </button>
                                    </form>


                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="d-flex justify-content-between align-items-center mb-0">
                                        <span class="text-muted">Your cart</span>
                                        <span class="badge badge-secondary badge-pill">{{$carts->count()}}</span>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group mb-3">
                                        @foreach($carts as $cart)
                                            <li class="list-group-item d-flex justify-content-between">
                                                <div>
                                                    <h6 class="my-0">{{$cart->product->name}}</h6>
                                                    <small class="text-muted">{{$cart->product->description}}</small>
                                                </div>
                                                <span
                                                    class="text-muted">{{$cart->quantity}} x ${{$cart->product->price}}</span>
                                            </li>
                                        @endforeach

                                        <li class="list-group-item d-flex justify-content-between">
                                            <span>Total (USD)</span>
                                            <strong>${{$total}}</strong>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

@endsection
