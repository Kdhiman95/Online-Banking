<?php
    $showAlert = false;
    $showErr = false;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include '_dbconnect.php';
        $fname = $_POST["firstname"];
        $lname = $_POST["lastname"];
        $fathername = $_POST["fathername"];
        $mothername = $_POST["mothername"];
        $address = $_POST["address"];
        $date = $_POST["dob"];
        $email = $_POST["email"];
        $username = $_POST["username"];
        $password = $_POST["password"];
        $cpassord = $_POST["cpassword"];
        $balance = 500;
        $emty=false;

        //for providing random account no
        $random = rand(95000,95999);
        $r = false;
        while ($r == false) {
            $random = rand(95000,95999);
            $accountNoExists = "SELECT * FROM `userdetail` WHERE accountNo = '$random'";
            $result = mysqli_query($con, $accountNoExists);
            $num = mysqli_num_rows($result);
            if ($num == 0) {
                $r = true;
            }
        }
        $accountNo = $random;

        //check username exists
        $exists = false;
        $existSql = "SELECT * FROM `userdetail` WHERE username = '$username'";
        $result = mysqli_query($con, $existSql);
        $num = mysqli_num_rows($result);
        if ($num > 0) {
            $exists = true;
        }

        //for entering data in database if both password are same and username dosn't exits
        if (($password == $cpassord) && $exists == false && $fname!=null && $lname!=null && $fathername!=null && $mothername!=null && $address!=null && $date!=null && $username!=null && $password!=null) {
            $hash = password_hash($password,PASSWORD_DEFAULT);
            $sql = "INSERT INTO `userdetail`(`firstName`, `lastName`, `fatherName`, `motherName`, `address`, `DOB`, `email`, `username`, `password`, `accountNo`, `balance`) VALUES ('$fname','$lname','$fathername','$mothername','$address','$date','$email','$username','$hash','$accountNo','$balance')";
            $result = mysqli_query($con, $sql);
            if ($result) {
                $showAlert = true;
            }
        } else if($exists){
            $showErr = "Username already exists. try another username";
        }else {
            $showErr = "Password dosen't match";
            $emty = "Please enter your full details";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sky Bank</title>

    <!-- Favicons -->
    <link href="../assets/img/favicon-32x32.png" rel="icon">
    <link href="../assets/img/apple-icon-180x180.png" rel="apple-touch-icon">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <?php
        if ($showAlert) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Your account is now created.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                </div>';
        }
        if ($showErr) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> ' . $showErr . '.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                </div>';
        }
    ?>

    <button type="button" class="btn btn-primary">
        <a href="../index.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="30" fill="White" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
            </svg>
        </a>
    </button>
    
    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div>
                    <div class="p-4">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                        </div>
                        <form class="user" method="post" action="register.php">
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFirstName" placeholder="First Name" name="firstname">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleLastName" placeholder="Last Name" name="lastname">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user" id="exampleFatherName" placeholder="Father name" name="fathername">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleMotherName" placeholder="Mother Name" name="mothername">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="address" class="form-control form-control-user" id="exampleAddress" placeholder="Address" name="address">
                                </div>
                                <div class="col-sm-6">
                                    <input type="Date" class="form-control form-control-user" id="exampleDateOfBirth" placeholder="Date of Birth" name="dob">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="email" class="form-control form-control-user" id="exampleInputEmail" placeholder="Email Address" name="email">
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" id="exampleDateOfBirth" placeholder="Username" name="username">
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Password" name="password">
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Repeat Password" name="cpassword">
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block">Create</button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="login.php">Already have an account? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>