@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <h1>
            Create Teacher
        </h1>
        <a href="{{route("admin.teachers.index")}}" class="btn btn-primary">
            Back to Teacher
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="font-weight-bold">
                {{ __('Add Teacher') }}
            </h5>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route("admin.teachers.save") }}" enctype="multipart/form-data">
                @csrf

                @if($teacher->id > 0)
                    <input type="hidden" name="id" value="{{ $teacher->id }}">
                @endif

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               value="{{ old("name",$teacher->name) }}"
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
                    <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of birth') }}</label>

                    <div class="col-md-6">
                        <input id="date_of_birth"
                               type="date"
                               value="{{ old("date_of_birth",$teacher->date_of_birth) }}"
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
                    <label for="national_id" class="col-md-4 col-form-label text-md-right">{{ __('National ID') }}</label>

                    <div class="col-md-6">
                        <input id="national_id"
                               type="number"
                               value="{{ old("number",$teacher->national_id) }}"
                               class="form-control"
                               name="national_id">

                        @if($errors->has("national_id"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("national_id") }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="mobile" class="col-md-4 col-form-label text-md-right">{{ __('Mobile No') }}</label>

                    <div class="col-md-6">
                        <input id="mobile"
                               type="number"
                               value="{{ old("mobile",$teacher->mobile) }}"
                               class="form-control"
                               name="mobile">

                        @if($errors->has("mobile"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("mobile") }}
                            </div>
                        @endif

                    </div>
                </div>

                <!-- Add Image-->
                <div class="form-group row">
                    <label for="image_path" class="col-md-4 col-form-label text-md-right">{{ __('Teacher Image') }}</label>

                    <div class="col-md-6">

                        @if($teacher->image_path)
                            <img src="{{ url($teacher->image_path) }}"
                                 alt="..."
                                 class="mb-3 img-thumbnail">
                        @endif


                        <input id="image_path"
                               type="file"
                               class="form-control"
                               name="image">

                        @if($errors->has("image_path"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("image_path") }}
                            </div>
                        @endif
                    </div>
                </div>
<!--*****************************************************************-->
                <h5 class="font-weight-bold">
                    Login Information
                </h5>


                <div class="form-group row">
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                    <div class="col-md-6">
                        <input id="email"
                               type="email"
                               value="{{ old("email",$teacher->user ? $teacher->user->email : "") }}"
                               class="form-control"
                               name="email">

                        @if($errors->has("email"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("email") }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                    <div class="col-md-6">
                        <input id="password"
                               type="password"
                               class="form-control"
                               name="password">

                        @if($errors->has("password"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("password") }}
                            </div>
                        @endif

                    </div>
                </div>

                <div class="form-group row">
                    <label for="password_confirmation" class="col-md-4 col-form-label text-md-right">{{ __('Confirm password') }}</label>

                    <div class="col-md-6">
                        <input id="password_confirmation"
                               type="password"
                               class="form-control"
                               name="password_confirmation">

                        @if($errors->has("password_confirmation"))
                            <div class="text-danger font-weight-bold">
                                {{ $errors->first("password_confirmation") }}
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