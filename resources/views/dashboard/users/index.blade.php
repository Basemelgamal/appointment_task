@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        <button class="btn btn-primary mb-2"><a href="{{route('dashboard.users.create')}}" style="color:#fff">Create User</a></button>
        <div class="table">
            <table class="table mt-2" id="usersTable">
                <thead>
                    <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr id="user{{ $user->id }}">
                        <td>
                            @if(isset($user->image))
                                <img src="{{ url($user->image) }}" style="width:50px;height:50px;border-radius:50px">
                            @else
                                __
                            @endif
                        </td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->phone ?? '__' }}</td>
                        <td>{{ $user->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.users.edit',$user->id) }}">
                                <span class="text-dark">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </a>
                            <a href="javascript:void(0)" onclick="userDelete({{ $user->id }})" >
                                <span class="text-danger">
                                    <i class="fa fa-trash"></i>
                                </span>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        function userDelete(id){
                var url = '{{ url("admin/users/") }}'+'/'+id;
                Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url:url,
                            type:'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            success:function(res){
                                $('#user'+id).remove();
                                Swal.fire(
                                    res['alert']['title'],
                                    res['alert']['text'],
                                    res['alert']['icon']
                                )
                            }
                        })
                    }
                })
            }
    </script>
@endpush
