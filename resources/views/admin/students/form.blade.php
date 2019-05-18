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

            <form method="POST" action="{{ route("admin.students.save") }}">
                @csrf

                @if($student->id > 0)
                    <input type="hidden" name="id" value="{{ $student->id }}">
                @endif

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               value="{{ $student->name }}"
                               class="form-control"
                               name="name" autofocus>

                        @if($errors->has("name"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("name") }}
                            </div>
                        @endif

                    </div>
                </div>


                <div class="form-group row">
                    <label for="date_of_birth"
                           class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                    <div class="col-md-6">
                        <input id="date_of_birth"
                               type="date"
                               value="{{ $student->date_of_birth }}"
                               class="form-control"
                               name="date_of_birth">

                        @if($errors->has("date_of_birth"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("date_of_birth") }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="mobile"
                           class="col-md-4 col-form-label text-md-right">{{ __('Mobile') }}</label>

                    <div class="col-md-6">
                        <input id="mobile"
                               type="number"
                               value="{{ $student->mobile }}"
                               class="form-control"
                               name="mobile">

                        @if($errors->has("mobile"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("mobile") }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="national_id"
                           class="col-md-4 col-form-label text-md-right">{{ __('National ID') }}</label>
                    <div class="col-md-6">
                        <input id="national_id"
                               type="number"
                               value="{{ $student->national_id }}"
                               class="form-control"
                               name="national_id">

                        @if($errors->has("national_id"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("national_id") }}
                            </div>
                        @endif

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
