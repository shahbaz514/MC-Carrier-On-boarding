<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['email']))
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
                            All Invoices
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Payment Pending Orders</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">View</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        $sql = mysqli_query($db, "SELECT * FROM `cus_orders` ORDER by id DESC");
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            ?>
                                            <tr>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['orderid']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php
                                                    echo $row['p_name'];
                                                    ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['p_desc']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['p_price']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['p_discount']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['p_c_price']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <a href="editInvoiceStatus.php?orderId=<?php echo $row['orderid'] ?>" class="btn btn-info">
                                                        <?php echo $row['status']; ?>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="../invoicePending.php?invoice=<?php echo $row['orderid'] ?>&email=<?php echo $row['email'] ?>" class="btn btn-warning">
                                                        <i class="mdi mdi-eye"></i>
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
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>