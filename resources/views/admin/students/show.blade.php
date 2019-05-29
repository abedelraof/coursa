@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <div>
            <h1>
                Student Show
            </h1>
        </div>

        <div>
            <!--edit student-->
            <a href="{{ route("admin.students.edit", $student->id) }}"
               class="btn btn-warning text-capitalize">edit</a>
            <!--delete student-->
            <form action="{{ route("admin.students.delete") }}"
                  method="POST"
                  class="d-inline-block"
                  onsubmit="return confirm('you are about delete a record, are you sure?')">
                @csrf
                <input type="hidden" name="id" value="{{ $student->id }}">
                <button class="btn btn-danger text-capitalize" type="submit">delete</button>
            </form>
            <!--back button-->
            <a href="{{route("admin.students.index")}}" class="btn btn-primary">
                Back
            </a>
        </div>
    </div>

    <div class="card mb-3 mt-3" style="width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-4">
                @if($student->image_path)
                    <img src="{{ url($student->image_path) }}"
                         alt="..."
                         class="mb-3 mt-4 ml-2 img-thumbnail card-img">
                @endif
                    @if(!$student->image_path)
                        <img src="/uploads/person.png"
                             alt="..."
                             class="mb-3 mt-4 ml-2 img-thumbnail card-img">
                    @endif

            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Student Information</h5>
                    <p class="card-text">
                        <table class="table table-striped bg-white">
                            <tbody>
                                <tr>
                                    <th>Name</th>
                                    <td>{{ $student->name }}</td>
                                </tr>
                                <tr>
                                    <th>Date of birth</th>
                                    <td>{{ $student->date_of_birth }}</td>
                                </tr>
                                <tr>
                                    <th>National ID</th>
                                    <td>{{ $student->national_id }}</td>
                                </tr>
                                <tr>
                                    <th>Mobile</th>
                                    <td>{{ $student->mobile }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Student Courses-->
    <div class="card mb-3 mt-3" style="width: 100%;">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold">Student Courses</h5>
                    <p class="card-text">
                    <table class="table table-striped bg-white">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <!--<th scope="col">Teacher Name</th>-->
                            <th scope="col">Description</th>
                            <th scope="col">Language</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($student->course_student as $course)
                            <tr>
                                <td>{{ $course->course_id }}</td>
                                <td>{{ $course->course->name }}</td>
                                <!--<td>{{ $course->id }}</td>-->
                                <td>{{ $course->course->description }}</td>
                                <td>{{ $course->course->language }}</td>
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
