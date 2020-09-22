<?php include 'Header.php'; ?>
		<div><form action = "" method = "post">
				<label>Server name:  </label><input type = "text" name = "servername" class = "box"/><br /><br />
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
				<input type = "submit" value = " Submit "/><br />
			</form>
			<?php
			echo "</select><br><br>";
			if(!isset($_SESSION)) { session_start(); }  
			if($_SERVER["REQUEST_METHOD"] == "POST") {
				$db = mysqli_connect("localhost", "root", "", "wow");
				$servername = mysqli_real_escape_string($db,$_POST['servername']);
				$gold = mysqli_real_escape_string($db,$_POST['gold']);
				$array = array($_POST['selection1'], $_POST['selection2'], $_POST['selection3'], $_POST['selection4']);
				$holdername = "Nivsvtrader-".$servername;
				echo($holdername);
				$sql = "SELECT * FROM `wowservers` WHERE `Gold Holder` = '$holdername'";
				$result = mysqli_query($db,$sql);
				echo(mysqli_num_rows($result) > 0);
				if(mysqli_num_rows($result) > 0){
					echo("sss");
					$result2 = mysqli_query($db,"SELECT * FROM `wowservers` WHERE `Gold Holder` = '$holdername'");
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result2)){
								$currgold=$row['gold'];
						}
						mysqli_free_result($result2);
						$sum = (float)$currgold+(float)$gold;
						$sql = "UPDATE `wowservers` SET `gold`= '$sum' WHERE `Gold Holder` = '$holdername'";
						mysqli_query($db, $sql);
					}
				}
				else{
					if($servername!=null)
					{
						echo("sss2");
						$sql = "INSERT INTO `wowservers`(`name`, `gold`, `Gold Holder`) VALUES ('$servername','$gold','$holdername')";
						mysqli_query($db,$sql);
					}
				}
				for ($i = 1; $i <= 4; $i++)
				{
					$newgold=$gold/4;
					$name = print_r($array[$i-1], true);
					$result = mysqli_query($db,"SELECT * FROM `users` WHERE Nameingame = '$name'");
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
								$currgold=$row['gold'];
						}
						mysqli_free_result($result);
					}
					$sum = (float)$currgold+(float)$newgold;
					$sql = "UPDATE `users` SET `gold`= '$sum' WHERE Nameingame = '$name'";
					mysqli_query($db, $sql);
				}
				$sql = "INSERT INTO `boosthistory`(`Date`, `gold`, `booster1`, `booster2`, `booster3`, `booster4`, `added`, `servername`, `link`) VALUES (CURRENT_TIMESTAMP(),'$gold','$array[0]','$array[1]','$array[2]','$array[3]',true,'$servername','-')";
				mysqli_query($db,$sql);
			}
			?>
	   </div>
	   	<center style="position: relative;">
		<table class="table-fill">
			<thead>
				<tr>
					<th class="text-left">Date</th>
					<th class="text-left">Holder Name</th>
					<th class="text-left">Gold</th>
					<th class="text-left">Booster1</th>
					<th class="text-left">Booster2</th>
					<th class="text-left">Booster3</th>
					<th class="text-left">Booster4</th>
					<th class="text-left">Added to balance</th>
				</tr>
			</thead>
			<tbody class="table-hover">
				<?php
					$link = mysqli_connect("localhost", "root", "", "wow");
					if($link === false){
						die("ERROR: Could not connect. " . mysqli_connect_error());
					}
					$sql = "SELECT * FROM boosthistory ORDER BY Date DESC";
					if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							if(!$row['added'])
							{
								echo "<tr>";
									echo "<td>" . $row['Date'] . "</td>";
									echo "<td>" . $row['servername'] . "</td>";
									echo "<td>" . $row['gold'] . "</td>";
									echo "<td>" . $row['booster1'] . "</td>";
									echo "<td>" . $row['booster2'] . "</td>";
									echo "<td>" . $row['booster3'] . "</td>";
									echo "<td>" . $row['booster4'] . "</td>";
									echo "<td><font color='red'>Waiting for approval</font></td>";
								echo "</tr>";
							}
						}
						mysqli_free_result($result);
					}
					} else{
						echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
					}

					// Close connection
					mysqli_close($link);
				?>
			</tbody>
		</table>
	</center>
<?php include 'Footer.php'; ?>