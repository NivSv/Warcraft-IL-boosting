<?php include 'Header.php'; ?>
	<style>
		#demotext {
		color: #FFFFFF;
		text-shadow: 2px 2px 0 #4074b5, 2px -2px 0 #4074b5, -2px 2px 0 #4074b5, -2px -2px 0 #4074b5, 2px 0px 0 #4074b5, 0px 2px 0 #4074b5, -2px 0px 0 #4074b5, 0px -2px 0 #4074b5;
		color: #FFFFFF;
		}
	</style>
	<div id="demotext">Edit this text</div>
	<div>
			<link rel="stylesheet" type="text/css" href="Background.css">
			<form action = "" method = "post">
				<label id="demotext">Type Holder Name + the server":  </label><input type = "text" name = "holdername" class = "box"/><br /><br />
				<label>Gold:  </label><input type = "text" name = "gold" class = "box" /><br/><br />
					<?php
					$link = mysqli_connect("localhost", "root", "", "wow");
					if($link === false){
						die("ERROR: Could not connect. " . mysqli_connect_error());
					}
					$sql = "SELECT * FROM users ORDER BY Nameingame";
					for ($i = 1; $i <= 4; $i++)
					{
						echo "player:".$i."<select name = 'selection".$i."'>";
						if($result = mysqli_query($link, $sql)){
						if(mysqli_num_rows($result) > 0){
							while($row = mysqli_fetch_array($result)){
									echo "<option value='".$row['Nameingame']."'>".$row['Nameingame']."</option>";
							}
							mysqli_free_result($result);
						} else{
							echo "No records matching your query were found.";
						}
						} else{
							echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
						}
						echo "</select><br><br>";
					}
					// Close connection
					mysqli_close($link);
					?>
				<label>Picture link that you sent the gold(note that you need Postal addon to do so):  </label><input type = "text" name = "link" class = "box" /><br/><br />
				<input type = "submit" value = " Submit "/><br />
			</form>
			<?php
			if(!isset($_SESSION)) { session_start(); }  
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$db = mysqli_connect("localhost", "root", "", "wow");
				$holdername = mysqli_real_escape_string($db,$_POST['holdername']);
				$gold = mysqli_real_escape_string($db,$_POST['gold']);
				$link = mysqli_real_escape_string($db,$_POST['link']);
				$array = array($_POST['selection1'], $_POST['selection2'], $_POST['selection3'], $_POST['selection4']);
				$sql = "INSERT INTO `boosthistory`(`Date`, `gold`, `booster1`, `booster2`, `booster3`, `booster4`, `added`, `servername`, `link`) VALUES (CURRENT_TIMESTAMP(),'$gold','$array[0]','$array[1]','$array[2]','$array[3]',false,'$holdername','$link')";
				mysqli_query($db,$sql);
			}
			?>
	</div>
<?php include 'Footer.php'; ?>