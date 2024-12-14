
<?php
// Get form data
$n = trim($_POST['email']); 
$c = trim($_POST['password']); 

// Validate input
if (empty($n) || empty($c)) {
    die("Email and Password are required.");
}

// Hash the password for secure storage
$hashedPassword = password_hash($c, PASSWORD_DEFAULT);

// Database connection
$con = mysqli_connect("localhost", "root", "", "rbsubmit");

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

// Use prepared statements to prevent SQL injection
$sql = "INSERT INTO roomboking (name, password) VALUES ('$c','$n');";
$stmt = $mysqli_query($con, $sql);

// Check if the statement is prepared successfully
if ($stmt) {
    // Bind parameters
    mysqli_stmt_bind_param($stmt, "ss", $n, $hashedPassword);

    // Execute the statement
    if (mysqli_stmt_execute($stmt)) {
        echo "Value submitted successfully.";
    } else {
        echo "Value not submitted: " . mysqli_error($con);
    }

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    echo "Failed to prepare the SQL statement: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);
?>
