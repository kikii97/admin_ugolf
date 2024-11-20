@extends('index')

@section('content')
    <style>
        .btn-gradient-purple {
            background: linear-gradient(45deg, #78296D, #D058B9);
            color: white;
            border: none;
            border-radius: 30px;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Adds subtle shadow */
            transition: background 0.3s ease, box-shadow 0.3s ease;
            /* Smooth transition */
        }

        .btn-gradient-purple:hover {
            background: linear-gradient(45deg, #6c2563, #a1448f);
            /* Darker gradient on hover */
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.3);
            /* Stronger shadow on hover */
        }

        .btn-action {
            background: none;
            border: none;
            /* Remove border */
            padding: 10px;
            cursor: pointer;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
        }

        .btn-action:hover {
            transform: scale(1.1);
            /* Slightly enlarge icon on hover */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Add shadow on hover */
        }

        .iconify {
            font-size: 22px;
            color: #6c2563;
        }

        .iconify:hover {
            color: #D058B9;
            /* Change color on hover */
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
            /* Tetap di sebelah kiri */
            align-items: center;
            text-align: left;
            /* Teks tetap rata kiri */
            /* Hidden by default */
        }

        .alert-success {
            background-color: #c3e6cb;
            color: #449e59;
            border: 1px solid #c3e6cb;
            height: 80px;
        }

        .alert-danger {
            background-color: #f5c6cb;
            color: #c4616b;
            border: 1px solid #f5c6cb;
            height: 80px;
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
            <div class="col-7 align-self-center">
                <h4 style="font-family: 'Kufam', sans-serif;"
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Role Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Role</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addRoleModal">
                        <button class="custom-select-set form-control btn-gradient-purple">
                            <span style="margin-left: 12px;">Add</span>
                        </button>
                    </a>
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
                                        <th>Name</th>
                                        <th>Email</th>
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
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="saveBtn" class="btn btn-gradient-purple">Save Role</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit role -->
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
                    <form id="editRole">
                        <div class="mb-3">
                            <label for="editRole" class="form-label">Role</label>
                            <input type="text" class="form-control" id="editRole" required>
                        </div>
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" class="form-control" id="editName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="text" class="form-control" id="editEmail" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="updateBtn" class="btn btn-gradient-purple">Update Role</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Role -->
    <div class="modal fade" id="deleteRoleModal" tabindex="-1" aria-labelledby="deleteRoleLabel"
        aria-hidden="true">
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
            var roleData = {
                role: $('#role').val(),
                name: $('#name').val(),
                email: $('#email').val()
            };
            $.ajax({
                url: '{{ env('API_URL') }}/roles',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                data: roleData,
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', 'Role added successfully');
                        $('#addRoleModal').modal('hide');
                        $('#role-table').DataTable().ajax.reload(); // Reload table data
                    } else {
                        showNotification('error', 'Failed to add role');
                    }
                },
                error: function() {
                    showNotification('error', 'Error occurred while adding role');
                }
            });
        });

        // Edit role
        $('#role-table').on('click', '.btn-edit', function() {
            const roleId = $(this).data('id');
            $('#editRoleModal').modal('show');

            $.ajax({
                url: `{{ env('API_URL') }}/role/${roleId}`,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        const role = response.data;

                        $('#editRole').val(role.role);
                        $('#editName').val(role.name);
                        $('#editEmail').val(role.email);
                        selectedId = role.id;
                        $('#editRoleModal').modal('show');
                        $('#role-table').DataTable().ajax.reload();
                    } else {
                        showNotification('error', 'Failed to update role');
                    }
                },
                error: function() {
                    showNotification('error', 'Error occurred while updating role');
                }
            });
        });

        // Update role
        $('#updateBtn').click(function() {
            const updatedData = {
                role: $('#editRole').val(),
                name: $('#editName').val(),
                email: $('#editEmail').val()
            };

            $.ajax({
                url: `{{ env('API_URL') }}/roles/${selectedId}`,
                type: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                data: updatedData,
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', 'Role updated successfully');
                        $('#editRoleModal').modal('hide');
                        $('#role-table').DataTable().ajax.reload(); // Reload table data
                    } else {
                        showNotification('error', 'Failed to update role');
                    }
                },
                error: function() {
                    showNotification('error', 'Error occurred while updating role');
                }
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
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', 'Role deleted successfully');
                        $('#deleteRoleModal').modal('hide');
                        $('#role-table').DataTable().ajax.reload();
                    } else {
                        showNotification('error', 'Failed to delete role');
                    }
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

        // Initialize DataTable
        $('#role-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ env('API_URL') }}/roles',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                dataSrc: function(json) {
                    if (!json.status) {
                        alert('Failed to fetch data: ' + json.message);
                        return [];
                    }
                    return json.data; // Return data to DataTable
                }
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
                    data: 'role',
                    name: 'role'
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
            ],
            order: [
                [1, 'asc'] // Sort by role_code (or any other column you prefer)
            ],
            autoWidth: false,
        });
    </script>
@endsection
