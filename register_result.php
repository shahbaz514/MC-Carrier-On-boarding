<?php
include "db/db.php";
include "inc/head.php";
?>
    <section>
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>CARRIER PRE-QUALIFICATION</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>CARRIER PRE-QUALIFICATION</h2>
                        </div>
                        <div class="body">
                            <center>
                                <a href="register.php" class="btn btn-primary btn-warning">
                                    Please Click Here to Search again
                                </a>
                            </center>
                            <?php
                            $op_status = "";
                            $dot_auth = "";
                            if (isset($_POST['save_us_dot_no']))
                            {
                                $us_dot_no = mysqli_real_escape_string($db, $_POST['us_dot_no']);
                                $ch = curl_init();
                                $url = "https://mobile.fmcsa.dot.gov/qc/services/carriers/".$us_dot_no."/?webKey=c145307b4d09cd5b3a5ebfdd36c1efecf9a64448";
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
                                    $data = $decode['content']['carrier'];
                                }
                                ?>
                                <div class="card" style="margin-top: 20px;">
                                    <div class="header bg-blue">
                                        <h2 class="text-uppercase">MCCO Requirements</h2>
                                    </div>
                                    <div class="body">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Rule</th>
                                                <td>Result</td>
                                            </tr>
                                            <tr>
                                                <th>Op Status:</th>
                                                <td>
                                                    <?php
                                                    if($data[bipdInsuranceOnFile] < $data[bipdRequiredAmount])
                                                    {
                                                        $op_status = "Fail";
                                                        echo $op_status;
                                                    }
                                                    else
                                                    {
                                                        $op_status = "Pass";
                                                        echo $op_status;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>DOT Auth:</th>
                                                <td>
                                                    <?php
                                                    if(($data[commonAuthorityStatus] == "N" || $data[commonAuthorityStatus] == "I") && ($data[contractAuthorityStatus] == "I" || $data[contractAuthorityStatus] == "N"))
                                                    {
                                                        $dot_auth = "Fail";
                                                        echo $dot_auth;
                                                    }
                                                    else if($data[commonAuthorityStatus] == "A" || $data[contractAuthorityStatus] == "A")
                                                    {
                                                        $dot_auth = "Pass";
                                                        echo $dot_auth;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>DOT Safety:</th>
                                                <td>
                                                    <?php
                                                    if($data[hazmatOosRate] > $data[hazmatOosRateNationalAverage])
                                                    {
                                                        echo "Fail";
                                                    }
                                                    elseif ($data[vehicleOosRate] > $data[vehicleOosRateNationalAverage])
                                                    {
                                                        echo "Fail";
                                                    }
                                                    elseif ($data[crashTotal] > $data[driverOosRateNationalAverage])
                                                    {
                                                        echo "Fail";
                                                    }
                                                    else
                                                    {
                                                        echo "Pass";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Intrastate DOTNumber:</th>
                                                <td>
                                                    <?php
                                                    echo $data[dotNumber];
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>U.S. DOT INFORMATION</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Docket Number:</th>
                                                        <td>
                                                            <?php
                                                            $mc_no = "";
                                                            $ch1 = curl_init();
                                                            $url1 = "https://mobile.fmcsa.dot.gov/qc/services/carriers/".$us_dot_no."/docket-numbers?webKey=c145307b4d09cd5b3a5ebfdd36c1efecf9a64448";
                                                            curl_setopt($ch1, CURLOPT_URL, $url1);
                                                            curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
                                                            $resp1 = curl_exec($ch1);
                                                            if ($e1 = curl_error($ch1))
                                                            {
                                                                echo $e1;
                                                            }
                                                            else
                                                            {
                                                                $data1 = json_decode($resp1, true);
                                                                //print_r($data1);
                                                                $mc_no = $data1['content'][0]['docketNumber'];
                                                                echo $data1['content'][0]['prefix']."-".$data1['content'][0]['docketNumber'];
                                                            }

                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Legal Name:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[legalName];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>DBA Name:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[dbaName];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[phyStreet].", ".$data[phyCity].", ".$data[phyState].", ".$data[phyZipcode];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <hr>
                                                    <tr>
                                                        <th>Operating Status:</th>
                                                        <td>
                                                            <?php
                                                            if($data[bipdInsuranceOnFile] < $data[bipdRequiredAmount])
                                                            {
                                                                echo "Fail";
                                                            }
                                                            else
                                                            {
                                                                echo "Pass";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Out of Service Date:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[oosDate];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>AUTHORITY INFORMATION</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Common Authority:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[commonAuthorityStatus];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Contract Authority:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[contractAuthorityStatus];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Broker Authority:</th>
                                                        <td>
                                                            <?php echo $data[brokerAuthorityStatus]; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Inspection:</th>
                                                        <td><?php echo $data[driverInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Oos Inspection:</th>
                                                        <td><?php echo $data[driverOosInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Oos Rate:</th>
                                                        <td><?php echo $data[driverOosRate]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Oos Rate National Average:</th>
                                                        <td><?php echo $data[driverOosRateNationalAverage]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Inspection:</th>
                                                        <td><?php echo $data[hazmatInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Oos Inspection:</th>
                                                        <td><?php echo $data[hazmatOosInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Oos Rate:</th>
                                                        <td><?php echo $data[hazmatOosRate]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Oos Rate National Average:</th>
                                                        <td><?php echo $data[hazmatOosRateNationalAverage]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Inspection:</th>
                                                        <td><?php echo $data[vehicleInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Oos Inspection:</th>
                                                        <td><?php echo $data[vehicleOosInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Oos Rate:</th>
                                                        <td><?php echo $data[vehicleOosRate]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Oos Rate National Average:</th>
                                                        <td><?php echo $data[vehicleOosRateNationalAverage]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Towaway Crash:</th>
                                                        <td><?php echo $data[towawayCrash]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Inj Crash:</th>
                                                        <td><?php echo $data[injCrash]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fatal Crash:</th>
                                                        <td><?php echo $data[fatalCrash]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Crash Total:</th>
                                                        <td><?php echo $data[crashTotal]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Drivers:</th>
                                                        <td><?php echo $data[totalDrivers]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Power Units:</th>
                                                        <td><?php echo $data[totalPowerUnits]; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>CARRIER SAFETY RATING</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Rating Date:</th>
                                                        <td><?php echo $data[safetyRatingDate]?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rating:</th>
                                                        <td><?php echo $data[safetyRating]?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Review Date:</th>
                                                        <td><?php echo $data[reviewDate]?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Review Type:</th>
                                                        <td><?php echo $data[reviewType]?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>DRIVERS</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Interstate Drivers <100 Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Interstate Drivers 100+ Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Interstate Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Intrastate Drivers <100 Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Intrastate Drivers 100+ Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Intrastate Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Interstate & Intrastate Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>CDL Employed Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Monthly Average Leased Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>EQUIPMENT</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Fleet Size:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Power Units:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Tractors & Trucks:</th>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Equipment Type</th>
                                                        <th>Owned</th>
                                                        <th>Term Leased</th>
                                                        <th>Trip Leased</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th>Tractors</th>
                                                        <td>0</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Trucks</th>
                                                        <td>0</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Trailers</th>
                                                        <td>0</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    -->

                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>MCCO REQUIREMENTS</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <?php
                                                    $sqlCountData = mysqli_num_rows(mysqli_query($db, "SELECT * FROM carrierprofile WHERE mcno = '$mc_no'"));
                                                    ?>
                                                    <tr>
                                                        <th>Rule</th>
                                                        <th>Result</th>
                                                        <th>Comment</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Carrier Already Registered?</th>
                                                        <th>
                                                            <?php
                                                            if ($sqlCountData > 0){
                                                                echo "Yes";
                                                            }
                                                            else
                                                            {
                                                                echo "No";
                                                            }
                                                            ?>
                                                        </th>
                                                        <th>
                                                            <?php
                                                            if ($sqlCountData > 0){
                                                                echo "Already Registered No Need to Register Again";
                                                                echo '
                                                                <a href="carrierLogin.php" class="btn btn-primary btn-warning">
                                                                    Go To Carrier Login
                                                                </a>
                                                                ';
                                                            }
                                                            else
                                                            {
                                                                if ($op_status == "Fail" OR $dot_auth == "Fail")
                                                                {
                                                                    echo "You are not Eligible to Register. Kindly contact to Website Administrator or Try other US MC Number OR US Dot Number";
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <a href="goforRegisteration.php?mcno=<?php echo $mc_no; ?>" class="btn btn-warning">
                                                                        Go For Registration
                                                                    </a>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>MCCO INFORMATION</h2>
                                            </div>
                                            <div class="body">
                                                <?php
                                                $sqlGetData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM carrierprofile WHERE mcno == '$mc_no'"));
                                                ?>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Company Name:</th>
                                                        <td>
                                                            <?php echo $sqlGetData['cont_company_name']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address:</th>
                                                        <td>
                                                            <?php echo $sqlGetData['cont_company_address']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>City, State & Zipcode:</th>
                                                        <td>
                                                            <?php echo $sqlGetData['cont_city_state_zipcode']; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            if (isset($_POST['save_us_docket']))
                            {
                                $us_docket = mysqli_real_escape_string($db, $_POST['us_docket']);
                                $ch = curl_init();
                                $url = "https://mobile.fmcsa.dot.gov/qc/services/carriers/docket-number/".$us_docket."/?webKey=c145307b4d09cd5b3a5ebfdd36c1efecf9a64448";
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
                                }
                                ?>
                                <div class="card" style="margin-top: 20px;">
                                    <div class="header bg-blue">
                                        <h2 class="text-uppercase">MCCO Requirements</h2>
                                    </div>
                                    <div class="body">
                                        <table class="table table-bordered table-striped">
                                            <tr>
                                                <th>Rule</th>
                                                <td>Result</td>
                                            </tr>
                                            <tr>
                                                <th>Op Status:</th>
                                                <td>
                                                    <?php
                                                    if($data[bipdInsuranceOnFile] < $data[bipdRequiredAmount])
                                                    {
                                                        $op_status = "Fail";
                                                        echo $op_status;
                                                    }
                                                    else
                                                    {
                                                        $op_status = "Pass";
                                                        echo $op_status;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>DOT Auth:</th>
                                                <td>
                                                    <?php
                                                    if(($data[commonAuthorityStatus] == "N" || $data[commonAuthorityStatus] == "I") && ($data[contractAuthorityStatus] == "I" || $data[contractAuthorityStatus] == "N"))
                                                    {
                                                        $dot_auth = "Fail";
                                                        echo $dot_auth;
                                                    }
                                                    else if($data[commonAuthorityStatus] == "A" || $data[contractAuthorityStatus] == "A")
                                                    {
                                                        $dot_auth = "Pass";
                                                        echo $dot_auth;
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>DOT Safety:</th>
                                                <td>
                                                    <?php
                                                    if($data[hazmatOosRate] > $data[hazmatOosRateNationalAverage])
                                                    {
                                                        echo "Fail";
                                                    }
                                                    elseif ($data[vehicleOosRate] > $data[vehicleOosRateNationalAverage])
                                                    {
                                                        echo "Fail";
                                                    }
                                                    elseif ($data[crashTotal] > $data[driverOosRateNationalAverage])
                                                    {
                                                        echo "Fail";
                                                    }
                                                    else
                                                    {
                                                        echo "Pass";
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Intrastate DOTNumber:</th>
                                                <td>
                                                    <?php
                                                    echo $data[dotNumber];
                                                    ?>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>U.S. DOT INFORMATION</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Docket Number:</th>
                                                        <td>
                                                            <?php
                                                            $mc_no = $us_docket;
                                                            echo "MC-".$mc_no;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Legal Name:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[legalName];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>DBA Name:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[dbaName];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[phyStreet].", ".$data[phyCity].", ".$data[phyState].", ".$data[phyZipcode];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <hr>
                                                    <tr>
                                                        <th>Operating Status:</th>
                                                        <td>
                                                            <?php
                                                            if($data[bipdInsuranceOnFile] < $data[bipdRequiredAmount])
                                                            {
                                                                echo "Fail";
                                                            }
                                                            else
                                                            {
                                                                echo "Pass";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Out of Service Date:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[oosDate];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>AUTHORITY INFORMATION</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Common Authority:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[commonAuthorityStatus];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Contract Authority:</th>
                                                        <td>
                                                            <?php
                                                            echo $data[contractAuthorityStatus];
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Broker Authority:</th>
                                                        <td>
                                                            <?php echo $data[brokerAuthorityStatus]; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Inspection:</th>
                                                        <td><?php echo $data[driverInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Oos Inspection:</th>
                                                        <td><?php echo $data[driverOosInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Oos Rate:</th>
                                                        <td><?php echo $data[driverOosRate]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Driver Oos Rate National Average:</th>
                                                        <td><?php echo $data[driverOosRateNationalAverage]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Inspection:</th>
                                                        <td><?php echo $data[hazmatInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Oos Inspection:</th>
                                                        <td><?php echo $data[hazmatOosInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Oos Rate:</th>
                                                        <td><?php echo $data[hazmatOosRate]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Hasmat Oos Rate National Average:</th>
                                                        <td><?php echo $data[hazmatOosRateNationalAverage]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Inspection:</th>
                                                        <td><?php echo $data[vehicleInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Oos Inspection:</th>
                                                        <td><?php echo $data[vehicleOosInsp]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Oos Rate:</th>
                                                        <td><?php echo $data[vehicleOosRate]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Vehicle Oos Rate National Average:</th>
                                                        <td><?php echo $data[vehicleOosRateNationalAverage]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Towaway Crash:</th>
                                                        <td><?php echo $data[towawayCrash]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Inj Crash:</th>
                                                        <td><?php echo $data[injCrash]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Fatal Crash:</th>
                                                        <td><?php echo $data[fatalCrash]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Crash Total:</th>
                                                        <td><?php echo $data[crashTotal]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Drivers:</th>
                                                        <td><?php echo $data[totalDrivers]; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Power Units:</th>
                                                        <td><?php echo $data[totalPowerUnits]; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>CARRIER SAFETY RATING</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Rating Date:</th>
                                                        <td><?php echo $data[safetyRatingDate]?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Rating:</th>
                                                        <td><?php echo $data[safetyRating]?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Review Date:</th>
                                                        <td><?php echo $data[reviewDate]?></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Review Type:</th>
                                                        <td><?php echo $data[reviewType]?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!--
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>DRIVERS</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Interstate Drivers <100 Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Interstate Drivers 100+ Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Interstate Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Intrastate Drivers <100 Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Intrastate Drivers 100+ Miles:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Intrastate Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Interstate & Intrastate Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>CDL Employed Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Monthly Average Leased Drivers:</th>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6"></div>
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>EQUIPMENT</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Fleet Size:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Power Units:</th>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <th>Total Tractors & Trucks:</th>
                                                        <td></td>
                                                    </tr>
                                                </table>
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <th>Equipment Type</th>
                                                        <th>Owned</th>
                                                        <th>Term Leased</th>
                                                        <th>Trip Leased</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th>Tractors</th>
                                                        <td>0</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Trucks</th>
                                                        <td>0</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Trailers</th>
                                                        <td>0</td>
                                                        <td>0</td>
                                                        <td>0</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    -->

                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>MCCO REQUIREMENTS</h2>
                                            </div>
                                            <div class="body">
                                                <table class="table table-bordered">
                                                    <?php
                                                    $sqlCountData = mysqli_num_rows(mysqli_query($db, "SELECT * FROM carrierprofile WHERE mcno = '$mc_no'"));
                                                    ?>
                                                    <tr>
                                                        <th>Rule</th>
                                                        <th>Result</th>
                                                        <th>Comment</th>
                                                    </tr>
                                                    <tr>
                                                        <th>Carrier Already Registered?</th>
                                                        <th>
                                                            <?php
                                                            if ($sqlCountData > 0){
                                                                echo "Yes";
                                                            }
                                                            else
                                                            {
                                                                echo "No";
                                                            }
                                                            ?>
                                                        </th>
                                                        <th>
                                                            <?php
                                                            if ($sqlCountData > 0){
                                                                echo "Already Registered No Need to Register Again";
                                                                echo '
                                                                <a href="carrierLogin.php" class="btn btn-primary btn-warning">
                                                                    Go To Carrier Login
                                                                </a>
                                                                ';
                                                            }
                                                            else
                                                            {
                                                                if ($op_status == "Fail" OR $dot_auth == "Fail")
                                                                {
                                                                    echo "You are not Eligible to Register. Kindly contact to Website Administrator or Try other US MC Number OR US Dot Number";
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                <a href="goforRegisteration.php?mcno=<?php echo $mc_no; ?>" class="btn btn-warning">
                                                                    Go For Registration
                                                                </a>
                                                                <?php
                                                                }
                                                            }
                                                            ?>
                                                        </th>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card" style="margin-top: 20px;">
                                            <div class="header bg-blue">
                                                <h2>MCCO INFORMATION</h2>
                                            </div>
                                            <div class="body">
                                                <?php
                                                $sqlGetData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM carrierprofile WHERE mcno == '$mc_no'"));
                                                ?>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Company Name:</th>
                                                        <td>
                                                            <?php echo $sqlGetData['cont_company_name']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>Address:</th>
                                                        <td>
                                                            <?php echo $sqlGetData['cont_company_address']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <th>City, State & Zipcode:</th>
                                                        <td>
                                                            <?php echo $sqlGetData['cont_city_state_zipcode']; ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
include "inc/footer.php";
?>