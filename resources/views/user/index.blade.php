@extends('layouts.main')

@section('container')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Base API</h1>
        <a class="btn btn-success mb-3" href="/users/create">Create</a>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('message') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <table class="table text-center mb-3">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            {{-- //di foreach dari $users['data'] karna biasanya response dari API itu di bungkus dalam index 'data' --}}
            @forelse($users['data'] as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user['firstName'] }}</td>
                    <td>{{ $user['lastName'] }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user['id']) }}" class="btn btn-warning"><i
                                class="fa fa-fw fa-edit"></i>
                            Edit</a>

                        <form method="POST" action="{{ route('users.destroy', $user['id']) }}" class="d-inline block">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger"
                                onClick="return confirm('Are you sure to delete this user?');"><i
                                    class="fa fa-fw fa-trash"></i> Delete</button>
                        </form>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center fs-4">User Not Available</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if ($users['total'] > $users['limit'])
        @php
            $pages = ceil($users['total'] / $users['limit']);
        @endphp
        <nav aria-label="Page navigation example">
            <ul class="pagination">
                <li class="page-item {{ request('page') == 1 || is_null(request('page')) ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ request('page') ? request('page') - 1 : 1 }}"
                        aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                @for ($i = 1; $i <= $pages; $i++)
                    <li
                        class="page-item {{ request('page') == $i || (is_null(request('page')) && $i == 1) ? 'active' : '' }}">
                        <a class="page-link" href="?page={{ $i }}">{{ $i }}</a>
                    </li>
                @endfor
                <li class="page-item {{ request('page') == $pages ? 'disabled' : '' }}">
                    <a class="page-link" href="?page={{ request('page') ? request('page') + 1 : $pages }}"
                        aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    @endif
    {{-- {!! $users->links() !!} --}}
@endsection
