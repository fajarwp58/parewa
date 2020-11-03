@extends('layouts.app')

@section('content')
<div class="account-pages my-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-header p-4 bg-primary">
                                <h4 class="text-white text-center mb-0 mt-0">Parewa Coffee</h4>
                            </div>
                            <div class="card-body">
                               <form method="POST" action="{{ route('login') }}">
                        		@csrf
                                    <div class="form-group mb-3">
                                        <label for="login">Username :</label>
                                        <input class="form-control @error('username') is-invalid @enderror" type="login" id="login" name="login" value="{{ old('username') }}" required autocomplete="username" autofocus placeholder="username">
                                         @error('username')
                                    		<span class="invalid-feedback" role="alert">
                                        		<strong>{{ $message }}</strong>
                                    		</span>
                                		@enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="password">Password :</label>
                                        <input class="form-control @error('password') is-invalid @enderror" type="password" required autocomplete="current-password" name="password" id="password" placeholder="password">
                                        @error('password')
                                    		<span class="invalid-feedback" role="alert">
                                        		<strong>{{ $message }}</strong>
                                    		</span>
                                		@enderror
                                    </div>

                       

                                    <div class="form-group row text-center mt-4 mb-4">
                                        <div class="col-12">
                                            <button class="btn btn-md btn-block btn-primary waves-effect waves-light" type="submit">Sign In</button>
                                        </div>
                                    </div>

                                <!--     <div class="form-group row mb-0">
                                        <div class="col-sm-12 text-center">
                                            <p class="text-muted mb-0">Don't have an account? <a href="pages-register.html" class="text-dark m-l-5"><b>Sign Up</b></a></p>
                                        </div>
                                    </div> -->
                                </form>

                            </div>
                            <!-- end card-body -->
                        </div>
                        <!-- end card -->

                        <!-- end row -->

                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

            </div>
        </div>

@endsection

@section('js')
 		<!-- Vendor js -->
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('assets/js/app.min.js') }}"></script>
@endsection