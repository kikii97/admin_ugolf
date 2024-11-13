@extends('index')

@section('content')
    <!-- Bread crumb -->
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-7 align-self-center">
                <h4 style="font-family: 'Kufam', sans-serif;"
                    class="page-title text-truncate text-dark font-weight-medium mb-1">Transaction Management</h4>
                <div class="d-flex align-items-center">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb m-0 p-0">
                            <li class="breadcrumb-item"><a href="/dashboard" class="text-muted">Apps</a></li>
                            <li class="breadcrumb-item text-muted active" aria-current="page">Transaction</li>
                        </ol>
                    </nav>
                </div>
            </div>
            <div class="col-5 align-self-center">
                <div class="customize-input float-end">
                    <a href="#">
                        <button class="custom-select-set form-control bg-white border-0 custom-shadow custom-radius">
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
                            <table id="transaksi-table" class="table table-bordered table-striped table-hover"
                                style="width:100%">
                                <thead class="thead-dark">
                                    <tr>
                                        <th class="d-flex justify-content-center align-items-center">No</th>
                                        <th>Terminal Code</th>
                                        <th>Trx Code</th>
                                        <th>Trx Reff</th>
                                        <th>Payment Type Name</th>
                                        <th>Amount</th>
                                        <th>Qty</th>
                                        <th>Total Amount</th>
                                        <th>Paycode</th>
                                        <th>Expire</th>
                                        <th>Trx Date</th>
                                        <th>Payment Date</th>
                                        <th>Payment Name</th>
                                        <th>Payment Phone</th>
                                        <th>Payment Status</th>
                                        <th>Reffnumber</th>
                                        <th>Issuer Reffnumber</th>
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
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <!-- DataTables Bootstrap 4 integration -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>

    <!-- Script untuk inisialisasi DataTables -->
    <script>
        // $(document).ready(function() {
        $('#transaksi-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: 'http://192.168.43.45/api/trx',
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
                    data: 'terminal_kode',
                    name: 'terminals.terminal_code'
                },
                {
                    data: 'trx_code',
                    name: 'trx_code'
                },
                {
                    data: 'trx_reff',
                    name: 'trx_reff'
                },
                {
                    data: 'payment_type_name',
                    name: 'payment_types.payment_type_name'
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
                    data: 'paycode',
                    name: 'paycode'
                },
                {
                    data: 'expire',
                    name: 'expire'
                },
                {
                    data: 'trx_date',
                    name: 'trx_date'
                },
                {
                    data: 'payment_date',
                    name: 'payment_date'
                },
                {
                    data: 'payment_name',
                    name: 'payment_name'
                },
                {
                    data: 'payment_phone',
                    name: 'payment_phone'
                },
                {
                    data: 'payment_status',
                    name: 'payment_status'
                },
                {
                    data: 'reffnumber',
                    name: 'reffnumber'
                },
                {
                    data: 'issuer_reffnumber',
                    name: 'issuer_reffnumber'
                },
                {
                    data: 'trx_id',
                    orderable: false,
                    render: function(data) {
                        return `
                    <div class="d-flex">
                        <button title="Detail" data-id="${data}" class="btn-detail btn-action">
                            <iconify-icon icon="mdi:file-document-outline"></iconify-icon>
                        </button>
                        <button title="Edit" data-id="${data}" class="btn-edit btn-action">
                            <iconify-icon icon="mdi:edit"></iconify-icon>
                        </button>
                        <button title="Delete" data-id="${data}" class="btn-action btn-delete">
                            <iconify-icon icon="mdi:delete"></iconify-icon>
                        </button>
                    </div>`;
                    }
                }
            ],
            order: [
                [1, 'asc'] // Mengurutkan berdasarkan kolom merchant_name, atau sesuai kebutuhan
            ]
        });
        // });
    </script>
@endsection
