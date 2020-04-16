<?php
error_reporting(E_ERROR | E_PARSE);
function check($var){
  $var=trim($var);             //remove unwated space
  $var=strip_tags($var);      //remove html tags | you can use htmlspecialchars
  $var=stripcslashes($var);  // remove slaches \
  return $var;
}

if(isset($_POST['submit'])) { // if someone press the submit
  $fname=check($_POST['fname']);
  $lname=check($_POST['lname']);
  $user_name=check($_POST['user_name']);
  $password=check($_POST['password']);
  $phone_number=check($_POST['phone_number']);
  $email=check($_POST['email']);
  $web_site="http://".check($_POST['web_site']);
  $gender=$_POST['gender'];
  $date_birth=check($_POST['date_birth']);


  /*Firist,Last Name => required - alpha - <15
    Username => required - numbers&alpha - <15
    Password => required - numbers&alpha - >=6 || <20 - hashing
    email => required - email
    web_site => required - URL
    gender => required*/

    $err=array();
  if(!$fname || !ctype_alpha($fname) || strlen($fname)>15)
  $err[fname]="invalid First Name";
  if(!$lname || !ctype_alpha($lname) || strlen($lname)>15)
  $err[lname]="invalid Last Name";
  if(!$user_name || !ctype_alnum($user_name) || strlen($user_name)>15)
  $err[user_name]="invalid User Name";
  if(!$password || !ctype_alnum($password) || strlen($password)<6 || strlen($password)>20)
  $err[password]="invaled Password";
  if(!$err[password]) $password = md5($password);
  if(!$phone_number || !ctype_digit($phone_number) || strlen($phone_number)!=10)
  $err[phone_number]="invaled Phone Number";
  if(!$email || !filter_var($email,FILTER_VALIDATE_EMAIL))
  $err[email]="invaled Email Address";
if(!$web_site || !filter_var($web_site,FILTER_VALIDATE_URL))
$err[web_site]="invaled URL";
if(!$_POST['gender'])
$err['gender']="Please chooes your gender";

if(isset($_FILES['image'])){
    // print_r($_FILES['image']);
    $file_name=$_FILES['image']['name'];
    $file_type=$_FILES['image']['type'];
    $file_tmp=$_FILES['image']['tmp_name'];
    $file_size=$_FILES['image']['size'];
    $ext=strtolower(end(explode('.',$file_name)));
    $avalibale_ext=array('jpeg','jpg','png');
    if($file_size>2097152) $err[image]="too large image";
    if(!in_array($ext,$avalibale_ext)) $err[image]="invaled extension";
    if(empty($err[image])){
      move_uploaded_file($file_tmp,"img/up/".$file_name);
    }

    // inset to DB

    require 'connection_mysql.php';
    if (count($err) == 0) {
    $query="INSERT INTO `account`
    (`id`,`first_name`,`last_name`,`user_name`,`password`,`phone_number`,`email`,`web_site`,`gender`,`date_birth`)
     VALUES (NULL,'$fname','$lname','$user_name','$password','$phone_number','$email','$web_site','$gender','$date_birth')";
    if(mysqli_query($connection,$query))
    // $_SESSION['username'] = $user_name;
  	// $_SESSION['success'] = "You are now logged in";
  	header('location: index.html');}

}

}


