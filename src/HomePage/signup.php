<?php
require 'db.php';
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $emp_no = $_POST['emp_no'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("INSERT INTO users (name, emp_no, address, email, mobile, password, role, status) 
                           VALUES (?, ?, ?, ?, ?, ?, 'user', 'pending')");
    if ($stmt->execute([$name, $emp_no, $address, $email, $mobile, $password])) {
        $message = "Registration successful! Wait for admin approval.";
    } else {
        $message = "Registration failed!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Sign Up</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <?php if ($message): ?>
            <p class="<?= strpos($message, 'successful') ? 'success' : 'error' ?>"><?= htmlspecialchars($message) ?></p>
        <?php endif; ?>
        <form method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
            <label for="emp_no">Employee Number:</label>
            <input type="text" id="emp_no" name="emp_no" required>
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" required>
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            <label for="mobile">Mobile:</label>
            <input type="text" id="mobile" name="mobile" required>
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <button type="submit">Sign Up</button>
        </form>
    </div>
</body>
</html>
