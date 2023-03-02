<!DOCTYPE html>
<html>

<head>
    <title>Login Form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<body>


    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default ">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit User</h3>
                    </div>
                    <div class="panel-body">
                        <form action="{{ route('updateUser',$user->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">First Name</label>
                                <input type="text" class="form-control" value="{{ $user->first_name }}"
                                    id="first_name" name="first_name" placeholder="Enter your first_name" required>
                            </div>
                            <div class="form-group">
                                <label for="name">Last Name</label>
                                <input type="text" class="form-control" value="{{ $user->last_name }}" id="last_name"
                                    name="last_name" placeholder="Enter your last_name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" value="{{ $user->email }}" id="email" name="email"
                                    placeholder="Enter your email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" value="{{ $user->password }}" id="password" name="password"
                                    placeholder="Enter your password" required>
                            </div>
                            <!-- <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
                            </div> -->
                            <div id="my-dropdown-container">
                                <select name="role" id="role" class="form-select"
                                    aria-label="Default select example">
                                    <option value="">{{ $user->roles->pluck('name')->first() }}</option>i
                                    @foreach ($roles as $roleName)
                                        <option value="{{ $roleName }}">{{ $roleName }}</option>
                                    @endforeach

                                </select>
                            </div><br>
                            <button type="submit" class="btn btn-primary">Register</button>
                        </form>
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- <script>
        function toggleDropdown() {
            var dropdownContainer = document.getElementById('my-dropdown-container');
            if (window.location.pathname === '/registeration') {
                dropdownContainer.style.display = 'none';
            } else {
                dropdownContainer.style.display = 'block';
            }
        }

        // Call the function when the page loads
        toggleDropdown();
    </script> --}}
</body>

</html>
