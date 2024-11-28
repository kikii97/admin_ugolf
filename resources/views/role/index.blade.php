@extends('index')

@section('content')

    <style>
        .btn-gradient-purple {
            background: linear-gradient(45deg, #78296D, #D058B9);
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, .2);
            transition: background .3s ease, box-shadow .3s ease
        }

        .btn-gradient-purple:hover {
            background: linear-gradient(45deg, #6c2563, #a1448f);
            box-shadow: 0 6px 12px rgba(0, 0, 0, .3)
        }

        .btn-action {
            background: none;
            border: none;
            padding: 10px;
            cursor: pointer;
            transition: transform .2s ease, box-shadow .3s ease
        }

        .btn-action:hover {
            transform: scale(1.1);
            box-shadow: 0 4px 8px rgba(0, 0, 0, .2)
        }

        .iconify {
            font-size: 22px;
            color: #6c2563
        }

        .iconify:hover {
            color: #D058B9
        }

        #notification {
            position: fixed;
            top: 10px;
            right: 10px;
            width: 300px;
            padding: 15px;
            border-radius: 5px;
            z-index: 9999;
            display: none;
            text-align: center;
            justify-content: flex-start;
            align-items: center;
            text-align: left
        }

        .alert-success {
            background-color: #c3e6cb;
            color: #449e59;
            border: 1px solid #c3e6cb;
            height: 80px
        }

        .alert-danger {
            background-color: #f5c6cb;
            color: #c4616b;
            border: 1px solid #f5c6cb;
            height: 80px
        }
    </style>

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
                    <h4 style="font-family: 'Kufam', sans-serif;"
                        class="page-title text-truncate text-dark font-weight-medium">Role Management</h4>
                    <div class="d-flex align-items-center">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb m-0 p-0">
                                <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Dashboard</a></li>
                                <li class="breadcrumb-item text-muted active" aria-current="page">Role</li>
                            </ol>
                        </nav>
                    </div>
                </div>
                <div style="display: flex;">
                    <div class="customize-input float-end" style="margin-left:20px; margin-buttom:15px;">
                        <a href="#" data-bs-toggle="modal" data-bs-target="#addRoleModal">
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
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">

                    <div class="card-body">
                        <div class="row">
                            <!-- Column -->
                        </div>
                        <div class="table-responsive">
                            <table id="role-table" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="d-flex justify-content-center align-items-center">No</th>
                                        <th>Role</th>
                                        <th>Permission</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- basic table -->
        <div class="row">
            <div class="col-5 align-self-center" style="margin-top:10px;">
                <div class="customize-input float-end" style="margin-left:20px; margin-buttom:15px;">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addUserModal">
                        <button class="custom-select-set form-control btn-gradient-purple">
                            <span style="margin-left: 12px;">Add</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
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

    <!-- Add role Modal -->
    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-labelledby="addRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="addRoleLabel">Add New Role</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- Add Role -->
                    <form id="addRole">
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <input type="text" class="form-control" id="role" required>
                        </div>
                        <div class="mb-3">
                            <label for="permissions" class="form-label">Permissions</label>

                            @foreach ($groupedPermissions as $module => $permissions)
                                <div class="card mb-2" style="padding-left: 0 !important;">
                                    <div class="card-header">
                                        <h5 class="mb-0">Modul {{ ucfirst($module) }}</h5>
                                    </div>
                                    <div id="{{ $module }}Permissions" class="show">
                                        <div class="card-body">
                                            @foreach ($permissions as $permission)
                                                <div class="form-check form-switch">
                                                    <input type="checkbox" name="permissions[]"
                                                        value="{{ $permission['name'] }}" class="form-check-input"
                                                        id="permission-{{ $permission['id'] }}">
                                                    <label class="form-check-label"
                                                        for="permission-{{ $permission['id'] }}">
                                                        {{ $permissionNames[$permission['name']] ?? ucfirst(str_replace("{$module}.", '', $permission['name'])) }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            <script>
                                function handlePermissionCheck(checkbox, permissionName) {
                                    if (permissionName === 'item request.viewAll' || permissionName === 'item request.viewFilterbyUser') {
                                        const viewAll = document.querySelector('input[value="item request.viewAll"]');
                                        const viewFilter = document.querySelector('input[value="item request.viewFilterbyUser"]');

                                        if (checkbox.checked) {
                                            if (permissionName === 'item request.viewAll') {
                                                viewFilter.checked = false;
                                            } else {
                                                viewAll.checked = false;
                                            }
                                        }
                                    }
                                }
                            </script>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="saveBtn" class="btn btn-gradient-purple">Save Role</button>
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
                <div class="modal-body" style="padding: 20px;">
                    <!-- Add User -->
                    <form id="addUser">
                        <div class="mb-3">
                            <label for="user" class="form-label">User</label>
                            <input type="text" class="form-control" id="user" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="roleSelected" class="form-label">Role</label>
                            <select class="form-select" name="role_id" id="roleSelect" required>
                                <option value="">-- Select Role --</option>
                                {{-- @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->merchant_id }}"
                                        data-merchant-code="{{ $merchant->merchant_code }}">
                                        {{ $merchant->merchant_code }} - {{ $merchant->merchant_name }}
                                    </option>
                                @endforeach --}}
                            </select>
                        </div>
                    </form>
                </div>
            </div>
            <div class="modal-footer" style="border-top: none; padding-top: 0;">
                <button type="button" id="save" class="btn btn-gradient-purple">Save Role</button>
            </div>
        </div>
    </div>
    </div>

    <!-- Edit role -->
    @can('roles.edit')
        <div class="modal fade" id="editRoleModal" tabindex="-1" aria-labelledby="editRoleLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
                <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                    <div class="modal-header"
                        style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                        <h5 class="modal-title text-white" id="editRoleLabel">Edit Role</h5>
                        <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                            style="font-weight: bold; opacity: 1; color: white;"></button>
                    </div>
                    <div class="modal-body" style="padding: 20px;">
                        <!-- Edit Role -->
                        <form id="editRoleForm">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="editname" class="form-label">Role</label>
                                <input type="text" name="editname" id="editname" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="editpermissions" class="form-label">Permissions</label>

                                @foreach ($groupedPermissions as $module => $permissions)
                                    <div class="card mb-2" style="padding-left: 0 !important;">
                                        <div class="card-header">
                                            <h5 class="mb-0">Modul {{ ucfirst($module) }}</h5>
                                        </div>
                                        <div id="{{ $module }}Permissions" class="collapse show">
                                            <div class="card-body">
                                                @foreach ($permissions as $permission)
                                                    <div class="form-check form-switch">
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $permission['name'] }}" class="form-check-input"
                                                            id="permission-{{ $permission['id'] }}"
                                                            {{ in_array($permission['name'], old('permissions', $rolePermissions ?? [])) ? 'checked' : '' }}
                                                            onclick="session('jwt_token')(this, '{{ $permission['name'] }}')">
                                                        <label class="form-check-label"
                                                            for="permission-{{ $permission['id'] }}">
                                                            {{ $permissionNames[$permission['name']] ?? ucfirst(str_replace("{$module}.", '', $permission['name'])) }}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <script>
                                    function session('jwt_token')(checkbox, permissionName) {
                                        if (permissionName === 'item request.viewAll' || permissionName === 'item request.viewFilterbyUser') {
                                            const viewAll = document.querySelector('input[value="item request.viewAll"]');
                                            const viewFilter = document.querySelector('input[value="item request.viewFilterbyUser"]');

                                            if (checkbox.checked) {
                                                if (permissionName === 'item request.viewAll') {
                                                    viewFilter.checked = false;
                                                } else {
                                                    viewAll.checked = false;
                                                }
                                            }
                                        }
                                    }
                                </script>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="border-top: none; padding-top: 0;">
                        <button type="button" id="updateBtn" class="btn btn-gradient-purple">Update Role</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Script to handle edit button click -->
        <script>
            $(document).ready(function() {
                let selectedId = null; // Define global variable to store selected role ID

                // Handle edit button click
                $('#role-table').on('click', '.btn-edit', function() {
                    selectedId = $(this).data('id'); // Store role ID globally

                    // Fetch role data from API
                    $.ajax({
                        url: `{{ env('API_URL') }}/roles/${selectedId}`,
                        type: 'GET',
                        headers: {
                            'Authorization': 'Bearer {{ session('jwt_token') }}'
                        },
                        success: function(response) {
                            if (response.status === 'success') {
                                const role = response.data;
                                $('#editname').val(role.name); // Set role name

                                // Uncheck all permissions first
                                $('input[name^=permissions]').prop('checked', false);

                                // Check permissions based on fetched role data
                                if (role.permissions && role.permissions.length) {
                                    role.permissions.forEach(permission => {
                                        $(`input[value="${permission}"]`).prop('checked',
                                            true);
                                    });
                                }

                                $('#editRoleModal').modal('show'); // Show modal
                            } else {
                                showNotification('error', 'Failed to fetch role data');
                            }
                        },
                        error: function() {
                            showNotification('error', 'Error occurred while fetching role data');
                        }
                    });
                });

                // Handle update button click
                $('#updateBtn').click(function() {
                    const updatedData = {
                        name: $('#editname').val(),
                        permissions: $('input[name^=permissions]:checked').map(function() {
                            return $(this).val();
                        }).get()
                    };

                    // Send updated data to API
                    $.ajax({
                        url: `{{ env('API_URL') }}/roles/${selectedId}`,
                        type: 'PUT',
                        headers: {
                            'Authorization': 'Bearer {{ session('jwt_token') }}'
                        },
                        data: updatedData,
                        success: function(response) {
                            if (response.status === 'success') {
                                showNotification('success', 'Role updated successfully');
                                $('#editRoleModal').modal('hide'); // Hide modal
                                $('#role-table').DataTable().ajax.reload(); // Reload table
                            } else {
                                showNotification('error', 'Failed to update role');
                            }
                        },
                        error: function() {
                            showNotification('error', 'Error occurred while updating role');
                        }
                    });
                });
            });
        </script>
    @endcan

    <!-- Delete Role -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="deleteRoleLabel">Delete role</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p>Are you sure you want to delete this role?</p>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="deleteBtn" class="btn btn-gradient-purple">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- DataTables JS -->
    <script src="../datatables/jquery.datatables.min.js"></script>

    <!-- DataTables Bootstrap 4 integration -->
    <link rel="stylesheet" href="../datatables/datatables.min.css">
    <script src="../datatables/datatables.bootstrap5.min.js"></script>

    <!-- Add Iconify CDN in the head section -->
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

    <!-- Script untuk inisialisasi DataTables -->
    <script>
        let selectedId = null;

        // Save New role
        $('#saveBtn').click(function() {
            // Ambil data dari form
            const role = $('#role').val();
            const permissions = $('input[name="permissions[]"]:checked')
                .map(function() {
                    return $(this).val();
                })
                .get(); // Ambil semua permissions yang dicentang

            // Validasi input
            if (!role) {
                showNotification('error', 'Role name is required');
                return;
            }

            // Siapkan data untuk dikirim ke API
            const roleData = {
                name: role, // Pastikan key sesuai dengan kebutuhan API
                permissions: permissions,
            };

            // Kirim data ke API
            $.ajax({
                url: '{{ env('API_URL') }}/roles',
                type: 'POST',
                headers: {
                    Authorization: 'Bearer {{ session('jwt_token') }}',
                },
                contentType: 'application/json', // Pastikan format data dikirim sebagai JSON
                data: JSON.stringify(roleData),
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', 'Role added successfully');
                        $('#addRoleModal').modal('hide');
                        $('#role-table').DataTable().ajax.reload(); // Reload tabel
                    } else {
                        // Tampilkan pesan error jika ada
                        showNotification('error', response.message || 'Failed to add role');
                    }
                },
                error: function(xhr) {
                    // Tampilkan error dari server jika ada
                    const errorMessage =
                        xhr.responseJSON && xhr.responseJSON.message ?
                        xhr.responseJSON.message :
                        'Error occurred while adding role';
                    showNotification('error', errorMessage);
                },
            });
        });

        // Delete role
        $('#role-table').on('click', '.btn-delete', function() {
            selectedId = $(this).data('id');
            $('#deleteRoleModal').modal('show');
        });

        $('#deleteBtn').click(function() {
            $.ajax({
                url: `{{ env('API_URL') }}/roles/${selectedId}`,
                type: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('jwt_token') }}'
                },
                success: function(response) {
                    showNotification('success', 'Role deleted successfully');
                    $('#deleteRoleModal').modal('hide');
                    $('#role-table').DataTable().ajax.reload();
                },
                error: function() {
                    showNotification('error', 'Error occurred while deleting role');
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

        const permissionNames = @json($permissionNames);

        // Initialize DataTable
        $('#role-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ env('API_URL') }}/roles',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('jwt_token') }}'
                },
                dataSrc: 'data'
            },
            columns: [{
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'permissions',
                    name: 'permissions',
                    render: function(data, type, row) {
                        if (!data || data.length === 0) return '';

                        const displayLimit = 3;
                        const permissions = data.slice(0, displayLimit).map(permission =>
                            permissionNames[permission] || permission);
                        const joinedPermissions = permissions.join(', ');

                        if (data.length <= displayLimit) {
                            return joinedPermissions;
                        }
                        return `<span title="${data.map(permission => permissionNames[permission] || permission).join(', ')}">
                            ${joinedPermissions}... 
                            <a href="#" onclick="showPermissions('${data.map(permission => permissionNames[permission] || permission).join(', ')}', '${row.name}'); return false;">[Show More]</a>
                        </span>`;
                    }
                },
                @can('role.edit')
                    {
                        data: 'id',
                        orderable: false,
                        render: function(data) {
                            return `
                    <div class="d-flex">
                        <button title="Edit" data-id="${data}" class="btn-edit btn-action">
                            <span class="iconify" data-icon="heroicons:pencil" style="font-size: 22px;"></span>
                        </button>
                        <button title="Delete" data-id="${data}" class="btn-delete btn-action">
                            <span class="iconify" data-icon="heroicons:trash" style="font-size: 22px;"></span>
                        </button>
                    </div>`;
                        }
                    }
                @endcan
            ],
            order: [
                [1, 'asc'] // Sort by role name (or any other column you prefer)
            ],
            autoWidth: false,
        });

        function showPermissions(permissionText, roleName) {
            // Ubah permissionText menjadi array dan gunakan Bootstrap list group untuk tampilannya
            const permissionsArray = permissionText.split(', ').map(permission =>
                `<li class="list-group-item" style="color:#3c3c3c !important;font-size:16px">${permission}</li>`);
            const permissionsHtml = `<ul class="list-group">${permissionsArray.join('')}</ul>`;

            Swal.fire({
                title: `Permissions for ${roleName}`,
                html: `<div style="max-height: 300px; overflow-y: auto;">${permissionsHtml}</div>`,
                icon: 'info',
                confirmButtonText: 'Close',
                confirmButtonColor: 'white',
                customClass: {
                    confirmButton: 'btn-gradient-purple'
                }
            });
        }

        // Initialize DataTable
        $('#user-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ env('API_URL') }}/roles/assign',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('jwt_token') }}'
                },
            },
            columns: [{
                    data: null,
                    orderable: false,
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return meta.row + 1;
                    }
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
                    render: function(data) {
                        return data ? data.join(', ') : '';
                    }
                },
                @can('role.edit')
                    {
                        data: 'id',
                        name: 'action',
                        orderable: false,
                        render: function(data) {
                            return `
                                <div class="d-flex">
                                    <button title="Edit" data-id="${data}" class="btn-edit btn-action">
                                    <span class="iconify" data-icon="heroicons:pencil" style="font-size: 22px;"></span>
                                </button>
                                    <button title="Delete" data-id="${data}" class="btn-delete btn-action">
                                        <span class="iconify" data-icon="heroicons:trash" style="font-size: 22px;"></span>
                                    </button>
                                </div>`;
                        }
                    }
                @endcan
            ],
            order: [
                [1, 'asc'] // Sort by role_code (or any other column you prefer)
            ],
            autoWidth: false,
        });
    </script>

    @can('roles.edit')
        <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit Roles</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="editRoleForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="roles" class="form-label">Select Roles</label>
                                <select name="roles[]" id="rolesSelect" class="form-select">
                                    <!-- Options akan ditambahkan dengan JavaScript -->
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Roles</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const editUserModal = document.getElementById('editUserModal');

                // Mengisi dropdown roles dengan data dari API saat modal dibuka
                editUserModal.addEventListener('show.bs.modal', function(event) {
                    const button = event.relatedTarget;
                    const userId = button.getAttribute('data-user-id');
                    const userName = button.getAttribute('data-user-name');
                    const userRoles = button.getAttribute('data-user-roles').split(',');

                    // Set action URL pada form sesuai user ID
                    const form = document.getElementById('editRoleForm');
                    form.action = `/roles/assign-role/${userId}`;

                    // Update title modal
                    const modalTitle = editUserModal.querySelector('.modal-title');
                    modalTitle.textContent = `Edit Roles for ${userName}`;

                    // Ambil data roles dari API untuk mengisi select box
                    $.ajax({
                        url: '{{ env('API_URL') }}/roles',
                        headers: {
                            'Authorization': 'Bearer ' + '{{ $jwt_token }}'
                        },
                        success: function(response) {
                            const rolesSelect = document.getElementById('rolesSelect');
                            rolesSelect.innerHTML = ''; // Kosongkan select box terlebih dahulu

                            // Isi select box dengan data roles dari API
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

                // Handle form submission
                document.getElementById('editRoleForm').addEventListener('submit', function(e) {
                    e.preventDefault();
                    const form = e.target;
                    $('#editUserModal').modal('hide');

                    $.ajax({
                        url: form.action,
                        method: form.method,
                        data: $(form).serialize(),
                        success: function(response) {
                            $('#users-table').DataTable().ajax.reload();
                        }
                    });
                });
            });
        </script>
    @endcan
@endsection
