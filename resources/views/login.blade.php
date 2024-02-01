@extends('layouts.main')

@section('unregister')
    <div class="container my-4 ">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center mb-5">
                <h2 class="heading-section">Rizky POS</h2>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-7 col-lg-5">
                <div class="login-wrap p-4 p-md-5 bg-light">
                    <div class="icon d-flex align-items-center justify-content-center">
                        <span class="fa fa-user-o"></span>
                    </div>
                    <h3 class="text-center mb-4">Login</h3>
                    <form action="#" class="login-form">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" id="username" class="form-control rounded-left" placeholder="Input Username" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <div class="d-flex">
                                <input type="password" id="password" class="form-control rounded-left" placeholder="Input Password" required>
                                <button class="btn btn-outline-primary" type="button" id="button-password"><i
                                    class="far fa-eye"></i></button>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary rounded submit px-3">Login</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="w-50">
                                <label class="checkbox-wrap checkbox-primary">Remember Me
                                    <input type="checkbox" checked>
                                    <span class="checkmark"></span>
                                </label>
                            </div>
                            <div class="w-50 text-md-right">
                                <a href="{{route('register')}}">Create Account</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            document.getElementById("button-password").addEventListener("click", function() {
                let passwordInput = document.getElementById("password");

                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            });

            $('#password').on('copy paste', function(e) {
                e.preventDefault();
                alert('Tidak bisa salin dan tempel pada kolom password!');
                return false;
            });

        });
    </script>
@endsection
