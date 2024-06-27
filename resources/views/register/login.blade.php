<x-layout>
    @section('body')
    <style>
        .fa-brands {
            display: flex;
	        justify-content: center;
	        align-items: center;
	        border: none;
	        background: #2A284D;
	        height: 40px;
        }

        .fa-brands:hover {
            background: #800080;
        }

        .division {
	        float: none;
	        position: relative;
	        margin: 30px auto 20px;
	        text-align: center;
	        width: 100%;
	        box-sizing: border-box;
        }
        .line.l {
	        left: 52px;
        }
        .line.r {
	        right: 45px;
        }

        .form-control {
            background-color: #212042;
            border: none;
            border-bottom: solid rgb(176,106,252);
            border-radius: 0rem;
        }

        .form-control:focus {
            background-color: #212042;
            color: white;
            border-bottom: solid rgb(13, 2, 23);
            box-shadow: 0 0 5px rgb(176,106,252);
            outline: none;
        }

        .icon {
            text-decoration: none;
        }


        .form-check-input:checked {
            background-color: rgb(176,106,252);
        }
        .form-check-input:focus {
            box-shadow: rgb(184, 158, 213);
        }

        .form-control:hover {
            border-bottom: solid rgb(13, 2, 23);
        }
        .btn-gradient {
            background: linear-gradient(30deg, #5c2d91, #471f73, #371859, #2a1245, #1f0e35);
            color: #fff;
            border: none;
            font-weight: bold;
            color: rgb(184, 158, 213);
            padding: 0.75rem 1.25rem;
        }
        .btn-gradient:hover {
            color: rgb(184, 158, 213);
            background: linear-gradient(10deg, #1f0e35, #2a1245, #371859, #471f73, #5c2d91);
        }

        .error {
            display: flex;
            justify-content: start;
            color: rgb(164, 40, 164);
        }

        .alert {
            padding: 15px;
            background-color: rgb(128,0,128);
            color: white;
            opacity: 1;
            transition: opacity 0.6s;
            border: none;
        }

    </style>
    <div class="card" style="border-radius: 1rem; border-top: 5px solid  rgb(176,106,252);background: #212042;color: #57557A;">
        <div class="card-body text-center p-5" style="background: #212042;color: #57557A;; border-radius: 1rem">
            <a href="{{route('landing')}}"><img src="{{asset('assets/images/logo-nobg-1.png')}}" alt="" style="max-width: 100px; max-height: 100px;"></a>
            <p class="text-center mb-4 mt-2 h6">SIGN IN USING</p>
            <div class="row mx-auto mb-5 ml-5">
                <div class="col-1">

                </div>
                <div class="col-5 mx-auto pr-icon">
                    <a href="{{route('login.google')}}" class="icon"><i class="fa-brands fa-google" style="color: #EA4335"></i></a>
                </div>
                <div class="col-5 mx-auto pr-icon">
                    <a href="{{route('login.git')}}" class="icon"><i class="fa-brands fa-github" style="color: #181717"></i></a>
                </div>
                <div class="col-1">

                </div>
            </div>
            <div class="division">
                <div class="row">
                    <div class="col-3"><div class="line l"><hr></div></div>
                    <div class="col-6"><span>OR WITH YOUR MAIL</span></div>
                    <div class="col-3"><div class="line r"><hr></div></div>
                </div>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="form-floating mb-4">
                    <input
                        type="text"
                        name="email"
                        class="form-control"
                        placeholder=""
                        style="color: white;"
                        value="{{ old('email') }}"
                    />
                    <label for="email">Email</label>
                </div>
                @error('email')
                <script>
                    $(".error").fadeOut("slow", function() {
                        $('.error').addClass('hidden').show(0);
                    });
                </script>
                <div class="error mb-3" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <div class="form-floating mb-4">
                    <input
                        type="password"
                        name="password"
                        class="form-control"
                        placeholder=""
                        value="{{ old('password') }}"
                        style="color: white;"
                    />
                    <label for="password">Password</label>
                </div>
                @error('password')
                <div class="error mb-3" role="alert">
                    {{ $message }}
                </div>
                @enderror
                <div class="row d-flex justify-content-start text-left mb-4 mx-1">
                    <div class="form-check col d-flex justify-content-start">
                        <input
                            type="checkbox"
                            class="form-check-input me-2"
                            name="frem"
                        />
                        <label for="frem" class="form-check-label">Remember me</label>
                    </div>
                    <div class="d-flex justify-content-end col d-flex justify-content-start">
                        <a href="{{route('login.signup')}}" class="text-decoration-none" style="color: rgb(176,106,252)">Not registered?</a>
                    </div>
                </div>
                @error('invalid')
                    <script>
                    $(document).ready(function dip() {
                        setTimeout(function () {$(".dipper").fadeOut('fast');}, 3000);
                    });
                    </script>
                    <div class="alert alert-danger mb-2 dipper" role="alert">
                       {{ $message }}
                    </div>
                @enderror
                <button type="submit" class="btn btn-gradient btn-lg w-100 mb-3">
                    Login
                </button>
            </form>
        </div>
    </div> 
    @endsection
</x-layout>
