<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $student->name }} - Finance Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #888; padding: 6px; text-align: left; }
        h1, h2 { color: #2a4d8f; }
    </style>
</head>
<body>
    <h1>Saint Pauls Academy - Finance Report</h1>
    <h2>Student: {{ $student->name }}</h2>

    <p><strong>Total Paid:</strong> KSh {{ number_format($totalPaid, 2) }}</p>
    <p><strong>Total Due:</strong> KSh {{ number_format($totalDue, 2) }}</p>
    <p><strong>Balance:</strong> KSh {{ number_format($balance, 2) }}</p>

    <h3>Fee Breakdown</h3>
    <table>
        <thead>
            <tr>
                <th>Term</th>
                <th>Amount Due</th>
                <th>Amount Paid</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($fees as $fee)
                <tr>
                    <td>{{ $fee->term }}</td>
                    <td>KSh {{ number_format($fee->amount_due, 2) }}</td>
                    <td>KSh {{ number_format($fee->amount_paid, 2) }}</td>
                    <td>{{ $fee->created_at->format('d M Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
