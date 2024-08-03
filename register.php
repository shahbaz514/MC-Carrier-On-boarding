<?php
include "db/db.php";
include "inc/head.php";
?>
    <section>
        <div class="container-fluid" style="margin-top: 100px!important;">
            <div class="block-header">
                <h2>CARRIER PRE-QUALIFICATION</h2>
            </div>
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12">
                    <div class="card">
                        <div class="header bg-blue">
                            <h2>CARRIER PRE-QUALIFICATION</h2>
                        </div>
                        <div class="body">
                            <div class="row">
                                <div class="col-sm-6">
                                    <form action="register_result.php" method="post" enctype="multipart/form-data">
                                        <label for="email_address">US Docket# (MC):</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="us_docket" class="form-control" placeholder="Enter your US Docket# (MC)">
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-block btn-primary m-t-15 waves-effect" name="save_us_docket" value="Go To Next Step">
                                    </form>
                                </div>
                                <div class="col-sm-6">
                                    <form action="register_result.php" method="post" enctype="multipart/form-data">
                                        <label for="email_address">US Dot Number:</label>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="us_dot_no" placeholder="Enter Your US Dot Number" required>
                                            </div>
                                        </div>
                                        <input type="submit" class="btn btn-block btn-primary m-t-15 waves-effect" name="save_us_dot_no" value="Go To Next Step">
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


<?php
include "inc/footer.php";
?>