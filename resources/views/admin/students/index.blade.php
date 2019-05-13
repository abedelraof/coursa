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
        <tr>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>1</td>
            <td>
                <a href="" class="btn btn-info text-capitalize">View</a>
                <a href="" class="btn btn-warning text-capitalize">edit</a>
                <a href="" class="btn btn-danger text-capitalize">delete</a>
            </td>
        </tr>
        </tbody>
    </table>
@endsection
