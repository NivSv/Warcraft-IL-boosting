<?php include 'Header.php'; ?>
<br><br><br>
	<center style="position: relative; top: -150px;">
		<table class="table-fill">
			<thead>
				<tr>
					<th class="text-left">Img</th>
					<th class="text-left">Player</th>
					<th class="text-left">Main name</th>
					<th class="text-left">Balance</th>
					<th class="text-left">Balance after the 15% fee</th>
				</tr>
			</thead>
			<tbody class="table-hover">
				<?php
					$link = mysqli_connect("localhost", "root", "", "wow");
					if($link === false){
						die("ERROR: Could not connect. " . mysqli_connect_error());
					}
					$sql = "SELECT * FROM users ORDER BY gold DESC";
					if($result = mysqli_query($link, $sql)){
					if(mysqli_num_rows($result) > 0){
						while($row = mysqli_fetch_array($result)){
							echo "<tr>";
								echo "<td><img height='50' width='50' src='//render-eu.worldofwarcraft.com/character/the-maelstrom/". $row['img'] . "-avatar.jpg'></td>";
								echo "<td>" . $row['name'] . "</td>";
								echo "<td>" . $row['Nameingame'] . "</td>";
								echo "<td>" . $row['gold'] . "k</td>";
								$newgold = $row['gold']*0.85;
								echo "<td>" . $newgold . "k</td>";
							echo "</tr>";
						}
						mysqli_free_result($result);
					} else{
						echo "No records matching your query were found.";
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