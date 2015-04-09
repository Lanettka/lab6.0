<?
include'mysql.inc';
echo "<center>";
if (! mysql_connect(mysql_host,mysql_user,mysql_password)){
echo
 "No connection with server MySQL";
exit;
};
if (!mysql_select_db("portal")){
echo
 "Unable to connect to database";
exit;
}
$nik=$_POST['nik'];
if($nik==''){
echo
 "Registration Error - do not enter an alias<br>";
echo"<ahref='adduser.html'>Try again...</a>";
exit;}
$sql="SELECT * from users WHERE nik='$nik'";
$result=mysql_query($sql);
if (mysql_num_rows($result)>0){
echo "Registration Error - nickname is already registered<br>";
echo "<a href='adduser.html'>Try again...</a>";
exit;
}
$password=$_POST['password'];
if ($password==''){
echo"Registration Error - no password entered<br>";
echo"<ahref='adduser.html'>Try again...</a>";
exit;
}
if($password!=$_POST['confirm_password']){
echo"Error Reyestratsiyi- passwords do not match<br>";
echo"<ahref='adduser.html'>Try again...</a>";
exit;
}
$name =$_POST['name'];
if($name==''){echo"Registration Error - do not enter a name<br>";
echo"<ahref='adduser.html'>Try again...</a>";
exit;
}
$surname =$_POST['surname'];if ($surname==''){
echo"Registration Error - do not put name<br>";
echo"<ahref='adduser.html'>Try again...</a>";
exit;
}

$mail =$_POST['mail'];
if (!strpos($mail,'@')){
echo"Registration Error - incorrect e-mail<br>";
echo"<ahref='adduser.html'>Try again...</a>";
exit;
}
$country =$_POST['country'];
$city =$_POST['city'];
if(($country=='') || ($city=='')){
echo"Registration error - not entered address<br>";
echo"<ahref='adduser.html'>Try again...</a>";
exit;
}
$address=$_POST['address'];

if (isset($nik)){
$sql="INSERT into users (nik, password, name, surname, mail, country,
city, address) VALUES ('$nik', '$password' , '$name', '$surname', '$mail', '$country',
'$city', '$address')";

mysql_query($sql);
session_start();
$_SESSION['nik']=$nik;
$_SESSION['password']=$password;
echo "User $nik registered!";
echo '<script>';
echo 'parent.leftFrame.regist.href="exit.php";';
echo 'parent.leftFrame.regist.innerText="Вихід";';
echo '</script>';
}
echo "</center>";
?>
