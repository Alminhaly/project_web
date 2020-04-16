<?php
error_reporting(E_ERROR | E_PARSE);
require 'connection_mysql.php';

$user_name = $_POST['user_name'];
$password = $_POST['password'];

$stmt= $connection ->prepare("select * from account where user_name=? and password=?");
$stmt->bind_param("ss",$user_name,$password);
$stmt->execute();
$result= $stmt->get_result();
?>

<!DOCTYPE html>
<html class="loginpage">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta name="description" content="professional web design">
    <meta name="keywords" content="HTML,CSS,php,JavaScript,jq,mysql">
    <meta name="author" content="Ali Salem">
    <link rel="shortcut icon" href="img/favicon.ico.gif">
    <title>ADC Design :: Login Page</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

</head>

<body class="loginbody">
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

    <div class="login">
			<h1>Login</h1>
			<form method="post">
				<label for="user_name">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="user_name" placeholder="Username" id="username" required>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<input type="submit" value="Login">
			</form>
		</div>
<?php
    if($result->num_rows>0){
      echo "Welcom"." ".$user_name;
    }else {
      echo "incorect password";
    }
?>

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
