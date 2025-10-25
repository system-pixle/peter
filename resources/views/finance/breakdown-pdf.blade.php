<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Fee Breakdown Report - {{ $term }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; margin: 30px; color: #333; }
        h1, h2 { text-align: center; margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #aaa; padding: 8px; text-align: left; }
        th { background-color: #f0f0f0; }
        .total { font-weight: bold; text-align: right; }
        .footer { text-align: center; margin-top: 40px; font-size: 12px; color: #777; }
    </style>
</head>
<body>
    <h1>Saint Paul's Academy</h1>
    <h2>Fee Breakdown Report - {{ $term }}</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Description</th>
                <th>Amount (KSh)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($breakdowns as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->description }}</td>
                    <td style="text-align:right;">{{ number_format($item->amount, 2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="2" class="total">Total Fee</td>
                <td class="total" style="text-align:right;">KSh {{ number_format($total, 2) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="footer">
        Printed on {{ now()->format('F d, Y h:i A') }}
    </div>
</body>
</html>
