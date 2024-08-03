<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}
if (isset($_GET['id']))
{
    $sqlDel = mysqli_query($db, "DELETE FROM categories_pro WHERE id = '".$_GET['id']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('allCategoriesProducts.php', '_self')</script>";
    }
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
                            ALL CATEGORIES
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">ALL CATEGORIES</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Sub Heading</th>
                                            <th>Description</th>
                                            <th>Main Category</th>
                                            <th>Image</th>
                                            <th>Date</th>
                                            <th>Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sqlUsers = mysqli_query($db, "SELECT * FROM categories_pro ORDER BY id ASC");
                                        while ($rowUser = mysqli_fetch_array($sqlUsers))
                                        {
                                            ?>
                                            <tr>
                                                <td><?php echo $rowUser['name'] ; ?></td>
                                                <td><?php echo $rowUser['sub_head'] ; ?></td>
                                                <td><?php echo $rowUser['description'] ; ?></td>
                                                <td><?php echo $rowUser['cat'] ; ?></td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php
                                                    if (!empty($rowUser['img']))
                                                    {
                                                        ?>
                                                        <a href="../images/<?php echo $rowUser['img']; ?>" target="_blank">
                                                            <img src="../images/<?php echo $rowUser['img']; ?>" style="width: 100px;">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td><?php echo $rowUser['date'] ; ?></td>
                                                <td>
                                                    <a class="btn btn-info" href="allCategoriesProducts.php?id=<?php echo $rowUser['id']; ?>">
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