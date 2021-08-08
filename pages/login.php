<?php
session_start();
?>

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous" />
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="../css/login-form.css" />
  <title>Building Allocation Database</title>
</head>

<body>
  <div class="wrapper fadeInDown">
    <div id="formContent">

      <!-- Icon -->
      <div class="fadeIn first">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16" id="icon" style="margin-top: 10px;width: 50%;border-radius: 100px;color: #58baed;height: 100px;">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" />
        </svg>
      </div>

      <!-- Login Form -->
      <form method="post">
        <input type="text" id="login" name="login" class="fadeIn second" name="login" placeholder="login" />
        <input type="text" name="password" id="password" class="fadeIn third" name="login" placeholder="password" />
        <input type="submit" class="fadeIn fourth" value="Log In" />
      </form>
    </div>
  </div>
</body>

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
  $username = $_POST['login'];
  $password = $_POST['password'];
  $q = "select * from userrole where username ='$username' and password ='$password'";
  $query_id = oci_parse($con, $q);
  $r = oci_execute($query_id);

  $user_name = NULL;
  $password_ = NULL;
  
  // header("Location: waiting-list.php");
  while ($row = oci_fetch_array($query_id, OCI_BOTH + OCI_RETURN_NULLS)) {
    $user_name = $row["USERNAME"];
    $password_ = $row["PASSWORD"];
  }
  if ($user_name != NULL and $password_ != NULL) {
    
    $_SESSION["username"] = $user_name;
    header("Location: user.php");
  } else {
    $q = "select * from adminrole where username ='$username' and password ='$password'";
    $query_id = oci_parse($con, $q);
    $r = oci_execute($query_id);
  
    $user_name = NULL;
    $password_ = NULL;
    while ($row = oci_fetch_array($query_id, OCI_BOTH + OCI_RETURN_NULLS)) {
      $user_name = $row["USERNAME"];
      $password_ = $row["PASSWORD"];
    }
    if ($user_name != NULL and $password_ != NULL) {
      
      header("Location: admin.php");
    }
  }
  oci_free_statement($query_id);
  oci_close($con);
}
?>
