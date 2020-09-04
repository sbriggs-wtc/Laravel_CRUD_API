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
            #nameInputTag, #courseInputTag {
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
                <td>Will return all students</td>
                <td>
                    N/A
                </td>
                <td><button onclick="get_api_students()">Request</button></td>
                <td id="get_api_students_response"></td>
            </tr>
            <tr>
                <td>GET</td>
                <td>/api/students/<input style="width: 30px;" id="api_students_id_input_tag" placeholder="ID" type="text" name="id"></td>
                <td>Will return a student record by referencing its ID</td>
                <td>
                    Please enter student ID in the URI field
                </td>
                <td><button onclick="get_api_students_id()">Request</button></td>
                <td id="get_api_students_id_response"></td>
            </tr>
            <tr>
                <td>POST</td>
                <td>/api/students</td>
                <td>Will create a new student record</td>
                <td>
                    <input id="nameInputTag" placeholder="Name" type="text" name="name"><br>
                    <input id="courseInputTag" placeholder="Course" type="text"  name="course"><br>
                </td>
                <td><button onclick="post_api_students()">Request</button></td>
                <td id="post_api_students_response"></td>
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
        formData.append("name", document.getElementById("nameInputTag").value);
        formData.append("course", document.getElementById("courseInputTag").value);
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
            console.log(data);
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
        let formData = new FormData();
        console.time("API request timer");
        fetch('http://localhost:3000/api/students', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById("get_api_students_response").innerHTML = "";
            data.forEach(e => {document.getElementById("get_api_students_response").innerHTML += `${e.id} ${e.name} ${e.course} ${e.created_at} ${e.updated_at}<br>`});
            console.timeEnd("API request timer");
            console.log("data:", data);
        })
        .catch(exception => console.log('Error: ', exception));
    }

    function get_api_students_id(){
        document.getElementById("info").innerHTML = document.getElementById("api_students_id_input_tag").value;
        if(document.getElementById("api_students_id_input_tag").value){
            console.log("nempty");
            
            let formData = new FormData();
            console.time("API request timer");
            console.log(document.getElementById("api_students_id_input_tag").value);
            fetch(`http://localhost:3000/api/students/${document.getElementById("api_students_id_input_tag").value}`, {
                method: 'GET',
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById("get_api_students_id_response").innerHTML = `${data[0].id} ${data[0].name} ${data[0].course} ${data[0].created_at} ${data[0].updated_at}<br>`;

                /* data.forEach(e => {document.getElementById("get_api_students_id_response").innerHTML += `${e.id} ${e.name} ${e.course} ${e.created_at} ${e.updated_at}<br>`}); */
                console.timeEnd("API request timer");
                console.log("data:", data);
            })
            .catch(exception => console.log('Error: ', exception));
        } else {
            console.log("empty");
        }
    }
    

    let sl = document.getElementById("sl");
</script>
</html>
