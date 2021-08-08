<?php  // creating a database connection 

class User
{
    public $name;
    public $ssn;
    public $emp_id;
    public $grade;
    public $entryTime;

    function set_Values(
        $name,
        $ssn,
        $emp_id,
        $grade,
        $entryTime
    ) {
        $this->name = $name;
        $this->ssn = $ssn;
        $this->emp_id = $emp_id;
        $this->grade = $grade;
        $this->entryTime = $entryTime;
    }
}
$user_data = array();
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



$q = "select employee1.emp_id,person.name,person.ssn,employee1.grade,employee1.entryTime from employee1 inner join person on person.ssn=employee1.ssn where entryTime is not NULL order by employee1.entrytime";
$query_id = oci_parse($con, $q);
$r = oci_execute($query_id);
$iter = 0;
while ($row = oci_fetch_array($query_id, OCI_BOTH + OCI_RETURN_NULLS)) {

    $object = new User();
    $object->set_Values(
        $row['NAME'],
        $row['SSN'],
        $row['EMP_ID'],
        $row['GRADE'],
        $row['ENTRYTIME']
    );
    array_push($user_data, $object);
}
?>

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="../css/admin.css" />
    <title>Building Allocation Database</title>
</head>

<body>
    <div class="card">


        <hr>
        <div class="row text-center text-primary">
            <h2>Waitng List</h2>
        </div>
        <table class="table table-responsive table-striped text-center">
            <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">SSN</th>
                    <th scope="col">Grade</th>
                    <th scope="col">entryTime</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($user_data as $value) {
                    echo "<tr>";
                    echo "<td>" . $value->emp_id . "</td>";
                    echo "<td>" . $value->name . "</td>";
                    echo "<td>" . $value->ssn . "</td>";
                    echo "<td>" . $value->grade . "</td>";
                    echo "<td>" . $value->entryTime . "</td>";
                    // echo "<td>" . $row['name'] . "</td>";
                    // echo "<td>" . $row['Mobile'] . "</td>";
                    // echo "<td>" . $row['email'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>

    </div>
    </div>
</body>