<?php
include "db/db.php";
$sqlGet = mysqli_query($db, "SELECT * FROM carrierprofile WHERE status = ''");
while ($sqlRow = mysqli_fetch_array($sqlGet))
{

    $to = $sqlRow['email'];
    $subject = "Account Completion Request for MC On-boarding";

    $headers  = "From: info@hotmetallogos.com \r\n";
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
                <h3 style="text-align: center;">Account Completion Request for MC Onboarding</h3>
                <p style="text-align: center">
                  Kindly Completed Your Profile associated with: <br> 
                  Email address: '.$sqlRow['email'].'  
                  <br> 
                  Carrier Name: '.$sqlRow['carriername'].'
                  <br>
                  Kindly login by Using the Below Button.
                </p>
              </td>
            </tr>
            <tr>
              <td>
                <p>
                <center>
                  <a href="https://mcco.hotmetallogos.com/carrierLogin.php" style="padding: 10px 15px; display: inline-block; border-radius: 5px; background: #17bebb; color: #ffffff;">
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

    $mail = mail($to, $subject, $message, $headers);
}
?>