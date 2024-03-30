@extends('admin.layouts.app')
@section('content')
    <div class="col-lg-12">


        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Hr List</h5>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Position</th>
                            <th scope="col">Image</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->first_name . '' . $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->position }}</td>
                                <td><img src="{{ $user->getImageUrl() }}" width="150" height="100" /></td>
                                {{-- <td> <a class="btn btn-warning" href="{{ route('user.edit', [$user->id]) }}"><i
                                            class="fa fa-edit"></i> Edit</a></td>
                                <td>
                                    <form action="{{ route('user.destroy', ['user' => $user->id]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('Are you sure you want to delete this user?')">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td> --}}

                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
