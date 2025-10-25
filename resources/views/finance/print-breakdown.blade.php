<!DOCTYPE html>
<html>
<head>
    <title>Fee Breakdown - {{ $term }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
        .total { font-weight: bold; }
    </style>
</head>
<body>
    <h2>Fee Breakdown for {{ $term }}</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Item</th>
                <th>Amount (KES)</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($breakdowns as $index => $item)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $item->item }}</td>
                <td>{{ number_format($item->amount, 2) }}</td>
            </tr>
            @endforeach
            <tr class="total">
                <td colspan="2">Total</td>
                <td>{{ number_format($totalAmount, 2) }}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>
