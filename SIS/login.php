<?php
// Start the session to keep track of the user login state
session_start();

// Include the database configuration file
require_once 'dbconf.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize form data
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Validate inputs
    if (empty($username) || empty($password)) {
        $error_message = "Please fill in all fields.";
    } else {
        // Prepare SQL statement to fetch the user data based on the provided email (username)
        $stmt = $conn->prepare("SELECT id, name, email, password FROM user WHERE email = ?");
        if (!$stmt) {
            die("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        // Check if the email exists in the database
        if ($stmt->num_rows > 0) {
            // Bind the result variables
            $stmt->bind_result($id, $name, $email, $hashed_password);
            $stmt->fetch();

            // Verify the password entered against the hashed password in the database
            if (password_verify($password, $hashed_password)) {
                // Set session variables to store user information (for use in the next page)
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;

                // Redirect to the next page (e.g., dashboard or home page)
                header("Location: index.html");
                exit();
            } else {
                $error_message = "Incorrect password. Please try again.";
            }
        } else {
            $error_message = "No user found with this email address.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f0f0f0;
    }

    .login-container {
      background-color: white;
      border-radius: 10px;
      padding: 40px;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }

    h1 {
      text-align: center;
      margin-bottom: 20px;
      font-size: 24px;
    }

    label {
      display: block;
      font-size: 14px;
      margin-bottom: 5px;
    }

    input {
      width: 100%;
      padding: 10px;
      margin: 10px 0 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      cursor: pointer;
    }

    button:hover {
      background-color: #45a049;
    }

    .error-message {
      color: red;
      text-align: center;
      margin-bottom: 20px;
    }

    footer {
      position: fixed;
      bottom: 10px;
      width: 100%;
      text-align: center;
      font-size: 12px;
      color: #777;
    }

    a {
      text-decoration: none;
      color: #007BFF;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <h1>Login</h1>

    <!-- Error message display -->
    <?php if (isset($error_message)) : ?>
      <div class="error-message"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <!-- Login Form -->
    <form action="login.php" method="POST">
      <label for="username">Username (Email):</label>
      <input type="email" id="username" name="username" required>
      
      <label for="password">Password:</label>
      <input type="password" id="password" name="password" required>
      
      <button type="submit">Login</button>
    </form>

    <p style="text-align: center; margin-top: 20px;">
      Don't have an account? <a href="register.php">Register here</a>
    </p>
  </div>

  <footer>
    <p>&copy; 2025 Elders' Care. All Rights Reserved.</p>
  </footer>

</body>
</html>


