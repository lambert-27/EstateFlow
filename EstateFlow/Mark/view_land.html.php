<!-- Estate Flow - View Land Page  -->
<!--Name: Mark Lambert
Student ID: C00192497
Purpose: View/Amend land form page
Date: February 2025
EstateFow Y2 Project 2025-->
<!DOCTYPE html>
<?php
	session_start();
?>

<html lang="en">

    <head>
        <!-- Sets title -->
        <title>EstateFlow - View Land</title>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="../menu.css">
        <link rel="stylesheet" href="land.css">
        <script src="view_land.js"></script>
        <link rel="icon" type="image/x-icon" href="../images/icon.png">

    </head>

<body>

    <!-- Fixed Top Bar displaying the page title -->
    <div class="topBar">EstateFlow</div>
   
    <!-- Sidebar Navigation Menu -->
    <div class="sidebar" id="mySidebar">
        <!-- Logo Section inside Sidebar -->
        <div class="logo">
            <a href ="../menu.html"><img src="../images/logo.png" alt="EstateFlow Logo"></a>
        </div>
        <!-- Navigation Links -->
        <a class ="button" href="add_land.html.php">Add a New Land Property</a>
        <a class ="button" href="delete_land.html.php">Delete a Land Property</a>
        <a class ="button selected" href="view_land.html.php">Amend/View a Land Property</a>
        <a class ="button" id="exit" href="../menu.html">Return to Menu</a>
    </div>
    
   <!-- Main Content Area -->
   <div class="content">

        <!-- Start form, sending info via Post to add_land.php -->
        <form action="view_land.php" onsubmit="return confirmCheck()"  method="Post">
            <!-- Set heading for the form -->
            <h1>Amend a Land Property</h1>
            
            <!-- Container for Listbox containing all clients w/ their client_id in the values-->
            <div class = "view-listbox">
                <label for = "view-listbox"><h2>Select a Land Property to Edit</h2></label> 
                <!-- Calls the php script to make the dynamic listbox and insert it into the form via an echo -->
                <?php include 'view_land_listbox.php'; ?>
            </div>    
            
            <!-- Button which when clicked, calls the toggleLock function (toggleLock, switches between the two states of Amend and View) -->
            <div class = "myButton">
                <input type = "button" value = "Amend Details" id = "amendViewbutton" onclick = "toggleLock()" disabled>
                <input type='button' value='Filter by Sold' id='filterSold' onclick='filterBySold()'>
                <input type='button' value='Filter by Not Sold' id='filterNotSold' onclick='filterByNotSold()'>
                <input type='button' value='Reset Filter' id='resetFilter' onclick='filterAll()'>			
            </div>
			
			<!-- Script which checks if the session variable has been set for when a land property has been edited, if so, echo a message out -->
			<?php
				if(isset($_SESSION['property_id'])){
					echo "<h2>Land Property with ID: " . $_SESSION['property_id'] . " has been updated</h2>";	
				}
			session_destroy();
			?>
            
            <div class = "formContainer">

                <fieldset>

                    <legend>Amend a Land Property</legend>

                
                        <!-- Container for Eircode -->
                        <div class = "inputbox">
                            <label for = "eircode">Eircode: </label><br>
                            <!-- Pattern: Eircode 1 alpha char(upper or lowercase) followed by TWO digits, any number of spaces then another alpha char and THREE digits -->
                            <input type="text" name="eircode" id="eircode" required autofocus placeholder="Y21 234" pattern="[A-Za-z]?\d{2}[ ]?[A-Za-z]?\d{3}" disabled autofocus>
                        </div>

                        <!-- Container for Location -->
                        <div class = "inputbox">
                            <label for ="location">Location: </label><br>
                            <input type="text" name="location" id="location" required placeholder="Carlow" disabled>
                        </div>

                        <!-- Container for Status -->
                        <div class = "inputbox">
                            <label for ="status">Status: </label><br>
                            <select name = "status" id = status disabled> 			
                                <option value="0">For Sale</option>  
                                <option value="1">Sale Agreed</option>  
                                <option value="2">Sale Complete</option>  
                            </select>
                        </div>

                        <!-- Container for Owner -->
                        <div class = "inputbox">
                            <label for = "ownerName">Owner: </label><br>
                            <input type="text" name="ownerName" id="ownerName" disabled>
                        </div>

                        <!-- Container for Highest Bid -->
                        <div class = "inputbox">
                            <label for = "bid">Highest Bid: </label><br>
                            <input type="number" name="bid" id="bid" placeholder="€385000" min="1" required disabled>
                        </div>

                        <!-- Container for Asking Price -->
                        <div class = "inputbox">
                            <label for = "price">Asking Price: </label><br>
                            <input type="number" name="price" id="price" placeholder="€400000" min="1" required disabled>
                        </div>
                        
                        <!-- Container for Viewing Times -->
                        <div class = "inputbox">
                            <label for = "viewing_times">Viewing Times: </label><br>
                            <input type="text" name="viewing_times" id="viewing_times" placeholder= "Weekends 12pm - 5pm" required disabled>
                        </div>
                                    
                </fieldset>
                
                <!-- Begin Fieldset for Land Specific Details -->
                <fieldset>
                    
                    <legend>Land-Specific Details</legend>

                        <!-- Container for Address -->
                        <div class = "inputbox">
                            <label for ="adrs">Address: </label><br>
                            <input type="text" name="adrs" id="adrs" required placeholder="Line 1 (Required)" disabled> <br><br>
                            <input type="text" name="adrs2" id="adrs2" placeholder="Line 2 (Optional)" disabled> <br><br>
                            <input type="text" name="adrs3" id="adrs3" placeholder="Line 3 (Optional)" disabled> 
                        </div>

                        <!-- Container for Acres -->
                        <div class = "inputbox">
                            <label for ="acres">Acres: </label><br>
                            <!-- Min 1 - validation that we have atleast an acre of land -->
                            <input type="number" name="acres" id="acres" required placeholder="2500" min="1" disabled>
                        </div>

                        <!-- Container for Buildings -->
                        <div class = "inputbox">
                            <label for = "buildings">Buildings: </label><br>
                            <input type="text" name="buildings" id="buildings" required placeholder="Two large buildings, one shed" disabled>
                        </div>

                        <!-- Container for Residence Details -->
                        <div class = "inputbox">
                            <label for ="details">Residence Details: </label><br>
                            <input type="text" name="details" id="details" required placeholder="4 bedroom period residence in need of repair" disabled>
                        </div>

                        <!-- Container for Quotas -->
                        <div class = "inputbox">
                            <label for ="quotas">Quotas: </label><br>
                            <input type="number" name="quotas" id="quotas" required placeholder="50000" min="0" max="1000000" disabled>
                        </div>

                        <!-- Container for Notes -->
                        <div class = "inputbox">
                            <label for = "notes">Notes: </label><br>
                            <input type="text" name="notes" id="notes" placeholder="Exceptional condition, beautiful view, next to local village" disabled>
                        </div>
                                
                        <!-- Container for Owner ID - Hidden, as ID is only needed when updating to the correct entry in table -->
                        <input type="number" name="owner" id="owner" hidden>

                        <!-- Container for Property ID - Hidden, as ID is only needed when updating to the correct entry in table -->
                        <input type="number" name="property_id" id="property_id" hidden>
                                
                        <!-- Container for Land ID - Hidden, as ID is only needed when updating to the correct entry in table -->
                        <input type="number" name="id" id="id" hidden>
						
						<!-- Hidden for UI tidyness as only needed for query-->
                        <input type="text" name="property_type" id="property_type" hidden>
					
                </fieldset>
            <!-- End Form Container -->
            </div>

            <!-- Submit/Reset buttons -->
            <div class = "myButton">
                <!-- Submit button is initially disabled, as user will only be able to submit details when in the amend state-->
                <input type="submit" value = "Update Record" name = "submit" class ="button" id="submit" disabled>
				<!-- Note, on click reset re-locks fields -->
                <input type="reset" value = "Reset" name = "reset" class ="button" onclick="toggleLock()">
            </div>
        </form>
    <!-- End Main Content Area -->
    </div>

</body>
</html>
