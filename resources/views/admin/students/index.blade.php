@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb-4 justify-content-between align-items-center">
        <h1>
            Students Management
        </h1>
        <a href="{{ route("admin.students.create") }}" class="btn btn-primary">
            Create new student
        </a>
    </div>

    <table class="table table-striped bg-white">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">DOB</th>
            <th scope="col">Mobile</th>
            <th scope="col">ID</th>
            <th scope="col">actions</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $student)
            <tr>
                <td>{{ $student->id }}</td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->date_of_birth }}</td>
                <td>{{ $student->mobile }}</td>
                <td>{{ $student->national_id }}</td>
                <td>
                    <a href="" class="btn btn-info text-capitalize">View</a>
                    <a href="{{ route("admin.students.edit", $student->id) }}" class="btn btn-warning text-capitalize">edit</a>
                    <form onsubmit="return confirm('you are about to delete a record, Are u sure?')" class="d-inline-block" action="{{ route("admin.students.delete") }}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{ $student->id }}">
                        <button type="submit" class="btn btn-danger text-capitalize">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>

    {{ $data->links() }}
@endsection
