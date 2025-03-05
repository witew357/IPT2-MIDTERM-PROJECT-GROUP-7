<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    $sql = "INSERT INTO employees (first_name, middle_name, last_name, position, age, address) VALUES ('$firstname', '$middlename', '$lastname', '$position', '$age', '$address')";

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