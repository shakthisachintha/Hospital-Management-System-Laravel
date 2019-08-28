@extends('template.auth')

@section('content')


<div id="content" class="container h-100">
    <div class="row  h-100 justify-content-center align-items-center">
        <div class="col-8 bg-white border border-white p-5 m-5 rounded">
            <div class="row">
                <div class="col-6">
                    <img class="text-center mt-5 mx-auto d-block border-0 img-thumbnail" style="border-radius:100%"
                        src="./images/logo.png" alt="">
                    <h3 class="mt-2 text-center mb-5">Smart Hospitals</h3>
                </div>
                <div class="col-6 mt-2">
                    <form method="post" action="{{ route('login') }}">
                            @csrf
                        <h3 class="text-center mb-5">System Login</h3>
                        <div class="form-group">

                            <input id="email" class="form-control @error('email') border-danger @enderror" style="height: 3.2rem;border-radius:1.25rem"
                                type="email" placeholder="Username" name="email" autocomplete="email" autofocus>
                                @error('email')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <input id="password" placeholder="Password" style="height: 3.2rem;border-radius:1.25rem"
                                class="form-control @error('password') border-danger @enderror" type="password" name="password" autocomplete="current-password">
                                @error('password')
                                <span class="text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            @if (Route::has('password.request'))
                                   <br> <a class="text-decoration-none" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                        </div>

                        <div class="ml-1 mb-1 custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                            <label class="custom-control-label" for="remember">Remember Me</label>
                          </div>
                        <input class="mt-2 form-control btn border-0 btn-success" style="height: 3.2rem;" value="Login"
                            type="submit" name="">
                    </form>

                </div>
            </div>

        </div>

    </div>
</div>
@endsection
