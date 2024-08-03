<?php
ob_start();
session_start();
include "db/db.php";
if (isset($_GET['verify']) AND isset($_GET['carreirId']))
{
    $count = 0;
    $count = mysqli_num_rows(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_GET['carreirId']."' AND otp = '".$_GET['verify']."'"));
    if ($count>0)
    {
        $sqlUp = mysqli_query($db,"UPDATE `carrierprofile` SET `status_otp`='Verified' WHERE carrier_id = '".$_GET['carreirId']."'");
        if ($sqlUp)
        {
            echo "<script>alert('Email Verified Successfully! Login Now')</script>";
            echo "<script>window.open('carrierLogin.php','_self')</script>";
        }
    }
    else
    {
        echo "<script>alert('Take an Error! Try Again')</script>";
        echo "<script>window.open('carrierLogin.php','_self')</script>";
    }
}
else
{
    echo "<script>window.open('index.php','_self')</script>";
}