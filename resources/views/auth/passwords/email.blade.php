<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- CSRF Token --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Reset Password') }}</title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
          href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('backend/css/material-dashboard.css?v=2.1.0') }}" rel="stylesheet" />
    <link href="{{ asset('backend/demo/demo.css') }}" rel="stylesheet" />
</head>
<body>
<div id="app">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-8 auth">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title ">{{ __('Reset Password') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}"
                              aria-label="{{ __('Reset Password') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    {{ __('E-Mail Address') }}
                                </label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                                           name="email" value="{{ old('email') }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('backend/js/core/jquery.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/core/popper.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/core/bootstrap-material-design.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('backend/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('backend/js/plugins/bootstrap-notify.js') }}"></script>
</body>
</html>
