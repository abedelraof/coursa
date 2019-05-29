@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <div>
            <h1>
                Student Show
            </h1>
        </div>

        <div>
            <!--back button-->
            <a href="{{route("admin.users.index")}}" class="btn btn-primary">
                Back
            </a>
        </div>
    </div>

    <div class="card mb-3 mt-3" style="width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                <!--<img src="" class="card-img" alt="">-->
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Student Information</h5>
                    <p class="card-text">
                        <table class="table table-striped bg-white">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Type</th>
                                    <td>{{ $user->type }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection
