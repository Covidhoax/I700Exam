<?php
require_once '../db.php';
if(!$user->is_loggedin())
{
 $user->redirect('../index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html>
 <head>
<meta charset ="UTF-8">
 <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=no"/>
 <title>Upload Video</title>
 <link href="../../css/bootstrap.css" rel="stylesheet" type="text/css" media="screen">
 <?php require ('../db.php'); ?>
<link rel="stylesheet" href="../style.css" type="text/css" /> 
 <script src="../../js/jquery.js" type="text/javascript"></script>
 <script src="../../js/bootstrap.js" type="text/javascript"></script>
</head>
<body>
<br>
 <div class="row-fluid">
 <div class="span12">
 <div class="container fluid">
 <div class="row">
 <div class="col-md-2"></div>
 <div class="col-md-8">
 <div class ="panel panel-primary">
 <div class = "panel panel-heading">Upload Video</div>
 <div class = "panel panel-body">
 <form method="post" enctype="multipart/form-data" >
 <?php
 if(isset($_FILES['file'])){
 $name = $_FILES['file']['name'];
 $extension = explode('.', $name);
 $extension = end($extension);
 $type = $_FILES['file']['type'];
 $size = $_FILES['file']['size'] /1024/1024;
 $random_name = rand();
 $tmp = $_FILES['file']['tmp_name'];
 $newname = $random_name.'.'.$extension;
 if ((strtolower($type) != "video/mp4") && (strtolower($type) != "video/webm") && (strtolower($type) != "video/ogg") ) { 
 $message= "Unsupported format! MP4,Ogv and WebM Supported";
 }
 else{
 move_uploaded_file($tmp, '/var/www/html/pdo/uploads/'.$random_name.'.'.$extension); 
 $stmt = $DB_con->prepare("insert into videos (title,location) values (?,?)");
 $stmt->execute(array($name, $newname));
 $message="Video Uploaded Successfully!";} echo "<script type='text/javascript'>alert('$message\\n\\nUpload: $name\\nSize: $size\\nType: $type');</script>";
 }
 ?>
 <h4> Select a Video : </h4>
 <input name="UPLOAD_MAX_FILESIZE" value="20971520" type="hidden"/>
 <input type="file" name="file" id="file" />
 <input type="submit" value="Click to Upload" />
 </form>
 <hr>
<div class= "label">
 <label>See All Videos
<a href ='../home.php'> Home </a></label>
</div>
 </div>
 </div>
 </div>
 </div>
</div>
</div>
</body>
</html>
