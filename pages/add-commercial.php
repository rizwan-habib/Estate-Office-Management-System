<!DOCTYPE html>
<html lang="en">

<head>

    <link href="../css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-gra-02 p-t-130 p-b-100 font-poppins">
        <div class="wrapper wrapper--w680">
            <div class="card card-4">
                <div class="card-body">
                    <h2 class="title">Add Commercial Building</h2>
                   
                   
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Building Name</label>
                                    <input class="input--style-4" type="text" name="building_name">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Alloted Years</label>
                                    <input class="input--style-4" type="number" name="alloted_years">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Building Number</label>
                                    <input class="input--style-4" type="number" name="buildingno">
                                </div>
                            </div>
                            
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Building ID</label>
                                    <input class="input--style-4" type="number" name="buildingid">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Area</label>
                                    <input class="input--style-4" type="text" name="area">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Yearly Rent</label>
                                    <input class="input--style-4" type="number" name="yearlyrent">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Last Renovated</label>
                                    <input class="input--style-4" type="date"  name="lastrenovated" placeholder="yyyy-mm-dd" value="2018-07-22">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">House No</label>
                                    <input class="input--style-4" type="number" name="h_no">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Street</label>
                                    <input class="input--style-4" type="text" name="street">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Town</label>
                                    <input class="input--style-4" type="text" name="town">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">City</label>
                                    <input class="input--style-4" type="text" name="city">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Company ID</label>
                                    <input class="input--style-4" type="number" name="companyid">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Company Name</label>
                                    <input class="input--style-4" type="text" name="companyname">
                                </div>
                            </div>
                        </div>

                        <div class="p-t-15">
                            <button class="btn btn--radius-2 btn--blue" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>

<?php
$db_sid =
  "(DESCRIPTION =
    (ADDRESS = (PROTOCOL = TCP)(HOST = DESKTOP-G9AMCKG)(PORT = 1521))
    (CONNECT_DATA =
      (SERVER = DEDICATED)
      (SERVICE_NAME = XE)
    )
  )";            // Your oracle SID, can be found in tnsnames.ora  ((oraclebase)\app\Your_username\product\11.2.0\dbhome_1\NETWORK\ADMIN) 

$db_user = "system";   // Oracle username e.g "scott"
$db_pass = "Janjua123";    // Password for user e.g "1234"
$con = oci_connect($db_user, $db_pass, $db_sid);
if ($con) {
  echo "Oracle Connection Successful.";
} else {
  die('Could not connect to Oracle: ');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $buildingno = $_POST['buildingno'];
  $alloted_years = $_POST['alloted_years'];
  $buildingid = $_POST['buildingid'];
  $companyid = $_POST['companyid'];
  $name = $_POST['building_name'];
  $area = $_POST['area'];
  $last_renovated = $_POST['lastrenovated'];
  $h_no = $_POST['h_no'];
  $street = $_POST['street'];
  $town = $_POST['town'];
  $city = $_POST['city'];
  $cname = $_POST['companyname'];
  $rent = $_POST['yearlyrent'];
    // echo $last_renovated;
  $q = "insert into buildings values ($buildingid,'$name','$area',TO_DATE('$last_renovated', 'YYYY/MM/DD'),'$h_no','$street','$town','$city')";
  $query_id = oci_parse($con, $q);
  $r = oci_execute($query_id);
  $q = "insert into companies values ($companyid,'$cname')";
  $query_id1 = oci_parse($con, $q);
  $r = oci_execute($query_id1);
  $q = "insert into commercial values($buildingno,$alloted_years,$rent,$buildingid,$companyid)  ";
  $query_id2 = oci_parse($con, $q);
  $r = oci_execute($query_id2);
  
}
?>
<!-- end document-->