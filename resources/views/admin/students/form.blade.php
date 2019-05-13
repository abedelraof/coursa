@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb-4 justify-content-between align-items-center">
        <h1>
            Create Student
        </h1>
        <a href="{{ route("admin.students.index") }}" class="btn btn-primary">
            back to students
        </a>
    </div>


    <div class="card">

        <div class="card-body">
            <form method="POST" action="">
                @csrf

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               class="form-control"
                               name="name" autofocus>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="date_of_birth"
                           class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                    <div class="col-md-6">
                        <input id="date_of_birth"
                               type="date"
                               class="form-control"
                               name="date_of_birth">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="mobile"
                           class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                    <div class="col-md-6">
                        <input id="mobile"
                               type="number"
                               class="form-control"
                               name="mobile">
                    </div>
                </div>

                <div class="form-group row">
                    <label for="national_id"
                           class="col-md-4 col-form-label text-md-right">{{ __('National ID') }}</label>
                    <div class="col-md-6">
                        <input id="national_id"
                               type="number"
                               class="form-control"
                               name="national_id">
                    </div>
                </div>


                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>


@endsection
