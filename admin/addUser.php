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
                                ADD NEW USER
                            </h3><br>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <form action="addUser.php" enctype="multipart/form-data" method="post">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="text" name="name" placeholder="Name" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" name="username" placeholder="User Name" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" name="password" placeholder="Password" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="email" name="email" placeholder="Email" class="form-control" required>
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" name="addUser" value="Add New User" class="btn bg-warning" style="height: 60px; margin-top: 20px;">
                                    </div>
                                </div>
                            </form>


                            <?php
                            if (isset($_POST['addUser']))
                            {
                                $name = mysqli_real_escape_string($db, $_POST['name']);
                                $username = mysqli_real_escape_string($db, $_POST['username']);
                                $password = mysqli_real_escape_string($db, $_POST['password']);
                                $email = mysqli_real_escape_string($db, $_POST['email']);
                                $role = "Admin";
                                $sqlSelectU = mysqli_query($db, "SELECT * FROM users WHERE username = '$username'");
                                $count = mysqli_num_rows($sqlSelectU);
                                if ($count == 0) {
                                    $sqlAddUser = mysqli_query($db, "INSERT INTO `users`(`name`, `email`, `username`, `password`, `role`, `status`) 
                                                                    VALUES ('$name', '$email', '$username', '$password', '$role','Active')");
                                    if ($sqlAddUser) {
                                        echo "<script>window.open('allUsers.php', '_self')</script>";
                                    } else {
                                        echo "<script>alert('Take An Error! Try Again.')</script>";
                                        echo "<script>window.open('allUsers.php', '_self')</script>";
                                    }
                                }
                                else
                                {
                                    echo "<script>alert('Username Already Exit! Try Another One.')</script>";
                                    echo "<script>window.open('allUsers.php', '_self')</script>";
                                }
                            }
                            ?>

                            <style>
                                input{
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