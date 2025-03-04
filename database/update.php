<?php
session_start();
include('database.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // Get the ID from the POST data
    $firstname = $_POST['firstname'];
    $middlename = $_POST['middlename'];
    $lastname = $_POST['lastname'];
    $position = $_POST['position'];
    $age = $_POST['age'];
    $address = $_POST['address'];

    $sql = "UPDATE employees SET first_name='$firstname', middle_name='$middlename', last_name='$lastname', position='$position', age='$age', address='$address' WHERE id='$id'";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['status'] = "updated";
    } else {
        $_SESSION['status'] = "error";
    }

    mysqli_close($conn);
    header("Location: ../dashboard.php");
    exit();
}
?>
