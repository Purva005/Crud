<?php
// Include your database connection
include "config.php";

// Initialize variables to store user input
$name = $phone_number = $email = $message = '';
$nameErr = $phone_numberErr = $emailErr = $messageErr = '';

// Function to sanitize and validate input data
function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Validate and process form data on form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
    if (empty($_POST["name"])) {
        $nameErr = "Name is required";
    } else {
        $name = sanitize_input($_POST["name"]);
    }

    // Validate phone number
    if (empty($_POST["phone_number"])) {
        $phone_numberErr = "Phone number is required";
    } else {
        $phone_number = sanitize_input($_POST["phone_number"]);
    }

    // Validate email
    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = sanitize_input($_POST["email"]);
        // Check if email is valid
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailErr = "Invalid email format";
        }
    }

    // Validate message
    if (empty($_POST["message"])) {
        $messageErr = "Message is required";
    } else {
        $message = sanitize_input($_POST["message"]);
    }

    // If all fields are valid, insert data into database
    if ($name && $phone_number && $email && $message) {
        // Prepare SQL query to insert data
        $sql = "INSERT INTO `table@1` (`name`, `phone_number`, `email`, `message`) 
                VALUES ('$name', '$phone_number', '$email', '$message')";

        // Execute SQL query
        if ($conn->query($sql) === TRUE) {
            // Redirect to view.php after successful insertion
            header("Location: view.php");
            exit(); // Make sure to exit after header redirection
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    // Close database connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback Form</title>
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Link to your custom CSS -->
    <!-- Bootstrap CSS -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CSS -->
    <link href="assets/vendor/fontawesome/css/all.min.css" rel="stylesheet">
</head>

<body>

<!-- ======= Feedback Form Section ======= -->

<section id="feedback" class="feedback-section" style="height: 100vh;">
    <div class="container d-flex justify-content-center align-items-center" style="height: 100%;">
        <div class="row justify-content-center w-100">
            <div class="col-lg-7 mt-5 mt-lg-0">
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" role="form" class="php-email-form">
                    <div class="section-title">
                        <h2>Login Form</h2>
                        <p>Fill you info here!</p>
                        <hr class="underline mx-auto">
                    </div>
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" class="form-control" id="name" required>
                        <span class="error"><?php echo $nameErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="tel" class="form-control" name="phone_number" id="phone_number" required>
                        <span class="error"><?php echo $phone_numberErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                        <span class="error"><?php echo $emailErr; ?></span>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Feedback</label>
                        <textarea class="form-control" name="message" rows="5" required></textarea>
                        <span class="error"><?php echo $messageErr; ?></span>
                    </div>
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- End Feedback Form Section -->


    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Your custom JS files -->
    <script src="assets/js/main.js"></script>
</body>

</html>
