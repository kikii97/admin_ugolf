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
    </style>

    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 style="font-family: 'Kufam', sans-serif;"
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Merchant Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Apps</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Merchant</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addMerchantModal">
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
                            <table id="merchant-table" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="d-flex justify-content-center align-items-center">No</th>
                                        <th>Kode</th>
                                        <th>Name</th>
                                        <th>Alamat</th>
                                        <th>Deskripsi</th>
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

    <!-- Add Merchant Modal -->
    <div class="modal fade" id="addMerchantModal" tabindex="-1" aria-labelledby="addMerchantModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="addMerchantModalLabel">Add New Merchant</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- Add Merchant Form -->
                    <form id="addMerchantForm">
                        <div class="mb-3">
                            <label for="merchantCode" class="form-label">Merchant Code</label>
                            <input type="text" class="form-control" id="merchantCode" name="merchant_code" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="merchantName" class="form-label">Merchant Name</label>
                            <input type="text" class="form-control" id="merchantName" required>
                        </div>
                        <div class="mb-3">
                            <label for="merchantAddress" class="form-label">Merchant Address</label>
                            <input type="text" class="form-control" id="merchantAddress" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="saveMerchantBtn" class="btn btn-gradient-purple">Save Merchant</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Merchant Modal -->
    <div class="modal fade" id="editMerchantModal" tabindex="-1" aria-labelledby="editMerchantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="editMerchantModalLabel">Edit Merchant</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- Edit Merchant Form -->
                    <form id="editMerchantForm">
                        <div class="mb-3">
                            <label for="editMerchantCode" class="form-label">Merchant Code</label>
                            <input type="text" class="form-control" id="editMerchantCode" required readonly>
                        </div>
                        <div class="mb-3">
                            <label for="editMerchantName" class="form-label">Merchant Name</label>
                            <input type="text" class="form-control" id="editMerchantName" required>
                        </div>
                        <div class="mb-3">
                            <label for="editMerchantAddress" class="form-label">Merchant Address</label>
                            <input type="text" class="form-control" id="editMerchantAddress" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="editDescription" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="updateMerchantBtn" class="btn btn-gradient-purple">Update
                        Merchant</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Merchant Modal -->
    <div class="modal fade" id="deleteMerchantModal" tabindex="-1" aria-labelledby="deleteMerchantModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="deleteMerchantModalLabel">Delete Merchant</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <p>Are you sure you want to delete this merchant?</p>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="confirmDeleteBtn" class="btn btn-gradient-purple">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 4 integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Add Iconify CDN in the head section -->
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

    <script>
        $(document).ready(function() {
            // Fetch merchant_code when the modal is opened
            // Fetch merchant_code when the modal is opened
            $('#addMerchantModal').on('show.bs.modal', function() {
                $.ajax({
                    url: 'http://192.168.43.138/api/merchant/code', // API endpoint to get merchant code
                    type: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' +
                            '{{ session('token') }}' // If authentication is required
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            // Set the merchant_code in the input field
                            $('#merchantCode').val(response
                            .merchant_code); // Pre-fill the merchant_code field
                        } else {
                            alert('Failed to fetch merchant code');
                        }
                    },
                    error: function() {
                        alert('Error occurred while fetching merchant code');
                    }
                });
            });


            // When the form is submitted
            $('#saveMerchantBtn').click(function() {
                var merchantData = {
                    merchant_code: $('#merchantCode').val(), // The merchant_code is now pre-filled
                    merchant_name: $('#merchantName').val(),
                    merchant_address: $('#merchantAddress').val(),
                    description: $('#description').val()
                };

                $.ajax({
                    url: 'http://192.168.43.138/api/merchant', // API endpoint for creating a merchant
                    type: 'POST',
                    headers: {
                        'Authorization': 'Bearer ' + '{{ session('token') }}'
                    },
                    data: merchantData,
                    success: function(response) {
                        if (response.status) {
                            alert('Merchant added successfully');
                            $('#addMerchantModal').modal('hide');
                            $('#merchant-table').DataTable().ajax.reload(); // Reload table data
                        } else {
                            alert('Failed to add merchant: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Error occurred while adding merchant');
                    }
                });
            });
        });
    </script>

    <!-- Script untuk inisialisasi DataTables -->
    <script>
        let selectedMerchantId = null;

        // // Save New Merchant
        // $('#saveMerchantBtn').click(function() {
        //     var merchantData = {
        //         merchant_code: $('#merchantCode').val(), // Make sure you're using the correct field
        //         merchant_name: $('#merchantName').val(),
        //         merchant_address: $('#merchantAddress').val(),
        //         description: $('#description').val()
        //     };

        //     $.ajax({
        //         url: 'http://192.168.43.138/api/merchant',
        //         type: 'POST',
        //         headers: {
        //             'Authorization': 'Bearer ' + '{{ session('token') }}'
        //         },
        //         data: merchantData,
        //         success: function(response) {
        //             if (response.status) {
        //                 // Make sure this line updates the correct field
        //                 $('#merchantCode').val(response.data
        //                 .merchant_code); // Update the field in the modal with the merchant code from the API
        //                 alert('Merchant added successfully');
        //                 $('#addMerchantModal').modal('hide');
        //                 $('#merchant-table').DataTable().ajax.reload(); // Reload table data
        //             } else {
        //                 alert('Failed to add merchant: ' + response.message);
        //             }
        //         },
        //         error: function() {
        //             alert('Error occurred while adding merchant');
        //         }
        //     });
        // });

        // Edit Merchant
        $('#merchant-table').on('click', '.btn-edit', function() {
            const merchantId = $(this).data('id');

            $.ajax({
                url: `http://192.168.43.138/api/merchant/${merchantId}`,
                type: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                success: function(response) {
                    if (response.status) {
                        const merchant = response.data;
                        $('#editMerchantCode').val(merchant.merchant_code);
                        $('#editMerchantName').val(merchant.merchant_name);
                        $('#editMerchantAddress').val(merchant.merchant_address);
                        $('#editDescription').val(merchant.description);
                        selectedMerchantId = merchant.merchant_id;
                        $('#editMerchantModal').modal('show');
                    } else {
                        alert('Failed to fetch merchant details: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error occurred while fetching merchant details');
                }
            });
        });

        // Update Merchant
        $('#updateMerchantBtn').click(function() {
            const updatedData = {
                merchant_code: $('#editMerchantCode').val(),
                merchant_name: $('#editMerchantName').val(),
                merchant_address: $('#editMerchantAddress').val(),
                description: $('#editDescription').val()
            };

            $.ajax({
                url: `http://192.168.43.138/api/merchant/${selectedMerchantId}`,
                type: 'PUT',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                data: updatedData,
                success: function(response) {
                    if (response.status) {
                        alert('Merchant updated successfully');
                        $('#editMerchantModal').modal('hide');
                        $('#merchant-table').DataTable().ajax.reload(); // Reload table data
                    } else {
                        alert('Failed to update merchant: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error occurred while updating merchant');
                }
            });
        });

        // Delete Merchant
        $('#merchant-table').on('click', '.btn-delete', function() {
            selectedMerchantId = $(this).data('id');
            $('#deleteMerchantModal').modal('show');
        });

        $('#confirmDeleteBtn').click(function() {
            $.ajax({
                url: `http://192.168.43.138/api/merchant/${selectedMerchantId}`,
                type: 'DELETE',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                success: function(response) {
                    if (response.status) {
                        alert('Merchant deleted successfully');
                        $('#deleteMerchantModal').modal('hide');
                        $('#merchant-table').DataTable().ajax.reload(); // Reload table data
                    } else {
                        alert('Failed to delete merchant: ' + response.message);
                    }
                },
                error: function() {
                    alert('Error occurred while deleting merchant');
                }
            });
        });

        // Initialize DataTable
        $('#merchant-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'http://192.168.43.138/api/merchant',
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
                    // Display row number
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Row index (meta.row)
                    }
                },
                {
                    data: 'merchant_code',
                    name: 'merchant_code'
                },
                {
                    data: 'merchant_name',
                    name: 'merchant_name'
                },
                {
                    data: 'merchant_address',
                    name: 'merchant_address'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'merchant_id',
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
                [1, 'asc'] // Sort by merchant_code (or any other column you prefer)
            ]
        });
    </script>
@endsection
