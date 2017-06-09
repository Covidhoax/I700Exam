<?php
include_once 'db.php';
if(!$user->is_loggedin())
{
 $user->redirect('index.php');
}
$user_id = $_SESSION['user_session'];
$stmt = $DB_con->prepare("SELECT * FROM users WHERE user_id=:user_id");
$stmt->execute(array(":user_id"=>$user_id));
$userRow=$stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" />
<link rel="stylesheet" href="style.css" type="text/css" />
<title>welcome - <?php print($userRow['user_email']); ?></title>
</head>
<body>
<nav class="navbar navbar-default">
<div class = "page-header">
 <div class ="container-fluid">
 <label><a href="uploads/index.php"><h3>Upload Video</h3></a></label>
 </div>
 <label><a href="logout.php?logout=true"><i class="glyphicon glyphicon-log-out"></i> logout</a></label>
 </div>
 </div>
 </div>
 <div class= "container-fuid" >
 <div class="row">
 <div class ="panel panel-primary">
 <div class = "panel panel-heading" align="center" ><b>All Videos</b></div>
 <br>
 <div class= "col-md-12">
 <div class = "panel panel-body" style="padding:5px;" >
<?php
$query = $DB_con->prepare("SELECT * FROM videos ORDER BY video_id DESC");
$query->execute();
while ($row =$query->fetch(PDO::FETCH_ASSOC)) {
 ?>
<div class="overlay"><h3>
<?php echo $row['title']; ?></h3>
</div>
<video class="videoPlayer" controls>
<source src="uploads/<?php echo $row['location']; ?>" type="video/mp4">
 <source src="uploads/<?php echo $row['location']; ?>" type="video/ogg">
 <source src="uploads/<?php echo $row['location']; ?>" type="video/webm">
 This video is not Supported By Your Browser
 </video>
<?php
 }
?>
<div>
</div>
</div>
</div>
</div>
</div>
</div>
</body>
</html>
