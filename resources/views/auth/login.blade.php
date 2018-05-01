<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Login</title>
    <link rel="stylesheet" href="{{asset('js/bootstrap/css/bootstrap.min.css')}}">
</head>
<body>
<div class="container">
        <div class="row">
            <div class="col-sm-6 mx-auto">
                <div class="panel panel-default">
                    <h2 class="text-primary text-center">User Login</h2>
                    <hr>
                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                            {{ csrf_field() }}
    
                            <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                                <label for="username" class="col-sm-4 control-label">Username</label>
    
                                <div class="col-sm-8">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('email') }}" required autofocus>
    
                                    
                                </div>
                            </div>
    
                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>
    
                                <div class="col-md-8">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                    <br>
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                    <div class="text-danger">
                                        @if ($errors->has('password'))
                                            Invalid username or password!
                                        @endif
                                        @if ($errors->has('email'))
                                            Invalid username or password!
                                        @endif
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

