<?php include '../header.php';

include '../../connect.php';

// if (isset($_GET['delete'])) {
//     $id = $_GET['delete'];
//     mysqli_query($conn, "DELETE FROM inventory WHERE itemID=$id");
//     unset($_GET['delete']);

//     $_SESSION['message'] = "Record has been Deleted";
//     $_SESSION['msg_type'] = "danger";
// }


// $result = mysqli_query($conn, "SELECT * FROM inventory")
//     or die($mysqli->error);


//pre_r($result);
//pre_r($result->fetch_assoc());

function pre_r($array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

?>
<script src="sweetalert2.all.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

<!-- BEGIN: Content-->
<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper">
        <div class="content-body">
            <!-- Basic Horizontal form layout section start -->
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-9 col-12 mb-2">
                        <div class="row breadcrumbs-top">
                            <div class="col-12">
                                <h2 class="content-header-title float-left mb-0">View Delivery Order</h2>
                                <div class="breadcrumb-wrapper">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="index.html">Order</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="#">Delivery Order</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-body">
                    <!-- Basic table -->
                    <section id="basic-datatable">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap4 no-footer">
                                        <div class="card-header     border-bottom p-1" bis_skin_checked="1">
                                            <div class="head-label" bis_skin_checked="1">
                                                <h4 class="mb-0">Delivery Order List</h4>
                                            </div>

                                        </div>
                                        <br>
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Delivery Order Number
                                                    </th>
                                                    <th>
                                                        Delivery Order Date
                                                    </th>
                                                    <th>
                                                        Supplier
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (isset($_GET['ID'])) {
                                                    $ID = $_GET['ID'];

                                                    $sql = "SELECT * FROM delivery_order WHERE ID=" . $ID;
                                                    $result = $conn->query($sql);

                                                    while ($row = $result->fetch_assoc()) {
                                                        $ID          = $row['ID'];
                                                        $do_date     = date("d/m/Y", strtotime($row["do_date"]));
                                                        $supplier    = $row['supplier'];

                                                        if ($row["status"] == 1) {
                                                            $shake = "In Process";
                                                        } elseif ($row["status"] == 2) {
                                                            $shake = "Completed";
                                                            # code...
                                                        }
                                                    }
                                                    echo "
                                    <tr>
                                    <td>" . $ID . "</td>
                                    <td>" . $do_date . "</td>
                                    <td>" . $supplier . "</td>
                                    <td>" . $shake . "</td>
                                    
                                    
                                    </tr>";
                                                    // echo $sql;

                                                }
                                                echo "</table>";
                                                ?>
                                            </tbody>
                                        </table>

                                        <div class="container-fluid">
                                            <div class="card shadow mb-4">
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <?php
                                                        $i = 1;

                                                        if (isset($_GET['ID'])) {

                                                            $ID = (int) $_GET['ID'];

                                                            $sql = "SELECT * FROM delivery_order INNER JOIN delivery_order_detail 
                        ON delivery_order_detail.DO_ID = delivery_order.ID 
                        WHERE delivery_order_detail.DO_ID=" . $ID;

                                                            echo "
                <table class='table table-bordered'>
        <form action='do_receive.php?ID=" . $ID . "' method='POST'>
         <thead>
          <tr>
           <th width = 1%>
            #
           </th>
           <th width=5%>
           Tick Box
           </th>
           <th width=30%>
           Product Name
           </th>
           <th width=15%>
           Ordered Quantity
           </th>
           <th width=15%>
           Received Quantity
           </th>
           <th>
            status
           </th>
          </tr>
         </thead>
         <tbody>
                ";

                                                            $result = $conn->query($sql);
                                                            while ($row = $result->fetch_assoc()) {
                                                                $product     = $row['product'];
                                                                $quantity    = $row['quantity'];

                                                                //to display the item status
                                                                for ($k = 1; $k < 2; $k++) {

                                                                    if ($row["item_status"] >= $k) {

                                                                        $status = "Complete";
                                                                        # code...
                                                                    } else {
                                                                        $status = "Incomplete";
                                                                    }

                                                                    # code...
                                                                }
                                                                // end

                                                                //start of display the drop down choice

                                                                // if ($row["item_status"] == 0) {
                                                                //     $sout = "Pending";
                                                                // } elseif ($row["item_status"] == 1) {
                                                                //     $sout = "Good";
                                                                // } elseif ($row["item_status"] == 2) {
                                                                //     $sout = "Damaged";
                                                                //     # code...
                                                                // } elseif ($row["item_status"] == 3) {
                                                                //     $sout = "Missing";
                                                                //     # code...
                                                                // }

                                                                // //for checking receiving quantity
                                                                // if ($quantity == $received_qty) {
                                                                //     mysqli_query($conn, "UPDATE delivery_order_detail SET item_status = '1' ")
                                                                //         or die($mysqli->error);
                                                                // } else  if ($quantity > $received_qty) {
                                                                //     mysqli_query($conn, "UPDATE delivery_order_detail SET received_qty = $received_qty ")
                                                                //         or die($mysqli->error);
                                                                // } else {
                                                                //     echo "<script>alert('Received quantity cannot be larger than ordered quantity');</script>";
                                                                // }

                                                                //for Check box
                                                                if ($row["item_status"] == 0) {
                                                                    $shake1 = "<td><input type='checkbox'  name='received[]' value='" . $product . "'/>";
                                                                    # code...
                                                                } else {
                                                                    $shake1 = "<td><input type='checkbox'  name='received[]' value='" . $product . "' disabled/>";
                                                                }
                                                                // End for Check box

                                                                // disabling the drop down and enable it
                                                                for ($m = 1; $m < 2; $m++) {
                                                                    if ($row["item_status"] >= $m) {
                                                                        $sout = "<td><input type='quantity' id='received_qty' class='form-control' name='received_qty[]' placeholder='0' />
                       </td>";
                                                                    } else {
                                                                        $sout = "<td><input type='quantity' id='received_qty' class='form-control' name='received_qty[]' placeholder='0' />
                        </td>";
                                                                    }

                                                                    # code...

                                                                    // if ($row["item_status"] >= $m) {

                                                                    //    $sout= "<td disabled><select class='form-control' name='item_status[]' disabled>
                                                                    //             <option>".$sout."</option>
                                                                    //             <option value='1'>Good</option>
                                                                    //             <option value='2'>Damaged</option>
                                                                    //             <option value='3'>Missing</option>
                                                                    //             <option value='4'>Wrong Amount</option>
                                                                    //             </select></td>";
                                                                    //     # code...
                                                                    // }
                                                                    // else {
                                                                    //     $sout="<td><select class='form-control' name='item_status[]'>

                                                                    //             <option> </option>
                                                                    //             <option value='1'>Good</option>
                                                                    //             <option value='2'>Damaged</option>
                                                                    //             <option value='3'>Missing</option>
                                                                    //             <option value='4'>Wrong Amount</option>
                                                                    //             </select></td>";
                                                                    // }
                                                                    // # code...

                                                                }

                                                                //end of it 


                                                                echo "
                <tr>
                <td>    " . $i++ . "            </td> 
                        " . $shake1 . "
                <td>    " . $product . "        </td>
                <td>    " . $quantity . "       </td>
                        " . $sout . "
                <td>    " . $status . "</td>";
                                                                echo "<input type='hidden' name='item_status[]' value='" . $row["item_status"] . "' >";
                                                                echo "<input type='hidden' name='product[]' value='" . $product . "' >";
                                                                echo "<input type='hidden' name='quantity[]' value='" . $quantity . "' >";

                                                                "</tr>";
                                                            }
                                                            // echo "$sql";


                                                            echo "</table>";
                                                        }
                                                        ?>
                                                        <br>
                                                        <a href="do_list.php"><button class="btn btn-primary mr-1">Back</button></a>

                                                        <button type="submit" style="float:right;" class="btn btn-primary" name="received_btn">Received Item</button>

                                                        </tbody>
                                                        </form>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="d-flex justify-content-between mx-0 row">

                                    <div class="col-sm-12 col-md-6">


                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate">
                                            <ul class="pagination">

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

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

<script>
    $(document).ready(function() {
        $('#do_table').DataTable({

            "bInfo": false,
            "order": [],
            "columnDefs": [{
                "targets": [0, 2, 3, 4, 5],
                "orderable": false,
            }, ],
        });

    });


    // $stat=document.getElementById("button").innerText;
    //     if ($stat=="Completed") {
    //         document.getElementById("received").style.display="none";
    //     }
</script>