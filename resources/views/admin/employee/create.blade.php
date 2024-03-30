

@extends('admin.layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12">

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">User Creation</h5>

                    <!-- General Form Elements -->
                    <form method="POST" action="{{ route('user.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="inputText" class="col-sm-6 col-form-label">First Name</label>
                                <input type="text" name="first_name" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="inputText" class="col-sm-6 col-form-label">Last Name</label>
                                <input type="text" name="last_name" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="inputText" class="col-sm-6 col-form-label">Position</label>
                                <input type="text" name="position" class="form-control">
                            </div>
                            <div class="col-lg-6">
                                <label for="inputText" class="col-sm-6 col-form-label">Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-lg-6">
                                <label for="inputText" class="col-sm-6 col-form-label">Password</label>
                                <div class="input-group">
                                    <input type="password" name="password" class="form-control">
                                    <div class="input-group-append">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="document.getElementsByName('password')[0].value = '';">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <label for="inputText" class="col-sm-6 col-form-label">Role</label>
                                <select class="form-select" aria-label="Default select example" name="role">
                                    @foreach (Spatie\Permission\Models\Role::get() as $role)
                                        <option value="{{ $role->name }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <img src="" width="200" height="200" class="image_preview">
                            <div class="form-group mt-3">
                                <input class="form-control" type="file" name="image" id="image">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label">Submit Button</label>
                            <div class="col-sm-10">
                                <button type="submit" class="btn btn-primary">Submit Form</button>
                            </div>
                        </div>
                    </form><!-- End General Form Elements -->

                </div>
            </div>

        </div>

    </div>
@endsection
@push('scripts')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {

            //todo:image preview
            $(document).on('change', '#image', function() {
                $('.error_success_msg_container').html('');
                if (this.files && this.files[0]) {
                    let img = document.querySelector('.image_preview');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);
                    }
                    img.src = URL.createObjectURL(this.files[0]);
                    document.querySelector(".image_preview").files = this.files;
                }
            });


        })
    </script>
@endpush
