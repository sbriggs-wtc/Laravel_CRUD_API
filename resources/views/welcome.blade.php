<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel API</title>
        <!-- <link rel="stylesheet" href="./app/public/sass/myStyle.css"/> -->
        <style>
            body {
                font-family: monospace;
            }
            table, th, td {
            border: 1px solid black;
                border-collapse: collapse;
            }
            /* body {
                background: black;
                color: green;
                font-family: sans-serif;
                font-family: monospace;
            }
            table, th, td {
            border: 1px solid green;
                border-collapse: collapse;
            } */
            /* input {
                border: 2px solid black;
            }
            input::placeholder {
                background: green;
                color: black;
            } */
        </style>
    </head>
    <body>
    <div>
        <h1>Endpoints:</h1>
        <table>
            <tr>
                <th>Method</th>
                <th>URI</th>
                <th>Description</th>
                <th>Payload</th>
                <th>Action</th>
                <th>JSON Response</th>
            </tr>
            <tr>
                <td>GET</td>
                <td>/api/students</td>
                <td>Return all student records</td>
                <td>
                    N/A
                </td>
                <td><button onclick="get_api_students()">Request</button></td>
                <td id="get_api_students_response"></td>
            </tr>
            
            <tr>
                <td>POST</td>
                <td>/api/students</td>
                <td>Create a new student record</td>
                <td>
                    <input id="postNameInputTag" placeholder="Name" type="text">
                    <input id="postCourseInputTag" placeholder="Course" type="text">
                </td>
                <td><button onclick="post_api_students()">Request</button></td>
                <td id="post_api_students_response"></td>
            </tr>
            <tr>
                <td>GET</td>
                <td>/api/students/<input style="width: 30px;" id="get_api_students_id_input_tag" placeholder="ID" type="text"></td>
                <td>Return a student record by referencing its ID</td>
                <td>
                    N/A
                </td>
                <td><button onclick="get_api_students_id()">Request</button></td>
                <td id="get_api_students_id_response"></td>
            </tr>
            <tr>
                <td>PUT</td>
                <td>/api/students/<input style="width: 30px;" id="put_api_students_id_input_tag" placeholder="ID" type="text"></td>
                <td>Update an existing student record by referencing its ID</td>
                <td>
                    <input id="putNameInputTag" placeholder="Name" type="text">
                    <input id="putCourseInputTag" placeholder="Course" type="text">
                </td>
                <td><button onclick="put_api_students_id()">Request</button></td>
                <td id="put_api_students_id_response"></td>
            </tr>
            <tr>
                <td>DELETE</td>
                <td>/api/students/<input style="width: 30px;" id="delete_api_students_id_input_tag" placeholder="ID" type="text"></td>
                <td>Delete a student record by referencing its ID</td>
                <td>N/A</td>
                <td><button onclick="delete_api_students_id()">Request</button></td>
                <td id="delete_api_students_id_response"></td>
            </tr>
        </table>
    </div>
</body>
<script>
    function get_api_students(){
        console.time("API request timer");
        fetch('http://localhost:3000/api/students', {
            method: 'GET',
        })
        .then(response => { console.timeEnd("API request timer"); return response.json()})
        .then(data => { document.getElementById("get_api_students_response").innerHTML = JSON.stringify(data);})
        .catch(exception => console.error('Error: ', exception));
    }
    function post_api_students(){
        let formData = new FormData();
        formData.append("name", document.getElementById("postNameInputTag").value);
        formData.append("course", document.getElementById("postCourseInputTag").value);
        console.time("API request timer");
        fetch('http://localhost:3000/api/students', {
            method: 'POST',
            body: formData,
        })
        .then(response => { console.timeEnd("API request timer"); return response.json()})
        .then(data => { document.getElementById("post_api_students_response").innerHTML = JSON.stringify(data);})
        .catch(exception => console.error('Error: ', exception));
    }
    function get_api_students_id(){
        if(document.getElementById("get_api_students_id_input_tag").value){
            console.time("API request timer");
            fetch(`http://localhost:3000/api/students/${document.getElementById("get_api_students_id_input_tag").value}`, {
                method: 'GET',
            })
            .then(response => { console.timeEnd("API request timer"); return response.json()})
            .then(data => { document.getElementById("get_api_students_id_response").innerHTML = JSON.stringify(data);})
            .catch(exception => console.error('Error: ', exception));
        } else {
            document.getElementById("get_api_students_id_response").innerHTML = "Please provide a student ID in the URI field.";
        }
    }
    function put_api_students_id(){
        if(document.getElementById("put_api_students_id_input_tag").value){
            console.time("API request timer");
            fetch(`http://localhost:3000/api/students/${document.getElementById("put_api_students_id_input_tag").value}`, {
                method: 'PUT',
                headers: {"Content-Type" : "application/json; charset=UTF-8"},
                body: JSON.stringify({"name": `${document.getElementById("putNameInputTag").value}`, "course": `${document.getElementById("putCourseInputTag").value}`}),
            })
            .then(response => { console.timeEnd("API request timer"); return response.json() })
            .then(data => { document.getElementById("put_api_students_id_response").innerHTML = JSON.stringify(data); })
            .catch(exception => console.error('Error: ', exception));
        } else {
            document.getElementById("put_api_students_id_response").innerHTML = "Please provide a student ID in the URI field.";
        }
    }
    function delete_api_students_id(){
        if(document.getElementById("delete_api_students_id_input_tag").value){
            console.time("API request timer");
            fetch(`http://localhost:3000/api/students/${document.getElementById("delete_api_students_id_input_tag").value}`, {
                method: 'DELETE',
            })
            .then(response => { console.timeEnd("API request timer"); return response.json()})
            .then(data => { document.getElementById("delete_api_students_id_response").innerHTML = JSON.stringify(data); })
            .catch(exception => console.error('Error: ', exception));
        } else {
            document.getElementById("delete_api_students_id_response").innerHTML = "Please provide a student ID in the URI field.";
        }
    }
</script>
</html>
