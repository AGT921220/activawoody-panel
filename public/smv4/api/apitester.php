<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>API Tester</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
          body {
            font-family: Arial, sans-serif;
            margin: 0; /* Remove default margin */
            background-color: black; /* Set the background color to black */
            color: #fff; /* Set text color to white */
        }


        header {
            background-color: #007BFF;
            color: #fff;
            text-align: center;
            padding: 20px;
        }

        h1 {
            margin: 0;
        }

        .test-button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            cursor: pointer;
        }

        .test-result {
            margin-top: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #f5f5f5
            color: black;;
        }
    </style>
</head>
<body>
    <header>
        <h1>API Tester</h1>
    </header>

    <h2>Test Your API</h2>
    <button class="test-button" onclick="testAPI('check-maintainencemode')">Check Maintenance Mode</button>
    <button class="test-button" onclick="testAPI('get_advertisemnt_status')">Get Advertisement Status</button>
    <button class="test-button" onclick="testAPI('get-advertisement')">Get Advertisement</button>
    <button class="test-button" onclick="testAPI('get-allcombinedashrequest')">Get allcombinedashrequest</button>
    <button class="test-button" onclick="testAPI('add-device')">Add Device</button>
    <button class="test-button" onclick="testAPI('addreport')">Get Reports</button>
    <button class="test-button" onclick="testAPI('addclientfeedback')">Client Feedback</button>
    <button class="test-button" onclick="testAPI('get-announcements')">Get Announcements</button>
    <button class="test-button" onclick="testAPI('get-ovpnzip')">Get Advertisement</button>
    <!-- Add buttons for other API endpoints as needed -->

    <div id="api-results" class="test-result"></div>

    <script>
        function testAPI(action) {
            $.ajax({
                url: 'api.php',  // Replace with the actual path to your API file
                method: 'POST',
                contentType: 'application/json',
                data: JSON.stringify({ action: action }),
                success: function(response) {
                    displayResult(JSON.stringify(response, null, 2));
                },
                error: function(xhr, status, error) {
                    displayResult(`Error: ${error}`);
                }
            });
        }

        function displayResult(result) {
            document.getElementById('api-results').innerHTML = `<pre>${result}</pre>`;
        }
    </script>
</body>
</html>
