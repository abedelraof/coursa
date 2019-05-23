@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header bg-info text-white font-weight-bold text-capitalize">
                        {{ __('quick links') }}
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a class="d-block" href="{{ route("admin.students.index") }}">
                                    Students Management
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="d-block" href="{{ route("admin.teachers.index") }}">
                                    Teachers Management
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="d-block" href="">
                                    Courses Management
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a class="d-block" href="">
                                    Users Management
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">

                @if(request()->session()->has("success"))
                    <div class="alert alert-success">
                        {{ request()->session()->get("success") }}
                    </div>
                @endif

                @if(request()->session()->has("error"))
                    <div class="alert alert-error">
                        {{ request()->session()->get("error") }}
                    </div>
                @endif

                @yield("adminContent")
            </div>
        </div>
    </div>
@endsection