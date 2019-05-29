@extends("layouts.admin")

@section("adminContent")
    <div class="d-flex mb4 justify-content-between align-items-center">
        <h1>
            Users Management
        </h1>
        <a href="{{ route("admin.users.create")}} " class="btn btn-primary">
            Create new user
        </a>
    </div>

    <table class="table table-striped bg-white">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Type</th>
            <th scope="col">Email</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($data as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->type }}</td>
                <td>{{ $user->email }}</td>
                <td>

                    @if($user->type == "student")
                    <a href="{{ route("admin.students.show",$user->student->id)}}"
                       class="btn btn-info text-capitalize">View</a>
                        @elseif ($user->type == "teacher")
                        <a href="{{ route("admin.teachers.show",$user->teacher->id)}}"
                           class="btn btn-info text-capitalize">View</a>
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
@endsection