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

if (isset($_GET['del']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM products WHERE id = '".$_GET['del']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('products.php', '_self')</script>";
    }
}
?>
    <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align:center;">
                            ALL Products
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">ALL Products</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Total Price</th>
                                            <th scope="col">Discount</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Pack</th>
                                            <th scope="col">Edit</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        $sql = mysqli_query($db, "SELECT * FROM `products` ORDER by id ASC");
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            $i = $i + 1;
                                            ?>
                                            <tr>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <a href="features.php?id=<?php echo $row['id']; ?>">
                                                        <?php
                                                        $sqlCat = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `categories_pro` WHERE id = '".$row['cat']."'"));
                                                        echo $sqlCat['name'];
                                                        ?>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['price']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['discount']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['c_price']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['pack']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="editproducts.php?edit=<?php echo $row['id'] ?>" class="btn btn-warning">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="products.php?del=<?php echo $row['id'] ?>" class="btn btn-danger">
                                                        <i class="mdi mdi-delete"></i>
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