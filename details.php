<?php

include("_includes/config.inc");
include("_includes/dbconnect.inc");
include("_includes/functions.inc");


// check logged in
if (isset($_SESSION['id'])) {

   echo template("templates/partials/header.php");
   echo template("templates/partials/nav.php");

   // if the form has been submitted
   if (isset($_POST['submit'])) {

      // build an sql statment to update the student details
      $sql = "update student set firstname ='" . $_POST['txtfirstname'] . "',";
      $sql .= "lastname ='" . $_POST['txtlastname']  . "',";
      $sql .= "house ='" . $_POST['txthouse']  . "',";
      $sql .= "town ='" . $_POST['txttown']  . "',";
      $sql .= "county ='" . $_POST['txtcounty']  . "',";
      $sql .= "country ='" . $_POST['txtcountry']  . "',";
      $sql .= "postcode ='" . $_POST['txtpostcode']  . "' ";
      $sql .= "where studentid = '" . $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);

      $data['content'] = "<p>Your details have been updated</p>";

   }
   else {
      // Build a SQL statment to return the student record with the id that
      // matches that of the session variable.
      $sql = "select * from student where studentid='". $_SESSION['id'] . "';";
      $result = mysqli_query($conn,$sql);
      $row = mysqli_fetch_array($result);

      // using <<<EOD notation to allow building of a multi-line string
      // see http://stackoverflow.com/questions/6924193/what-is-the-use-of-eod-in-php for info
      // also http://stackoverflow.com/questions/8280360/formatting-an-array-value-inside-a-heredoc
      $data['content'] = <<<EOD

   <h2>My Details</h2>
   <form name="frmdetails" action="" method="post">
   <table class='table2'>

<tr>
   <td>First Name :</td>
   <td>
   <input name="txtfirstname" type="text" value="{$row['firstname']}" />
   </td>
</tr>

<tr>
   <td>Surname :</td>
   <td>
   <input name="txtlastname" type="text"  value="{$row['lastname']}" />
   </td>
</tr>

<tr>
   <td>Number and Street :</td>
   <td>
   <input name="txthouse" type="text"  value="{$row['house']}" />
   </td>
</tr>

<tr>
   <td>Town :</td>
   <td>
   <input name="txttown" type="text"  value="{$row['town']}" />
   </td>
</tr>

<tr>
   <td>County :</td>
   <td>
   <input name="txtcounty" type="text"  value="{$row['county']}" />
   </td>
</tr>

<tr>
   <td>Country :</td>
   <td>
   <input name="txtcountry" type="text"  value="{$row['country']}" />
   </td>
</tr>

<tr>
   <td>Postcode :</td>
   <td>
   <input name="txtpostcode" type="text"  value="{$row['postcode']}" />
   </td>
   </tr

<tr>
<td>
</td>
<td>
 <input type="submit" value="Save" name="submit"/>
</td>
</tr>
   </table>
   </form>

EOD;

   }

   // render the template
   echo template("templates/default.php", $data);

} else {
   header("Location: index.php");
}

echo template("templates/partials/footer.php");

?>
