document.getElementById("userForm").addEventListener("submit", function(event) {
    event.preventDefault();

    var userId = document.getElementById("userId").value;

    // Construct the SQL query
    var sql = "SELECT * FROM users WHERE id = '" + userId + "'";

    // Make a request to a server-side script to execute the SQL query
    var request = new XMLHttpRequest();
    request.open("GET", "query.php?sql=" + encodeURIComponent(sql), true);
    request.onreadystatechange = function() {
        if (request.readyState == 4 && request.status == 200) {
            var response = JSON.parse(request.responseText);
            if (response.success) {
                var resultDiv = document.getElementById("result");
                resultDiv.innerHTML = "";
                response.data.forEach(function(row) {
                    resultDiv.innerHTML += "id: " + row.id + " - Name: " + row.name + "<br>";
                });
            } else {
                alert("Error: " + response.error);
            }
        }
    };
    request.send();
});
