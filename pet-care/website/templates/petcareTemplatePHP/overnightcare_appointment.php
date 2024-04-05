<!DOCTYPE html>
<html>
    <head>
        <title>Overnight Care Appointment</title>
    </head>
    <body>
        <div class="padding">
        <body style="background-color: LightCyan;">
        <center><h1><img src="petcare_logo.png" alt="Logo" class="logo" width="150" height="150"> <br> Waggle & Snuggle Lodge</h1> <h2>Overnight Care Appointment</h2></center>
        <div style="padding: 30px; background-color: LightBlue; border-radius:10px;">
            <div class="container"></div>
            <form action="confirmed_oc.php" method="POST" onsubmit="return calculateTotal()">
            <div style="display: flex; flex-wrap: wrap;">
                    <div style="flex: 1; margin-right: 30px;"> 
                    <p><b>Pet Details</b></p>
                    <!-- Pet Name -->
                    <label for="name">Pet Name:</label><br> 
                    <input type="text" id="name" name="name" required><br><br>
                    <!-- Pet Age -->
                    <label for="age">Pet Age:</label><br> 
                    <input type="text" id="age" name="age" required><br><br> 
                    <!-- Pet Type/Breed -->
                    <label for="type">Pet Type:</label><br> 
                    <input type="text" id="type" name="type" required><br><br>
                    <!-- Pet Gender -->
                    <label for="gender">Pet Gender:</label><br> 
                    <input type="gender" id="gender" name="gender" required><br><br>
                    <!-- Pet Color -->
                    <label for="color">Pet Color:</label><br> 
                    <input type="text" id="color" name="color" required><br><br>
                    </div>

                    <!-- Setting Appointment for Drop-Off & Pick Up -->
                    <div style="flex: 1; margin-right: 30px;"> 
                    <p><b>Appointment Date</b></p>
                    <!-- Set Drop-Off Date -->
                    <label for="d_date">Date for Drop-off:</label><br>
                    <input type="date" id="d_date" name="d_date" required><br><br>
                    <!-- Set Drop-Off Time -->
                    <label for="d_time">Time for Drop-off:</label><br>
                    <input type="time" id="d_time" name="d_time" required><br><br>
                    <!-- Set Pick-Up Date -->
                    <label for="p_date">Date for Pick-Up:</label><br>
                    <input type="date" id="p_date" name="p_date" required><br><br>
                    <!-- Set Pick-Up Time -->
                    <label for="p_time">Time for Pick-Up:</label><br>
                    <input type="time" id="p_time" name="p_time" required><br><br>
                    <!-- Duration Time -->
                    <button type="button" onclick="calculateDuration()">Calculate Duration</button>
                    <!-- Duration Cost -->
                    <input type="hidden" id="total_cost" name="total_cost" value="">

                </div>

                <div id="durationOutput"></div>
                <!-- 1st User-Defined Function -->
                <script>
                    function calculateDuration() {
                        var dropOffDate = new Date(document.getElementById("d_date").value);
                        var dropOffTime = document.getElementById("d_time").value;
                        var pickUpDate = new Date(document.getElementById("p_date").value);
                        var pickUpTime = document.getElementById("p_time").value;

                        // Date Objects from date and time values
                        var dropOffDateTime = new Date(dropOffDate.getFullYear(), dropOffDate.getMonth(), dropOffDate.getDate(), dropOffTime.split(':')[0], dropOffTime.split(':')[1]);
                        var pickUpDateTime = new Date(pickUpDate.getFullYear(), pickUpDate.getMonth(), pickUpDate.getDate(), pickUpTime.split(':')[0], pickUpTime.split(':')[1]);

                        // Shows how is the computation for the duration hours
                        var durationMs = pickUpDateTime - dropOffDateTime;
                        var durationHours = durationMs / (1000*60*60);

                        // Drop-Off and PickUp 
                        if (durationHours < 0) {
                        // A 24 hours duration for overnight stays
                        durationHours += 24;
                        }
                       
                        // Calculated Duration
                        document.getElementById("durationOutput").innerHTML = "Duration: " + durationHours.toFixed(2) + " hours";

                        return durationHours;
                    }
                </script>

                <!-- 2nd User-Defined Function -->
                <div id="totalCostOutput"></div>
                  <script>
                    function calculateTotalCost() {
                        // Shows how is the computation for the duration cost
                        var durationHours = calculateDuration();
                        var ratePerHour = 50;
                        var totalCost = durationHours * ratePerHour;

                        // Calculated Cost
                        document.getElementById("totalCostOutput").innerHTML = "Total Cost: $" + totalCost.toFixed(2);

                        return true;
                    }
                  </script>
                  
                    <!-- We need to know if the pet has allergies -->
                    <div style="flex: 1; margin-right: 30px;">
                    <p><b>Health Condition</b></p>
                    <!-- Food Allergies -->
                    <input type="checkbox" id="food_allergy_checkbox" name="food" onchange="toggleInput('food')"> <label for="food">Food Allergy</label><br>
                    <input type="text" id="food" placeholder="Please specify" name="food" style="display: none;"><br>
                    <!-- Skin Allergies -->
                    <input type="checkbox" id="skin_allergy_checkbox" name="skin" onchange="toggleInput('skin')"> <label for="skin">Skin Allergy</label><br>
                    <input type="text" id="skin" placeholder="Please specify" name="skin" style="display: none;"><br>
                    <!-- Medicine Allergies -->
                    <input type="checkbox" id="med_allergy_checkbox" name="med" onchange="toggleInput('med')"> <label for="med">Medicine Allergy</label><br>
                    <input type="text" id="med" placeholder="Please specify" name="med" style="display: none;"><br>
                    <!-- Check if None -->
                    <input type="checkbox" id="none_checkbox" name="none" onchange="toggleInput('none')"> <label for="none">Others</label><br>
                    <input type="text" id="none" placeholder="Type None" name="none" style="display: none;"><br>

                    <!-- If the checkbox is check it will display another text to specify the allergy of the pet -->
                    <!--3rd User-Defined Function -->
                    <script>
                        function toggleInput(inputId){
                            var inputField = document.getElementById(inputId);
                            inputField.style.display = inputField.style.display === 'none' ? 'inline-block' : 'none';
                        }
                    </script>
                    </div>

                    <!-- Feeding Selection -->
                    <div style="flex: 1; margin-right: 30px;"> 
                    <p><b>Food Flavors</b></p>
                    <!-- Flavors  -->
                    <input type="radio" id="beef_radio" name="flavor" value="Beef"> <label for="beef">Beef</label><br><br>
                    <input type="radio" id="chicken_radio" name="flavor" value="Chicken"> <label for="chicken">Chicken</label><br><br>
                    <input type="radio" id="fish_radio" name="flavor" value="Fish"> <label for="fish">Fish</label><br><br>
                    <input type="radio" id="liver_radio" name="flavor" value="Liver"> <label for="liver">Liver</label><br><br>
                    <input type="radio" id="other_radio" name="flavor" value="Other"> <label for="other">Others:</label> <input type="text" id="otherText" placeholder="Please specify" name="other"> <br><br>
                    <!-- Set a first Feeding Schedule -->
                    <p><b>Feeding Schedule</b></p>
                    <label for="firstDropdown">First Feeding Time:</label>
                    <select id="firstDropdown" onchange="handleSelection('firstDropdown', 'secondDropdown')">
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                    </select><br>
                    <input type="time" id="first_time" name="first_time"><br><br>
                   
                    <label for="secondDropdown">Second Feeding Time:</label>
                    <select id="secondDropdown"></select><br>
                    <input type="time" id="second_time" name="second_time"><br><br>

                    <!-- 4th User-Defined Function -->
                    <script>
                        function handleSelection(firstId, secondId) {
                            var firstDropdown = document.getElementById(firstId);
                            var secondDropdown = document.getElementById(secondId);
                        
                            secondDropdown.innerHTML = " ";

                            var selectedOption = firstDropdown.value;

                            if(selectedOption === "breakfast") {
                                addOption(secondDropdown, "lunch", "Lunch");
                                addOption(secondDropdown, "dinner", "Dinner");
                            } else if (selectedOption === "lunch") {
                                addOption(secondDropdown, "breakfast", "Breakfast");
                                addOption(secondDropdown, "dinner", "Dinner");
                            } else if (selectedOption === "dinner") {
                                addOption(secondDropdown, "breakfast", "Breakfast");
                                addOption(secondDropdown, "lunch", "Lunch");
                            }
                        }

                        /*5th User-Defined Function*/
                        function addOption(selectElement, value, text) {
                            var option = document.createElement("option");
                            option.value = value;
                            option.text = text || value;
                            selectElement.appendChild(option);
                        }
                        
                    </script>
                    </div>
                   
                    <!-- Additional Services -->
                    <div style="flex: 1; margin-right: 30px;">
                    <p><b>Grooming</b></p>
                    <!-- Haircut -->
                    <input type="checkbox" id="haircut" name="haircut"> <label for="haircut">Hair Cut</label><br><br>                  
                    <!-- Trim Nails -->
                    <input type="checkbox" id="nails" name="nails"> <label for="nails">Trim Nails</label><br><br>                   
                    <!-- Ear Cleaning -->
                    <input type="checkbox" id="ear" name="ear"> <label for="ear">Ear Cleaning</label><br><br>       
                    <!-- Tooth Brush -->
                    <input type="checkbox" id="tooth" name="tooth"> <label for="tooth">Tooth Brush</label><br><br>              
                    </div>

                    <!-- Additional Services -->
                    <div style="flex: 1; margin-right: 30px;">
                    <p><b>Night Time Routine</b></p>
                    <!-- Special Bed Night Routine -->
                    <label for="fav">Favourite toys/ Blanket/ Comfort Item</label><br> 
                    <input type="text" id="fav" name="fav" required><br><br>
                    <label for="treat">Favourite Treats / Snacks</label><br> 
                    <input type="text" id="treat" name="treat" required><br><br>
                    <!-- Night Routine -->
                    <label for="nyt">Night Routine: </label><br> 
                    <input type="text" id="nyt" name="nyt" required><br><br> 
                    </div>

                    <div style="flex: 1; margin-right: 30px;">
                    <p><b>Emergency Details</b></p>
                    <!-- Owners Name -->
                    <label for="oname">Owner's Name:</label><br> 
                    <input type="text" id="oname" name="oname" required><br><br>
                    <!-- Contact Number -->
                    <label for="num">Contact Number:</label><br> 
                    <input type="number" id="num" name="num" required><br><br> 
                    <!-- Address -->
                    <label for="add">Address:</label><br> 
                    <input type="text" id="add" name="add" required><br><br> 
                    </div>

                    <label for="duration"></label>
                <!-- Reset and Submit Button -->
                <div style="text-align: center; width: 100%;"> <input type="reset" value="Reset">&nbsp;<input type="submit" value="Submit"></div>
                </form>

        </div>
    </body>
</html>

