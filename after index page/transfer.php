<?php
include "main.php";
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
//UPDATE `userdetail` SET `balance`= `balance`+'10000' WHERE `username` = 'K_dhiman_95';
$success = false;
$showAlert = false;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $accountNo = $row['accountNo'];
    $faccountNo = $_POST['accountNo'];
    $amount = $_POST['amount'];

    $sql = "SELECT firstName,lastName FROM `userdetail` WHERE accountNo = '$accountNo'";
    $result1 = mysqli_query($con, $sql);
    $fetch = mysqli_fetch_assoc($result1);
    $num = mysqli_num_rows($result1);
    //echo $num;
    $name = "";
    if ($num) {
        $name = $fetch['firstName'] . " " . $fetch['lastName'];
    }
    //echo $name;

    $sql = "SELECT firstName,lastName FROM `userdetail` WHERE accountNo = '$faccountNo'";
    $result2 = mysqli_query($con, $sql);
    $fetch2 = mysqli_fetch_assoc($result2);
    $num1 = mysqli_num_rows($result2);
    //echo $num1;
    $fname = "";
    if ($num1) {
        $fname = $fetch2['firstName'] . " " . $fetch2['lastName'];
    }
    //echo $fname;

    $random = generateRandomString();
    $r = false;
    while ($r == false) {
        $random = generateRandomString();
        $accountNoExists = "SELECT * FROM `transaction` WHERE transactionId = '$random'";
        $result = mysqli_query($con, $accountNoExists);
        $num = mysqli_num_rows($result);
        if ($num == 0) {
            $r = true;
        }
    }
    $transactionId = $random;
    $balance = $row['balance'];
    //echo $balance;
    if ($balance < $amount) {
        $showAlert = " insufficient balance. <strong>your account balance : $balance</strong>";
        // break;
    } else if ($faccountNo != NULL && $amount != NULL && $accountNo != $faccountNo) {
        $sql = "UPDATE `userdetail` SET `balance`= `balance`-'$amount' WHERE `accountNO` = '$accountNo'";
        $result = mysqli_query($con, $sql);
        $sql = "UPDATE `userdetail` SET `balance`= `balance`+'$amount' WHERE `accountNO` = '$faccountNo'";
        $result = mysqli_query($con, $sql);
        $sql = "INSERT INTO `transaction`(`accountNo`, `faccountNo`, `name`, `fname`, `amount`, `transactionId`) VALUES ('$accountNo','$faccountNo','$name','$fname','$amount','$transactionId')";
        $result = mysqli_query($con, $sql);
        $success = " transfer completed <strong>Transaction Id: </strong>" . $transactionId;
    } else {
        $showAlert = " please enter correct detail.";
    }
}
?>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transfer Money</h1>
    </div>
    <?php
    if ($success) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> ' . $success . '.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    </div>';
    }
    if ($showAlert) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> ' . $showAlert . '.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                    </div>';
    }
    ?>
    <div class="d-flex justify-content-center">
        <div class="col-lg-7">
            <div class="p-4">
                <form class="user" method="post" action="transfer.php">
                    <div class="form-group">
                        <span class="label label-default"> &nbsp &nbsp Enter Account number :</span>
                        <input type="text" class="form-control form-control-user" id="exampleInputEmail"
                            aria-describedby="emailHelp" name="accountNo" placeholder="Enter Account no.">
                    </div>
                    <div class="form-group">
                        <span class="label label-default"> &nbsp &nbsp Amount :</span>
                        <input type="number" min="10" max="10000" class="form-control form-control-user"
                            id="exampleInputPassword" placeholder="Amount" name="amount">
                    </div>
                    <button class="btn btn-success btn-user btn-block" data-toggle="modal"
                        data-target="#myModal">Tranfer</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End of Main Content -->
<?php include "footer.php"; ?>