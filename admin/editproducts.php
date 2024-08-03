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

$sqlGet = mysqli_fetch_array(mysqli_query($db,"SELECT * FROM `products` WHERE id = '".$_GET['edit']."'"))
?>
    <div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="card-title" style="text-align:center;">
                            Edit Product
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form action="" enctype="multipart/form-data" method="post">
                            <div class="row">
                                <div class="col-sm-6">
                                    <input type="number" value="<?php echo $sqlGet['price']; ?>"  name="price" class="form-control" placeholder="Price" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" value="<?php echo $sqlGet['discount']; ?>"  name="discount" class="form-control" placeholder="Discount (%)" required>
                                </div>
                                <div class="col-sm-6">
                                    <select name="cat" id="" class="form-control" required>
                                        <option value="">Select Category</option>
                                        <?php
                                            $sqlUsers = mysqli_query($db, "SELECT * FROM categories_pro ORDER BY id ASC");
                                            while ($rowUser = mysqli_fetch_array($sqlUsers))
                                            {
                                                echo '<option value="'.$rowUser['id'].'">'.$rowUser['name'].'</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <select name="pack" id="" class="form-control">
                                        <option value="">Select Pack</option>
                                        <option>Silver</option>
                                        <option>Gold</option>
                                        <option>Diamond</option>
                                    </select>
                                </div>
                                <div class="col-sm-6">
                                    <input type="submit" name="save" value="Edit Product" class="btn bg-warning" style="height: 60px; margin-top: 20px;">
                                </div>
                            </div>
                        </form>


                        <?php
                        if (isset($_POST['save']))
                        {
                            $price = mysqli_real_escape_string($db, $_POST['price']);
                            $discount = mysqli_real_escape_string($db, $_POST['discount']);
                            $pack = mysqli_real_escape_string($db, $_POST['pack']);
                            $cat = mysqli_real_escape_string($db, $_POST['cat']);
                            $t_price = $price/100;
                            $t_price = $t_price*$discount;
                            $c_price = $price-$t_price;
                            $update = mysqli_query($db, "UPDATE `products` SET `cat`='$cat',`price`='$price',`pack`='$pack',`discount`='$discount',`c_price`='$c_price' WHERE id = '".$_GET['edit']."'");
                            if ($update)
                            {
                                echo "<script>window.open('products.php', '_self')</script>";

                            }
                        }
                        ?>

                        <style>
                            input, textarea{
                                margin-top: 20px;
                            }
                            select{
                                margin-top: 20px;
                            }
                        </style>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php
include "inc/footer.php";
?>