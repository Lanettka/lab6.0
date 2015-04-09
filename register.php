<?
include 'mysql.inc';
echo "<center>";
if (! mysql_connect(mysql_host,mysql_user,mysql_password)){
echo "Not connection with MySQL server";
exit;
};
if (!mysql_select_db("portal")){
echo "Unable to connect to database";
exit;
}
$nic=$_POST['nik'];
$password=$_POST['password'];
$sql="SELECT password from users WHERE nik='$nik'";
$result=mysql_query($sql);

if (!$result){
echo "Registration Error - mistyped nickname or password<br>";
echo "<a href='register.html'>Try again...</a>";
exit;
}
if (mysql_num_rows($result)==0){
echo "Registration Error - mistyped nickname or password<br>";
echo "<a href='register.html'>Try again...</a>";
exit;
}
else {
$res=mysql_fetch_array($result);
if ($res['password']==$password){
session_start();
$_SESSION[' nik ']=$nik;
$_SESSION[' password']=$password;
echo '<script>';
echo 'parent.leftFrame.regist.href="exit.php";';
echo 'parent.leftFrame.regist.innerText="Вихід";';
echo '</script>';
    echo 'Thank you for authorization';
} 
else {
echo "Authorization Error - incorrectly entered nickname or password<br>";
echo "<a href='register.html'>Try again...</a>";
exit;
}
}
echo "</center>";
?>