@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <h1>
            Create User
        </h1>
        <a href="{{route("admin.users.index")}}" class="btn btn-primary">
            Back to User
        </a>
    </div>

    <div class="card">
        <div class="card-header">
            <h5 class="font-weight-bold">
                {{ __('Add User') }}
            </h5>
        </div>

      <div class="card-body">
            <form method="POST" action="{{ route("admin.users.save") }} ">
                @csrf

                @if($user->id > 0)
                    <input type="hidden" name="id" value="{{ $user->id }}">
                @endif

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input id="name"
                               type="text"
                               value="{{ old("name",$user->name) }}"
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
                    <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('Email') }}</label>

                    <div class="col-md-6">
                        <input id="email"
                               type="email"
                               value="{{ old("email",$user->email) }}"
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