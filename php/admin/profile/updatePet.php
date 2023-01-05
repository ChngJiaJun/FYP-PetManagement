<?php

include '../../connect.php';

if (isset($_POST['update'])) {
    $petID = $_GET['edit'];
    $petName = $_POST['petName'];
    $petType = $_POST['petType'];
    $gender = $_POST['gender'];
    $species = $_POST['species'];
    $birthdate = $_POST['birthdate'];
    $color = $_POST['color'];
    $weight = $_POST['weight'];
    $petID = $_GET['edit'];
    $status = $_POST['status'];
    $remark = $_POST['remark'];
    mysqli_query($conn, "UPDATE pet SET petName='$petName',petType='$petType', gender='$gender', species = '$species', birthdate = '$birthdate', color='$color', weight = '$weight', status='$status', remark='$remark' WHERE petID = '$petID' ")
        or die($mysqli->error);

    echo '<script>alert("Record has been Updated")</script>';
    echo "<script>window.location.assign('viewPet.php');</script>";


    header('location:viewPet.php');
}

if (isset($_GET['edit'])) {
    $petID = $_GET['edit'];
    $result = mysqli_query($conn, "SELECT * FROM pet WHERE petID=$petID");
    unset($_GET['edit']);
    $row = $result->fetch_array();
    $petID = $row['petID'];
    $petName = $row['petName'];
    $gender = $row['gender'];
    $species = $row['species'];
    $birthdate = $row['birthdate'];
    $color = $row['color'];
    $weight = $row['weight'];
    $owner = $row['owner'];
    $image = $row['image'];


    $_SESSION['message'] = "Record has been Saved";
    $_SESSION['msg_type'] = "success";
}
$result = mysqli_query($conn, "SELECT * FROM  customer")
    or die($mysqli->error);

include '../header.php';
?>
<!-- BEGIN: Content-->
<div class="app-content content " bis_skin_checked="1">
    <div class="content-overlay" bis_skin_checked="1"></div>
    <div class="header-navbar-shadow" bis_skin_checked="1"></div>
    <div class="content-wrapper" bis_skin_checked="1">
        <div class="content-body" bis_skin_checked="1">
            <!-- Basic Horizontal form layout section start -->
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">Pet Details</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Pet Profile</a>
                                        </li>
                                        <li class="breadcrumb-item active">Details
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="content-body">
                    <!-- app e-commerce details start -->
                    <section class="app-ecommerce-details">
                        <div class="card">
                            <!-- Product Details starts -->
                            <div class="card-body">
                                <form class="form form-horizontal" method="POST">
                                    <div class="row my-2">
                                        <div class="col-12 col-md-4 d-flex align-items-center justify-content-center mb-2 mb-md-0">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img src="../../../app-assets/img/pet/<?php echo $image ?>" class="img-fluid petpic" alt="pet image">
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-7">

                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-9">
                                                            <h3><?php echo $petName ?></h3>
                                                        </div>



                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="petID">Pet ID</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" readonly id="petID" class="form-control" name="petID" value="<?php echo $petID ?>" />
                                                        </div>
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="gender">Gender</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="gender" name="gender">
                                                                <option value="Male">Male</option>
                                                                <option value="Female">Female</option>
                                                            </select>
                                                        </div>


                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="petName">Pet Name</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="petName" class="form-control" name="petName" value="<?php echo $petName ?>" />
                                                        </div>

                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="species">Species</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="species" class="form-control" name="species" value="<?php echo $species ?>" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="color">Color</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="color" class="form-control" name="color" value="<?php echo $color ?>" />
                                                        </div>
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="weight">Weight(KG)</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input type="text" id="weight" class="form-control" name="weight" value="<?php echo $weight ?>" />
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="petType">Pet Type</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <select id="petType" name="petType">
                                                                <option value="Dog">Dog</option>
                                                                <option value="Cat">Cat</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="birthdate">Birth Date</label>
                                                        </div>
                                                        <div class="col-sm-3">
                                                            <input name="birthdate" id="datefield" type='date' min='1899-01-01' value="<?php echo $birthdate ?>" />
                                                        </div>

                                                       

                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                    <div class="col-sm-2 col-form-label">
                                                            <label for="status">Owner</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <select id="owner" name="owner" class="custom-select" id="customSelect">
                                                                <?php while ($row = $result->fetch_assoc()) : ?>
                                                                    <option value=<?php echo $row['customerID'] ?>>
                                                                        [ <?php echo $row['customerID'] ?> ] <?php echo $row['customerName'] ?></option>
                                                                <?php endwhile; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="status">Status</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <select name="status" class="custom-select" id="customSelect">
                                                                <option selected="">...</option>
                                                                <option value="Healthy">Healthy</option>
                                                                <option value="Slightly Injured">Slightly Injured</option>
                                                                <option value="Injured">Seriously Injured</option>
                                                                <option value="Slightly Sick">Slightly Sick</option>
                                                                <option value="Seriously Sick">Seriously Sick</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-sm-2 col-form-label">
                                                            <label for="remark">Remark</label>
                                                        </div>
                                                        <div class="col-sm-9">
                                                            <textarea name="remark" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-8 offset-sm-3">
                                                    <div class="form-group">
                                                    </div>
                                                </div>
                                                <div class="col-sm-8 offset-sm-7">
                                                    <button name="update" type="submit" class="btn btn-primary mr-1">Update</button>
                                                    <a href="viewPet.php"><button name="back" type="button" class="btn btn-primary mr-1">Back</button></a>
                                                </div>
                                            </div>
                                </form>

                            </div>
                        </div>

                    </section>
                </div>
            </div>
            <!-- Product Details ends -->

        </div>
        </section>
        <!-- app e-commerce details end -->

    </div>
</div>

</div>
</div>
</div>
<!-- END: Content-->

<div class="sidenav-overlay"></div>
<div class="drag-target"></div>

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light">

</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->


<!-- BEGIN: Vendor JS-->
<script src="../app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<!-- END: Page Vendor JS-->

</html>