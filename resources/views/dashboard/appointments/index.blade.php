@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        <button class="btn btn-primary mb-2"><a href="{{route('dashboard.appointments.create')}}" style="color:#fff">Add Appointment</a></button>
        <div class="table">
            <table class="table mt-2" id="appointmentsTable">
                <thead>
                    <tr>
                        <th scope="col">User Name</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($appointments as $appointment)
                    <tr id="appointment{{ $appointment->id }}">
                        <td>{{ $appointment->user->name }}</td>
                        <td>{{ $appointment->appointment }}</td>
                        <td>{{ $appointment->reason }}</td>
                        <td>{{ $appointment->created_at }}</td>
                        <td>
                            <a href="{{ route('dashboard.appointments.edit',$appointment->id) }}">
                                <span class="text-dark">
                                    <i class="fa fa-edit"></i>
                                </span>
                            </a>
                            <a href="javascript:void(0)" onclick="appointmentDelete({{ $appointment->id }})" >
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
        function appointmentDelete(id){
                var url = '{{ url("admin/appointments/") }}'+'/'+id;
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
                                $('#appointment'+id).remove();
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
