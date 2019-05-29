@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <h1>
            Students Management
        </h1>
        <a href="{{ route("admin.students.create")}} " class="btn btn-primary">
            Create new student
        </a>
    </div>

    <table class="table table-striped bg-white">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Date of birth</th>
            <th scope="col">National ID</th>
            <th scope="col">Mobile</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>

            @foreach($data as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->date_of_birth }}</td>
                    <td>{{ $student->national_id }}</td>
                    <td>{{ $student->mobile }}</td>
                    <td>
                        <a href="{{ route("admin.students.show",$student->id)}}"
                           class="btn btn-info text-capitalize">View</a>

                        <a href="{{ route("admin.students.edit", $student->id) }}"
                           class="btn btn-warning text-capitalize">edit</a>

                        <form action="{{ route("admin.students.delete") }}"
                              method="POST"
                              class="d-inline-block"
                              onsubmit="return confirm('you are about delete a record, are you sure?')">
                            @csrf
                            <input type="hidden" name="id" value="{{ $student->id }}">
                            <button class="btn btn-danger text-capitalize" type="submit">delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>

    {{ $data->links() }}
@endsection