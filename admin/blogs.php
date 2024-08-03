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
    $sqlDel = mysqli_query($db, "DELETE FROM blog WHERE id = '".$_GET['del']."'");
    if ($sqlDel)
    {
        echo "<script>window.open('blogs.php', '_self')</script>";
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
                            ALL BLOGS
                        </h3><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <p class="card-title">ALL BLOGS</p>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="display expandable-table" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th scope="col">Sr. No.</th>
                                            <th scope="col">Title</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Description</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Username</th>
                                            <th scope="col">Delete</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $i = 0;
                                        $sql = mysqli_query($db, "SELECT * FROM `blog` ORDER by id ASC");
                                        while ($row = mysqli_fetch_array($sql))
                                        {
                                            $i = $i + 1;
                                            ?>
                                            <tr>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $i; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <a class="btn btn-sm btn-info" href="../blog-single.php?id=<?php echo $row['id']; ?>" target="_blank">
                                                        <?php echo $row['title']; ?>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <a href="../blog.php?cat=<?php echo $row['cat']; ?>" target="_blank">
                                                        <?php
                                                        $sqlCat = mysqli_fetch_array(mysqli_query($db, "SELECT * FROM categories WHERE id = '".$row['cat']."'"));
                                                        echo $sqlCat['name'];
                                                        ?>
                                                    </a>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_7">
                                                    <?php echo substr($row['description'], 0, 200); ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php
                                                    if (!empty($row['img']))
                                                    {
                                                        ?>
                                                        <a href="../images/<?php echo $row['img']; ?>" target="_blank">
                                                            <img src="../images/<?php echo $row['img']; ?>" style="width: 100px;">
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 color_text_6">
                                                    <?php echo $row['username']; ?>
                                                </td>
                                                <td class="f_s_12 f_w_400 text-end">
                                                    <a href="blogs.php?del=<?php echo $row['id'] ?>" class="btn btn-danger">
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