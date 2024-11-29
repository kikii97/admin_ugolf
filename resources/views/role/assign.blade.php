@extends('index')

@section('content')
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <!-- Notification Element -->
        <div id="notification" class="alert" style="display: none;">
            <strong id="notificationTitle">Notification</strong>
            <p id="notificationMessage"></p>
        </div>
        <div class="row">
            <div class="align-self-center" style="display: flex;align-items: center;justify-content: space-between;">
                <div style="display: flex;gap:20px;align-items: center;">
                    <h4 style="font-family: 'Kufam', sans-serif;margin:0"
                        class="page-title text-truncate text-dark font-weight-medium">Assign Roles</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item"><a href="/roles" class="text-muted">Role</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Assign Role</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div style="display: flex;">
                    <div class="customize-input float-end" style="margin-left:20px; margin-buttom:15px;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addUserModal">
                            <button class="custom-select-set form-control btn-gradient-purple">
                                <span style="margin-left: 12px;">Add</span>
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Container fluid  -->
    <div class="container-fluid">
        <div class="col-12">
            <div class="card">

                <div class="card-body">
                    <div class="row">
                        <!-- Column -->
                    </div>
                    <div class="table-responsive">
                        <table id="user-table" class="table table-bordered table-striped table-hover" style="width:100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="d-flex justify-content-center align-items-center">No</th>
                                    <th>User</th>
                                    <th>Email</th>
                                    <th>Roles</th>
                                    @can('role.edit')
                                        <th>Action</th>
                                    @endcan
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Add User Modal -->
    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="addRoleLabel">Add New User</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <form action="{{ route('roles.newUser') }}" method="POST">
                    <div class="modal-body" style="padding: 20px;">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="roleSelected" class="form-label">Role</label>
                            <select class="form-select" name="role_id" id="roleSelect" required>
                                <option value="">-- Select Role --</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role['id'] }}">
                                        {{ $role['name'] }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer" style="border-top: none; padding-top: 0;">
                        <button type="submit" class="btn btn-gradient-purple">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Role -->
    <div class="modal fade" id="deleteUserModal" tabindex="-1" aria-labelledby="deleteRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="deleteRoleLabel">Delete role</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p>Are you sure you want to delete this user?</p>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="deleteBtn" class="btn btn-gradient-purple">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk Edit Role -->
    @can('role.edit')
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
                <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                    <div class="modal-header"
                        style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                        <h5 class="modal-title text-white" id="editUserModalLabel">Edit User Role</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                            style="font-weight: bold; opacity: 1; color: white;"></button>
                    </div>
                    <form id="editUserRoleForm" method="POST">
                        <div class="modal-body" style="padding: 20px;">
                            @csrf
                            @method('PUT')
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="roles" class="form-label">Select Roles</label>
                                    <select name="roles[]" id="rolesSelect" class="form-select"></select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer" style="border-top: none; padding-top: 0;">
                            <button type="submit" class="btn btn-gradient-purple">Save Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endcan


    <script src="../js/jquery.min.js"></script>
    <script src="../datatables/jquery.datatables.min.js"></script>
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../datatables/datatables.bootstrap5.min.js"></script>
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

    <script>
        // Delete user
        $('#user-table').on('click', '.btn-delete', function() {
            selectedId = $(this).data('id');
            $('#deleteUserModal').modal('show');
        });

        $('#deleteBtn').click(function() {
            $.ajax({
                url: `{{ env('API_URL') }}/roles/assign/${selectedId}`,
                type: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('jwt_token') }}'
                },
                success: function(response) {
                    showNotification('success', 'Role deleted successfully');
                    $('#deleteUserModal').modal('hide');
                    $('#role-table').DataTable().ajax.reload();
                },
                error: function() {
                    showNotification('error', 'Error occurred while deleting user');
                }
            });
        });

        // Notification function
        function showNotification(type, message) {
            let notificationTitle = '';
            let notificationClass = '';

            switch (type) {
                case 'success':
                    notificationTitle = 'Sukses!';
                    notificationClass = 'alert-success';
                    break;
                case 'error':
                    notificationTitle = 'Error!';
                    notificationClass = 'alert-danger';
                    break;
                default:
                    notificationTitle = 'Notification';
                    notificationClass = 'alert-info';
            }

            // Save notification to localStorage
            const notification = {
                title: notificationTitle,
                message: message,
                class: notificationClass
            };

            localStorage.setItem('notification', JSON.stringify(notification));

            // Reload the page to trigger notification display
            window.location.reload();
        }

        // Check for notification in localStorage after page load
        $(document).ready(function() {
            const notification = JSON.parse(localStorage.getItem('notification'));
            if (notification) {
                $('#notificationTitle').text(notification.title);
                $('#notificationMessage').text(notification.message);
                $('#notification').removeClass('alert-success alert-danger alert-info')
                    .addClass(notification.class).fadeIn();

                setTimeout(function() {
                    $('#notification').fadeOut();
                }, 2500);

                // Clear the notification from localStorage after showing it
                localStorage.removeItem('notification');
            }
        });

        // Inisialisasi DataTable
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ env('API_URL') }}/roles/assign',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('jwt_token') }}'
                },
                cache: false // Pastikan data baru dimuat
            },
            columns: [{
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'email',
                    name: 'email'
                },
                {
                    data: 'roles',
                    name: 'roles',
                    render: (data) => data ? data.join(', ') : ''
                },
                @can('role.edit')
                    {
                        data: 'id',
                        orderable: false,
                        render: (data, type, row) => `
                <div class="d-flex">
                    <button type="button" class="btn-edit btn-action" data-bs-toggle="modal" data-bs-target="#editUserModal" data-id="${data}" data-name="${row.name}" data-roles="${row.roles.join(',')}">
                        <span class="iconify" data-icon="heroicons:pencil" style="font-size: 22px;"></span>
                    </button>
                    <button class="btn-delete btn-action" data-id="${data}">
                        <span class="iconify" data-icon="heroicons:trash" style="font-size: 22px;"></span>
                    </button>
                </div>`
                    }
                @endcan
            ],
            order: [
                [1, 'asc']
            ],
            autoWidth: false
        });

        // Event saat tombol Edit diklik
        $('#user-table').on('click', '.btn-edit', function() {
            const userId = $(this).data('id');
            const userName = $(this).data('name');
            const userRoles = $(this).data('roles');

            const form = document.getElementById('editUserRoleForm');
            form.action = `{{ env('API_URL') }}/roles/assign/${userId}`;

            // Update title modal
            const modalTitle = document.querySelector('#editUserModal .modal-title');
            modalTitle.textContent = `Edit Roles for ${userName}`;

            // Ambil data roles dari API untuk mengisi select box
            $.ajax({
                url: '{{ env('API_URL') }}/roles',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('jwt_token') }}'
                },
                success: function(response) {
                    const rolesSelect = document.getElementById('rolesSelect');
                    rolesSelect.innerHTML = '';

                    response.data.forEach(function(role) {
                        const option = document.createElement('option');
                        option.value = role.name;
                        option.textContent = role.name;
                        option.selected = userRoles.includes(role.name);
                        rolesSelect.appendChild(option);
                    });
                }
            });
        });

        // Bersihkan modal saat ditutup
        $('#editUserModal').on('hidden.bs.modal', function() {
            const rolesSelect = document.getElementById('rolesSelect');
            rolesSelect.innerHTML = '';
        });

        // Handle form submission
        document.getElementById('editUserRoleForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const form = e.target;

            $.ajax({
                url: form.action,
                method: form.method,
                data: $(form).serialize(),
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('jwt_token') }}'
                },
                success: function() {
                    $('#editUserModal').modal('hide');
                    showNotification('success', 'Role updated successfully.');
                    $('#user-table').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    console.error('Error Details:', xhr);
                    if (xhr.status === 500) {
                        showNotification('error', 'Server error. Please try again later.');
                    } else if (xhr.status === 422) {
                        showNotification('error', 'Validation failed. Please check the input.');
                    } else {
                        showNotification('error',
                            `Failed to update role. (${xhr.status}: ${xhr.statusText})`);
                    }
                }
            });

        });
    </script>
@endsection
