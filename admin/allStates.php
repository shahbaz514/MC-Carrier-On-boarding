<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
include 'inc/head.php';

if (isset($_GET['del']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM states WHERE id = '".$_GET['del']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('allStates.php', '_self')</script>";
    }
}
?>
<section>
    <?php include 'inc/sidebar.php'; ?>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2>ALL STATES</h2>
        </div>

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header bg-blue">
                        <h2>
                            ALL STATES

                            <a class="btn btn-success btn-sm" style="float: right;" data-toggle="modal" data-target="#exampleModal">
                                <i class="material-icons">
                                    add
                                </i>
                            </a>
                        </h2>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="header bg-blue">
                                        <h5 class="modal-title">
                                            Add New State
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        </h5>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" method="post" enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-9" style="margin-top: 20px;">
                                                    <input type="text" placeholder="Enter State Name" name="city" class="form-control" required>
                                                </div>
                                                <div class="col-sm-3" style="margin-top: 20px;">
                                                    <input type="submit" name="addCities" value="Add New State" class="btn bg-blue waves-button" >
                                                </div>
                                            </div>
                                        </form>

                                        <?php
                                        if (isset($_POST['addCities']))
                                        {
                                            $city = mysqli_real_escape_string($db, $_POST['city']);

                                            $sqlAdd = mysqli_query($db, "INSERT INTO `states`(`name`) VALUES ('$city')");

                                            if ($sqlAdd)
                                            {
                                                echo "<script>window.open('allStates.php', '_self')</script>";
                                            }
                                        }
                                        ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn bg-red waves-button" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>State</th>
                                    <th>Delete</th>
                                </tr>
                                </thead>
                                <tfoot>
                                <tr>
                                    <th>State</th>
                                    <th>Delete</th>
                                </tr>
                                </tfoot>
                                <tbody style="text-align: center!important;">

                                <?php
                                $sqlCities = mysqli_query($db, "SELECT * FROM states");
                                while ($rowCities = mysqli_fetch_array($sqlCities))
                                {
                                    ?>
                                    <tr>
                                        <td><?php echo $rowCities['name'] ; ?></td>
                                        <td>
                                            <a class="btn btn-danger" href="allStates.php?del=<?php echo $rowCities['id']; ?>">
                                                <i class="material-icons">
                                                    delete
                                                </i>
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
        </div>

    </div>
</section>

<?php
include 'inc/footer.php';
?>
