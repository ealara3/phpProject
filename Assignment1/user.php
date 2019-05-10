<?php
/**
 * Created by PhpStorm.
 * User: Eduardo
 * Date: 3/8/2019
 * Time: 4:31 PM
 */

$file = fopen('user.txt','w');

if(isset($_POST['getUser']) && $_POST['getUser'] == 'getUser'){
  $userName = $_POST['users'];


    fwrite($file, $userName);
 #echo $userName;
}
fclose($file);

?>
<!DOCTYPE html>
<html>
<head><p style="color:black;text-align:center"><font size="7">zMusic</font></p>
    <p style="color:black;text-align:center"><font size="5">login</font></p> </head>



    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">

        <p style="color:black;text-align:center">
    <input type="text" name="users" id="users">
    <input type="submit" name="getUser" id="getUser" value="getUser">
        </p>

    </form>
<form action="Lab1.php">
    <p style="color:black;text-align:center">
    <input type="submit" name="go to store" id="gostore" value="gostore">
    </p>
</form>
</html>