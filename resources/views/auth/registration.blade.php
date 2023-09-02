<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Concept - Bootstrap 4 Admin Dashboard Template</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets')}}/vendor/bootstrap/css/bootstrap.min.css">
    <link href="{{ asset('assets')}}/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets')}}/libs/css/style.css">
    <link rel="stylesheet" href="{{ asset('assets')}}/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: -ms-flexbox;
            display: flex;
            -ms-flex-align: center;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
    </style>
</head>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<body>
<!-- ============================================================== -->
<!-- signup form  -->
<!-- ============================================================== -->

<form action="{{ route('register.custom') }}" method="POST" class="splash-container">
    @csrf
    <div class="card">
        <div class="card-header">
            <h3 class="mb-1">Sign Up</h3>
            <p>Please enter your user information.</p>
        </div>
        <div class="card-body">
            <div class="form-group">
                <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text">@</span></span>
                    <input type="text" name="name" placeholder="Name" class="form-control">
                    @if ($errors->has('name'))
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    @endif
                </div>

            </div>
            <div class="form-group">
                <div class="input-group mb-3"><span class="input-group-prepend"><span class="input-group-text">@</span></span>
                    <input type="text" name="surname" placeholder="Surname" class="form-control">
                    @if ($errors->has('surname'))
                        <span class="text-danger">{{ $errors->first('surname') }}</span>
                    @endif
                </div>

            </div>


            <div class="form-group">
                <label>Phone<small class="text-muted">(999) 999-9999 </small></label>
                <input type="text" class="form-control phone-inputmask" name="phone" id="xphone-mask" im-insert="true" >
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>



            <div class="form-group">
                <label>Email<small class="text-muted">(xxx@xxx.xxx)</small>
                </label>
                <input type="text" name="email" class="form-control email-inputmask" id="email-mask" im-insert="true">
                @if ($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
            </div>
            <div class="form-group">
                <label for="inputPassword">Password</label>
                <input id="inputPassword" name="password" type="password" placeholder="Password" class="form-control">
                @if ($errors->has('password'))
                    <span class="text-danger">{{ $errors->first('password') }}</span>
                @endif
            </div>

            <div class="form-group pt-2">
                <button class="btn btn-block btn-primary" type="submit">Register My Account</button>
            </div>


        </div>
        <div class="card-footer bg-white">
            <p>Already member? <a href="{{ route('login') }}" class="text-secondary">Login Here.</a></p>
        </div>
    </div>
</form>

<script src="{{ asset('assets')}}/vendor/jquery/jquery-3.3.1.min.js"></script>
<script src="{{ asset('assets')}}/vendor/bootstrap/js/bootstrap.bundle.js"></script>
<script src="{{ asset('assets')}}/vendor/slimscroll/jquery.slimscroll.js"></script>
<script src="{{ asset('assets')}}/libs/js/main-js.js"></script>
<script src="{{ asset('assets')}}/vendor/inputmask/js/jquery.inputmask.bundle.js"></script>
<script>
    $(function(e) {
        "use strict";
            $(".phone-inputmask").inputmask("(999) 999-9999"),

            $(".email-inputmask").inputmask({
                mask: "*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[*{2,6}][*{1,2}].*{1,}[.*{2,6}][.*{1,2}]",
                greedy: !1,
                onBeforePaste: function(n, a) {
                    return (e = e.toLowerCase()).replace("mailto:", "")
                },
                definitions: {
                    "*": {
                        validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~/-]",
                        cardinality: 1,
                        casing: "lower"
                    }
                }
            })
    });
</script>


</body>


</html>




