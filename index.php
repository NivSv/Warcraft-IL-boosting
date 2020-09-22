<?php include 'Header.php'; ?>
<br><br><br>
<center style="position: relative; top: -150px;">
	<table class="table-fill">
			<thead>
			<tr>
				<th class="text-left">Server</th>
				<th class="text-left">Gold in thousands</th>
				<th class="text-left">Gold Holder</th>
			</tr>
		</thead>
	<tbody class="table-hover">
	<?php
		$link = mysqli_connect("localhost", "root", "", "wow");
		if($link === false){
			die("ERROR: Could not connect. " . mysqli_connect_error());
		}
		$sql = "SELECT * FROM wowservers ORDER BY gold DESC";
		if($result = mysqli_query($link, $sql)){
		if(mysqli_num_rows($result) > 0){
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
					echo "<td>" . $row['name'] . "</td>";
					echo "<td>" . $row['gold'] . "k</td>";
					echo "<td>" . $row['Gold Holder'] . "</td>";
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