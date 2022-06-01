<?php
include "main.php";
$accountNo = $row['accountNo'];
$sql = "SELECT * FROM `transaction` WHERE `accountNo`='$accountNo' ORDER BY `DateTime` DESC";
$result1 = mysqli_query($con, $sql);
$sql = "SELECT * FROM `transaction` WHERE `faccountNo`='$accountNo'ORDER BY `DateTime` DESC";
$result2 = mysqli_query($con, $sql);
?>
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Transaction History</h1>
    </div>
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-0 text-success">Received</h5>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Account number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Transtion Id</th>
                    <th scope="col">Date and Time</th>
                </tr>
            </thead>
            <?php
            while ($r = mysqli_fetch_assoc($result2)) {
                echo '
                    <tbody>
                        <tr>
                            <td>' . $r['accountNo'] . '</td>
                            <td>' . $r['name'] . '</td>
                            <td>' . $r['amount'] . '</td>
                            <td>' . $r['transactionId'] . '</td>
                            <td>' . $r['DateTime'] . '</td>
                        </tr>
                    </tbody>';
            }
            ?>
        </table>
    </div>

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h5 class="h5 mb-0 text-danger">Send</h5>
    </div>
    <div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Account number</th>
                    <th scope="col">Name</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Transtion Id</th>
                    <th scope="col">Date and Time</th>
                </tr>
            </thead>
            <?php
            while ($t = mysqli_fetch_assoc($result1)) {
                echo '
            <tbody>
                <tr>
                    <td>' . $t['faccountNo'] . '</td>
                    <td>' . $t['fname'] . '</td>
                    <td>' . $t['amount'] . '</td>
                    <td>' . $t['transactionId'] . '</td>
                    <td>' . $t['DateTime'] . '</td>
                </tr>
            </tbody>';
            }
            ?>
        </table>
    </div>


</div>
<!-- End of Main Content -->
<?php include "footer.php"; ?>