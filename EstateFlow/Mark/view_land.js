//Name: Mark Lambert
//Student ID: C00192497
//Purpose: JavaScript file for view/amend a land property
//Date: February 2025
//EstateFlow Y2 Project 2025

// // Function confirmCheck() prompts user to confirm if the want to save the changes
function confirmCheck()
{
    var response = confirm('Confirm Update?');
	console.log("User response:", response); // Log the user's response
    return response; // Return the response directly
	if(response)
	{
		document.getElementById("property_type").disabled = false;
		return true;
	}
	else
	{
		populate();
		toggleLock();
		return false;
	}
}
// Function populate which populates the textboxes when the desired user is selected from the listbox
function populate()
{
    // Selected person is got by the element with id listbox
    var sel = document.getElementById("listbox");
    var result;
    // Returns the value of the selected item in the listbox by going to the index in the listbox and calling .value
    result = sel.options[sel.selectedIndex].value;
    // Split the details by using the , as a delimeter
    var landDetails = result.split('#');

	//Check if the user has clicked an entry on the listbox
	if(!(landDetails[0] == "none")){
		//If they have, then we can enable the amendView button
		document.getElementById("amendViewbutton").disabled = false;
        document.getElementById("property_type").value = landDetails[0];
		//Address values get split using a seperate delimeter, the ', ' sequence of characters
        document.getElementById("adrs").value = landDetails[1].split(', ')[0];
		
		//Check if the split details have a value, if they are null, give them a default value
		//ensuring that "undefined" isn't displayed
		if((landDetails[1].split(', ')[1] == null)){ 
			document.getElementById("adrs2").value = "";
			document.getElementById("adrs3").value = "";
		}else{
			document.getElementById("adrs2").value = landDetails[1].split(', ')[1];
			document.getElementById("adrs3").value = landDetails[1].split(', ')[2];
		}
		
        document.getElementById("eircode").value = landDetails[2];
        document.getElementById("location").value = landDetails[3];
        document.getElementById("status").value = landDetails[4];
        document.getElementById("owner").value = landDetails[5];
        document.getElementById("bid").value = landDetails[6];
        document.getElementById("price").value = landDetails[7];
        document.getElementById("viewing_times").value = landDetails[8];
        document.getElementById("property_id").value = landDetails[9];
        document.getElementById("id").value = landDetails[10];
        document.getElementById("acres").value = landDetails[11];
        document.getElementById("ownerName").value = landDetails[12];
        document.getElementById("buildings").value = landDetails[13];
        document.getElementById("details").value = landDetails[14];
        document.getElementById("quotas").value = landDetails[15];
        document.getElementById("notes").value = landDetails[16];
	}

}

// Function toggleLock() is called onload, locking all fields until the user selects a client first
function toggleLock()
{	
	//Set title
	document.title = "EstateFlow - Amend Land";
	//Set a href class to button selected for specified page
	document.getElementById("amendLand").className = "button selected";
	
    // Checkls if the user has first actually selected a property, which will be known if the Property Type field is populated with "Land", otherwise, 
    // if it reads none, null, undefined etc it wont allow the user to insert/amend 
	if(document.getElementById("property_type").value == "Land")
	{	
		document.getElementById("submit").disabled = false;
		document.getElementById("amendViewbutton").disabled = false;
	}
	
	//If the button reads Amend Details, then we are in the View Details state, so lock all the fields
	//also checks if property_id has a value, otherwise, don't allow the body onload tag to execute, as it would cause the form to unlock
	if(document.getElementById("amendViewbutton").value == "Amend Details" && document.getElementById("property_id").value > 0){

		document.getElementById("adrs").disabled = false;
		document.getElementById("adrs2").disabled = false;
		document.getElementById("adrs3").disabled = false;
		document.getElementById("eircode").disabled = false;
		document.getElementById("location").disabled = false;
		document.getElementById("price").disabled = false;
		document.getElementById("viewing_times").disabled = false;
		document.getElementById("buildings").disabled = false;
		document.getElementById("acres").disabled = false;
		document.getElementById("details").disabled = false;
		document.getElementById("quotas").disabled = false;
		document.getElementById("notes").disabled = false;
		document.getElementById("ownerName").disabled = false;
		// Set focus to the eircode field
        document.getElementById('eircode').focus();
		//Change the button to View Details
		document.getElementById("amendViewbutton").value = "View Details";
	}
	else
	{
		unlock();	
	}
}

