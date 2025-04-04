<!-- Estate Flow - Land Report Page  -->
<!-- Name: Mark Lambert
Student ID: C00192497
Purpose: Land Report Page
Date: March 2025
Estate Flow Y2 Project 2025-->
<!DOCTYPE html>
<?php 
	include "reports.html.php";
	include '../db.inc.php';
?>
    
    <!-- Begin form, note, action loops back to current form, set to hidden -->
	<form action = "land_report.html.php" method = "post" name = "reportForm" hidden>
        <!-- Hidden input w/ name choice, used for determining which filter is active -->
		<input type = "hidden" name = "choice">
	</form>
	
	    <!-- Begin clientForm, note, action loops back to current form, set to hidden so doesn't interfere with interface -->
	<form action = "land_report.html.php" method = "post" name = "clientForm" hidden>
        <!-- Hidden input w/ name choice, used for determining which filter is active -->
		<input type = "hidden" name = "clientInfo">
	</form>
	
    <!-- Main Content Area -->
    <div class="content">

    <!-- Div for styling report -->
		<div class = "report">
			<h1>Land Reports</h1>
            <!-- Div for styling buttons -->
            <div class = "myButton">
                <!-- Button to filter by PRICE -->
			<input type = "button" id = "priceButton" value = "Order by Price" onclick = "priceOrder()" title="Click here to see the Land table in Ascending Price order">
            <!-- Button to filter by ACRES -->
			<input type = "button" id = "acreButton" value = "Order by Acreage" onclick = "acreOrder()" title="Click here to see the Land table in Ascending Acreage order">
            <!-- Button, initially disabled, to get info on a client who owns a propety -->
			<input type = "button" id = "clientButton" value = "Owner Information" onclick = "clientInformation()" title="Click here to see the information on a Client who owns a selected Land Property" disabled>
		</div>
		<br><br>
		
			<!-- Begin javascript for filtering and client info buttons -->
			<script>
				document.title = "Estate Flow - Land Reports";
				
				document.getElementById("landReport").className = "button selected";
				
				//Super variable to track if the radio button has been clicked
				var client = null;
				// Function acreOrder, sets the buttons value to acre and submits the form that the button is in, therin applying the filter
				function acreOrder()
				{
					document.reportForm.choice.value = "Acre";
					document.reportForm.submit();
				}
				
				// Filter by price
				function priceOrder()
				{
					document.reportForm.choice.value = "Price";
					document.reportForm.submit();
				}
				
				//When radio button is clicked, assign the super variable the client id and enable the button
				function selectProperty(clientID)
				{
					client = clientID;
					document.getElementById("clientButton").disabled = false;
				}
				//If the super var has been set and user pressed button, submit form
				function clientInformation()
				{
					if(client !== null)
					{
						document.clientForm.clientInfo.value = client;
						document.clientForm.submit();
					}
				}
			//End Javascript
			</script>
		
			<!-- Begin php for default choice-->
			<?php
				// Var choice initialised to "Price", as filtering by Price will serve as the default
				$choice = "Price";

				// If the filter has been set (the javascript to insert the value into the choice field has been triggered ie, button has been clicked) then set out variable to be the value of POSTchoice
				if(ISSET($_POST['choice']))
				{
					$choice = $_POST['choice'];
				}

				//If the client report form has been submitted, then the user has clicked the button
				IF(ISSET($_POST['clientInfo']))
				{
					$sqlClient = "SELECT Client.* FROM Client INNER JOIN Property ON Property.owner = Client.client_id WHERE client_id = " . $_POST['clientInfo'];
					produceClientReport($con, $sqlClient);
				}

				// Event where Choice = Price
				if($choice == "Price")
				{
			//End php
			?>

					<!-- Enable the acre button, so that now the user may only switch to filter by acre as Price is active -->
					<script>
						document.getElementById("acreButton").disabled = false;
						document.getElementById("priceButton").disabled = true;
					</script>
					  
			<!-- Begin php for default choice select statement -->
			<?php
				// Prepare the SQL statement for execution, produceReport() then handles the execution
				$sql = "SELECT * FROM Land INNER JOIN Property ON Land.property_id = Property.property_id WHERE Land.delete_flag = 0 AND Property.status != 2 ORDER BY asking_price ASC";
					produceReport($con, $sql);
				}
				// End if for Price
				
				//Event for choice being Acre
				if($choice == "Acre")
				{
			//End php
			?>

					<!-- Begin script to disable acre button -->
					<script>
						document.getElementById("acreButton").disabled = true;
						document.getElementById("priceButton").disabled = false;
					</script>

			<!-- Begin php for ACRE filter-->
			<?php
						//Prepare the statement for execution for filtering by acres
							$sql = "SELECT * FROM Land INNER JOIN Property ON Land.property_id = Property.property_id WHERE Land.delete_flag = 0 AND Property.status != 2 ORDER BY acres ASC";
							produceReport($con, $sql);
				
				}
					
            // Function produceReport, ehco's out the structure of the report, then executes SQL and echo's out the results all using CLIENT SIDE RENDERING
			function produceReport($con, $sql)
			{
				$result = mysqli_query($con, $sql);

				echo "<table>
					<tr><th> </th>
				 	<th>Property Number</th>
				 	<th>Address</th>
				 	<th>No. of Acres</th>
				 	<th>Quotas</th>
				 	<th>Residence Details</th>
				 	<th>Status</th>
				 	<th>Highest Bid</th>
				 	<th>Asking Price</th></tr>";

				while($row = mysqli_fetch_array($result))
				{
					
					if($row['status'] == 0)
					{
						$status = "For Sale";
					}
					else if($row['status'] == 1)
					{
						$status = "Sale Agreed";	
					}
					//Echo out a radio button for each property, that when selected will be used to display client info via the owner field
					 echo"<td><input type='radio' name='property' onclick='selectProperty(" . $row['owner'] . ")'></td>
						<td>" . $row['property_id'] . "</td> 
						<td>" . $row['address'] . "</td>
						<td>" . $row['acres'] . "</td>
						<td>" . $row['quotas'] . "</td>
						<td>" . $row['residence_details'] . "</td>
						<td>" . $status . "</td>
						<td>" . $row['highest_bid'] . "</td>
						<td>" . $row['asking_price'] . "</td>
						</tr>";
				}
				echo "</table>";

			}
			
			//Function to produce a small report on a client when button is clicked
			function produceClientReport($con, $sql)
			{
				$result = mysqli_query($con, $sql);
				
				if(!$result)
				{
					die("Error with your statement" . mysql_error($con));	
				}
				
				$row = mysqli_fetch_array($result);
				
				echo "<script>
				alert('Client Name:  " . $row['name'] . 
					"\\nEmail: " .  $row['email'] . 
					"\\nPhone No: " .  $row['phone_no'] .
					"\\nAddress: " .  $row['address'] .
					"\\nEircode: " .  $row['eircode'] ."');
				</script>";
				

			}
			mysqli_close($con);
		?>
    	</div>
	</div>
	
</body>
</html>