?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="professional web design">
    <meta name="keywords" content="HTML,CSS,php,JavaScript,jq,mysql">
    <meta name="author" content="Ali Salem">
    <link rel="shortcut icon" href="img/favicon.ico.gif">
    <title>ADC Design :: Sing Up Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/singup.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body>
    <header>
        <div class="container">
            <div id="branding">
                <h1><span class="highlight">ADC</span> Design</h1>
                <nav>
                    <ul>
                      <li class="current"><a href="index.html">Home</a></li>
                      <li><a href="singup.php">Sing Up</a></li>
                      <li><a href="about.html">ABOUT</a></li>
                      <li><a href="login.php">Login</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <div class="containers">
	<div class="row">
    <div class="col-md-8">
      <section>
        <h1 class="entry-title"><span>Sign Up</span> </h1>
        <hr>
            <form class="form-horizontal" method="post" id="signup" enctype="multipart/form-data" >
        <div class="form-group">
          <label class="control-label col-sm-3" for="email">Email ID <span class="text-danger">* <?php echo $err[email];?></span></label>
          <div class="col-md-8 col-sm-9">
              <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
              <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email ID">
            </div>
            <small> Your Email Id is being used for ensuring the security of your account, authorization and access recovery. </small> </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3" for="fname">First Name <span class="text-danger">* <?php echo $err[fname];?></span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter your First Name">
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="lname">Last Name <span class="text-danger">* <?php echo $err[lname];?></span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter your Last Name">
           </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3" for="user_name">User Name <span class="text-danger">* <?php echo $err[user_name];?></span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="text" class="form-control" name="user_name" id="user_name" placeholder="Enter your User Name">
           </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3" for="date_birth">Date of Birth</label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="date" class="form-control" name="date_birth" id="date_birth">
           </div>
          </div>
        </div>

        <div class="form-group">
          <label class="control-label col-sm-3" for="password">Set Password <span class="text-danger">* <?php echo $err[password];?></span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="password" class="form-control" name="password" id="password" placeholder="Choose password (6-20 chars)">
           </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="phone_number">Phone Number <span class="text-danger">* <?php echo $err[phone_number];?></span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="0501234567">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="web_site">Web Site <span class="text-danger">* <?php echo $err[web_site];?></span></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group">
              <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
              <input type="text" class="form-control" name="web_site" id="web_site" placeholder="www.google.com">
            </div>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="gender">Gender <span class="text-danger">* <?php echo $err[gender];?></span></label>
          <div class="col-md-8 col-sm-9">
            <label>
            <input name="gender" type="radio" value="Male" checked>
            Male </label>
               
            <label>
            <input name="gender" type="radio" value="Female" >
            Female </label>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-3" for="image">Profile Photo <span class="text-danger"><?php echo $err[image];?></span> <br>
          <small>(optional)</small></label>
          <div class="col-md-5 col-sm-8">
            <div class="input-group"> <span class="input-group-addon" id="file_upload"><i class="glyphicon glyphicon-upload"></i></span>
              <input type="file" name="image" id="image" class="form-control upload" placeholder="" aria-describedby="file_upload">
            </div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-xs-offset-3 col-md-8 col-sm-9"><span class="text-muted"><span class="label label-danger">Note:-</span> By clicking Sign Up, you agree to our <a href="#">Terms</a> and that you have read our <a href="#">Policy</a>, including our <a href="#">Cookie Use</a>.</span> </div>
        </div>
        <div class="form-group">
          <div class="col-xs-offset-3 col-xs-10">
            <input name="submit" type="submit" value="Sign Up" class="btn btn-primary">
            <input name="reset" type="reset" value="Reset" class="btn btn-primary">
          </div>
        </div>

      </form>
    </div>
</div>
</div>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">


    <!-- Site footer -->
    <footer class="footer">
    <div class="container bottom_border">
    <div class="row">
    <div class=" col-sm-4 col-md col-sm-4  col-12 col">
    <h5 class="headin5_amrc col_white_amrc pt2">Find us</h5>
    <!--headin5_amrc-->
    <p class="mb10">stry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s</p>
    <p><i class="fa fa-location-arrow"></i> 9878/25 sec 9 rohini 35 </p>
    <p><i class="fa fa-phone"></i>  +91-9999878398  </p>
    <p><i class="fa fa fa-envelope"></i> info@example.com  </p>


    </div>


    <div class=" col-sm-4 col-md  col-6 col">
    <h5 class="headin5_amrc col_white_amrc pt2">Quick links</h5>
    <!--headin5_amrc-->
    <ul class="footer_ul_amrc">
    <li><a href="#">Image Rectoucing</a></li>
    <li><a href="#">Clipping Path</a></li>
    <li><a href="#">Hollow Man Montage</a></li>
    <li><a href="#">Ebay & Amazon</a></li>
    <li><a href="#">Hair Masking/Clipping</a></li>
    <li><a href="#">Image Cropping</a></li>
    </ul>
    <!--footer_ul_amrc ends here-->
    </div>


    <div class=" col-sm-4 col-md  col-6 col">
    <h5 class="headin5_amrc col_white_amrc pt2">Quick links</h5>
    <!--headin5_amrc-->
    <ul class="footer_ul_amrc">
    <li><a href="#">Remove Background</a></li>
    <li><a href="#">Shadows & Mirror Reflection</a></li>
    <li><a href="#">Logo Design</a></li>
    <li><a href="#">Vectorization</a></li>
    <li><a href="#">Hair Masking/Clipping</a></li>
    <li><a href="#">Image Cropping</a></li>
    </ul>
    <!--footer_ul_amrc ends here-->
    </div>


    <div class=" col-sm-4 col-md  col-12 col">
    <h5 class="headin5_amrc col_white_amrc pt2">Follow us</h5>
    <!--headin5_amrc ends here-->

    <ul class="footer_ul2_amrc">
    <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
    <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
    <li><a href="#"><i class="fab fa-twitter fleft padding-right"></i> </a><p>Lorem Ipsum is simply dummy text of the printing...<a href="#">https://www.lipsum.com/</a></p></li>
    </ul>
    <!--footer_ul2_amrc ends here-->
    </div>
    </div>
    </div>


    <div class="containerf">
    <ul class="foote_bottom_ul_amrc">
    <li><a href="#">Home</a></li>
    <li><a href="#">About</a></li>
    <li><a href="#">Services</a></li>
    <li><a href="#">Pricing</a></li>
    <li><a href="#">Blog</a></li>
    <li><a href="#">Contact</a></li>
    </ul>
    <!--foote_bottom_ul_amrc ends here-->
    <p class="text-center">Copyright @ 2020 | Designed With by <a href="#">ADC Design</a></p>

    <ul class="social_footer_ul">
    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
    <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
    </ul>
    <!--social_footer_ul ends here-->
    </div>

    </footer>


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>
