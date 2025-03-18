<?php
session_start();
include('database.php'); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') { 
    $variants = $_POST['Variants']; 
    $colors = $_POST['Colors']; 
    $storage = $_POST['Storage']; 
    $price = $_POST['Price'];

    // Prepare the SQL statement to prevent SQL injection
    $sql = "INSERT INTO iphone (Variants, Colors, Storage, Price) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssss", $variants, $colors, $storage, $price);
        if ($stmt->execute()) { 
            $_SESSION['status'] = "created"; 
        } else { 
            $_SESSION['status'] = "error"; 
        }
        $stmt->close();
    } else {
        $_SESSION['status'] = "error"; 
    }

    // Get the total number of records to determine the current page
    $total_sql = "SELECT COUNT(*) as total FROM iphone";
    $total_result = $conn->query($total_sql);
    $total_row = $total_result->fetch_assoc();
    $total_records = $total_row['total'];

    // Calculate the current page based on the total records and limit
    $limit = 5; // Assuming you have 5 records per page
    $current_page = ceil($total_records / $limit); // Redirect to the last page

    mysqli_close($conn); 

    // Redirect back to the main page with the current page number
    header("Location: ../index.php?page=$current_page"); // Redirect to the last page
    exit(); 
}
?>