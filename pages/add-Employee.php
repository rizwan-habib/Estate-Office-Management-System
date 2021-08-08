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
                    <h2 class="title">Add Employee</h2>
                   
                   
                    <form method="POST">
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Employee ID</label>
                                    <input class="input--style-4" type="number" name="emp_id">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Grade</label>
                                    <input class="input--style-4" type="text" name="grade">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Years of Service</label>
                                    <input class="input--style-4" type="number" name="yearsofservice">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">SSN</label>
                                    <input class="input--style-4" type="text" name="ssn">
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Name</label>
                                    <input class="input--style-4" type="text" name="empname">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">House No (Permanent Address)</label>
                                    <input class="input--style-4" type="number" name="h_no">
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Street (Permanent Address)</label>
                                    <input class="input--style-4" type="text" name="street">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">Town (Permanent Address)</label>
                                    <input class="input--style-4" type="text" name="town">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="input-group">
                                    <label class="label">City (Permanent Address)</label>
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
  $empid = $_POST['emp_id'];
  $grade = $_POST['grade'];
  $yearsofservice = $_POST['yearsofservice'];
  $ssn=$_POST['ssn'];
  $name = $_POST['empname'];
  $h_no = $_POST['h_no'];
  $street = $_POST['street'];
  $town = $_POST['town'];
  $city = $_POST['city'];
    // echo $last_renovated;
  $q = "insert into person values($ssn,'$name','$h_no','$street','$town','$city')";
  $query_id = oci_parse($con, $q);
  $r = oci_execute($query_id);

  $q = "insert into Employee1 values($empid,$grade,$yearsofservice,TO_DATE(sysdate, 'DD/MM/YYYY'),$ssn)";
  $query_id1 = oci_parse($con, $q);
  $r = oci_execute($query_id1);
}
?>