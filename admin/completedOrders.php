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
                            Completed Orders
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">Completed Orders</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Order ID</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Pack</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">View</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        $sql = mysqli_query($db, "SELECT * FROM `orders` WHERE status = 'Completed' ORDER by id DESC");
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            $sqlP = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `products` WHERE id = '".$row['p_id']."'"));
                                            $i = $i + 1;
                                            ?>
                                            <tr>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['orderid']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <a href="features.php?id=<?php echo $row['id']; ?>">
                                                        <?php
                                                        $sqlCat = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `categories_pro` WHERE id = '".$sqlP['cat']."'"));
                                                        echo $sqlCat['name'];
                                                        ?>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['price']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['dicount']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['c_price']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $sqlP['pack']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <a href="editStatus.php?orderId=<?php echo $row['orderid'] ?>" class="btn btn-info">
                                                        <?php echo $row['status']; ?>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="invoice.php?view=<?php echo $row['orderid'] ?>" class="btn btn-warning">
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