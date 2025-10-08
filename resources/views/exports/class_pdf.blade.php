<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>{{ $class }} Report</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f4f4f4; }
    </style>
</head>
<body>
    <h2>{{ $class }} - Student Report</h2>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Student Name</th>
                <th>Attendance (%)</th>
                <th>Fees Paid</th>
                <th>Balance</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $index => $student)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->attendance ?? 'N/A' }}</td>
                    <td>{{ $student->fees_paid ?? 0 }}</td>
                    <td>{{ $student->fees_balance ?? 0 }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
