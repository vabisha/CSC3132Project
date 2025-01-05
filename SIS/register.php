<?php
// Include the database configuration file
require_once 'dbconf.php';

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = $conn->real_escape_string($_POST['password']);
    $confirm_password = $conn->real_escape_string($_POST['confirm-password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Hash the password for secure storage
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert user data into the `users` table
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            // Redirect to login page
            header("Location: login.php");
            exit();
        } else {
            $error = "Error: " . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
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
            <!-- Name Input -->
            <div class="form-outline">
                <label for="name">Your Name</label>
                <input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required />
            </div>

            <!-- Email Input -->
            <div class="form-outline">
                <label for="email">Your Email</label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required />
            </div>

            <!-- Password Input -->
            <div class="form-outline">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Create a password" required />
            </div>

            <!-- Confirm Password Input -->
            <div class="form-outline">
                <label for="confirm-password">Repeat Password</label>
                <input type="password" id="confirm-password" name="confirm-password" class="form-control" placeholder="Repeat your password" required />
            </div>

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
        </form>
    </div>
</body>

</html>
