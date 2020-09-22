<html>
	<head>
		<meta charset='UTF-8'>
		<meta name="description" content="NivSv Boosting" />
		<title>NivSv Boosting Team</title>
		<link rel="stylesheet" type="text/css" href="Background.css">
		<meta name="viewport" content="width=device-width, initial-scale=1">
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
	</head>
	<style>
	.myButton {
		box-shadow:inset 0px -3px 7px 0px #29bbff;
		background:linear-gradient(to bottom, #2dabf9 5%, #0688fa 100%);
		background-color:#2dabf9;
		border-radius:3px;
		border:1px solid #0b0e07;
		display:inline-block;
		cursor:pointer;
		color:#ffffff;
		font-family:Arial;
		font-size:15px;
		padding:10px 23px;
		text-decoration:none;
		text-shadow:0px 1px 0px #263666;
	}
	.myButton:hover {
		background:linear-gradient(to bottom, #0688fa 5%, #2dabf9 100%);
		background-color:#0688fa;
	}
	.myButton:active {
		position:relative;
		top:1px;
	}
	.GeneratedText {
	font-family:'Comic Sans MS';font-size:xx-large;color:#000000;padding:%;
	}
	</style>
	<body id="playpen">
		<center><img src="img/Shadowlandlogo.png" width="700" height="300"></center> 
		<br><br><br><br><br>
		<div style="position: relative; top: -100px;"><h1><?php
			if(!isset($_SESSION)) { session_start(); }  
			if(!isset($_SESSION['login_user'])){
			  header("location:login.php");
			  die();
			}
			echo "<div class='GeneratedText'>Welcome " . $_SESSION["login_user"] . "!</div><br> ";
		?><?php if($_SESSION["login_user"]=="nivsvb"){ echo "<a href='Addgold.php' class='myButton'>Management</a>";}?>
		<a href="Profile.php" class="myButton">Profile</a>     <a href="AddBoosts.php" class="myButton">Add Boosts</a><a href="index.php" class="myButton">Servers</a><a href="users.php" class="myButton">Users</a><a href="History.php" class="myButton">Boost History</a><a href="?sendcode=true" class="myButton">Logout</a></div></h1>
		<?php
		if(isset($_GET['sendcode'])){
			if(session_destroy()) {
				header("Location: login.php");
			}
		}
		?>