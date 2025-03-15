<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Variants = $_POST['Variants'];
    $Color = $_POST['Color'];
    $Storage = $_POST['Storage'];
    $Price = $_POST['Price'];

    $sql = "INSERT INTO iphone (Variants, Color, Storage, Price) VALUES ('$Variants', '$Color', '$Storage', '$Price')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "created";
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);
    header("Location: ../dashboard.php");
    exit();
}
?>