<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
include 'inc/head.php';
include "inc/sidebar.php";

?>
    <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align:center;">
                            ADD NEW INVOICE
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="name" name="p_name" placeholder="Product Name" class="form-control" required>
                                </div>

                                <div class="col-sm-6">
                                    <input type="number" name="p_price" placeholder="Price" class="form-control" required>
                                </div>

                                <div class="col-sm-6">
                                    <input type="number" name="p_discount" placeholder="Discount" class="form-control" required>
                                </div>

                                <div class="col-sm-6">
                                    <input type="email" name="email" placeholder="Email" class="form-control" required>
                                </div>

                                <div class="col-sm-6">
                                    <textarea name="p_desc" rows="5" placeholder="Product Description" class="form-control" required></textarea>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="addUser" value="Create Invoice" class="btn bg-warning">
                                </div>
                            </div>
                        </form>


                        <?php
                        if (isset($_POST['addUser']))
                        {
                            $email = mysqli_real_escape_string($db, $_POST['email']);
                            $p_name = mysqli_real_escape_string($db, $_POST['p_name']);
                            $p_desc = mysqli_real_escape_string($db, $_POST['p_desc']);
                            $price = mysqli_real_escape_string($db, $_POST['p_price']);
                            $dicount = mysqli_real_escape_string($db, $_POST['p_discount']);
                            $p_c_price = $price/100;
                            $p_c_price = $p_c_price * $dicount;
                            $p_c_price = $price - $p_c_price;
                            $getLatestInvoiceID = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM cus_orders ORDER BY orderid DESC"));
                            $invoiceID = $getLatestInvoiceID['orderid'];
                            $invoiceIDNew = $invoiceID+1;
                            $status = "Pending";
                            $sqlAddUser = mysqli_query($db, "INSERT INTO `cus_orders`(`p_name`, `p_desc`, `p_price`, `p_discount`, `p_c_price`, `email`, `status`, `orderid`) VALUES ('$p_name','$p_desc','$price','$dicount','$p_c_price','$email','$status','$invoiceIDNew')");
                            if ($sqlAddUser) {
                                $getUser = mysqli_num_rows(mysqli_query($db,"SELECT * FROM users_site WHERE email = '$email'"));
                                if ($getUser == null)
                                {
                                    $sqlIn = mysqli_query($db,"INSERT INTO `users_site`( `email`, `password`) VALUES ('$email','123456')");
                                    if ($sqlIn)
                                    {

                                        $to = $email;
                                        $subject = 'Order Confirmation | Hot Metal Logos';

                                        $headers['From'] = 'info@hotmetallogos.com';
                                        $headers['MIME-Version'] = 'MIME-Version: 1.0';
                                        $headers['Content-type'] = 'text/html; charset=iso-8859-1';
                                        $message = '
                                        <html>
                                        <head>
                                            <title>Order Confirmation | '.$p_name.' | Hot Metal Logos</title>
                                        </head>
                                        <body style="text-align: center;">
                                            <div style="background: grey; border-radius: 30px; padding: 50px; margin-top: 20px; margin-bottom: 20px;">
                                                <p style="text-align: center;">Click on the below link to confirm your order:</p>
                                                <center>
                                                    <a style="" href="https://hotmetallogos.com/invoicePending.php?invoice='.$invoiceIDNew.'&email='.$email.'">Order Confirmation</a>
                                                </center>
                                            </div>
                                            <style>
                                            .shahbaz_btn{
                                                background: #0c4128; padding: 5px; border-radius: 10px;
                                            }
                                            .shahbaz_btn:hover{
                                                background: rgba(12,65,40,0.96);
                                                padding: 5px;
                                                border-radius: 10px;
                                            }
                                            </style>
                                        </body>
                                        </html>
                                        ';

                                        $result = mail($to, $subject, $message, $headers);
                                        if ($result)
                                        {
                                            echo "<script>alert('Invoice has been Created!')</script>";
                                            echo "<script>window.open('invoices.php', '_self')</script>";
                                        }

                                    }
                                }
                                else{
                                    $to = $email;
                                    $subject = 'Order Confirmation | Hot Metal Logos';

                                    $headers['From'] = 'info@hotmetallogos.com';
                                    $headers['MIME-Version'] = 'MIME-Version: 1.0';
                                    $headers['Content-type'] = 'text/html; charset=iso-8859-1';
                                    $message = '
                                        <html>
                                        <head>
                                            <title>Order Confirmation | '.$p_name.' | Hot Metal Logos</title>
                                        </head>
                                        <body style="text-align: center;">
                                            <div style="background: grey; border-radius: 30px; padding: 50px; margin-top: 20px; margin-bottom: 20px;">
                                                <p style="text-align: center;">Click on the below link to confirm your order:</p>
                                                <center>
                                                    <a class="shahbaz_btn" href="https://hotmetallogos.com/invoicePending.php?invoice='.$invoiceIDNew.'&email='.$email. '">Order Confirmation</a>
                                                </center>
                                            </div>
                                            <style>
                                            .shahbaz_btn{
                                                background: #0c4128;
                                                padding: 5px;
                                                border-radius: 10px;
                                            }
                                            .shahbaz_btn:hover{
                                                background: rgba(12,65,40,0.96);
                                                padding: 5px;
                                                border-radius: 10px;
                                            }
                                            </style>
                                        </body>
                                        </html>
                                        ';

                                    $result = mail($to, $subject, $message, $headers);
                                    if ($result)
                                    {
                                        echo "<script>alert('Invoice has been Created!')</script>";
                                        echo "<script>window.open('invoices.php', '_self')</script>";
                                    }
                                }
                            } else {
                                echo "<script>alert('Take An Error! Try Again.')</script>";
                                echo "<script>window.open('invoices.php', '_self')</script>";
                            }
                        }
                        ?>

                        <style>
                            input{
                                margin-top: 20px;
                            }
                            select,textarea{
                                margin-top: 20px;
                            }
                        </style>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>