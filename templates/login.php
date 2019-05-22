
<?php echo $message; ?>
</br>
<form name="frmLogin" action="authenticate.php" method="post">
  <table align="center" class="table2">

    <tr>
      <td>Student ID:</td>
      <td>
   <input name="txtid" type="text" />
 </td>
</tr>

   <tr>
     <td>Password:</td>
     <td>
   <input name="txtpwd" type="password" />
 </td>
</tr>

   <tr>
     <td></td>
     <td>
   <input type="submit" value="Login" name="btnlogin" />
 </td>
 </tr>
</table>
</form>
