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
                    <h2 class="title">Add New Apartment</h2>
                   
                   
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Appartment ID</label>
                                    <input class="input--style-4" type="number" name="houseid">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">NO of Rooms</label>
                                    <input class="input--style-4" type="number" name="noOfRooms">
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
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Type</label>
                                    <div class="rs-select2 js-select-simple select--no-search">
                                    <select name="type">
                                        <option disabled="disabled" selected="selected">Choose option</option>
                                        <option>A1</option>
                                        <option>A2</option>
                                        <option>A3</option>
                                        <option>A4</option>
                                        <option>A5</option>
                                        <option>A6</option>
                                        <option>A7</option>
                                    </select>
                                    <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Category</label>
                                    <input class="input--style-4" type="text" name="category">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Building ID</label>
                                    <input class="input--style-4" type="number" name="buildingID">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Building Name</label>
                                    <input class="input--style-4" type="text" name="buildingname">
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
                                    <label class="label">Last Renovated</label>
                                    <input class="input--style-4" type="date" name="lastrenovated">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Floor No</label>
                                    <input class="input--style-4" type="number" name="floorno">
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
  $houseid = $_POST['houseid'];
  $no_of_rooms = $_POST['noOfRooms'];
  $buildingno = $_POST['buildingno'];
  $floorno=$_POST['floorno'];
  $type = $_POST['type'];
  $category = $_POST['category'];
  $buildingid = $_POST['buildingID'];
  $name = $_POST['buildingname'];
  $area = $_POST['area'];
  $last_renovated = $_POST['lastrenovated'];
  $h_no = $_POST['h_no'];
  $street = $_POST['street'];
  $town = $_POST['town'];
  $city = $_POST['city'];
    // echo $last_renovated;
  $q = "select min(entryTime) min from employee1";
  $query_id = oci_parse($con, $q);
  $r = oci_execute($query_id);
  while ($row = oci_fetch_array($query_id, OCI_BOTH + OCI_RETURN_NULLS)) {

    $object = $row["MIN"];
  }
  $q = " select * from employee1 where entrytime='$object'";
  $query_id1 = oci_parse($con, $q);
  $r = oci_execute($query_id1);
  while ($row = oci_fetch_array($query_id1, OCI_BOTH + OCI_RETURN_NULLS)) {

    $object = $row["EMP_ID"];
  }
  $q = "insert into buildings values ($buildingid,'$name','$area',TO_DATE('$last_renovated', 'YYYY/MM/DD'),'$h_no','$street','$town','$city')";
  $query_id2 = oci_parse($con, $q);
  $r = oci_execute($query_id2);
  $q = "insert into ressidential values ($buildingno,'$type','appartment',$buildingid)  ";
  $query_id2 = oci_parse($con, $q);
  $r = oci_execute($query_id2);
  echo $houseid;
  echo $floorno;
  echo $buildingno;
  echo $object;
  $q = "insert into appartments values($houseid,$floorno,$no_of_rooms,$buildingno,$object) ";
  $query_id2 = oci_parse($con, $q);
  $r = oci_execute($query_id2);
  $q = "update employee1 set entrytime=NULL where emp_id = $object";
  $query_id2 = oci_parse($con, $q);
  $r = oci_execute($query_id2);
  
}
?>