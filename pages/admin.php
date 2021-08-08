<?php  // creating a database connection 

class User
{
  public $name;
  public $ssn;
  public $emp_id;
  public $grade;
  public $type;
  public $category;
  public $area;
  public $lastrenovated;
  public $h_no;
  public $street;
  public $town;
  public $city;
  public $no_of_rooms;
  public $floor_no;

  function set_Values(
    $name,
    $ssn,
    $emp_id,
    $grade,
    $type,
    $category,
    $area,
    $lastrenovated,
    $h_no,
    $street,
    $town,
    $city,
    $no_of_rooms,
    $floor_no
  ) {
    $this->name = $name;
    $this->ssn = $ssn;
    $this->emp_id = $emp_id;
    $this->grade = $grade;
    $this->type = $type;
    $this->category = $category;
    $this->area = $area;
    $this->lastrenovated = $lastrenovated;
    $this->h_no = $h_no;
    $this->street = $street;
    $this->floor_no = $floor_no;
    $this->town = $town;
    $this->city = $city;
    $this->no_of_rooms = $no_of_rooms;
  }
}
class Companies
{
  public $name;
  public $allotedYears;
  public $yearlyRent;
  public $area;
  public $lastrenovated;
  public $h_no;
  public $street;
  public $town;
  public $city;

  function set_Values(
    $name,
    $allotedYears,
    $yearlyRent,
    $area,
    $lastrenovated,
    $h_no,
    $street,
    $town,
    $city
  ) {
    $this->name = $name;
    $this->area = $area;
    $this->allotedYears = $allotedYears;
    $this->yearlyRent = $yearlyRent;
    $this->lastrenovated = $lastrenovated;
    $this->h_no = $h_no;
    $this->street = $street;
    $this->town = $town;
    $this->city = $city;
  }
}
$user_data = array();
$user_data1 = array();
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


$q = "select person.name,person.ssn,employee1.emp_id,employee1.grade, ressidential.type,ressidential.category,buildings.area,buildings.lastrenovated,buildings.h_no,buildings.street,buildings.town,buildings.city,houses.no_of_rooms from buildings inner join ressidential on ressidential.buildingid=buildings.buildingid inner join houses on houses.buildingno=ressidential.buildingno inner join employee1 on houses.emp_id=employee1.emp_id inner join person on employee1.ssn=person.ssn";
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
    $row['TYPE'],
    $row['CATEGORY'],
    $row['AREA'],
    $row['LASTRENOVATED'],
    $row['H_NO'],
    $row['STREET'],
    $row['TOWN'],
    $row['CITY'],
    $row['NO_OF_ROOMS'],
    "-"
  );
  array_push($user_data, $object);
}
$q = "select person.name,person.ssn,employee1.emp_id,employee1.grade, ressidential.type,ressidential.category,buildings.area,buildings.lastrenovated,buildings.h_no,buildings.street,buildings.town,buildings.city,appartments.floor_no,appartments.no_of_rooms from buildings inner join ressidential on ressidential.buildingid=buildings.buildingid inner join appartments on appartments.buildingno=ressidential.buildingno inner join employee1 on appartments.emp_id=employee1.emp_id inner join person on employee1.ssn=person.ssn";
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
    $row['TYPE'],
    $row['CATEGORY'],
    $row['AREA'],
    $row['LASTRENOVATED'],
    $row['H_NO'],
    $row['STREET'],
    $row['TOWN'],
    $row['CITY'],
    $row['NO_OF_ROOMS'],
    $row['FLOOR_NO']
  );
  array_push($user_data, $object);
}
$q = "select companies.name,commercial.alloted_years,commercial.yearly_rent,buildings.area,buildings.lastRenovated,buildings.h_no,buildings.street,buildings.town,buildings.city from (companies inner join commercial on commercial.company_id=companies.company_id inner join buildings on commercial.buildingID=buildings.buildingID)";
$query_id = oci_parse($con, $q);
$r = oci_execute($query_id);
$iter = 0;
$var = NULL;

