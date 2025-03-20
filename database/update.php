<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Use isset() to avoid undefined variables
    $id = isset($_POST['id']) ? trim($_POST['id']) : null;
    $Variants = isset($_POST['Variants']) ? trim($_POST['Variants']) : null;
    $Colors = isset($_POST['Colors']) ? trim($_POST['Colors']) : null;
    $Storage = isset($_POST['Storage']) ? trim($_POST['Storage']) : null;
    $Price = isset($_POST['Price']) ? trim($_POST['Price']) : null;

    // Check if required fields are not empty
    if ($id === null || $Variants === null || $Colors === null || $Storage === null || $Price === null || 
        $id === '' || $Variants === '' || $Colors === '' || $Storage === '' || $Price === '') {
        $_SESSION['status'] = "error";
        header("Location: ../index.php");
        exit();
    }
    // Prepare and execute the update statement safely
    $sql = "UPDATE iphone SET Variants = ?, Colors = ?, Storage = ?, Price = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ssssi", $Variants, $Colors, $Storage, $Price, $id);
        if ($stmt->execute()) {
            $_SESSION['status'] = "updated";
        } else {
            $_SESSION['status'] = "error";
        }
        $stmt->close();
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);

    // Redirect back to the main page with the current page number
    $current_page = isset($_POST['current_page']) ? (int)$_POST['current_page'] : 1;
    header("Location: ../index.php?page=$current_page");
    exit();
}
?>