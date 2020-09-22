<html>
	<head>
		<meta charset='UTF-8'>
		<meta name="description" content="NivSv Boosting" />
		<title>NivSv Boosting Team</title>
		<link rel="stylesheet" type="text/css" href="Background.css">
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js'></script>
		<script>
			// DOM Ready
			$(function() {
			
				var originalBGplaypen = $("#playpen").css("background-color"),
					x, y, xy, bgWebKit, bgMoz, 
					lightColor = "rgba(255,255,255,0.75)",
					gradientSize = 100;
						
					// Basic Demo
					$('#playpen').mousemove(function(e) {
					
						x  = e.pageX - this.offsetLeft;
						y  = e.pageY - this.offsetTop;
						xy = x + " " + y;
						   
						bgWebKit = "-webkit-gradient(radial, " + xy + ", 0, " + xy + ", " + gradientSize + ", from(" + lightColor + "), to(rgba(255,255,255,0.0))), " + originalBGplaypen;
						bgMoz    = "-moz-radial-gradient(" + x + "px " + y + "px 45deg, circle, " + lightColor + " 0%, " + originalBGplaypen + " " + gradientSize + "px)";
											
						$(this)
							.css({ background: bgWebKit })
							.css({ background: bgMoz });
						
					}).mouseleave(function() {			
						$(this).css({ background: originalBGplaypen });
					});
				
			
			
					
					var originalBG = $(".nav a").css("background-color");
					
					$('.nav li:not(".active") a')
					.mousemove(function(e) {
					
						   x  = e.pageX - this.offsetLeft;
						   y  = e.pageY - this.offsetTop;
						   xy = x + " " + y;
						   
						   bgWebKit = "-webkit-gradient(radial, " + xy + ", 0, " + xy + ", 100, from(rgba(255,255,255,0.8)), to(rgba(255,255,255,0.0))), " + originalBG;
						   bgMoz    = "-moz-radial-gradient(" + x + "px " + y + "px 45deg, circle, " + lightColor + " 0%, " + originalBG + " " + gradientSize + "px)";
					
							$(this)
								.css({ background: bgWebKit })
								.css({ background: bgMoz });
							
							
					}).mouseleave(function() {
						$(this).css({ background: originalBG });
					});
					
			});
		</script>
		<style>
			#demotext {
			font-size: 27px;
			text-shadow: 2px 2px 0 black, 2px -2px 0 black, -2px 2px 0 black, -2px -2px 0 black, 2px 0px 0 black, 0px 2px 0 black, -2px 0px 0 black, 0px -2px 0 black;
			color: #FFFFFF;
			}
			.button {
			  background-color: #4CAF50; /* Green */
			  border: none;
			  color: white;
			  padding: 16px 32px;
			  text-align: center;
			  text-decoration: none;
			  display: inline-block;
			  font-size: 16px;
			  margin: 4px 2px;
			  -webkit-transition-duration: 0.4s; /* Safari */
			  transition-duration: 0.4s;
			  cursor: pointer;
			}
			.button5 {
			  background-color: white;
			  color: black;
			  border: 2px solid #555555;
			}
			.button5:hover {
			  background-color: #555555;
			  color: white;
			}
			input[type=text] {
			  padding: 12px 20px;
			  margin: 8px 0;
			  box-sizing: border-box;
			  border: 3px solid #ccc;
			  -webkit-transition: 0.5s;
			  transition: 0.5s;
			  outline: none;
			}

			input[type=text]:focus {
			  border: 3px solid #555;
			}
			input[type=password] {
			  padding: 12px 20px;
			  margin: 8px 0;
			  box-sizing: border-box;
			  border: 3px solid #ccc;
			  -webkit-transition: 0.5s;
			  transition: 0.5s;
			  outline: none;
			}

			input[type=password]:focus {
			  border: 3px solid #555;
			}
		</style>
	</head>
	<body id="playpen">
		<center><img src="img/Shadowlandlogo.png" width="700" height="300"></center> 
		<br><br><br>
		<div><form action = "" method = "post">
		  <label id="demotext">UserName : </label><input type = "text" name = "username" class = "box"/><br /><br />
		  <label id="demotext">Password : </label><input type = "password" name = "password" class = "box" /><br/><br />
		  <input class="button button5" type = "submit" value = " Submit "/><br />
	   </form></div>
	   <?php
		if(!isset($_SESSION)) { session_start(); }  
	    if($_SERVER["REQUEST_METHOD"] == "POST") {
		  $db = mysqli_connect("localhost", "root", "", "wow");
		  $myusername = mysqli_real_escape_string($db,$_POST['username']);
		  $mypassword = mysqli_real_escape_string($db,$_POST['password']); 
		  $sql = "SELECT * FROM `users` WHERE Nameingame = '$myusername' and password = '$mypassword'";
		  $result = mysqli_query($db,$sql);
		  $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
		  $count = mysqli_num_rows($result);
		  if($count == 1) {
			 $_SESSION['login_user'] = $myusername;
			 
			 header("location: index.php");
		  }else {
			 $error = "Your Login Name or Password is invalid";
		  }
	   }
	?>
<?php include 'Footer.php'; ?>