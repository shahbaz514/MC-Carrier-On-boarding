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
                            ADD NEW Product
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
                                    <input type="number" name="price" class="form-control" placeholder="Price">
                                </div>
                                <div class="col-sm-6">
                                    <input type="number" name="discount" class="form-control" placeholder="Discount (%)">
                                </div>
                                <div class="col-sm-6">
                                    <select name="cat" id="" class="form-control">
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
                                    <input type="submit" name="save" value="Add New Product" class="btn bg-warning" style="height: 60px; margin-top: 20px;">
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
                            $update = mysqli_query($db, "INSERT INTO `products`(`cat`, `price`, `discount`, `c_price`, `pack`) VALUES ('$cat','$price','$discount','$c_price','$pack')");
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