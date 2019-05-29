@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <h1>
            Teachers Management
        </h1>
        <a href="{{ route("admin.teachers.create")}} " class="btn btn-primary">
            Create new teacher
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
        @foreach($data as $teacher)
            <tr>
                <td>{{ $teacher->id }}</td>
                <td>{{ $teacher->name }}</td>
                <td>{{ $teacher->date_of_birth }}</td>
                <td>{{ $teacher->national_id }}</td>
                <td>{{ $teacher->mobile }}</td>
                <td>
                    <a href="{{ route("admin.teachers.show",$teacher->id)}}"
                       class="btn btn-info text-capitalize">View</a>

                    <a href="{{ route("admin.teachers.edit", $teacher->id) }}"
                       class="btn btn-warning text-capitalize">edit</a>

                    <form action="{{ route("admin.teachers.delete") }}"
                          method="POST"
                          class="d-inline-block"
                          onsubmit="return confirm('you are about delete a record, are you sure?')">
                        @csrf
                        <input type="hidden" name="id" value="{{ $teacher->id }}">
                        <button class="btn btn-danger text-capitalize" type="submit">delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $data->links() }}
@endsection