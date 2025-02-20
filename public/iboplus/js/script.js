document.addEventListener("DOMContentLoaded", function () {
    const strSportDropdown = document.getElementById("strSport");
    const idLeagueDropdown = document.getElementById("idLeague");
    const selectedStrLeagueInput = document.getElementById("selectedStrLeague");

    // Function to populate the strSport dropdown with data from a PHP endpoint
    function populateStrSportDropdown() {
        // Clear existing options
        strSportDropdown.innerHTML = "<option value=''>Select a Sport</option>";
        idLeagueDropdown.innerHTML = "<option value=''>Select a League</option>";

        fetch('js/fetch_leagues.php?getSport') // Replace with the actual PHP endpoint
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Populate the strSport dropdown with data from the response
                for (const sport of data) {
                    const option = document.createElement("option");
                    option.value = sport;
                    option.textContent = sport;
                    strSportDropdown.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Error fetching sports data:', error);
            });
    }

    // Function to populate the idLeague dropdown based on the selected sport
    function populateIdLeagueDropdown(selectedSport) {
        // Clear existing options
        idLeagueDropdown.innerHTML = "<option value=''>Select a League</option>";

        fetch('js/fetch_leagues.php?selectedSport=' + selectedSport) // Replace with the actual PHP endpoint
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                // Populate the idLeague dropdown with data from the response
                for (const league of data) {
                    const option = document.createElement("option");
                    option.value = league.idLeague;
                    option.textContent = league.strLeague;
                    idLeagueDropdown.appendChild(option);
                }
            })
            .catch(error => {
                console.error('Error fetching leagues data:', error);
            });
    }

    // Event listener for the idLeague dropdown
    idLeagueDropdown.addEventListener("change", function () {
        const selectedStrLeague = idLeagueDropdown.options[idLeagueDropdown.selectedIndex].text;

        // Update the hidden input field with the selected strLeague
        selectedStrLeagueInput.value = selectedStrLeague;
    });

    // Initial population of the strSport dropdown
    populateStrSportDropdown();

    // Event listener to update the idLeague dropdown when the sport is changed
    strSportDropdown.addEventListener("change", function () {
        const selectedSport = strSportDropdown.value;
        if (selectedSport) {
            populateIdLeagueDropdown(selectedSport);
        } else {
            // Clear the idLeague dropdown when no sport is selected
            idLeagueDropdown.innerHTML = "<option value=''>Select a League</option>";
        }
    });
});
