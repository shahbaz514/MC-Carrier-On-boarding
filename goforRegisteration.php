<?php
include "db/db.php";
include "inc/head.php";
?>
    <section>
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>CARRIER REGISTRATION</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>CARRIER REGISTRATION</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-6">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="email_address">Confirm Your EIN#:</label>
                                                <input type="text" name="ein_no" class="form-control" placeholder="Enter your EIN" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="email_address">Enter Your Email:</label>
                                                <input type="email" name="email" class="form-control" placeholder="Enter your Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <label for="email_address">Enter Your Password:</label>
                                                <input type="password" name="password" class="form-control" placeholder="Enter your Password" required>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-block btn-primary m-t-15 waves-effect" name="save_data" value="Click Here to Confirm Registration">
                                    </form>
                                    <?php

                                    if (isset($_POST['save_data']))
                                    {
                                        $op_status = "";
                                        $dot_auth = "";
                                        $mcno = $_GET['mcno'];
                                        $ein_no = mysqli_real_escape_string($db, $_POST['ein_no']);

                                        $ch = curl_init();
                                        $url = "https://mobile.fmcsa.dot.gov/qc/services/carriers/docket-number/".$_GET['mcno']."/?webKey=c145307b4d09cd5b3a5ebfdd36c1efecf9a64448";
                                        curl_setopt($ch, CURLOPT_URL, $url);
                                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                                        $resp = curl_exec($ch);
                                        if ($e = curl_error($ch))
                                        {
                                            echo $e;
                                        }
                                        else
                                        {
                                            $decode = json_decode($resp, true);
                                            $data = $decode['content']['0']['carrier'];

                                            if($data[bipdInsuranceOnFile] < $data[bipdRequiredAmount]) {
                                                $op_status = "Fail";
                                            } else {
                                                $op_status = "Pass";
                                            }

                                            if(($data[commonAuthorityStatus] == "N" || $data[commonAuthorityStatus] == "I") && ($data[contractAuthorityStatus] == "I" || $data[contractAuthorityStatus] == "N")) {
                                                $dot_auth = "Fail";
                                            }
                                            else if($data[commonAuthorityStatus] == "A" || $data[contractAuthorityStatus] == "A") {
                                                $dot_auth = "Pass";
                                            }
                                            $sqlCountData = 0;
                                            $sqlCountData = mysqli_num_rows(mysqli_query($db, "SELECT * FROM carrierprofile WHERE mcno = '$mcno'"));

                                            if ($op_status == "Fail" OR $dot_auth == "Fail") {
                                                ?>

                                                <div class="alert bg-red alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    You are not Eligible to Register. Kindly contact to Website Administrator or Try other US MC Number OR US Dot Number.
                                                </div>
                                                <center>
                                                    <a href="register.php" class="btn btn-primary btn-warning">
                                                        Please Click Here to Search again
                                                    </a>
                                                </center>
                                                <?php
                                            }
                                            else if ($data[ein] != $ein_no) {
                                                ?>
                                                <div class="alert bg-red alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    Your Entered EIN <?php echo $data[ein]; ?> is not match with the <span class="text-uppercase">fmcsa</span>
                                                </div>
                                                <center>
                                                    <a href="register.php" class="btn btn-primary btn-warning">
                                                        Please Click Here to Search again
                                                    </a>
                                                </center>
                                                <?php
                                            }
                                            else if ($sqlCountData > 0) {
                                                ?>
                                                <div class="alert bg-red alert-dismissible" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    This MC# / Carrier ID is already registered. Kindly login Now.
                                                </div>
                                                <center>
                                                    <a href="carrierLogin.php" class="btn btn-primary btn-warning">
                                                        Go To Carrier Login
                                                    </a>
                                                </center>
                                                <?php
                                            }
                                            else {
                                                $carrier_id = $_GET['mcno'];
                                                $carriername = $data[legalName];
                                                $date = date("d-m-Y");
                                                $street = $data[phyStreet];
                                                $city = $data[phyCity];
                                                $zipcode = $data[phyZipcode];
                                                $state = $data[phyState];
                                                $ein_no = $data[ein];
                                                $dot_no = $data[dotNumber];
                                                $otp = rand();
                                                $email = mysqli_real_escape_string($db,$_POST['email']);
                                                $password = mysqli_real_escape_string($db,$_POST['password']);
                                                $sqlInter = mysqli_query($db, "INSERT INTO `carrierprofile`(`carrier_id`, `carriername`, `date`, `street`, `city`, `state`, `zipcode`, `mcno`, `dot_no`, `ein`, `email`, `password`, `otp`) VALUES ('$carrier_id', '$carriername','$date','$street','$city','$state','$zipcode','$mcno', '$dot_no','$ein_no','$email','$password','$otp')");
                                                if ($sqlInter) {
                                                    $to = $email;
                                                    $subject = "Account Verification/Confirmation for MC On-boarding";

                                                    $headers  = "From: " . strip_tags($_POST['req-email']) . "\r\n";
                                                    $headers = "MIME-Version: 1.0\r\n";
                                                    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                                                    $message = '
<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #fff;">
<center style="width: 100%; background-color: #fff;">
  <div style="max-width: 600px; border-radius: 10px; background: lightgrey; margin: 100px auto 0;" class="email-container">
    <table align="center" role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="margin: auto;">
      <tr>
        <td valign="top" style="padding: 1em 2.5em 0 2.5em;">
          <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
            <tr>
              <td style="text-align: center;">
                <h1>
                    <a href="http://www.mutualconceptstx.com/">
                        <img src="https://mcco.hotmetallogos.com/images/logo.png" style="width: 50%!important; height: 50%!important;"/>
                    </a>    
                </h1>
              </td>
            </tr>
            <tr>
              <td>
                <h3 style="text-align: center;">Verify your Email address</h3>
                <p style="text-align: center">
                  You have created an Account associated with the following email address: '.$email.'. Please verify email address by clicking the below button.
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                <center>
                  <a href="https://mcco.hotmetallogos.com/otp.php?verify='.$otp.'&carreirId='.$carrier_id.'" style="padding: 10px 15px; display: inline-block; border-radius: 5px; background: #17bebb; color: #ffffff;">
                    Verify My Email
                  </a>
                </center>
                </p>
              </td>
            </tr>
          </table>
        </td>
      </tr>
    </table>
  </div>
</center>
</body>
';

                                                    $mail = mail($to, $subject, $message, $headers);

                                                    if ($mail){
                                                        ?>

                                                        <div class="alert bg-green alert-dismissible" role="alert" style="margin-top: 20px;">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                            Your Registration is Completed! Kindly verify your Email Account. Kindly also check Your Spam Folder.
                                                        </div>
                                                        <center>
                                                            <a href="carrierLogin.php" class="btn btn-primary btn-warning">
                                                                Go To Login Page
                                                            </a>
                                                        </center>

                                                        <?php
                                                    }
                                                }
                                                else {
                                                    ?>
                                                    <div class="alert bg-red alert-dismissible" role="alert" style="margin-top: 20px;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        Take an Error! Try Again.
                                                    </div>
                                                    <center>
                                                        <a href="register.php" class="btn btn-primary btn-warning">
                                                            Go To Registration Page
                                                        </a>
                                                    </center>
                                                    <?php
                                                }
                                            }
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-sm-3"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>





<?php
include "inc/footer.php";
?>