@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <div>
            <h1>
                Course Show
            </h1>
        </div>

        <div>
            <!--edit course-->
            <a href="{{ route("admin.courses.edit", $course->id) }}"
               class="btn btn-warning text-capitalize">edit</a>
            <!--delete students-->
            <form action="{{ route("admin.courses.delete") }}"
                  method="POST"
                  class="d-inline-block"
                  onsubmit="return confirm('you are about delete a record, are you sure?')">
                @csrf
                <input type="hidden" name="id" value="{{ $course->id }}">
                <button class="btn btn-danger text-capitalize" type="submit">delete</button>
            </form>
            <!--back button-->
            <a href="{{route("admin.courses.index")}}" class="btn btn-primary">
                Back
            </a>
        </div>
    </div>

    <div class="card mb-3 mt-3" style="width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if($course->image_path)
                    <img src="{{ url($course->image_path) }}"
                         alt="..."
                         class="mb-3 mt-4 ml-2 img-thumbnail card-img">
                @endif
                @if(!$course->image_path)
                    <img src="/uploads/elearn.png"
                         alt="..."
                         class="mb-3 mt-4 ml-2 img-thumbnail card-img">
                @endif
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Course Information</h5>
                    <p class="card-text">
                        <table class="table table-striped bg-white">
                            <tbody>
                                <tr>
                                    <th>Course Name</th>
                                    <td>{{ $course->name }}</td>
                                </tr>
                                <tr>
                                    <th>Number of hours</th>
                                    <td>{{ $course->hours }}</td>
                                </tr>
                                <tr>
                                    <th>Course Description</th>
                                    <td>{{ $course->description }}</td>
                                </tr>
                                <tr>
                                    <th>Skills</th>
                                    <td>{{ $course->skills }}</td>
                                </tr>
                                <tr>
                                    <th>Language</th>
                                    <td>{{ $course->language }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Student in Courses-->
    <div class="card mb-3 mt-3" style="width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Students In Courses</h5>
                    <p class="card-text">
                    <table class="table table-striped bg-white">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Date of Birth</th>
                            <th scope="col">National ID</th>
                            <th scope="col">Mobile</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($course->course_student as $student)
                            <tr>
                                <td>{{ $student->student_id }}</td>
                                <td>{{ $student->student->name }}</td>
                                <td>{{ $student->student->date_of_birth }}</td>
                                <td>{{ $student->student->national_id }}</td>
                                <td>{{ $student->student->mobile }}</td>
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
