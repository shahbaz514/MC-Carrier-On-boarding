<?php
ob_start();
session_start();
include "../db/db.php";
include "inc/head.php";
if (!isset($_SESSION['carrier_id']))
{
    header("Location: ../carrierLogin.php");
}
if ($_SESSION['status'] == 'Completed')
{
    header("Location: viewSubmitedData.php");
}
if (isset($_GET['id']))
{
    if ($_SESSION['carrier_id'] == $_GET['carrier_id']) {
        $sqlDel = mysqli_query($db, "DELETE FROM `documents` WHERE id = '".$_GET['id']."' AND carrier_id = '".$_SESSION['carrier_id']."'");
        if ($sqlDel) {
            header("Location: mutualconcepts.v7.php");
        }
        else {
            header("Location: mutualconcepts.v7.php");
        }
    }
    else {
        header("Location: mutualconcepts.v7.php");
    }
}
$getSqlS = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM `carrierprofile` WHERE carrier_id = '".$_SESSION['carrier_id']."'"));
$steps = $getSqlS['steps'];
$steps++;
if ($steps != '7')
{
    header("Location: mutualconcepts.v".$steps.".php");
}
?>
    <section class="content">
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>Required Documents</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>Documents Uploaded</h2>
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
                                            <th>Delete</th>
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
                                                <td>
                                                    <a href="mutualconcepts.v7.php?id=<?php echo $rowSqlDoc['id']; ?>&carrier_id=<?php echo $_SESSION['carrier_id']; ?>" class="btn bg-blue waves-button">
                                                        <i class="material-icons">delete</i>
                                                    </a>
                                                </td>
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
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>Upload Required Documents</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>Select File</label>
                                                        <input type="file" name="img" class="form-control" accept="*/*" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <div class="form-line">
                                                        <label>
                                                            Select File Type
                                                        </label>
                                                        <select class="form-control show-tick" name="file_type" required>
                                                            <option value="">Select File Type</option>
                                                            <option>FMCSA Letter of Authority Certificate</option>
                                                            <option>Driver License</option>
                                                            <option>Truck Cab or Registration Card</option>
                                                            <option>Picture of truck showing MC number</option>
                                                            <option>Insurance Certificate</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn bg-blue waves-effect" name="save" value="Upload File">

                                        <a href="mutualconcepts.v6.php?edit" class="btn bg-orange waves-effect">
                                            Go to Previous Page
                                        </a>

                                        <a href="viewSubmitedData.php" class="btn bg-green waves-effect">
                                            View Submitted Data and Make your Profile as Completed
                                        </a>

                                    </form>
                                    <?php
                                    if (isset($_POST['save']))
                                    {

                                        $temp = explode(".", $_FILES["img"]["name"]);
                                        $newfilename = $_SESSION['carrier_id'] . '.' . $_POST['file_type'] . '.' . end($temp);
                                        if ($_FILES["img"]["name"] != null)
                                        {

                                            $move = move_uploaded_file($_FILES["img"]["tmp_name"], "../documents/" . $newfilename);
                                            if ($move)
                                            {
                                                $sqlAdd1 = mysqli_query($db, "INSERT INTO `documents`(`carrier_id`, `file_name`, `file_type`) VALUES ('".$_SESSION['carrier_id']."', '$newfilename','".$_POST['file_type']."')");
                                                if ($sqlAdd1)
                                                {
                                                    header("Location: mutualconcepts.v7.php");
                                                }
                                                else
                                                {
                                                    echo '<div class="alert bg-red alert-dismissible" role="alert" style="margin-top: 20px;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        Take an Error! Try Again.
                                                    </div>';
                                                }
                                            }
                                            else
                                            {
                                                echo '<div class="alert bg-red alert-dismissible" role="alert" style="margin-top: 20px;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        Take Error While Uploading File! Try Again.
                                                    </div>';
                                            }
                                        }
                                        else
                                        {
                                            echo '<div class="alert bg-red alert-dismissible" role="alert" style="margin-top: 20px;">
                                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                        No File Selected! Kindly select file first.
                                                    </div>';
                                        }
                                    }
                                    ?>
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