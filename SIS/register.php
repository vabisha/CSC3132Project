<?php
require_once 'dbconf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all expected keys exist in $_POST
    if (!isset($_POST['name'], $_POST['email'], $_POST['password'], $_POST['confirm_password'])) {
        die("All fields are required.");
    }

    // Capture and sanitize form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Validate inputs
    if (empty($name) || empty($email) || empty($password) || empty($confirm_password)) {
        die("All fields are required.");
    }

    if ($password !== $confirm_password) {
        die("Passwords do not match.");
    }

    // Check if email already exists
    $email_check = $conn->prepare("SELECT id FROM user WHERE email = ?");
    $email_check->bind_param("s", $email);
    $email_check->execute();
    $email_check->store_result();
    if ($email_check->num_rows > 0) {
        die("Error: Email already registered.");
    }
    $email_check->close();

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Insert into the 'user' table
    $stmt = $conn->prepare("INSERT INTO user (name, email, password) VALUES (?, ?, ?)");
    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Debugging statement
    }

    $stmt->bind_param("sss", $name, $email, $hashed_password);
    if ($stmt->execute()) {
        echo "Registration successful!";
    } else {
        die("Error executing query: " . $stmt->error); // Debugging statement
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        /* General body styling */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('registerbg.jpg'); /* Replace with your background image */
            background-size: cover;
            background-position: center;
        }

        /* Gradient overlay */
        .gradient-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(132, 250, 176, 0.5), rgba(143, 211, 244, 0.5));
            z-index: -1;
        }

        /* Card styling */
        .card {
            background-color: white;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.25);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            box-sizing: border-box;
        }

        /* Form controls styling */
        .form-outline {
            margin-bottom: 20px;
        }

        .form-control {
            width: 100%;
            padding: 10px 15px;
            font-size: 16px;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
        }

        /* Button styling */
        button {
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            background: linear-gradient(to right, rgba(132, 250, 176, 1), rgba(143, 211, 244, 1));
            color: white;
            transition: 0.3s;
            width: 100%;
        }

        button:hover {
            opacity: 0.9;
        }

        /* Link styling */
        a {
            text-decoration: none;
            color: #007BFF;
        }

        a:hover {
            text-decoration: underline;
        }

        /* Error message styling */
        .error {
            color: red;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="gradient-overlay"></div>
    <div class="card">
        <h2 class="text-center">Create an Account</h2>

        <!-- Error message display -->
        <?php if (isset($error)) : ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>

        <!-- Registration Form -->
        <form action="register.php" method="POST">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Enter your name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" placeholder="Enter your email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Create a password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Repeat your password" required>

            <button type="submit">Register</button>
        </form>

        <!-- Terms and Conditions -->
        <div class="form-check">
            <input type="checkbox" id="terms" name="terms" required />
            <label for="terms">I agree to the <a href="#">Terms of Service</a></label>
        </div>

        <!-- Register Button -->
        <button type="submit">Register</button>

        <!-- Login Link -->
        <p class="text-center">
            Already have an account? <a href="login.php">Login here</a>
        </p>
    </div>
</body>

</html>
