<?php
ob_start();
session_start();
include "../db/db.php";
include "inc/head.php";
if (!isset($_SESSION['carrier_id']))
{
    header("Location: ../carrierLogin.php");
}
$getSql = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `w9_form` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
?>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2 class="text-uppercase">Carrier Profile</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">

                    <div class="card">
                        <div class="header bg-blue">
                            <h2 class="text-uppercase">
                                Carrier Profile
                                <a href="mutualconcepts.v1.php?edit" class="btn btn-warning" style="float: right!important;">
                                    Edit Carrier Profile
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            <?php
                            $dataCarrierProfile = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
                            ?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Carrier ID:</th>
                                    <td><?php echo $dataCarrierProfile['carrier_id']; ?></td>
                                </tr>
                                <tr>
                                    <th>Carrier Name:</th>
                                    <td><?php echo $dataCarrierProfile['carriername']; ?></td>
                                </tr>
                                <tr>
                                    <th>Date Registered:</th>
                                    <td><?php echo $dataCarrierProfile['date']; ?></td>
                                </tr>
                                <tr>
                                    <th>Street: </th>
                                    <td><?php echo $dataCarrierProfile['street']; ?></td>
                                </tr>
                                <tr>
                                    <th>City: </th>
                                    <td><?php echo $dataCarrierProfile['city']; ?></td>
                                </tr>
                                <tr>
                                    <th>State: </th>
                                    <td><?php echo $dataCarrierProfile['state']; ?></td>
                                </tr>
                                <tr>
                                    <th>Zipcode</th>
                                    <td><?php echo $dataCarrierProfile['zipcode']; ?></td>
                                </tr>
                                <tr>
                                    <th>SCAC:</th>
                                    <td><?php echo $dataCarrierProfile['scac']; ?></td>
                                </tr>
                                <tr>
                                    <th>FED ID#:</th>
                                    <td><?php echo $dataCarrierProfile['fedidno']; ?></td>
                                </tr>
                                <tr>
                                    <th>MC#</th>
                                    <td><?php echo $dataCarrierProfile['mcno']; ?></td>
                                </tr>
                                <tr>
                                    <th>Dot Number#</th>
                                    <td><?php echo $dataCarrierProfile['dot_no']; ?></td>
                                </tr>
                                <tr>
                                    <th>EIN:</th>
                                    <td><?php echo $dataCarrierProfile['ein']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $dataCarrierProfile['phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>FAX:</th>
                                    <td><?php echo $dataCarrierProfile['fax']; ?></td>
                                </tr>
                                <tr>
                                    <th>Authorized Carrier Representative Name:</th>
                                    <td><?php echo $dataCarrierProfile['cont_name_auth_carier_representative']; ?></td>
                                </tr>
                                <tr>
                                    <th>Authorized Carrier Representative Title:</th>
                                    <td><?php echo $dataCarrierProfile['cont_title_auth_carier_representative']; ?></td>
                                </tr>
                                <tr>
                                    <th>Authorized Carrier Representative Contact:</th>
                                    <td><?php echo $dataCarrierProfile['contact']; ?></td>
                                </tr>
                                <tr>
                                    <th>Authorized Carrier Representative Email:</th>
                                    <td><?php echo $dataCarrierProfile['email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Safer Stat Rating:</th>
                                    <td><?php echo $dataCarrierProfile['safar_star_rating']; ?></td>
                                </tr>
                                <tr>
                                    <th>Date if last Compliance Audit:</th>
                                    <td><?php echo $dataCarrierProfile['last_complience_audit']; ?></td>
                                </tr>

                                <tr>
                                    <th colspan="2">
                                        <h5>
                                            Remit to Mailing Address: (if different from above)
                                        </h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Street: </th>
                                    <td><?php echo $dataCarrierProfile['remitstreet']; ?></td>
                                </tr>
                                <tr>
                                    <th>City: </th>
                                    <td><?php echo $dataCarrierProfile['remitcity']; ?></td>
                                </tr>
                                <tr>
                                    <th>State: </th>
                                    <td><?php echo $dataCarrierProfile['remitstate']; ?></td>
                                </tr>
                                <tr>
                                    <th>Zipcode:</th>
                                    <td><?php echo $dataCarrierProfile['remitzipcode']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">
                                        <h5>
                                            Contact Information:
                                        </h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>Dispatcher:</th>
                                    <td><?php echo $dataCarrierProfile['ci_dispatcher']; ?></td>
                                </tr>
                                <tr>
                                    <th>Main Phone:</th>
                                    <td><?php echo $dataCarrierProfile['ci_mainphone']; ?></td>
                                </tr>
                                <tr>
                                    <th>After Hours Cell or Night:</th>
                                    <td><?php echo $dataCarrierProfile['ci_afterhour']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $dataCarrierProfile['ci_email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Operations Manager:</th>
                                    <td><?php echo $dataCarrierProfile['ci_operationamanager']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $dataCarrierProfile['ci_om_phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $dataCarrierProfile['ci_om_email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Accounts Payable Contact:</th>
                                    <td><?php echo $dataCarrierProfile['ci_accounts_payable_contact']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $dataCarrierProfile['ci_accounts_phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $dataCarrierProfile['ci_accounts_email']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-blue">
                            <h2 class="text-uppercase">
                                Factoring Company Information
                                <a href="mutualconcepts.v2.php?edit" class="btn btn-warning" style="float: right!important;">
                                    Edit Factoring
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            <?php
                            $dataFactory = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `factory_info` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
                            ?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Factoring Company Name:</th>
                                    <td><?php echo $dataFactory['fc_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $dataFactory['fc_company_phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Remit To Address:</th>
                                    <td><?php echo $dataFactory['fc_remit_address']; ?></td>
                                </tr>
                                <tr>
                                    <th>City:</th>
                                    <td><?php echo $dataFactory['fc_city']; ?></td>
                                </tr>
                                <tr>
                                    <th>State:</th>
                                    <td><?php echo $dataFactory['fc_state']; ?></td>
                                </tr>
                                <tr>
                                    <th>Zip Code:</th>
                                    <td><?php echo $dataFactory['fc_zipcode']; ?></td>
                                </tr>
                                <tr>
                                    <th>Contact:</th>
                                    <td><?php echo $dataFactory['fc_contact']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $dataFactory['fc_phone']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="card">
                        <div class="header bg-blue">
                            <h2 class="text-uppercase">
                                Insurance Company Information
                                <a href="mutualconcepts.v3.php?edit" class="btn btn-warning" style="float: right!important;">
                                    Edit Insurance
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            <?php
                            $dataInsurance = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `insurance_info` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
                            ?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Insurance Agency:</th>
                                    <td><?php echo $dataInsurance['ic_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td><?php echo $dataInsurance['ic_phone']; ?></td>
                                </tr>
                                <tr>
                                    <th>Contact:</th>
                                    <td><?php echo $dataInsurance['ic_contact']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td><?php echo $dataInsurance['ic_email']; ?></td>
                                </tr>
                                <tr>
                                    <th>Policy Number:</th>
                                    <td><?php echo $dataInsurance['ic_policy_no']; ?></td>
                                </tr>
                                <tr>
                                    <th>Expiration Date:</th>
                                    <td><?php echo $dataInsurance['ic_expiery_date']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>


                    <div class="card">
                        <div class="header bg-blue">
                            <h2 class="text-uppercase">
                                Equipment
                                <a href="mutualconcepts.v4.php?edit" class="btn btn-warning" style="float: right!important;">
                                    Edit Equipment
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            <?php
                            $dataEquipment = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `equipment_info` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
                            ?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Tractors:</th>
                                    <td><?php echo $dataEquipment['eq_tractor']; ?></td>
                                    <th>Dry Van:</th>
                                    <td><?php echo $dataEquipment['eq_dry_van']; ?></td>
                                </tr>
                                <tr>
                                    <th>Flatbed:</th>
                                    <td><?php echo $dataEquipment['eq_flatbed']; ?></td>
                                    <th>Reefer:</th>
                                    <td><?php echo $dataEquipment['eq_reefer']; ?></td>
                                </tr>
                                <tr>
                                    <th>Hotshot:</th>
                                    <td><?php echo $dataEquipment['eq_hotshot']; ?></td>
                                    <th>CDL:</th>
                                    <td><?php echo $dataEquipment['eq_cdl']; ?></td>
                                </tr>
                                <tr>
                                    <th>TWIC:</th>
                                    <td><?php echo $dataEquipment['eq_twic']; ?></td>
                                    <th>Hazmat:</th>
                                    <td><?php echo $dataEquipment['eq_hazmat']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="4">
                                        <h5>Traffic Lanes that your company services:</h5>
                                    </th>
                                </tr>
                                <tr>
                                    <th>North East:</th>
                                    <td><?php echo $dataEquipment['eq_north_east']; ?></td>
                                    <th>South West:</th>
                                    <td><?php echo $dataEquipment['eq_south_west']; ?></td>
                                </tr>
                                <tr>
                                    <th>South East:</th>
                                    <td><?php echo $dataEquipment['eq_south_east']; ?></td>
                                    <th>North West:</th>
                                    <td><?php echo $dataEquipment['eq_north_west']; ?></td>
                                </tr>
                                <tr>
                                    <th>Mid West:</th>
                                    <td><?php echo $dataEquipment['eq_mid_west']; ?></td>
                                    <th>Central:</th>
                                    <td><?php echo $dataEquipment['eq_central']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Preferred States or Lanes:</th>
                                    <td colspan="2"><?php echo $dataEquipment['eq_prefered_states']; ?></td>
                                </tr>
                                <tr>
                                    <th>Email available loads?</th>
                                    <td><?php echo $dataEquipment['eq_email_available_load']; ?></td>
                                    <th>Email Address to send available loads:</th>
                                    <td><?php echo $dataEquipment['eq_email_load']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Do you have a locking policy in place?</th>
                                    <td colspan="2"><?php echo $dataEquipment['eq_looking_policy']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Are all drivers required to keep trailer doors-locked until reaching their final destination?</th>
                                    <td colspan="2"><?php echo $dataEquipment['eq_trailer_lock_doors']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Do you perform criminal background checks on drivers?</th>
                                    <td colspan="2"><?php echo $dataEquipment['eq_driver_criminal_record_check']; ?></td>
                                </tr>
                                <tr>
                                    <th>Does your company do business in the state of CA? </th>
                                    <td><?php echo $dataEquipment['eq_do_business_in_ca']; ?></td>
                                    <th>If yes, are all of your TRU’s registered on ARBER and in compliance with CA ARB & ATCM in-use engine emission standards? </th>
                                    <td><?php echo $dataEquipment['eq_tru_restered_on_arber']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="4">Please list your CA-ARB Identification Number below or attach a list of all of your
                                        ARB & ATCMapproved units.</th>
                                </tr>
                                <tr>
                                    <th>Year:</th>
                                    <td><?php echo $dataEquipment['eq_year']; ?></td>
                                    <th>Make:</th>
                                    <td><?php echo $dataEquipment['eq_make']; ?></td>
                                </tr>
                                <tr>
                                    <th>Color:</th>
                                    <td><?php echo $dataEquipment['eq_color']; ?></td>
                                    <th>Plate #:</th>
                                    <td><?php echo $dataEquipment['eq_plate']; ?></td>
                                </tr>
                                <tr>
                                    <th colspan="2">Last 6 Vin#:</th>
                                    <td colspan="2"><?php echo $dataEquipment['eq_last_vin']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-blue">
                            <h2 class="text-uppercase">
                                W9-Form Data
                                <a href="mutualconcepts.v6.php?edit" class="btn btn-warning" style="float: right!important;">
                                    Edit W9-Form
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            <?php
                            $dataWForm = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `w9_form` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
                            ?>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Name (as shown on your income tax return). Name is required on this line; do not leave this line blank.</th>
                                    <td><?php echo $dataWForm['name']; ?></td>
                                    <th>Business name/disregarded entity name, if different from above</th>
                                    <td><?php echo $dataWForm['business_name']; ?></td>
                                </tr>
                                <tr>
                                    <th>Check appropriate box for federal tax classification of the person whose name is entered on line 1. Check only one of the following seven boxes.</th>
                                    <td>
                                        <?php
                                        if ($dataWForm['fed_tex_classification'] == '1')
                                        {
                                            echo "Individual/sole proprietor or single-member LLC";
                                        }
                                        elseif ($dataWForm['fed_tex_classification'] == '2')
                                        {
                                            echo "C Corporation";
                                        }
                                        elseif ($dataWForm['fed_tex_classification'] == '3')
                                        {
                                            echo "S Corporation";
                                        }
                                        elseif ($dataWForm['fed_tex_classification'] == '4')
                                        {
                                            echo "Partnership";
                                        }
                                        elseif ($dataWForm['fed_tex_classification'] == '5')
                                        {
                                            echo "Trust/estate";
                                        }
                                        elseif ($dataWForm['fed_tex_classification'] == '6')
                                        {
                                            echo "Limited liability company";
                                        }
                                        else
                                        {
                                            echo "Employer identification number";
                                        }
                                        ?>
                                    </td>
                                    <th>If Select "Limited liability company". Select the tax classification (C=C corporation, S=S corporation, P=Partnership) </th>
                                    <td>
                                        <?php
                                        if ($dataWForm['limited_ability'] == 'C')
                                        {
                                            echo "C corporation";
                                        }
                                        elseif ($dataWForm['limited_ability'] == 'S')
                                        {
                                            echo "S corporation";
                                        }
                                        else
                                        {
                                            echo "Partnership";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Exempt payee code (if any)</th>
                                    <td><?php echo $dataWForm['examption_code']; ?></td>
                                    <th>Exemption from FATCA reporting code (if any)</th>
                                    <td><?php echo $dataWForm['examption_from_fatca']; ?></td>
                                </tr>
                                <tr>
                                    <th>Address (number, street, and apt. or suite no.)</th>
                                    <td><?php echo $dataWForm['address']; ?></td>
                                    <th>City, state, and ZIP code</th>
                                    <td><?php echo $dataWForm['city_state_zipcode']; ?></td>
                                </tr>
                                <tr>
                                    <th>List account number(s) here (optional)</th>
                                    <td><?php echo $dataWForm['account_number']; ?></td>
                                    <th>Requester’s name and address (optional)</th>
                                    <td><?php echo $dataWForm['requester_name_address']; ?></td>
                                </tr>
                                <tr>
                                    <th>Select Taxpayer Identification Number (TIN)</th>
                                    <td>
                                        <?php
                                        if ($dataWForm['tin'] == '1')
                                        {
                                            echo "Social security number";
                                        }
                                        else
                                        {
                                            echo "Employer identification number";
                                        }
                                        ?>
                                    </td>
                                    <th>TIN#</th>
                                    <td><?php echo $dataWForm['tin_no']; ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="header bg-blue">
                            <h2 class="text-uppercase">
                                Uploaded Documents
                                <a href="mutualconcepts.v7.php" class="btn btn-warning" style="float: right!important;">
                                    Edit Documents
                                </a>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Sr.</th>
                                            <th>File</th>
                                            <th>File Type</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        $getSqlDoc = mysqli_query($db, "SELECT * FROM `documents` WHERE carrier_id = '".$_SESSION['carrier_id']."'");
                                        while ($rowSqlDoc = mysqli_fetch_array($getSqlDoc))
                                        {
                                            $i++;
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td>
                                                    <a href="../documents/<?php echo $rowSqlDoc['file_name']; ?>" target="_blank">
                                                        <?php echo $rowSqlDoc['file_name']; ?>
                                                    </a>
                                                </td>
                                                <td><?php echo $rowSqlDoc['file_type']; ?></td>
                                                <td><?php echo $rowSqlDoc['date']; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <?php
                    if ($_SESSION['status'] == '' OR $_SESSION['status'] == 'InReview' )
                    {
                        ?>
                        <div class="card">
                            <div class="header bg-blue">
                                <h2 class="text-uppercase">
                                    Finalized Your Data
                                </h2>
                            </div>
                            <div class="body">
                                <div class="row">
                                    <div class="col-sm-4"></div>
                                    <div class="col-sm-4">
                                        <a href="finalizedData.php" class="btn bg-orange form-control waves-button">
                                            Finalized Data
                                        </a>
                                    </div>
                                    <div class="col-sm-4"></div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>





<?php
include "inc/footer.php";
?>