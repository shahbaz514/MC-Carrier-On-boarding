<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
include 'inc/head.php';

?>
    <section>
        <?php include 'inc/sidebar.php'; ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>ALL CARRIERS</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                ALL CARRIERS
                            </h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Carrier ID</th>
                                        <th>MC#</th>
                                        <th>Dot#</th>
                                        <th>EIN#</th>
                                        <th>Legal Name</th>
                                        <th>Authorized Representative Name</th>
                                        <th>Authorized Representative Title</th>
                                        <th>Authorized Representative Phone</th>
                                        <th>Authorized Representative Email</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Sr.</th>
                                        <th>Carrier ID</th>
                                        <th>MC#</th>
                                        <th>Dot#</th>
                                        <th>EIN#</th>
                                        <th>Legal Name</th>
                                        <th>Authorized Representative Name</th>
                                        <th>Authorized Representative Title</th>
                                        <th>Authorized Representative Phone</th>
                                        <th>Authorized Representative Email</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Delete</th>
                                    </tr>
                                    </tfoot>
                                    <tbody style="text-align: center!important;">

                                    <?php
                                    $i = 0;
                                    $sqlCarriers = mysqli_query($db, "SELECT * FROM carrierprofile ORDER BY id DESC");
                                    while ($rowCarriers = mysqli_fetch_array($sqlCarriers))
                                    {
                                        $i++;
                                        ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td>
                                                <a class="btn bg-blue waves-button" href="viewData.php?view=<?php echo $rowCarriers['mcno']; ?>">
                                                <?php echo $rowCarriers['carrier_id'] ; ?>
                                                </a>
                                            </td>
                                            <td><?php echo $rowCarriers['mcno'] ; ?></td>
                                            <td><?php echo $rowCarriers['dot_no'] ; ?></td>
                                            <td><?php echo $rowCarriers['ein'] ; ?></td>
                                            <td><?php echo $rowCarriers['carriername'] ; ?></td>
                                            <td><?php echo $rowCarriers['cont_name_auth_carier_representative'] ; ?></td>
                                            <td><?php echo $rowCarriers['cont_title_auth_carier_representative'] ; ?></td>
                                            <td><?php echo $rowCarriers['phone'] ; ?></td>
                                            <td><?php echo $rowCarriers['email'] ; ?></td>
                                            <td><?php echo $rowCarriers['date'] ; ?></td>
                                            <td>
                                                <a class="btn bg-orange waves-button" href="status.php?status=<?php echo $rowCarriers['mcno']; ?>">
                                                <?php
                                                if ($rowCarriers['status'] == "")
                                                {
                                                    echo "Not Completed";
                                                }
                                                elseif ($rowCarriers['status'] == "InReview") {
                                                    echo "In Review";
                                                }
                                                else
                                                {
                                                    echo "Completed";
                                                }
                                                ?>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn bg-red waves-button" href="delP.php?delete=<?php echo $rowCarriers['mcno']; ?>">
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