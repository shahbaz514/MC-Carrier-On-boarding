<?php
    $sqlGetData = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM carrierprofile WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Welcome To MCCO | Carrier Profile Building</title>
    <!-- Favicon-->
    <link rel="icon" href="favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="../plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Bootstrap Select Css -->
    <link href="../plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="../plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Morris Chart Css-->
    <link href="../plugins/morrisjs/morris.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="../css/themes/all-themes.css" rel="stylesheet" />
</head>

<body class="theme-blue">
<!-- Top Bar -->
<nav class="navbar">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="index.php">
                MC Carrier On-boarding
            </a>
        </div>
        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="pull-right">
                    <a href="../logout.php" class="js-right-sidebar" data-close="true">
                        <i class="material-icons">
                            logout
                        </i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<section>
    <!-- Left Sidebar -->
    <aside id="leftsidebar" class="sidebar">
        <!-- User Info -->
        <div class="user-info">
            <div class="image">
                <!--<img src="../images/user.png" width="48" height="48" alt="User" />-->
            </div>
            <div class="info-container" style="top: 48px;">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php echo $sqlGetData['carriername']; ?>
                </div>
                <div class="email">
                    <?php echo $sqlGetData['carrier_id']; ?>
                </div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="../logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- #User Info -->
        <!-- Menu -->
        <div class="menu">
            <ul class="list">
                <li class="header">MAIN NAVIGATION</li>
                <li class="active">
                    <a href="index.php">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <?php
                if ($_SESSION['status'] == '')
                {
                ?>
                <li>
                    <a href="mutualconcepts.v1.php">
                        <i class="material-icons">info</i>
                        <span>Carrier Profile</span>
                    </a>
                </li>
                <li>
                    <a href="mutualconcepts.v2.php">
                        <i class="material-icons">factory</i>
                        <span>Factory</span>
                    </a>
                </li>
                <li>
                    <a href="mutualconcepts.v3.php">
                        <i class="material-icons">backup</i>
                        <span>Insurance Company</span>
                    </a>
                </li>
                <li>
                    <a href="mutualconcepts.v4.php">
                        <i class="material-icons">build</i>
                        <span>Equipment</span>
                    </a>
                </li>
                <li>
                    <a href="mutualconcepts.v5.php">
                        <i class="material-icons">control_point_duplicate</i>
                        <span>Contract</span>
                    </a>
                </li>
                <li>
                    <a href="mutualconcepts.v6.php">
                        <i class="material-icons">transform</i>
                        <span>W-9 Form</span>
                    </a>
                </li>
                <li>
                    <a href="mutualconcepts.v7.php">
                        <i class="material-icons">file_upload</i>
                        <span>Upload Documents</span>
                    </a>
                </li>
                <?php
                }
                elseif ($_SESSION['status'] == 'InReview')
                {
                    ?>
                    <li>
                        <a href="mutualconcepts.v6.php?edit">
                            <i class="material-icons">transform</i>
                            <span>W-9 Form</span>
                        </a>
                    </li>
                    <?php
                }
                ?>
                <li>
                    <a href="viewSubmitedData.php">
                        <i class="material-icons">list</i>
                        <span>View Submitted Data</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- #Menu -->
        <!-- Footer -->
        <div class="legal">
            <div class="copyright">
                Copyright &copy; 2023 By
                <a href="#">
                    Mutual Concepts
                </a>
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div>
        <!-- #Footer -->
    </aside>
</section>
