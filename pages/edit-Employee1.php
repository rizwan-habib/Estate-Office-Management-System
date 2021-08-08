<?php
session_start();
?>

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

    $ssn = $_SESSION["ssn"];
    $empid=   $_SESSION["empid"];
    $grade = $_POST['grade'];
    $yearsofservice = $_POST['yearsofservice'];
    // $ssn=$_POST['ssn'];
    $name = $_POST['empname'];
    $h_no = $_POST['h_no'];
    $street = $_POST['street'];
    $town = $_POST['town'];
    $city = $_POST['city'];
    $q = "update person set name='$name',h_no='$h_no',street='$street',town='$town',city='$city' where ssn=$ssn";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
  
    $q = "update employee1 set grade=$grade,years_of_service=$yearsofservice,ssn=$ssn where emp_id = $empid";
    $query_id1 = oci_parse($con, $q);
    $r = oci_execute($query_id1);
    header("Location: admin.php");
  }
?>