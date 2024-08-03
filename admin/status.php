<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}

if ($_SESSION['role'] != 'Admin')
{
    header("Location: allUsers.php");
}
include 'inc/head.php';

?>
    <section>
        <?php include 'inc/sidebar.php'; ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>UPDATE STATUS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                UPDATE STATUS
                            </h2>
                        </div>
                        <div class="body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <select class="form-control" name="role" required>
                                <option value="">---Select Status---</option>
                                <option value="InReview">In Review</option>
                                <option value="Completed">Completed</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <center>
                                <input style="margin-top: 20px;" type="submit" name="editUser" value="Update Status" class="btn bg-blue waves-button">
                            </center>
                        </div>
                    </div>
                </form>

                <?php
                if (isset($_POST['editUser']))
                {
                    $role = mysqli_real_escape_string($db, $_POST['role']);
                    $getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_GET['status']."'"));
                    $sqlInter = mysqli_query($db, "UPDATE `carrierprofile` SET `status`='$role' WHERE carrier_id = '".$_GET['status']."'");
                    if ($sqlInter) {
                        $to = $getSql['email'];
                        $subject = "Carrier Profile is ".$role." for MC On-boarding";

                        $headers  = "From: " . strip_tags($_POST['req-email']) . "\r\n";
                        $headers = "MIME-Version: 1.0\r\n";
                        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

                        if ($role == "InReview") {

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
                <h3 style="text-align: center;">Update TIN and Company Details</h3>
                <p style="text-align: center">
                  Your provided tin and company details for W9-Form is not match. Kindly update your TIN and other company details.
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                <center>
                  <a href="https://mcco.hotmetallogos.com/" style="padding: 10px 15px; display: inline-block; border-radius: 5px; background: #17bebb; color: #ffffff;">
                    Login Now
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
                        }
                        else
                        {
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
                <h3 style="text-align: center;">Profile Completed</h3>
                <p style="text-align: center">
                  Your provided data is OK and Profile is marked as Completed.
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                <center>
                  <a href="https://mcco.hotmetallogos.com/" style="padding: 10px 15px; display: inline-block; border-radius: 5px; background: #17bebb; color: #ffffff;">
                    Login Now to Check Data.
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
                        }
                        $mail = mail($to, $subject, $message, $headers);

                        if ($mail){
                            ?>

                            <div class="alert bg-green alert-dismissible" role="alert" style="margin-top: 20px;">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                <?php
                                if ($role == 'InReview')
                                {
                                    echo 'An Email is send to Carrier Profile to Update the TIN Number.';
                                }
                                else
                                {
                                    echo "An Email is send to Carrier Profile mentioned that there account has been approved";
                                }
                                ?>
                            </div>
                            <center>
                                <a href="allCarrier.php" class="btn btn-primary btn-warning">
                                    Go To Carriers Page
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
                            <a href="allCarrier.php" class="btn btn-primary btn-warning">
                                Go To Carriers Page
                            </a>
                        </center>
                        <?php
                    }

                }
                ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php
include 'inc/footer.php';
?>