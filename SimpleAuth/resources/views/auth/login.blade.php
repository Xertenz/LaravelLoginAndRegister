<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <title>Login Page</title>
</head>
<body>
    <style>
        .my_form{
            width: 45%;
            margin: 30px auto
        }
        .new_acc{
            text-decoration: none;
        }
    </style>

    <div class="container">
        <div class="row">
            <div class="my_form">
                <div class="card">
                    <div class="card-header">
                        <h3>Login To Your Account</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('check.login') }}" method="post">
                            @csrf

                            <div class="results">
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @elseif (Session::has('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="username">Email</label>
                                <input class="form-control" type="email" name="email" id="email" value="{{ old('email') }}">
                                <span>@error('email') {{ $message }} @enderror</span>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input class="form-control" type="password" name="password" id="password" value="{{ old('password') }}">
                                <span>@error('password') {{ $message }} @enderror</span>
                            </div>
                            <div class="d-grid mt-3">
                                <input class="btn btn-primary" type="submit" value="Login">
                            </div>
                        </form>
                    </div><div class="card-footer">
                        <a class="new_acc" href="{{ route('auth.register') }}">Create a new account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>
</body>
</html>
