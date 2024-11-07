<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Tiket</title>
    <style>
        /* Styling omitted for brevity, can reuse the previous styles */
        body {
            font-family: 'Poppins', sans-serif;
            background: #f3f4f5;
            color: #333;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Removed the extra 'g' */
        }

        .details-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
        }

        h2 {
            text-align: center;
            margin-bottom: 1em;
        }

        .details {
            margin-bottom: 1.5em;
            font-size: 1.1em;
            color: #555;
        }

    </style>
</head>
<body>

    <div class="details-container">
        <h2>Detail Tiket</h2>
        <p><strong>Kode Loket:</strong> {{ $ticket->ticket_code }}</p>
        <p><strong>Harga Tiket (Rp):</strong> {{ number_format($ticket->ticket_price, 0, ',', '.') }}</p>
    </div>

</body>
</html>
