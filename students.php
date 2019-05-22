<?php

   include("_includes/config.inc");
   include("_includes/dbconnect.inc");
   include("_includes/functions.inc");


   // check logged in
   if (isset($_SESSION['id'])) {

      echo template("templates/partials/header.php");
      echo template("templates/partials/nav.php");

      if(!empty($_POST['checkbox'])) {
      foreach($_POST['checkbox'] as $check) {
      $sql = "delete from student where studentid=$check;";
      $result = mysqli_query($conn,$sql);
      }
      }

      // Build SQL statment that selects a student's modules
      $sql = "select * from student";

      $result = mysqli_query($conn,$sql);

      // prepare page content
      $data['content'] .= "<h2>Students</h2>";
      $data['content'] .= "<form name='delrow' action='' method ='post'><table class='table1'>";
      $data['content'] .= "<tr><th></th><th>Student ID</th><th>Date of Birth</th><th>First Name</th><th>Last Name</th><th>Adress</th><th>Town</th><th>County</th><th>Country</th><th>PostCode</th></tr>";
      // Display the modules within the html table
      while($row = mysqli_fetch_array($result)) {
         $data['content'] .= "<tr><td><input type='checkbox' name='checkbox[]' value='$row[studentid]'></td><td> $row[studentid] </td><td> $row[dob] </td>";
         $data['content'] .= "<td> $row[firstname] </td><td> $row[lastname] </td><td> $row[house] </td><td> $row[town] </td><td> $row[county] </td><td> $row[country] </td><td> $row[postcode] </td></tr>";
      }
      $data['content'] .= "</table>";

      $data['content'] .= "<input type='submit' value='Delete' name='delete'/></form>";

      // render the template
      echo template("templates/default.php", $data);

   } else {
      header("Location: index.php");
   }

   echo template("templates/partials/footer.php");

?>
