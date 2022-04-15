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

    <button id="save" value="">Add</button>


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


            $('#save').click(function() {
                let id = $(this).val();

                if($(this).text() == 'Add') {
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
    
                                printEmployee(employee);
    
                            },
                            error: function(data) {
                                console.log("error")
                            },
                        }
                    );
                } else if($(this).text() == 'Update') {
                    $.ajax(
                        '/updateEmployee',
                        {
                            type: 'POST',
                            data: {
                                'firstName': $('#firstName').val(),
                                'lastName': $('#lastName').val(),
                                'position': $('#position').val(),
                                'id': id,
                                _token: "{{ csrf_token() }}"
    
                            },
                            success: function(data) {
                                
                                refreshTable(JSON.parse(data));
    
                            },
                            error: function(data) {
                                console.log("error")
                            },
                        }
                    );
                }
            });

            function refreshTable(data) {
                id = data.employee.id;

                $('#firstName'+id).text(data.employee.first_name);
                $('#lastName'+id).text(data.employee.last_name);
                $('#position'+id).text(data.employee.position);

                clearForm();


            }


            function printEmployee(employee) {
                // let tr = document.createElement('tr');
                // $(tableBody).append(tr);
                
                // let tdId = document.createElement('td');
                // $(tdId).text(employee.id);
                // $(tr).append(tdId);

                // let tdFirstName = document.createElement('td');
                // $(tdFirstName).text(employee.first_name);
                // $(tr).append(tdFirstName);

                // let tdLastName = document.createElement('td');
                // $(tdLastName).text(employee.last_name);
                // $(tr).append(tdLastName);

                // let tdPosition = document.createElement('td');
                // $(tdPosition).text(employee.position);
                // $(tr).append(tdPosition);

                let tr = document.createElement('tr');
                    $(tr).attr('id', 'row'+employee.id);
                    $(tableBody).append(tr);
                    
                    let tdId = document.createElement('td');
                    $(tdId).text(employee.id);
                    $(tr).append(tdId);

                    let tdFirstName = document.createElement('td');
                    $(tdFirstName).attr('id', 'firstName'+employee.id)
                    $(tdFirstName).text(employee.first_name);
                    $(tr).append(tdFirstName);

                    let tdLastName = document.createElement('td');
                    $(tdLastName).attr('id', 'lastName'+employee.id)
                    $(tdLastName).text(employee.last_name);
                    $(tr).append(tdLastName);

                    let tdPosition = document.createElement('td');
                    $(tdPosition).attr('id', 'position'+employee.id)
                    $(tdPosition).text(employee.position);
                    $(tr).append(tdPosition);

                    // print Edit Btn
                    let tdEBtnCont = document.createElement('td');
                    $(tr).append(tdEBtnCont);

                    let editBtn = document.createElement('button');
                    $(editBtn).text('Edit');
                    $(editBtn).attr('id', employee.id);
                    $(editBtn).addClass('editBtn');
                    $(editBtn).click(function() {
                        getEmployee(this.id);
                    });
                    $(tdEBtnCont).append(editBtn);

                    // print Delete Btn
                    let tdDBtnCont = document.createElement('td');
                    $(tr).append(tdDBtnCont);
                    
                    let deleteBtn = document.createElement('button');
                    $(deleteBtn).text('X');
                    $(deleteBtn).attr('id', employee.id);
                    $(deleteBtn).addClass('deleteBtn');
                    $(deleteBtn).click(function() {
                        deleteEmployee(this.id);
                    });
                    $(tdDBtnCont).append(deleteBtn);
              
                clearForm();

            }

            function printEmployees(employees) {

                let tableBody = $('#tableBody');
                
                for (const key in employees) {
                    const element = employees[key];

                    let tr = document.createElement('tr');
                    $(tr).attr('id', 'row'+element.id);
                    $(tableBody).append(tr);
                    
                    let tdId = document.createElement('td');
                    $(tdId).text(element.id);
                    $(tr).append(tdId);

                    let tdFirstName = document.createElement('td');
                    $(tdFirstName).attr('id', 'firstName'+element.id)
                    $(tdFirstName).text(element.first_name);
                    $(tr).append(tdFirstName);

                    let tdLastName = document.createElement('td');
                    $(tdLastName).attr('id', 'lastName'+element.id)
                    $(tdLastName).text(element.last_name);
                    $(tr).append(tdLastName);

                    let tdPosition = document.createElement('td');
                    $(tdPosition).attr('id', 'position'+element.id)
                    $(tdPosition).text(element.position);
                    $(tr).append(tdPosition);

                    // print Edit Btn
                    let tdEBtnCont = document.createElement('td');
                    $(tr).append(tdEBtnCont);

                    let editBtn = document.createElement('button');
                    $(editBtn).text('Edit');
                    $(editBtn).attr('id', element.id);
                    $(editBtn).addClass('editBtn');
                    $(editBtn).click(function() {
                        getEmployee(this.id);
                    });
                    $(tdEBtnCont).append(editBtn);

                    // print Delete Btn
                    let tdDBtnCont = document.createElement('td');
                    $(tr).append(tdDBtnCont);
                    
                    let deleteBtn = document.createElement('button');
                    $(deleteBtn).text('X');
                    $(deleteBtn).attr('id', element.id);
                    $(deleteBtn).addClass('deleteBtn');
                    $(deleteBtn).click(function() {
                        deleteEmployee(this.id);
                    });
                    $(tdDBtnCont).append(deleteBtn);

                    // informativno :) 
                    // let trString = '<tr><td>'+element.id+'</td><td>'+element.firstName+'</td><td>'+element.last_name+'</td><td>'+element.position+'</td></tr>';
                    // $(tableBody).append(trString);
                }
            }


            function getEmployee(id) {

                $.ajax(
                    '/getEmployee',
                    {
                        type: 'GET',
                        data: {
                            id: id, 
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            data = JSON.parse(data);

                            if(data.success == true) {
                                populateFields(data);
                            }
                        },
                        error: function() {
                            console.log('error');
                        }
                    }
                )

            }

            function deleteEmployee(id) {
                $.ajax(
                    '/deleteEmployee',
                    {
                        type: 'POST',
                        data: {
                            id: id, 
                            _token: "{{ csrf_token() }}"
                        },
                        success: function(data) {
                            data = JSON.parse(data);

                            if(data.success == true) {
                                deleteRow(id);
                            }
                        },
                        error: function() {
                            console.log('error');
                        }
                    }
                )
            }

            function populateFields(data) {
                $('#firstName').val(data.employee.first_name);
                $('#lastName').val(data.employee.last_name);
                $('#position').val(data.employee.position);
                
                $('#save').val(data.employee.id);
                $('#save').text('Update');
            }

            function deleteRow(id) {
                $('#row'+id).remove();
            }

            function clearForm() {
                $('#firstName').val('');
                $('#lastName').val('');
                $('#position').val('');

                $('#save').val();
                $('#save').text('Add');
            }


        });

    </script>

</body>
</html>