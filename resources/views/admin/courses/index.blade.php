@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <h1>
            Courses Management
        </h1>
        <a href="{{ route("admin.courses.create")}} " class="btn btn-primary">
            Create new course
        </a>
    </div>

    <table class="table table-striped bg-white">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Hours no</th>
            <th scope="col">Description</th>
            <th scope="col">Skills</th>
            <th scope="col">Language</th>
          <!--  <th scope="col">Teacher Name</th>-->
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>{{ $course->hours }}</td>
                <td>{{ $course->description }}</td>
                <td>{{ $course->skills }}</td>
                <td>{{ $course->language }}</td>
                <td>
                    <a href="{{ route("admin.courses.show",$course->id)}}"
                       class="btn btn-info text-capitalize">View</a>

                    <a href="{{ route("admin.courses.edit", $course->id) }}"
                       class="btn btn-warning text-capitalize">edit</a>

                    <form action="{{ route("admin.courses.delete") }}"
                          method="POST"
                          class="d-inline-block"
                          onsubmit="return confirm('you are about delete a record, are you sure?')">
                        @csrf
                        <input type="hidden" name="id" value="{{ $course->id }}">
                        <button class="btn btn-danger text-capitalize" type="submit">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
