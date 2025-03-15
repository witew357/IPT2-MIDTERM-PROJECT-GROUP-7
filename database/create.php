<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $variant = $_POST['variant'];
    $color = $_POST['color'];
    $storage = $_POST['storage'];
    $price = $_POST['price'];

    $sql = "INSERT INTO iphones (variant, color, storage, price) VALUES ('$variant', '$color', '$storage', '$price')";

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