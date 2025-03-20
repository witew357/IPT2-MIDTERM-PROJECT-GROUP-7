<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Create Account</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/apple1.png" rel="icon">
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans|Poppins" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


    <style>
        /* Custom Styles */
        body {
            background-color: #f8f9fa;
        }
        .card {
            border-radius: 10px;
        }
        .btn-primary {
            background-color: #2c3930;
            border: none;
            border-radius: 5px;
        }
        .btn-primary:hover {
            background-color: #1e6434;
        }
        .logo h5{
            color: #2c3930 !important;
            font-weight: bold;
        }
        a:hover{
            color:rgb(32, 124, 61);
        }
    </style>
</head>

<body>
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

                            <div class="d-flex justify-content-center py-4">
                                <a class="logo d-flex align-items-center w-auto">
                                    <img src="assets/img/apple1.png" alt="Logo">
                                    <!--<span class="d-none d-lg-block">AppleZone Staff Signup</span>-->
                                    <h5>AppleZone Staff Signup</h5>
                                </a>
                            </div><!-- End Logo -->

                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="pt-4 pb-2 text-center">
                                        <h5 class="card-title fs-4">Create an Account</h5>
                                        <p class="small">Provide your information to register.</p>
                                    </div>

                                    <?php
                                    include 'database/account.php';

                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $name = $_POST['name'];
                                        $email = $_POST['email'];
                                        $username = $_POST['username'];
                                        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                                        $sql = "INSERT INTO registeredusers (name, email, username, password) VALUES ('$name', '$email', '$username', '$password')";

                                        if ($conn->query($sql) === TRUE) {
                                            header("Location: login.php?message=success");
                                            exit();
                                        } else {
                                            $error = "Error: Unable to register user. Please try again.";
                                        }
                                    }
                                    ?>

                                    <form action="register.php" method="POST" class="pt-3">
                                        <div class="col-12 mb-3">
                                          <label for="yourName" class="form-label">Name</label>
                                          <input type="text" name="name" class="form-control" id="yourName" required>
                                          <div class="invalid-feedback">Enter your name.</div>
                                        </div>

                                        <div class="col-12 mb-3">
                                          <label for="yourEmail" class="form-label">Email</label>
                                          <input type="email" name="email" class="form-control" id="yourEmail" required>
                                          <div class="invalid-feedback">Enter a valid Email address.</div>
                                        </div>

                                        <div class="col-12 mb-3">
                                          <label for="yourUsername" class="form-label">Username</label>
                                          <div class="input-group has-validation">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" name="username" class="form-control" id="yourUsername" required>
                                            <div class="invalid-feedback">Choose a username.</div>
                                          </div>
                                        </div>

                                        <div class="col-12">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group">
                                                <!-- Padlock Icon -->
                                                <span class="input-group-text"><i class="bi bi-lock"></i></span>

                                                <!-- Password Input Field -->
                                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required minlength="8">

                                                <!-- Eye Icon for Toggle -->
                                                <span class="input-group-text" onclick="togglePassword()" style="cursor: pointer;">
                                                    <i id="toggleIcon" class="bi bi-eye"></i>
                                                </span>

                                                <div class="invalid-feedback">Password must be at least 8 characters long.</div>
                                            </div>
                                        </div>



                                        <div class="col-12 mb-3">
                                          <div class="form-check">
                                            <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                                            <label class="form-check-label" for="acceptTerms">
                                              I agree and accept the <a href="#">terms and conditions</a>
                                            </label>
                                            <div class="invalid-feedback">You must agree before submitting.</div>
                                          </div>
                                        </div>

                                        <div class="col-12">
                                          <button class="btn btn-primary w-100" type="submit">Create Account</button>
                                        </div>

                                        <div class="col-12">
                                          <p class="small mb-0 text-center">Already have an account? <a href="login.php">Log in</a></p>
                                        </div>

                            <!-- Display Success or Error Messages -->
                            <?php if (!empty($success)): ?>
                                <div style="color: green;"><?php echo $success; ?></div>
                            <?php endif; ?>

                            <?php if (!empty($error)): ?>
                                <div style="color: red;"><?php echo $error; ?></div>
                            <?php endif; ?>

                            <script>
                            function togglePassword() {
                                const passwordField = document.getElementById("password");
                                const toggleIcon = document.getElementById("toggleIcon");

                                if (passwordField.type === "password") {
                                    passwordField.type = "text"; // Show password
                                    toggleIcon.classList.replace("bi-eye", "bi-eye-slash");
                                } else {
                                    passwordField.type = "password"; // Hide password
                                    toggleIcon.classList.replace("bi-eye-slash", "bi-eye");
                                }
                            }

                            // Live validation for minimum length
                            document.getElementById("password").addEventListener("input", function() {
                                if (this.value.length < 8) {
                                    this.setCustomValidity("Password must be at least 8 characters long.");
                                } else {
                                    this.setCustomValidity("");
                                }
                            });
                            </script>


                            
                        </div>
                    </div>
                </div>
            </section>
            <div class="credits text-center">
                Designed by <a href="https://web-tech-midterm-project-g7.vercel.app/">AppleZone Ph</a>
            </div>

        </div>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

</body>
</html>