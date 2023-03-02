<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css”/>
    <link rel=”stylesheet” href=”https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css” />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title text-uppercase mb-0">Users Settings</h3>
                    </div>
                    <a href="{{ route('dashboard') }}">
                        <button class="btn btn-primary">Dashboard</button></a>
                    {{-- @if (auth()->check() && --}}
                            {{-- auth()->user()->can('view posts')) --}}
                        {{-- <a href="{{ route('settings') }}">
                            <button type="button" class="btn btn-info">Settings</button>
                        </a> --}}
                    {{-- @endif --}}

                    <div class="table-responsive">
                        <table class="table">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Roles</th>
                                    <th scope="col">Edit</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($user)
                                    @foreach ($user as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $user->first_name }} </td>
                                            <td>{{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                @if ($user->roles)
                                                    @foreach ($user->roles as $role)
                                                    {{ $role->name }}
                                                    @endforeach
                                                @endif
                                                </td>
                                            <td>
                                                <ul class="list-inline m-0">
                                                <li class="list-inline-item">
                                                    <form action="">
                                                        <a href="{{ route('editUser',['user' => $user->id])}}" class="btn btn-info btn-sm" >
                                                        <span class="glyphicon glyphicon-pencil"></span>
                                                      </a>
                                                    </form>

                                                </li>
                                                <li class="list-inline-item">
                                                    {{-- <button type="button" class="btn btn-default btn-sm">
                                                        <a href="{{ route('deleteUser',['user' => $user->id])}}"><span class="glyphicon glyphicon-trash"></span></a>
                                                      </button> --}}
                                                      <form method="POST" action="{{ route('deleteUser', ['user' => $user->id]) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <button type="submit">Delete User</button>
                                                    </form>
                                                    </li>
                                            </ul></td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>


                    </div>
                    <div class="card-body">
                        <h5 class="card-title text-uppercase mb-0"><a href="{{ route('logout') }}">Logout</a></h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</body>

</html>
