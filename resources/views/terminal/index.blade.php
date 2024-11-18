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
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Terminal Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Terminal</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addTerminalModal">
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
                            <table id="terminal-table" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        {{-- <th><input type="checkbox" id="select-all"></th> --}}
                                        <th class="d-flex justify-content-center align-items-center">No</th>
                                        <th>Merchant Code</th>
                                        <th>Terminal Code</th>
                                        <th>Terminal Name</th>
                                        <th>Terminal Address</th>
                                        <th>Status</th>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="addTerminalModal" tabindex="-1" aria-labelledby="addTerminalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="addTerminalLabel">Add New Terminal</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- Add Terminal Form -->
                    <form id="addTerminalForm">
                        <div class="mb-3">
                            <label for="merchantCode" class="form-label">Merchant Code</label>
                            <select class="form-select" name="merchant_id" id="merchantSelect" required>
                                <option value="">-- Select Merchant --</option>
                                @foreach ($merchants as $merchant)
                                    <option value="{{ $merchant->merchant_id }}"
                                        data-merchant-code="{{ $merchant->merchant_code }}">
                                        {{ $merchant->merchant_code }} - {{ $merchant->merchant_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama" class="form-label">Terminal Name</label>
                            <input type="text" class="form-control" id="nama" required>
                        </div>
                        <div class="mb-3">
                            <label for="alamat" class="form-label">Terminal Address</label>
                            <input type="text" class="form-control" id="alamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="saveTerminalBtn" class="btn btn-gradient-purple">Save Terminal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Terminal Modal -->
    <div class="modal fade" id="editTerminalModal" tabindex="-1" aria-labelledby="editTerminalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="editTerminalLabel">Edit Terminal</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- Edit Terminal Form -->
                    <form id="editTerminalForm">
                        <div class="mb-3">
                            <label for="editMerchantCode" class="form-label">Merchant Code</label>
                            <input type="text" class="form-control" id="editMerchantCode" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="editTerminalCode" class="form-label">Terminal Code</label>
                            <input type="text" class="form-control" id="editTerminalCode" disabled>
                        </div>
                        <div class="mb-3">
                            <label for="editnama" class="form-label">Terminal Name</label>
                            <input type="text" class="form-control" id="editnama" required>
                        </div>
                        <div class="mb-3">
                            <label for="editalamat" class="form-label">Terminal Address</label>
                            <input type="text" class="form-control" id="editalamat" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="updateTerminalBtn" class="btn btn-gradient-purple">Update
                        Terminal</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Terminal Modal -->
    <div class="modal fade" id="deleteTerminalModal" tabindex="-1" aria-labelledby="deleteTerminalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="deleteTerminalLabel">Delete Terminal</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p>Are you sure you want to delete this terminal?</p>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="confirmDeleteBtn" class="btn btn-gradient-purple">Delete</button>
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

        // Save New Terminal
        $('#saveTerminalBtn').click(function() {
            const merchantSelect = $('#merchantSelect');
            const merchantCode = merchantSelect.find(':selected').data('merchant-code'); // Get the merchant code
            const terminalName = $('#nama').val();
            const terminalAddress = $('#alamat').val();
            const description = $('#description').val() || ''; // If description is empty, send an empty string

            // Log data to ensure it's being sent correctly
            console.log({
                merchant_code: merchantCode,
                terminal_name: terminalName,
                terminal_address: terminalAddress,
                description: description
            });

            // Validate required fields before sending request
            if (!merchantCode || !terminalName || !terminalAddress) {
                showNotification('error', 'Merchant Code, Terminal Name, and Terminal Address are required.');
                return;
            }

            const terminalData = {
                merchant_code: merchantCode,
                terminal_name: terminalName,
                terminal_address: terminalAddress,
                description: description
            };

            $.ajax({
                url: '{{ env('API_URL') }}/terminal',
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                data: terminalData,
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', 'Terminal added successfully');
                        $('#addTerminalModal').modal('hide');
                        $('#terminal-table').DataTable().ajax.reload(); // Reload table data
                    } else {
                        // Handle error from the API (e.g., merchant not found or duplicate terminal)
                        showNotification('error', response.message || 'Failed to add terminal');
                    }
                },
                error: function(xhr, status, error) {
                    // Handle unexpected error responses
                    let errorMessage = 'Error occurred while adding terminal';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    }
                    showNotification('error', errorMessage);
                }
            });
        });

        // Edit Terminal Functionality
        $('#terminal-table').on('click', '.btn-edit', function() {
            selectedId = $(this).data('id');

            $.ajax({
                url: `{{ env('API_URL') }}/terminal/${selectedId}`,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer {{ session('token') }}'
                },
                success(response) {
                    if (response.status === 'success') {
                        const terminal = response.data;
                        $('#editMerchantCode').val(
                            `${terminal.merchant_code || '-'} - ${terminal.merchant_name || '-'}`);
                        $('#editTerminalCode').val(`${terminal.terminal_code || '-'}`);
                        $('#editnama').val(terminal.terminal_name || '-');
                        $('#editalamat').val(terminal.terminal_address || '-');
                        $('#editDescription').val(terminal.description || '');
                        $('#merchantSelect').val(terminal.merchant_id);
                        const selectedOption = $('#merchantSelect').find('option:selected');
                        $('#editMerchantCode').val(selectedOption.data('merchant-code') + " - " +
                            selectedOption.text().split(" - ")[1]);
                        $('#editTerminalModal').modal('show');
                    } else {
                        showNotification('error', 'Failed to retrieve terminal data');
                    }
                },
                error() {
                    showNotification('error', 'Error occurred while retrieving terminal data');
                }
            });
        });

        // Update Terminal Functionality
        $('#updateTerminalBtn').click(function() {
            const updatedData = {
                terminal_name: $('#editnama').val(),
                terminal_address: $('#editalamat').val(),
                description: $('#editDescription').val()
            };

            // Validate required fields before sending request
            if (!updatedData.terminal_name || !updatedData.terminal_address) {
                showNotification('error', 'All fields are required.');
                return;
            }

            $.ajax({
                url: `{{ env('API_URL') }}/terminal/${selectedId}`,
                type: 'PUT',
                headers: {
                    'Authorization': 'Bearer {{ session('token') }}'
                },
                data: updatedData,
                success(response) {
                    if (response.status === 'success') {
                        showNotification('success', 'Terminal updated successfully');
                        $('#editTerminalModal').modal('hide');
                        $('#terminal-table').DataTable().ajax.reload();
                    } else {
                        showNotification('error', response.message || 'Failed to update terminal');
                    }
                },
                error() {
                    showNotification('error', 'Error occurred while updating terminal');
                }
            });
        });

        // Delete Terminal
        $('#terminal-table').on('click', '.btn-delete', function() {
            selectedId = $(this).data('id');
            $('#deleteTerminalModal').modal('show');
        });

        $('#confirmDeleteBtn').click(function() {
            $.ajax({
                url: `{{ env('API_URL') }}/terminal/${selectedId}`,
                type: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                success: function(response) {
                    if (response.status === 'success') {
                        showNotification('success', 'Terminal deleted successfully');
                        $('#deleteTerminalModal').modal('hide');
                        $('#terminal-table').DataTable().ajax.reload();
                    } else {
                        showNotification('error', 'Failed to delete terminal');
                    }
                },
                error: function() {
                    showNotification('error', 'Error occurred while deleting terminal');
                }
            });
        });

        // $(document).ready(function() {
        $('#terminal-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ env('API_URL') }}/terminal',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                dataSrc: function(json) {
                    if (!json.status) {
                        alert('Gagal mengambil data: ' + json.message);
                        return [];
                    }
                    console.log(json); // Log the response for debugging
                    return json.data; // Kembalikan data untuk DataTable
                }
            },
            columns: [{
                    // Menampilkan nomor urut
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Nomor urut berdasarkan indeks baris (meta.row)
                    }
                },
                {
                    data: 'merchant_code',
                    name: 'merchants.merchant_code'
                },
                {
                    data: 'terminal_code',
                    name: 'terminal_code'
                },
                {
                    data: 'terminal_name',
                    name: 'terminal_name'
                },
                {
                    data: 'terminal_address',
                    name: 'terminal_address'
                },
                {
                    data: 'status_terminal',
                    name: 'status_terminal'
                },
                {
                    data: 'description',
                    name: 'description',
                },
                {
                    data: 'terminal_id',
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
                [1, 'asc']
            ]
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
    </script>
@endsection
