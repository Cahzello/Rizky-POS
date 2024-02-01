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
                    <h3 class="text-center mb-4">Register</h3>
                    <form action="#" class="login-form">
                        <div class="form-group">
                            <label for="username">Username: </label>
                            <input type="text" id="username" class="form-control rounded-left"
                                placeholder="Input Username" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email: </label>
                            <input type="email" id="email" class="form-control rounded-left" placeholder="Input Email"
                                required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password: </label>
                            <div class="d-flex">
                                <input type="password" id="password" class="form-control rounded-left"
                                    placeholder="Input Password" required>
                                <button class="btn btn-outline-primary" type="button" id="button-password"><i
                                        class="far fa-eye"></i></button>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="repeat_pw">Reenter Password: </label>
                            <div class="d-flex">
                                <input type="password" id="repeat_pw" class="form-control rounded-left"
                                    placeholder="Input Password Again" required>
                                <button class="btn btn-outline-primary" type="button" id="button-password-repeat-pw"><i
                                        class="far fa-eye"></i></button>
                            </div>

                        </div>
                        <div class="form-group">
                            <button type="submit"
                                class="form-control btn btn-primary rounded submit px-3">Register</button>
                        </div>
                        <div class="form-group d-md-flex">
                            <div class="text-md-right">
                                <a href="{{ route('login') }}">Login Account</a>
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

            document.getElementById("button-password-repeat-pw").addEventListener("click", function() {
                let repeatPwInput = document.getElementById("repeat_pw");

                if (repeatPwInput.type === "password") {
                    repeatPwInput.type = "text";
                } else {
                    repeatPwInput.type = "password";
                }
            });

            $('#password').on('copy paste', function(e) {
                e.preventDefault();
                alert('Tidak bisa salin dan tempel pada kolom password!');
                return false;
            });

            $('#repeat_pw').on('copy paste', function(e) {
                e.preventDefault();
                alert('Tidak bisa salin dan tempel pada kolom repeat password!');
                return false;
            });

        });
    </script>
@endsection
