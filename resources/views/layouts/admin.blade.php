@extends("layouts.app")

@section("content")
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header bg-info text-white font-weight-bold text-capitalize">
                        {{ __('Control Panel')}}
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                        </ul>
                        <li class="list-group-item">
                            <a href="{{route("admin.students.index")}}" class="d-block">
                                Students Management
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route("admin.teachers.index")}}" class="d-block">
                                Teachers Management
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route("admin.courses.index")}}" class="d-block">
                                Courses Management
                            </a>
                        </li>
                        <li class="list-group-item">
                            <a href="{{route("admin.users.index")}}" class="d-block">
                                Users Management
                            </a>
                        </li>
                    </div>
                </div>
            </div>
            <div class="col-md-9">

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