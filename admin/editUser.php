<?php
session_start();
session_abort();
include "../db/db.php";
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
}

if ($_SESSION['role'] != 'Admin')
{
    header("Location: allUsers.php");
}
include 'inc/head.php';


$sqlUG = mysqli_query($db, "SELECT * FROM users WHERE id = '".$_GET['id']."'");
$count = mysqli_num_rows($sqlUG);
if ($count>0)
{
    $rowUG = mysqli_fetch_array($sqlUG);
}
?>
    <section>
        <?php include 'inc/sidebar.php'; ?>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>EDIT USER</h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>
                                EDIT USER
                            </h2>
                        </div>
                        <div class="body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="email" name="email" value="<?php echo $rowUG['email']; ?>" placeholder="Email" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <input type="password" name="password" placeholder="Password" class="form-control" required>
                        </div>
                        <div class="col-sm-6">
                            <select class="form-control" name="role" required>
                                <option value="">---Select Role---</option>
                                <option>Admin</option>
                                <option>Manager</option>
                                <option>Dispatch</option>
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <center>
                                <input style="margin-top: 20px;" type="submit" name="editUser" value="Edit Profile" class="btn bg-blue waves-button btn-block">
                            </center>
                        </div>
                    </div>
                </form>

                <?php
                if (isset($_POST['editUser']))
                {
                    $password = mysqli_real_escape_string($db, $_POST['password']);
                    $role = mysqli_real_escape_string($db, $_POST['role']);
                    $email = mysqli_real_escape_string($db, $_POST['email']);
                    $sqlUp = mysqli_query($db, "UPDATE users SET email = '$email', password = '$password', role = '$role' WHERE id = '".$_GET['id']."'");

                    if ($sqlUp)
                    {
                        echo "<script>window.open('allUsers.php','_self')</script>";
                    }

                }
                ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

<?php
include 'inc/footer.php';
?>