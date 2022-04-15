<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Employees</title>
</head>
<body>
    

    <h2>Manage employee</h2>

    <label for="firstName">First Name</label>
    <input type="text" id="firstName" name="firstName"> <br>

    <label for="lastName">Last Name</label>
    <input type="text" id="lastName" name="lastName"> <br>

    <label for="position">Position</label>
    <input type="text" id="position" name="position"> <br>

    <button id="add">Add</button>


    <br>
    <br>
    <br>
    <br>



    <table>
        <thead>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Position</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody id='tableBody'>

        </tbody>
    </table>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


    <script>
        $(document).ready(function() {

            $.ajax(
                '/getEmployees',
                {
                    type: 'GET',
                    success: function(data) {
                
                        let dataObj = JSON.parse(data);
                        let employees = dataObj.employees;

                        printEmployees(employees)

                    },
                    error: function(data) {
                        console.log("error")
                    },
                }
            );


            $('#add').click(function() {

                $.ajax(
                    '/insertEmployee',
                    {
                        type: 'POST',
                        data: {
                            'firstName': $('#firstName').val(),
                            'lastName': $('#lastName').val(),
                            'position': $('#position').val(),
                            _token: "{{ csrf_token() }}"

                        },
                        success: function(data) {
                            
                            let dataObj = JSON.parse(data);
                            let employee = dataObj.employee

                            let tr = document.createElement('tr');
                            $(tableBody).append(tr);
                            
                            let tdId = document.createElement('td');
                            $(tdId).text(employee.id);
                            $(tr).append(tdId);

                            let tdFirstName = document.createElement('td');
                            $(tdFirstName).text(employee.first_name);
                            $(tr).append(tdFirstName);

                            let tdLastName = document.createElement('td');
                            $(tdLastName).text(employee.last_name);
                            $(tr).append(tdLastName);

                            let tdPosition = document.createElement('td');
                            $(tdPosition).text(employee.position);
                            $(tr).append(tdPosition);
              

                            $('#firstName').val('');
                            $('#lastName').val('');
                            $('#position').val('');
                        },
                        error: function(data) {
                            console.log("error")
                        },
                    }


                );



            });


            function printEmployees(employees) {

                let tableBody = $('#tableBody');
                
                for (const key in employees) {
                    const element = employees[key];

                    let tr = document.createElement('tr');
                    $(tableBody).append(tr);
                    
                    let tdId = document.createElement('td');
                    $(tdId).text(element.id);
                    $(tr).append(tdId);

                    let tdFirstName = document.createElement('td');
                    $(tdFirstName).text(element.first_name);
                    $(tr).append(tdFirstName);

                    let tdLastName = document.createElement('td');
                    $(tdLastName).text(element.last_name);
                    $(tr).append(tdLastName);

                    let tdPosition = document.createElement('td');
                    $(tdPosition).text(element.position);
                    $(tr).append(tdPosition);

                }
            }


        });

    </script>

</body>
</html>