while ($row = oci_fetch_array($query_id, OCI_BOTH + OCI_RETURN_NULLS)) {

  $object = new Companies();
  $object->set_Values(
    $row["NAME"],
    $row['AREA'],
    $row['ALLOTED_YEARS'],
    $row['YEARLY_RENT'],
    $row['LASTRENOVATED'],
    $row['H_NO'],
    $row['STREET'],
    $row['TOWN'],
    $row['CITY']
  );
  array_push($user_data1, $object);
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
    <div class="card-body">
      <div class="row">
        <h2 class="card-title col-6">Admin Dashboard</h2>
        <div class="button col-2">
          <a type="button" class="btn btn-primary" href="./add-user.php">
            <svg xmlns="http://www.w3.org/2000/svg" style="color: white;" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
              <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
            </svg> Add Data
          </a>
        </div>
        <div class="button col-2">
          <a class="btn btn-secondary" href="./edit-user.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
              <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z" />
            </svg> Edit User
          </a>
        </div>
        <div class="button col-2">
          <a class="btn btn-success" href="./waiting-list.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
              <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
              <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
            </svg>
            Waiting List
          </a>
        </div>
      </div>
      <hr>
      <div class="row text-center text-primary">
        <h2>User's Residential Data</h2>
      </div>
      <table class="table table-responsive table-striped text-center">
        <thead>
          <tr>
            <th scope="col">Employee ID</th>
            <th scope="col">Name</th>
            <th scope="col">SSN</th>
            <th scope="col">Grade</th>
            <th scope="col">Type</th>
            <th scope="col">Category</th>
            <th scope="col">Area</th>
            <th scope="col">Floor No</th>
            <th scope="col">Last Renovated</th>
            <th scope="col">House No</th>
            <th scope="col">Street</th>
            <th scope="col">Town</th>
            <th scope="col">City</th>
            <th scope="col">No of Rooms</th>
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
            echo "<td>" . $value->type . "</td>";
            echo "<td>" . $value->category . "</td>";
            echo "<td>" . $value->area . "</td>";
            echo "<td>" . $value->floor_no . "</td>";
            echo "<td>" . $value->lastrenovated . "</td>";
            echo "<td>" . $value->h_no . "</td>";
            echo "<td>" . $value->street . "</td>";
            echo "<td>" . $value->town . "</td>";
            echo "<td>" . $value->city . "</td>";
            echo "<td>" . $value->no_of_rooms . "</td>";
            // echo "<td>" . $row['name'] . "</td>";
            // echo "<td>" . $row['Mobile'] . "</td>";
            // echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
          }
          ?>
        </tbody>
      </table>
      <div class="row text-center text-primary">
      <h2>User's Commercial Data</h2>
    </div>
    <table class="table table-responsive table-striped text-center">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">AREA</th>
          <th scope="col">ALLOTED YEARS</th>
          <th scope="col">YEARLY RENT</th>
          <th scope="col">LAST RENOVATED</th>
          <th scope="col">House No</th>
          <th scope="col">Street</th>
          <th scope="col">Town</th>
          <th scope="col">City</th>
        </tr>
      </thead>
      <tbody>
        <?php
        foreach ($user_data1 as $value) {
          echo "<tr>";
          echo "<td>" . $value->name . "</td>";
          echo "<td>" . $value->area . "</td>";
          echo "<td>" . $value->allotedYears . "</td>";
          echo "<td>" . $value->yearlyRent . "</td>";
          echo "<td>" . $value->lastrenovated . "</td>";
          echo "<td>" . $value->h_no . "</td>";
          echo "<td>" . $value->street . "</td>";
          echo "<td>" . $value->town . "</td>";
          echo "<td>" . $value->city . "</td>";
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
  </div>
</body>