@extends('layouts.app')
@section('content')
<div class="container">
    <div class="parent">
        <button class="btn btn-primary mb-2"><a href="{{route('dashboard.appointments.create')}}" style="color:#fff">Add Appointment</a></button>
        <div class="table">
            <table class="table mt-2" id="appointmentsTable">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Appointment Date</th>
                        <th scope="col">Reason</th>
                        <th scope="col">Created At</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')

    <script>
        $(document).ready( function () {

            let appointmentsTable = $("#appointmentsTable").DataTable({
                lengthChange: true,
                processing: true,
                serverSide: true,
                responsive: true,
                searching: true,
                dom: 'Blfrtip',
                "buttons": [
                    'colvis',
                ],
                'columnDefs': [{ 'orderable': false, 'targets': 0 }],
                'aaSorting': [[1, 'asc']],
                "ajax": {
                    url: "{{route('dashboard.appointments.datatable')}}",
                },
                "columns": [
                    {"data": "id"},
                    {"data": "username"},
                    {"data": "appointment"},
                    {"data": "reason"},
                    {"data": "created_at"},
                    {"data": "action"},
                ],
                "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            });
        });

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
