<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $Variants = $_POST['Variants'];
    $Colors = $_POST['Colors'];
    $Storage = $_POST['Storage'];
    $Price = $_POST['Price'];

    // Check if required fields are not empty
    if (empty($id)  empty($Variants)  empty($Colors)  empty($Storage)  empty($Price)) {
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