<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelian</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            padding: 20px;
        }
        .text-right {
            text-align: right;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table th, table td {
            border: 1px solid #000;
            padding: 8px;
        }
        table th {
            background-color: #f2f2f2;
        }
        .totals {
            margin-top: 20px;
        }
        .signature {
            margin-top: 80px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Laporan Pembelian</h2>

        <p><strong>Order ID:</strong> {{ $order->id }}</p>
        <p><strong>Nama:</strong> {{ $order->user->username }}</p>
        <p><strong>Alamat:</strong> {{ $order->user->address }}</p>
        <p><strong>No. HP:</strong> {{ $order->user->telp }}</p>
        <p><strong>Metode Pembayaran:</strong> {{ ucfirst($order->payment_method) }}</p>
        <p><strong>Tanggal Transaksi:</strong> {{ $order->created_at->format('d-m-Y') }}</p>

        <table>
            <thead>
                <tr>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                        <td>Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $subtotal = $order->total_price;
            $tax = $subtotal * 0.10;
            $totalWithTax = $subtotal + $tax;
        @endphp

        <div class="totals">
            <h3 class="text-right">Tax (10%): Rp {{ number_format($tax, 0, ',', '.') }}</h3>
            <h3 class="text-right">Total: Rp {{ number_format($totalWithTax, 0, ',', '.') }}</h3>
        </div>

        <div class="signature">
            <p>Hormat Kami,</p>
            <br><br>
            <strong>Careline Indonesia</strong>
        </div>
    </div>
</body>
</html>
