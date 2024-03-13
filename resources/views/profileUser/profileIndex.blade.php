@extends('layouts.main')

@section('container')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Profile Settings</h1>
    </div>

    <div class="card ">
        <div class="card-header">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-md-6 mb-2">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Sint, hic exercitationem illum numquam ea
                        tenetur molestiae est quaerat ipsam consequuntur ad iste velit! Reiciendis neque autem eligendi
                        laudantium dolore amet.</p>
                </div>
            </div>
            @foreach ($errors->all() as $item)
                <div class="alert alert-danger">
                    {{ $item }}
                </div>
            @endforeach
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{route('avatar')}}" method="POST" enctype="multipart/form-data" class="mb-2">
                @csrf
                <label for="avatar">Profle Picture: </label>
                <div class="form-group">
                    <input type="file" name="avatar" id="avatar" accept="image/*" class="form-control-file">
                </div>
                <div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                    <img id="preview" src="#" alt="Avatar Preview" class="my-2" style="display: none; width: 250px;">

                </div>
            </form>

            <form action="{{ route('username') }}" method="POST" class="login-form">
                @csrf
                <label for="username">Username: </label>
                <div class="d-flex">
                    <div class="form-group mr-2">
                        <input type="text" id="username" name="username"
                            class="form-control rounded-left @error('username') is-invalid @enderror"
                            placeholder="Input new username" value="{{ $user['username'] }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="form-group w-20">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Change</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('email') }}" method="POST" class="login-form">
                @csrf
                <label for="email">Email: </label>
                <div class="d-flex">
                    <div class="form-group mr-2">
                        <input type="email" id="email" name="email"
                            class="form-control rounded-left @error('email') is-invalid @enderror"
                            placeholder="Input new email" value="{{ $user['email'] }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group w-20">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Change</button>
                    </div>
                </div>
            </form>
            <form action="{{ route('password') }}" method="POST" class="login-form">
                @csrf
                <label for="password">Password: </label>
                <div class="d-flex">
                    <div class="form-group mr-2">
                        <input type="password" id="password" name="password"
                            class="form-control rounded-left @error('password') is-invalid @enderror"
                            placeholder="Input new password">
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-group mr-2">
                        <input type="password" id="pwd-repeat" name="pass_repeat" class="form-control rounded-left"
                            placeholder="Input new password again">
                    </div>
                    <div class="form-group w-20">
                        <button type="submit" class="form-control btn btn-primary rounded submit px-3">Change</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('avatar').addEventListener('change', function(e) {
            var preview = document.getElementById('preview');
            var file = e.target.files[0];
            if (file) {
                var reader = new FileReader();
                reader.onloadend = function() {
                    preview.src = reader.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                preview.style.display = 'none';
            }
        });
        </script>
@endsection
