@extends('index')

@section('content')
    <style>
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
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Transaction Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Dashboard</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Transaction</li>
                        </ol>
                    </nav>
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
                            <table id="trx-table" class="table table-bordered table-striped table-hover" style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="d-flex justify-content-center align-items-center">No</th>
                                        <th>Transaction Code</th>
                                        <th>Amount</th>
                                        <th>Qty</th>
                                        <th>Total Amount</th>
                                        <th>Payment Type</th>
                                        <th>Payment Status</th>
                                        <th style="width: 177px;">Transaksi Date</th>
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

    <!-- Transaction Detail Modal -->
    <div class="modal fade" id="transactionDetailModal" tabindex="-1" aria-labelledby="transactionDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 800px; width: 100%; margin-top: 28px;">
            <div class="modal-content" style="border-radius: 15px; box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #78296D, #D058B9); border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="modal-title text-white" id="transactionDetailModalLabel">Transaction Details</h5>
                    <button type="button" class="btn-close text-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="transactionDetailsContent"
                    style="max-height: 70vh; overflow-y: auto; padding: 20px; ">
                    <!-- Transaction details will be dynamically loaded here -->
                </div>
            </div>
        </div>
    </div>

    {{-- <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 4 integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Add Iconify CDN in the head section -->
    <script src="https://code.iconify.design/2/2.1.0/iconify.min.js"></script> --}}

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
        // Function to fetch transaction details and open the modal
        function showTransactionDetails(trx_id) {
            // Make the API call to get transaction details
            $.ajax({
                url: '{{ env('API_URL') }}/trx/' + trx_id, // Ensure this URL points to your API
                method: 'GET',
                headers: {
                    'Authorization': 'Bearer ' + '{{ session('token') }}', // Include token if needed
                },
                success: function(response) {
                    // On success, populate the modal with transaction data
                    let details = `
                                <div class="row">
                                    <div class="col-4"><strong>Transaction Code</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.trx_code}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Reference Code</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.trx_reff}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Amount</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.amount}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Quantity</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.qty}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Total Amount</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.total_amount}</span></div>
                                </div>
                                <hr class="col-span-10 my-3">
                                <div class="row">
                                    <div class="col-4"><strong>Payment Type</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.payment_type_name}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Payment Status</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.payment_status === 'P' ? 'Pending' : 'Success'}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Payment Date</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.payment_date}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Payment Name</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.payment_name}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Payment Phone</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.payment_phone}</span></div>
                                </div>
                                <hr class="col-span-10 my-3">
                                <div class="row">
                                    <div class="col-4"><strong>Reference Number</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.reffnumber}</span></div>
                                </div>
                                <div class="row">
                                    <div class="col-4"><strong>Issuer Reference Number</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.issuer_reffnumber}</span></div>
                                </div>
                                <hr class="col-span-10 my-3">
                                <div class="row">
                                    <div class="col-4"><strong>Terminal</strong></div>:
                                    <div class="col-5"><span class="text-muted">${response.terminal_name}</span></div>
                                </div>
            `;

                    // Insert details into the modal body
                    $('#transactionDetailsContent').html(details);

                    // Show the modal
                    $('#transactionDetailModal').modal('show');
                },
                error: function(xhr, status, error) {
                    alert('Error fetching transaction details: ' + error);
                }
            });
        }

        // Initialize DataTable
        $('#trx-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ env('API_URL') }}/trx',
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
                    className: 'text-center',
                    render: function(data, type, row, meta) {
                        return meta.row + 1; // Row index (meta.row)
                    }
                },
                {
                    data: 'trx_code',
                    name: 'trx_code'
                },
                {
                    data: 'amount',
                    name: 'amount'
                },
                {
                    data: 'qty',
                    name: 'qty'
                },
                {
                    data: 'total_amount',
                    name: 'total_amount'
                },
                {
                    data: 'payment_type_name',
                    name: 'payment_types.payment_type_name'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status',
                    render: function(data, type, row, meta) {
                        if (data === 'P') {
                            return 'Pending'; // Menampilkan 'Pending' jika status 'P'
                        } else if (data === 'S') {
                            return 'Success'; // Menampilkan 'Success' jika status 'S'
                        }
                        return data; // Menampilkan status asli jika bukan 'P' atau 'S'
                    }
                },
                {
                    data: 'trx_date',
                    name: 'trx_date',
                    render: function(data, type, row, meta) {
                        // Mengubah format tanggal
                        let date = new Date(data);

                        // Daftar nama hari dan bulan
                        const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
                        const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep',
                            'Oct', 'Nov', 'Dec'
                        ];

                        // Format: Hari, Tanggal Bulan Tahun | Waktu
                        let day = days[date.getDay()];
                        let dayOfMonth = date.getDate();
                        let month = months[date.getMonth()];
                        let year = date.getFullYear();
                        let hours = date.getHours().toString().padStart(2, '0');
                        let minutes = date.getMinutes().toString().padStart(2, '0');

                        // Mengembalikan hasil format tanggal dan waktu
                        return `${day}, ${dayOfMonth} ${month} ${year} | ${hours}:${minutes}`;
                    }
                },
                {
                    data: 'trx_id',
                    orderable: false,
                    render: function(data) {
                        return `
                            <div class="d-flex">
                                <button title="Detail" data-id="${data}" class="btn-detail btn-action" onclick="showTransactionDetails(${data})">
                                    <span class="iconify" data-icon="heroicons:document-text" style="font-size: 22px;"></span>
                                </button>
                            </div>`;
                    }
                }
            ],
            order: [
                [1, 'asc'] // Sort by trx_code (or any other column you prefer)
            ]
        });
    </script>
@endsection
