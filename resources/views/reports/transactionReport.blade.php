<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 210mm;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header-content {
            display: flex;
            align-items: center;    
            justify-content: center;
            gap: 10px;
        }

        .logo {
            max-width: 50px;
            max-height: 50px;
            object-fit: contain;
        }

        h1 {
            color: #2c3e50;
            margin: 0;
        }

        .report-info {
            margin-bottom: 20px;
        }

        .report-info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
            color: #2c3e50;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777;
        }

        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-content">
            <img src="../public/images/icon.webp" alt="Company Logo" class="logo">
            <h1>{{ $title }}</h1>
        </div>
    </div>

    <div class="report-info">
        <p><strong>Transaction Type: </strong>{{ $typeLabel }}</p>
        <p><strong>Generated on:</strong> {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Date</th>
                <th>Product</th>
                <th>Type</th>
                <th>Quantity</th>
                <th>User</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($item->date)->translatedFormat('d F Y') }}</td>
                    <td>{{ $item->products->name }}</td>
                    <td>{{ ucfirst($item->type) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->users->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        <p>
            Laporan ini digenerate secara otomatis oleh Sistem Manajemen Inventori.
            <br />
            Stockify &copy; 2024  Semua hak dilindungi.
        </p>
    </div>
</body>

</html>