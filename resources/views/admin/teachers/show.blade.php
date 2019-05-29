@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <div>
            <h1>
                Teacher Show
            </h1>
        </div>

        <div>
            <!--edit student-->
            <a href="{{ route("admin.teachers.edit", $teacher->id) }}"
               class="btn btn-warning text-capitalize">edit</a>
            <!--delete student-->
            <form action="{{ route("admin.teachers.delete") }}"
                  method="POST"
                  class="d-inline-block"
                  onsubmit="return confirm('you are about delete a record, are you sure?')">
                @csrf
                <input type="hidden" name="id" value="{{ $teacher->id }}">
                <button class="btn btn-danger text-capitalize" type="submit">delete</button>
            </form>
            <!--back button-->
            <a href="{{route("admin.teachers.index")}}" class="btn btn-primary">
                Back
            </a>
        </div>
    </div>

    <div class="card mb-3 mt-3" style="width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if($teacher->image_path)
                    <img src="{{ url($teacher->image_path) }}"
                         alt="..."
                         class="mb-3 mt-4 ml-2 img-thumbnail card-img">
                @endif
                    @if(!$teacher->image_path)
                        <img src="/uploads/person.png"
                             alt="..."
                             class="mb-3 mt-4 ml-2 img-thumbnail card-img">
                    @endif

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Teacher Information</h5>
                    <p class="card-text">
                        <table class="table table-striped bg-white">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $teacher->name }}</td>
                                </tr>
                                <tr>
                                    <th>Date of birth</th>
                                    <td>{{ $teacher->date_of_birth }}</td>
                                </tr>
                                <tr>
                                    <th>National ID</th>
                                    <td>{{ $teacher->national_id }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{ $teacher->mobile }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Teacher Courses-->
    <div class="card mb-3 mt-3" style="width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Teacher Courses</h5>
                    <p class="card-text">
                    <table class="table table-striped bg-white">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Language</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($teacher->course as $courses)
                            <tr>
                                <td>{{ $courses->id }}</td>
                                <td>{{ $courses->name }}</td>
                                <td>{{ $courses->description }}</td>
                                <td>{{ $courses->language }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
