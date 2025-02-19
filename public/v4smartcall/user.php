<?php
/**
*
* @ This file is created by http://DeZender.Net
* @ deZender (PHP7 Decoder for ionCube Encoder)
*
* @ Version			:	4.1.0.1
* @ Author			:	DeZender
* @ Release on		:	29.08.2020
* @ Official site	:	http://DeZender.Net
*
*/

function Submit($db, $table_name)
{
	$db->exec('UPDATE users SET' . "\t" . 'username=\'' . $_POST['username'] . '\', password=\'' . $_POST['password'] . '\' WHERE id=\'1\' ');
	session_start();
	session_regenerate_id();
	$_SESSION['loggedin'] = true;
	$_SESSION['name'] = $_POST['username'];
}

include 'includes/header.php';
$res = $db->query('SELECT * FROM users WHERE id=\'1\'');
$row = $res->fetchArray();

if (isset($_POST['submit'])) {
	submit($db, $table_name);
	header('Location: ' . $base_file . '?status=2');
}

?>
<div class="col-md-6 mx-auto">
   <div class="card-body">
      <div class="card text-white ctluser-main">
         <div class="card-header ctheading">                     
            <center>                          
               <h2><i class="fa fa-user"></i> Update Credentials</h2>                    
            </center>                   
         </div>
         <div class="alert alert-info alert-dismissible ctalert" role="alert">
            <center>
               <h3>Do <strong>not</strong> use <em>admin</em> for username or password!</h3>
            </center>
         </div>
         <div class="card-body">
            <form  method="post">
               <div class="form-group">
                  <div class="form-group form-float form-group-lg">                                   
                     <div class="form-line ctinput">                                        
						 <label class="form-label">Username</label>
						 <input type="text" class="form-control" name="username" value=" <?php echo $row['username']; ?> ">
					 </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="form-group form-float form-group-lg">                                  
                     <div class="form-line ctinput">                                        
						 <label class="form-label">Password</label>
						 <input type="text" class="form-control" name="password" value=" <?php echo $row['password']; ?> ">
					 </div>
                  </div>
               </div>
               <center><button type="submit" name="submit" class="btn btn-info ctbtn ctuserbtn"><i class="fa fa-check"></i>Update Credentials</button></center>
            </form>
         </div>
      </div>
   </div>
</div>
<?php include 'includes/footer.php'; ?>
	