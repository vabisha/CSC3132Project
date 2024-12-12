<?php
// Start a session to track logged-in users
session_start();

// Include the database connection
include('dbconfig.php'); // Make sure you have this file with DB credentials

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Query to check if the user exists in the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);  // Prepare the statement
    $stmt->bind_param("s", $username);  // Bind the parameter (s = string)
    $stmt->execute();  // Execute the query
    $result = $stmt->get_result();  // Get the result
    $user = $result->fetch_assoc();  // Fetch the user data as an associative array

    // If the user exists and the password matches (using password_verify)
    if ($user && password_verify($password, $user['password'])) {
        // Start the session for the user
        $_SESSION['username'] = $user['username'];
        header("Location: welcome.php");  // Redirect to welcome page
        exit;
    } else {
        // Display an error message if credentials are incorrect
        $error = "Invalid username or password!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/5.3.0/css/mdb.min.css" rel="stylesheet">
    <style>
        body { background-color: #eee; }
        .gradient-custom-2 {
            background: linear-gradient(to right, #87ceeb, #ff69b4);
        }
    </style>
</head>
<body>
    <section class="h-100 gradient-form">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">
                                    <div class="text-center">
                                        <img src="images/logo.png" style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">Secure Your Access: SIS</h4>
                                    </div>

                                    <form method="POST" action="login.php">
                                        <p>Please login to your account</p>

                                        <div class="form-outline mb-4">
                                            <input type="email" id="username" name="username" class="form-control" placeholder="Phone number or email address" required />
                                            <label class="form-label" for="username">Username</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" id="password" name="password" class="form-control" required />
                                            <label class="form-label" for="password">Password</label>
                                        </div>

                                        <div class="text-center pt-1 mb-5 pb-1">
                                            <button class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log in</button><br>
                                            <a class="text-muted" href="#!">Forgot password?</a>
                                        </div>

                                        <!-- Display error message if login failed -->
                                        <?php if (isset($error)) { echo "<p class='text-danger'>$error</p>"; } ?>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">Don't have an account?</p>
                                            <button type="button" class="btn btn-outline-danger">Create new</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-black px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Find Your Home Away from Home</h4>
                                    <p class="small mb-0">At Seniors in Sync, we believe that every senior deserves compassionate and dignified care tailored to their unique needs.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
