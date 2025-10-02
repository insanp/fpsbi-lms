<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Progress Report</title>
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
    <p>Berikut ini adalah daftar progres user yang memiliki kursus yang sedang aktif.</p>
    <table>
        <thead>
            <tr>
                <th>User Member ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Course Name</th>
                <th>Enrolled At</th>
                <th>Access Until</th>
                <th>Progress Percentage</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($report as $entry): ?>
                <tr>
                    <td><?= htmlspecialchars($entry['user_member_id']) ?></td>
                    <td><?= htmlspecialchars($entry['user_name']) ?></td>
                    <td><?= htmlspecialchars($entry['user_email']) ?></td>
                    <td><?= $entry['course_name'] ?></td>
                    <td><?= date('Y-m-d H:i', strtotime($entry['enrolled_at'])) ?></td>
                    <td><?= date('Y-m-d H:i', strtotime($entry['access_until'])) ?></td>
                    <td><?= $entry['progress_percentage'] ?>%</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>