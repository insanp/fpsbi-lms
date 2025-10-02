<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Finish Assessment</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>

<body>
    <h1>Laporan Progres Pembelajaran</h1>
    <p>User berikut baru saja menyelesaikan latihan ujian <?= $report['program'] ?>:</p>
    <table>
        <thead>
            <tr>
                <th>Member ID</th>
                <th>User Name</th>
                <th>Email</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($report['member_id']) ?></td>
                <td><?= htmlspecialchars($report['name']) ?></td>
                <td><?= htmlspecialchars($report['email']) ?></td>
            </tr>
        </tbody>
    </table>
</body>

</html>