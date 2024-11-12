@extends('index')

@section('content')

<style>
    body {
        /* font-family: 'Kufam', sans-serif; */
        background-color: white;
        display: flex;
        flex-direction: column;
        align-items: center;
        margin: 0;
    }
    
    .table-container {
        width: 100%;
        max-width: 800px;
        background-color: #ffecfc;
        border: 1px solid #ccc;
        border-radius: 8px;
        padding: 20px;
        margin-top: 60px;
    }
    
    .table-container h3 {
        text-align: center;
        font-size: 18px;
        color: #8F3581;
        font-weight: bold;
        margin-bottom: 20px;
    }
    
    .btn-primary {
        background: linear-gradient(180deg, rgba(143, 53, 129, 0.95) 72%, rgba(81, 13, 70, 1) 100%);
        color: white;
        border: none;
        transition: background-color 0.3s ease;
    }
    
    .btn-primary:hover {
        background: linear-gradient(180deg, rgba(168, 55, 143, 0.95) 72%, rgba(81, 13, 70, 1) 100%);
    }
    
    /* Modal Styling */
    .modal-content {
        border-radius: 15px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.2);
    }
    
    .modal-header {
        background-color: #8F3581;
        color: white;
        border-top-left-radius: 15px;
        border-top-right-radius: 15px;
    }
    
    .modal-body {
        padding: 30px;
    }
    
    .modal-body .form-control {
        border-radius: 8px;
    }
    
    .modal-footer .btn-primary {
        width: 100%;
        border-radius: 8px;
    }
    
    /* Responsive styling */
    @media (max-width: 768px) {
        .judul {
            font-size: 22px;
            padding: 15px 0;
            height: auto;
        }
    
        .table-container {
            padding: 15px;
            margin-top: 20px;
        }
    
        .table-container h3 {
            font-size: 16px;
        }
    
        #loketForm .form-label,
        #loketForm input,
        .btn-primary {
            font-size: 14px;
        }
    }
    
    @media (max-width: 480px) {
        .judul {
            font-size: 20px;
            letter-spacing: 2px;
        }
    
        .table-container h3 {
            font-size: 14px;
        }
    
        #loketForm .form-label,
        #loketForm input,
        .btn-primary {
            font-size: 12px;
        }
    }
    
    .custom-btn {
        background: white;
        color: #8F3581; /* Warna teks ungu */
        border: 2px solid #8F3581; /* Border ungu */
        padding: 10px 20px;
        font-size: 16px;
        font-weight: bold;
        border-radius: 50px;
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    
    .custom-btn:hover {
        background: #8F3581; /* Ubah warna background saat hover */
        color: white; /* Ubah warna teks menjadi putih */
        box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.3);
        transform: scale(1.05);
    }
    
    .custom-btn:active {
        transform: scale(0.98);
        box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.15);
    }
    
    .btn-small {
        padding: 5px 15px;
        font-size: 14px;
        width: auto;
    }
    
    </style>

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h4 class="page-title text-truncate text-dark font-weight-medium mb-1">Location</h4>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="index.html" class="text-muted">Apps</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Location</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="col-5 align-self-center">
            <div class="customize-input float-end">
                <button style="font-family: 'Kufam', sans-serif;" class="btn btn-primary custom-btn" data-bs-toggle="modal" data-bs-target="#addLoketModal">
                    Add
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Adding Loket -->
<div class="modal fade" id="addLoketModal" tabindex="-1" aria-labelledby="addLoketModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Kufam', sans-serif; font-size: 24px; font-weight: bold;" class="modal-title text-center w-100" id="addLoketModalLabel">Input Data Loket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="loketForm" onsubmit="submitLoketData(event)">
                    <div class="mb-3">
                        <label for="kodeLoket" class="form-label">Kode Loket</label>
                        <input type="text" class="form-control" id="kodeLoket" placeholder="Masukkan Kode Loket" required>
                    </div>
                    <div class="mb-3">
                        <label for="lokasi" class="form-label">Lokasi</label>
                        <input type="number" class="form-control" id="lokasi" placeholder="Masukkan Lokasi Loket" required>
                    </div>
                    <button 
                                style="font-family: 'Kufam', sans-serif;" 
                                class="btn btn-primary custom-btn btn-small" 
                                data-bs-toggle="modal" 
                                data-bs-target="#addLoketModal">
                                Simpan
                            </button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Default Ordering</h4>
                    <div class="table-responsive">
                        <table id="default_order" class="table table-striped table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Position</th>
                                    <th>Office</th>
                                    <th>Age</th>
                                    <th>Start date</th>
                                    <th>Salary</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Ashton Cox</td>
                                    <td>Junior Technical Author</td>
                                    <td>San Francisco</td>
                                    <td>66</td>
                                    <td>2009/01/12</td>
                                    <td>$86,000</td>
                                </tr>
                                <tr>
                                    <td>Cedric Kelly</td>
                                    <td>Senior Javascript Developer</td>
                                    <td>Edinburgh</td>
                                    <td>22</td>
                                    <td>2012/03/29</td>
                                    <td>$433,060</td>
                                </tr>
                                <!-- Additional rows as needed -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function submitLoketData(event) {
    event.preventDefault();
    const kodeLoket = document.getElementById('kodeLoket').value;
    const lokasi = document.getElementById('lokasi').value;

    if (kodeLoket && lokasi) {
        alert(`Data Loket: Kode - ${kodeLoket}, Lokasi - ${lokasi}`);
        
        $('#addLoketModal').modal('hide');
        document.getElementById('loketForm').reset();
    } else {
        alert('Silakan isi semua data!');
    }
}
</script>

@endsection
