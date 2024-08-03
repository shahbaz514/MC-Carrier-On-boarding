<?php
ob_start();
session_start();
include "../db/db.php";
include "inc/head.php";
if (!isset($_SESSION['carrier_id']))
{
    header("Location: ../carrierLogin.php");
}
?>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>WELCOME</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>WELCOME</h2>
                        </div>
                        <div class="body">
                            <p>
                                Thank you for your interest in becoming an approved carrier for Mutual Concepts.
                                Below are some of our key requirements in order for your company to qualify as an approved carrier.
                                All elements identified as 'required' must be finalized in order for the qualification process to be completed.
                                If your company is not compliant to one or several of the qualification criteria, you may return at another time to register once the non-compliant items are corrected.
                                The registration process will take on average 15 minutes to complete.
                                Once started, you must finish the registration process.
                                You cannot save and return to complete at another time without losing your submissions.
                            </p>
                            <center>
                                <a href="mutualconcepts.v1.php" class="btn bg-blue waves-effect">
                                    Start Profile Building
                                </a>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="block-header">
                <h2 class="text-uppercase">Steps required to complete registration process</h2>
            </div>
            <div class="card">
                <div class="header bg-blue">
                    <h2 class="text-uppercase">Steps required to complete registration process</h2>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="header bg-red">
                                    <h2 class="text-uppercase">
                                        Step 01
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="material-icons">arrow_right</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    Provide MC/MX# or DOT#
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="header bg-cyan">
                                    <h2 class="text-uppercase">
                                        Step 02
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="material-icons">arrow_right</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    Validate contact information
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="header bg-blue-grey">
                                    <h2 class="text-uppercase">
                                        Step 03
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="material-icons">arrow_right</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    Submit electronic W-9
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="header bg-green">
                                    <h2 class="text-uppercase">
                                        Step 04
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="material-icons">arrow_right</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    Complete carrier profile

                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="header bg-orange">
                                    <h2 class="text-uppercase">
                                        Step 05
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="material-icons">arrow_right</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    Read & accept Motor Carrier Agreement
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="header bg-blue-grey">
                                    <h2 class="text-uppercase">
                                        Step 06
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="material-icons">arrow_right</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    Provide certificate of insurance
                                    <ul style="text-align: justify;">
                                        <li>$100,000 cargo coverage</li>
                                        <li>$1,000,000 auto coverage</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="header bg-light-blue">
                                    <h2 class="text-uppercase">
                                        Step 07
                                    </h2>
                                    <ul class="header-dropdown m-r--5">
                                        <li>
                                            <a href="javascript:void(0);">
                                                <i class="material-icons">arrow_right</i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="body">
                                    Meet carrier compliance requirements
                                    <ul style="text-align: justify;">
                                        <li>Safety rating of satisfactory or none</li>
                                        <li>Active common or contract authority</li>
                                    </ul>
                                </div>
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