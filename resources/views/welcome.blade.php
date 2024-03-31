<!DOCTYPE html>
<html lang="en">

@include('admin.layouts.head')
@stack('styles')

<body>
    <div class="col-lg-12">

        <div class="card-body d-flex justify-content-end align-items-center">
            <h5 class="card-title"></h5>
        </div>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Users</h5>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Image</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td><img src="{{ $user->getImageUrl() }}" width="150" height="100" /></td>
                                <td>{{ $user->first_name . '' . $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->position }}</td>


                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>

</body>

</html>
