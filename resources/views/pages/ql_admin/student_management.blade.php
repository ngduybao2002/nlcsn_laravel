<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Management') }}
        </h2>
    </x-slot>

    @if (Session::has('success'))
        <script>
        window.onload = function() {
            swal('Success', '{{ Session::get('success') }}', 'success',{
                button:true,
                button:'OK',
                timer:5000,
            });
        }
        </script>
    @endif
    @if (Session::has('confirm'))
        <script>
        window.onload = function() {
            swal('Confirm', '{{ Session::get('confirm') }}', 'confirm',{
                title: "Are you sure?",
                icon: "warning"
                buttons:true,
                timer:5000,
                dangerMode: true,
            });
        }
        </script>
    @endif
    @if (Session::has('error'))
        <script>
        window.onload = function() {
            swal('Error', '{{ Session::get('error') }}', 'error',{
                button:true,
                button:'OK',
                timer:5000,
            });
        }
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-emerald-200 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="my-4 mx-4 sm:rounded-lg">
                    <div class="w-full overflow-hidden rounded-lg shadow-xs">
                        <div class="w-full overflow-x-auto">
                            <div class="mb-4">
                                Total Teacher: {{ $totalStudents }}
                            </div>
                            <table class="w-full whitespace-nowrap table-auto" name=hasregistered>
                                <caption class="caption-top mb-2 font-semibold text-xl text-gray-800">
                                    Has registered course: {{ $registeredStudents->count() }}
                                </caption>
                                <thead>
                                    <tr class="text-xs font-medium tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Gender</th>
                                    <th class="px-4 py-3">Birthday</th>
                                    <th class="px-4 py-3">Address</th>
                                    <th class="px-4 py-3">Phone</th>
                                    <th class="px-4 py-3">Course</th>
                                    <th class="px-4 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y">
                                    @foreach($registeredStudents as $student)
                                        <tr>
                                            <!-- Table data  -->
                                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-3">{{ $student->name }}</td>
                                            <td class="px-4 py-3">{{ $student->email }}</td>
                                            <td class="px-4 py-3">{{ $student->gender }}</td>
                                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($student->birthday)->format('d-m-Y') }}</td>
                                            <td class="px-4 py-3">{{ $student->address }}</td>
                                            <td class="px-4 py-3">0{{ $student->phone }}</td>
                                            <td class="px-4 py-3">{{ $student->registeredCourseStudent() }}</td>
                                            <td>
                                                <form action="" method="POST" onsubmit="confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="hover:text-red-500" onclick="confirmDeleteStudent(event, '{{ route('student-deleteCourse', ['userId' => $student->id, 'courseName' => $student->registeredCourseStudent()]) }}')">Delete</button>
                                                </form> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <table class="w-full whitespace-nowrap table-auto mt-8 name=hasnotregistered">
                                <caption class="caption-top mb-2 font-semibold text-xl text-gray-800">
                                    Has not registered course: {{ $notRegisteredStudents->count() }}
                                </caption>
                                <thead>
                                    <tr class="text-xs font-medium tracking-wide text-left text-gray-500 uppercase border-b bg-gray-50">
                                    <th class="px-4 py-3">ID</th>
                                    <th class="px-4 py-3">Name</th>
                                    <th class="px-4 py-3">Email</th>
                                    <th class="px-4 py-3">Gender</th>
                                    <th class="px-4 py-3">Birthday</th>
                                    <th class="px-4 py-3">Address</th>
                                    <th class="px-4 py-3">Phone</th>
                                    <th class="px-4 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y">
                                    @foreach($notRegisteredStudents as $student)
                                        <tr>
                                            <!-- Table data  -->
                                            <td class="px-4 py-3">{{ $loop->iteration }}</td>
                                            <td class="px-4 py-3">{{ $student->name }}</td>
                                            <td class="px-4 py-3">{{ $student->email }}</td>
                                            <td class="px-4 py-3">{{ $student->gender }}</td>
                                            <td class="px-4 py-3">{{ \Carbon\Carbon::parse($student->birthday)->format('d-m-Y') }}</td>
                                            <td class="px-4 py-3">{{ $student->address }}</td>
                                            <td class="px-4 py-3">0{{ $student->phone }}</td>
                                            <td>
                                                <form action="" method="POST" onsubmit="confirmDelete()">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="hover:text-red-500" onclick="confirmDeleteUserStudent(event, '{{ route('student-deleteUser', ['userId' => $student->id]) }}')">Delete</button>
                                                </form> 
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    //confirmDeleteStudent
    function confirmDeleteStudent(event, route) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            timer: 5000,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                deleteStudent(route);
            }
        });
    }

    function deleteStudent(route) {
        fetch(route, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                swal("Poof! Student has been removed from the course!", {
                    icon: "success",
                    timer: 5000,
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            closeModal: true
                        }
                    }
                })
                .then((value) => {
                    // Reload the page when user clicks on OK or after 5 seconds
                    if (value) {
                        location.reload();
                    } else {
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    }
                });
            } else {
                swal("Oops! Something went wrong, please refresh your website!", {
                    icon: "error",
                    timer: 5000,
                });
            }
        });
    }

    //confirmDeleteUserStudent
    function confirmDeleteUserStudent(event, route) {
        event.preventDefault();
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this user!",
            icon: "warning",
            buttons: true,
            timer: 5000,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                deleteStudentUser(route);
            }
        });
    }

    function deleteStudentUser(route) {
        fetch(route, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                swal("Poof! Student has been removed!", {
                    icon: "success",
                    timer: 5000,
                    buttons: {
                        confirm: {
                            text: "OK",
                            value: true,
                            visible: true,
                            closeModal: true
                        }
                    }
                })
                .then((value) => {
                    // Reload the page when user clicks on OK or after 5 seconds
                    if (value) {
                        location.reload();
                    } else {
                        setTimeout(function() {
                            location.reload();
                        }, 5000);
                    }
                });
            } else {
                swal("Oops! Something went wrong, please refresh your website!", {
                    icon: "error",
                    timer: 5000,
                });
            }
        });
    }
</script>