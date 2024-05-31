<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Beranda - SITASU</title>

    @include('layouts.head')

</head>
<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
            <div class="col-lg-4 mx-auto">
                    <div class="card pt-2 pb-5">
                        <div class="card-body">
                            <div class="brand-logo">
                                <center><img src="{{asset('template/images/sd.png')}}" alt="logo"></center>
                            </div>
                            <h4>Hallo! Selamat Datang Di SDN Labuhan Lara</h4>
                            <h6 class="fw-light">Masukan Username dan Password</h6>

                            <form class="pt-3" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="form-group">
                                    <input id="email" type="text" class="form-control rounded form-control-lg @error('email') is-invalid @enderror" name="id_tabungan" value="{{ old('email') }}" required autocomplete="email" placeholder="ID Tabungan / Username" autofocus>

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                </div>
                                <div class="form-group">
                                    <input id="password" type="password" class="form-control rounded form-control-lg @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                                        {{ __('MASUK') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
</body>
</html>
