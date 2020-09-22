<?php include 'Header.php'; ?>
<br><br><br>
	<center style="position: relative; top: -150px;">
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
							echo "<tr>";
								echo "<td>" . $row['Date'] . "</td>";
								echo "<td>" . $row['servername'] . "</td>";
								echo "<td>" . $row['gold'] . "</td>";
								echo "<td>" . $row['booster1'] . "</td>";
								echo "<td>" . $row['booster2'] . "</td>";
								echo "<td>" . $row['booster3'] . "</td>";
								echo "<td>" . $row['booster4'] . "</td>";
								if($row['added'])
								{
									echo "<td><font color='#33cc33'>Yes</font></td>";
								}
								else
								{
									echo "<td><font color='red'>Waiting for approval</font></td>";
								}
							echo "</tr>";
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