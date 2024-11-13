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
        color: white;
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
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Payment Type Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Apps</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Payment Type</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addPaymentType">
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
                            <table id="paymentTable" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        {{-- <th><input type="checkbox" id="select-all"></th> --}}
                                        <th class="d-flex justify-content-center align-items-center">No</th>
                                        <th>Payment Type Kode</th>
                                        <th>Payment Type Name</th>
                                        <th>Deskription</th>
                                        <th>Aksi</th>
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
    </div>

    <!-- Add Payment Type Modal -->
    <div class="modal fade" id="addPaymentType" tabindex="-1" aria-labelledby="addPaymentTypeLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 40%;">
            <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                    <h5 class="modal-title text-white" id="addPaymentTypeLabel">Add New paymentType</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"
                        style="font-weight: bold; opacity: 1; color: white;"></button>
                </div>
                <div class="modal-body" style="padding: 20px;">
                    <!-- Add paymentType Form -->
                    <form id="addPaymentForm">
                        <div class="mb-3">
                            <label for="paymentTypeCode" class="form-label">Payment Type Code</label>
                            <input type="text" class="form-control" id="paymentTypeCode" name="payment_type_code" required>
                        </div>
                        <div class="mb-3">
                            <label for="paymentTypeName" class="form-label">Payment Type Name</label>
                            <input type="text" class="form-control" id="paymentTypeName" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer" style="border-top: none; padding-top: 0;">
                    <button type="button" id="savepaymentTypeBtn" class="btn btn-gradient-purple">Save Payment Type</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Merchant Modal -->
    <div class="modal fade" id="deletePaymentModal" tabindex="-1" aria-labelledby="deletePaymentModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 20px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);">
            <div class="modal-header"
                style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 20px; border-top-right-radius: 20px;">
                <h5 class="modal-title text-white" id="deletePaymentModalLabel">Delete Merchant</h5>
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
    <!-- Add Iconify CDN in the head section -->
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script>

    <!-- Script untuk inisialisasi DataTables -->
    <script>
        // $(document).ready(function() {
            $('#paymentTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ env('API_URL') }}/paymentType',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                dataSrc: function(json) {
                    if (!json.status) {
                        alert('Gagal mengambil data: ' + json.message);
                        return [];
                    }
                    console.log(json); // Log the response for debugging
                    return json.data; // Return data array for DataTable
                }
            },
            columns: [
                {
                    // Display row number
                    data: null,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Row number based on index
                    }
                },
                {
                    data: 'payment_type_code',
                    name: 'payment_type_code'
                },
                {
                    data: 'payment_type_name',
                    name: 'payment_type_name'
                },
                {
                    data: 'description',
                    name: 'description'
                },
                {
                    data: 'payment_type_id',
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
                [1, 'asc'] // Sort by payment_type_code column
            ],
            // serverMethod: 'GET',
            // paging: true,
            // lengthChange: true,
            // searching: true,
            // info: true,
            autoWidth: false,
            // recordsTotal: 'recordsTotal',
            // recordsFiltered: 'recordsFiltered'
        });


        // });
    </script>

<script>
    $(document).ready(function() {
        // Function to show a notification
        function showNotification(title, message, type = 'success') {
            $('#notificationTitle').text(title);
            $('#notificationMessage').text(message);
            $('#notification').removeClass().addClass(`alert alert-${type}`).show();
            setTimeout(function() {
                $('#notification').fadeOut(); // Hide notification after 3 seconds
            }, 3000);
        }

        // When the form is submitted
        $('#savepaymentTypeBtn').click(function() {
            var paymentTypeData = {
                payment_type_code: $('#paymentTypeCode').val(), // Match 'payment_type_code'
                payment_type_name: $('#paymentTypeName').val(), // Match 'payment_type_name'
                description: $('#description').val()
            };

            $.ajax({
                url: '{{ env('API_URL') }}/paymentType', // API endpoint for creating a paymentType
                type: 'POST',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}'
                },
                data: paymentTypeData,
                success: function(response) {
                    // Close the modal first
                    $('#addPaymentType').modal('hide');
                    
                    // Store success message in localStorage
                    if (response.success) {
                        localStorage.setItem('notification', JSON.stringify({
                            title: 'Success',
                            message: 'Payment type added successfully',
                            type: 'success'
                        }));

                        // Reload the page
                        location.reload();
                    } else {
                        localStorage.setItem('notification', JSON.stringify({
                            title: 'Error',
                            message: 'Failed to add payment type: ' + response.message,
                            type: 'danger'
                        }));
                        location.reload();
                    }
                },
                error: function(xhr) {
                    // Close the modal first
                    $('#addPaymentType').modal('hide');

                    // Store error message in localStorage
                    if (xhr.status === 422) {
                        let errors = xhr.responseJSON.errors;
                        let errorMsg = 'Failed to add payment type:\n';
                        $.each(errors, function(key, value) {
                            errorMsg += value[0] + '\n'; // Display each error message
                        });
                        localStorage.setItem('notification', JSON.stringify({
                            title: 'Validation Error',
                            message: errorMsg,
                            type: 'danger'
                        }));
                    } else {
                        localStorage.setItem('notification', JSON.stringify({
                            title: 'Error',
                            message: 'Error occurred while adding payment type',
                            type: 'danger'
                        }));
                    }

                    // Reload the page
                    location.reload();
                }
            });
        });

        // Check if notification data exists in localStorage
        if (localStorage.getItem('notification')) {
            const notification = JSON.parse(localStorage.getItem('notification'));
            showNotification(notification.title, notification.message, notification.type);
            localStorage.removeItem('notification'); // Remove notification after showing it
        }
    });
</script>

<script>
    // Function to show a notification
    function showNotification(title, message, type = 'success') {
        $('#notificationTitle').text(title);
        $('#notificationMessage').text(message);
        $('#notification').removeClass().addClass(`alert alert-${type}`).show();
        setTimeout(function() {
            $('#notification').fadeOut(); // Hide notification after 3 seconds
        }, 3000);
    }

    // Delete Merchant
    $('#paymentTable').on('click', '.btn-delete', function() {
        selectedMerchantId = $(this).data('id');
        $('#deletePaymentModal').modal('show');
    });

    $('#confirmDeleteBtn').click(function() {
        $.ajax({
            url: `{{ env('API_URL') }}/paymentType/${selectedMerchantId}`,
            type: 'DELETE',
            headers: {
                'Authorization': 'Bearer ' + '{{ session('token') }}'
            },
            success: function(response) {
                // Close the modal first
                $('#deletePaymentModal').modal('hide');
                
                // Check if the response has the 'message' field and use it for notification
                if (response.message) {
                    // Check if the response message indicates success or failure
                    if (response.success) {
                        // Success: Show success notification
                        showNotification('Success', response.message, 'success');
                    } else {
                        // Failure: Show failure notification
                        showNotification('Error', response.message, 'danger');
                    }
                } else {
                    // If no message in response, show a general error
                    showNotification('Error', 'Unknown error occurred', 'danger');
                }

                // Reload the page after showing notification
                location.reload();
            },
            error: function(xhr) {
                // Close the modal first
                $('#deletePaymentModal').modal('hide');
                
                // Handle error if there is a problem with the request
                let errorMessage = 'Error occurred while deleting merchant';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message; // Use error message from API if available
                }

                // Show error notification
                showNotification('Error', errorMessage, 'danger');

                // Reload the page after showing notification
                location.reload();
            }
        });
    });
</script>



@endsection
