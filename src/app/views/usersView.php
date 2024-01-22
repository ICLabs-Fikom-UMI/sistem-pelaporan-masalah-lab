<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <link href="../../output.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <h1>Users</h1>
    <ul>
        <?php foreach ($users as $user): ?>
            <li class="bg-blue-500"><?php echo htmlspecialchars($user['nama']) . ' - ' . htmlspecialchars($user['email']); ?></li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
