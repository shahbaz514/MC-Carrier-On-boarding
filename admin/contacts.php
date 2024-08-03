<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
include 'inc/head.php';
include "inc/sidebar.php";
?>
    <div class="main-panel">
        <div class="content-wrapper">
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title" style="text-align:center;">
                                ALL Contacts
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <p class="card-title">ALL Contacts</p>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive">
                                        <table class="display expandable-table" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Contact#</th>
                                                <th>Query Type</th>
                                                <th>Message</th>
                                                <th>Date</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            $sqlUsers = mysqli_query($db, "SELECT * FROM contacts ORDER BY id DESC");
                                            while ($rowUser = mysqli_fetch_array($sqlUsers))
                                            {
                                                ?>
                                                <tr>
                                                    <td><?php echo $rowUser['name'] ; ?></td>
                                                    <td><?php echo $rowUser['email'] ; ?></td>
                                                    <td><?php echo $rowUser['contact_no'] ; ?></td>
                                                    <td><?php echo $rowUser['query_type'] ; ?></td>
                                                    <td><?php echo $rowUser['msg'] ; ?></td>
                                                    <td><?php echo $rowUser['date'] ; ?></td>
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
            </div>
        </div>
        <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>