function lock(){
	//If the button reads Amend Details, then we are in the View Details state, so lock all the fields
	//also checks if property_id has a value, otherwise, don't allow the body onload tag to execute, as it would cause the form to unlock
	if(document.getElementById("amendViewbutton").value == "View Details"){
		document.getElementById("adrs").disabled = true;
		document.getElementById("adrs2").disabled = true;
		document.getElementById("adrs3").disabled = true;
		document.getElementById("eircode").disabled = true;
		document.getElementById("location").disabled = true;
		document.getElementById("price").disabled = true;
		document.getElementById("viewing_times").disabled = true;
		document.getElementById("buildings").disabled = true;
		document.getElementById("acres").disabled = true;
		document.getElementById("details").disabled = true;
		document.getElementById("quotas").disabled = true;
		document.getElementById("notes").disabled = true;
		document.getElementById("ownerName").disabled = true;
	
		//Change the button to View Details
		document.getElementById("amendViewbutton").value = "Amend Details";
				//Change the button to View Details
		document.getElementById("amendViewbutton").disabled = true;
				//Change the button to View Details
		document.getElementById("submit").disabled = true;
	}	
}

function unlock()
{
		    document.getElementById("adrs").disabled = true;
			document.getElementById("adrs2").disabled = true;
			document.getElementById("adrs3").disabled = true;
			document.getElementById("eircode").disabled = true;
			document.getElementById("location").disabled = true;
			document.getElementById("status").disabled = true;
			document.getElementById("bid").disabled = true;
			document.getElementById("price").disabled = true;
			document.getElementById("viewing_times").disabled = true;
			document.getElementById("buildings").disabled = true;
			document.getElementById("acres").disabled = true;
			document.getElementById("details").disabled = true;
			document.getElementById("quotas").disabled = true;
			document.getElementById("notes").disabled = true;
			document.getElementById("ownerName").disabled = true;
		
			//Enable the submit button when in amend mode
			document.getElementById("submit").disabled = true;

			document.getElementById("amendViewbutton").value = "Amend Details";
	}



// Function filterAll() resets the listbox back to no filtered state
function filterAll()
{
	var options = document.getElementById("listbox");
    // Returns the value of the selected item in the listbox by going to the index in the listbox and calling .value
	for(var i = 0; i < options.length; i++)
	{
			if(options[i].hidden)
			{
				options[i].hidden = false;	
			}
		}
		//Enable both buttons
		document.getElementById("filterSold").disabled = false;
		document.getElementById("filterNotSold").disabled = false;
	}

// Function filterrBySold() hides all options that are currently NOT SOLD
function filterBySold()
{
	filterAll();
	var options = document.getElementById("listbox");
	var result;
    // Returns the value of the selected item in the listbox by going to the index in the listbox and calling .value
	for(var i =0; i < options.length; i++)
	{
		result = options.options[i].value;
		// Split the details by using the # as a delimeter
		var landDetails = result.split('#');
		//Disable any property that is tagged with a 0 (meaning any properties NOT SOLD get disabled)
		if(landDetails[4] == 0)
		{
			options[i].hidden = true;
		}
	}
	//Disable filterSold button
	document.getElementById("filterSold").disabled = true;
	document.getElementById("filterNotSold").disabled = false;
}

//Function filterByNotSold() hides all elements that ARE SOLD or SALE AGREED
function filterByNotSold()
{
	filterAll();
	var options = document.getElementById("listbox");
	var result;
    // Returns the value of the selected item in the listbox by going to the index in the listbox and calling .value
	for(var i =0; i < options.length; i++)
	{
		result = options.options[i].value;
		// Split the details by using the # as a delimeter
		var landDetails = result.split('#');
		//Disable any properties that ARE sold or sale agreed
		if(landDetails[4] != 0)  
		{
			options[i].hidden = true;
		}
	}
	
	//Disable filterNotSold button
	document.getElementById("filterNotSold").disabled = true;
	document.getElementById("filterSold").disabled = false;
}



