<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lokasi</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kufam&display=swap" rel="stylesheet">

    <style>
        /* General styling */
        body {
            font-family: 'Kufam', sans-serif;
            background-color: white;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0;
        }

        /* Header title styling */
        .judul {
            width: 100%;
            max-width: 776px;
            height: 70px;
            background-color: #8F3581;
            color: white;
            text-align: center;
            padding: 20px 0;
            font-size: 28px;
            font-weight: bold;
            clip-path: polygon(0 0, 100% 0, 85% 100%, 15% 100%);
            letter-spacing: 5px;
        }


        /* Table styling */
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

        .icon-detail {
            background-color: #112337;
        }

        .icon-edit {
            background-color: #000000;
        }

        /* Button styling */
        .btn-primary {
            background: linear-gradient(180deg, rgba(143, 53, 129, 0.95) 72%, rgba(81, 13, 70, 1) 100%);
            color: white;
            border: none;
            transition: background-color 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(180deg, rgba(168, 55, 143, 0.95) 72%, rgba(81, 13, 70, 1) 100%);
        }
    </style>
</head>

<body>

    <!-- Header title -->
    <div class="judul">
        LOKASI
    </div>

    <!-- Form for inputting data -->
    <div class="table-container">
        <h3>Input Data Loket</h3>
        <form id="loketForm">
            <div class="mb-3">
                <label for="kodeLoket" class="form-label">Kode Loket</label>
                <input type="text" class="form-control" id="kodeLoket" placeholder="Masukkan Kode Loket">
            </div>
            <div class="mb-3">
                <label for="hargaTiket" class="form-label">Lokasi / Alamat</label>
                <input type="number" class="form-control" id="lokasi" placeholder="Masukkan Alamat Loket">
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <!-- Include jQuery and DataTables -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#loket-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('loket.data') }}',
                columns: [{
                        data: 'kode_loket',
                        name: 'kode_loket'
                    },
                    {
                        data: 'lokasi',
                        name: 'lokasi'
                    },
                ]
            });

            $('#lokasiForm').on('submit', function(e) {
                e.preventDefault();
                const kodeLokasi = $('#kodeLokasi').val();
                const lokasi = $('#lokasi').val();

                $.ajax({
                    url: '{{ route('lokasi.store') }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        kode_lokasi: kodeLokasi,
                        lokasi: lokasi
                    },
                    success: function(response) {
                        alert(response.success);
                        $('#lokasiForm')[0].reset();
                        $('#lokasi-table').DataTable().ajax.reload();
                    },
                    error: function(xhr) {
                        alert('Error: ' + xhr.responseJSON.message);
                    }
                });
            });

        });
    </script>
</body>

</html>
