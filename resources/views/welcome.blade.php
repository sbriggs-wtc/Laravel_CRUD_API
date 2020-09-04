<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel API</title>

        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            #postNameInputTag, #postCourseInputTag {
                float: right;
            }
        </style>
    </head>
    <body>
    <div>
        <h1>Endpoints:</h1>
        <span>GET /api/students will return all students and will be accepting GET requests.</span><br/>
        <span>GET /api/students/{id} will return a student record by referencing its id and will be accepting GET requests.</span><br/>
        <span>POST /api/students will create a new student record and will be accepting POST requests.</span><br/>
        <span>PUT /api/students/{id} will update an existing student record by referencing its id and will be accepting PUT requests.</span><br/>
        <span>DELETE /api/students/{id} will delete a student record by referencing its id and will be accepting DELETE requests.</span><br/>
        <table>
            <tr>
                <th>Method</th>
                <th>URI</th>
                <th>Description</th>
                <th>Payload</th>
                <th>Action</th>
                <th>Response</th>
            </tr>
            <tr>
                <td>GET</td>
                <td>/api/students</td>
                <td>Return all students</td>
                <td>
                    N/A
                </td>
                <td><button onclick="get_api_students()">Request</button></td>
                <td id="get_api_students_response"></td>
            </tr>
            <tr>
                <td>GET</td>
                <td>/api/students/<input style="width: 30px;" id="get_api_students_id_input_tag" placeholder="ID" type="text"></td>
                <td>Return a student record by referencing its ID</td>
                <td>
                    Please enter student ID in the URI field
                </td>
                <td><button onclick="get_api_students_id()">Request</button></td>
                <td id="get_api_students_id_response"></td>
            </tr>
            <tr>
                <td>POST</td>
                <td>/api/students</td>
                <td>Create a new student record</td>
                <td>
                    <input id="postNameInputTag" placeholder="Name" type="text"><br>
                    <input id="postCourseInputTag" placeholder="Course" type="text"><br>
                </td>
                <td><button onclick="post_api_students()">Request</button></td>
                <td id="post_api_students_response"></td>
            </tr>
            <tr>
                <td>PUT</td>
                <td>/api/students/<input style="width: 30px;" id="put_api_students_id_input_tag" placeholder="ID" type="text"></td>
                <td>Update an existing student record by referencing its id</td>
                <td>
                    <input id="putNameInputTag" placeholder="Name" type="text"><br>
                    <input id="putCourseInputTag" placeholder="Course" type="text"><br>
                </td>
                <td><button onclick="put_api_students_id()">Request</button></td>
                <td id="put_api_students_id_response"></td>
            </tr>
            <tr>
                <td>DELETE</td>
                <td>/api/students/<input style="width: 30px;" id="delete_api_students_id_input_tag" placeholder="ID" type="text"></td>
                <td>Delete a student record by referencing its id</td>
                <td>N/A</td>
                <td><button onclick="delete_api_students_id()">Request</button></td>
                <td id="delete_api_students_id_response"></td>
            </tr>
        </table>
    </div>
    <div id="info">
        <h1>Info:</h1>
        <!-- <span>asdf</span> -->
    </div>
</body>
<script>
    function post_api_students(){
        let formData = new FormData();
        formData.append("name", document.getElementById("postNameInputTag").value);
        formData.append("course", document.getElementById("postCourseInputTag").value);
        console.time("API request timer");
        fetch('http://localhost:3000/api/students', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            /* document.getElementById("info").innerHTML += `${data.message}<br>` */
            document.getElementById("post_api_students_response").innerHTML = `${data.message}`
            console.timeEnd("API request timer");
            switch (data.statusCode) {
                case "200": console.log("200");break;
                case "201": console.log("201");break;
                case "202": console.log("202");break;
                case "404": console.log("404");break;
                case "500": console.log("404");break;
                default:console.log("Something went wrong");break;
            }   
        })
        .catch(exception => console.log('Error: ', exception));
    }

    function get_api_students(){
        console.time("API request timer");
        fetch('http://localhost:3000/api/students', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("get_api_students_response").innerHTML = "";
            data.forEach(e => {document.getElementById("get_api_students_response").innerHTML += `${e.id} ${e.name} ${e.course} ${e.created_at} ${e.updated_at}<br>`});
            console.timeEnd("API request timer");
        })
        .catch(exception => console.log('Error: ', exception));
    }

    function get_api_students_id(){
        document.getElementById("info").innerHTML += document.getElementById("get_api_students_id_input_tag").value;
        if(document.getElementById("get_api_students_id_input_tag").value){
            console.time("API request timer");
            fetch(`http://localhost:3000/api/students/${document.getElementById("get_api_students_id_input_tag").value}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("get_api_students_id_response").innerHTML = `${data[0].id} ${data[0].name} ${data[0].course} ${data[0].created_at} ${data[0].updated_at}<br>`;

                /* data.forEach(e => {document.getElementById("get_api_students_id_response").innerHTML += `${e.id} ${e.name} ${e.course} ${e.created_at} ${e.updated_at}<br>`}); */
                console.timeEnd("API request timer");
            })
            .catch(exception => console.log('Error: ', exception));
        } else {
            console.log("empty");
        }
    }
    function put_api_students_id(){
        document.getElementById("info").innerHTML += document.getElementById("get_api_students_id_input_tag").value;
        if(document.getElementById("put_api_students_id_input_tag").value){
            console.time("API request timer");
            fetch(`http://localhost:3000/api/students/${document.getElementById("put_api_students_id_input_tag").value}`, {
                method: 'PUT',
                headers: {"Content-Type" : "application/json; charset=UTF-8"},
                body: JSON.stringify({"name": `${document.getElementById("putNameInputTag").value}`, "course": `${document.getElementById("putCourseInputTag").value}`}),
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("put_api_students_id_response").innerHTML = `${data.message}<br>`;
                console.timeEnd("API request timer");
            })
            .catch(exception => console.log('Error: ', exception));
        } else {
            document.getElementById("put_api_students_id_response").innerHTML = "Please provide a student ID";
        }
    }

    
</script>
</html>
