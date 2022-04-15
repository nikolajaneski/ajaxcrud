<?php


if(isset($_GET['action']) || isset($_POST['action'])) {


    if($_GET['action'] == 'getAll') {

        $sql = 'SELECT * FROM employees';

        $stm =$pdo->prepare($sql);
        $stm->execute();

        $employees = $stm->fetcAll(PDO::FETCH_ASSOC);

        echo json_encode(['employees' => $employees]);
    }


    if($_POST['action'] == 'insert') {

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $position = $_POST['position'];

        
        $sql = 'INSERT INTO employees 
        (first_name, last_name, position)
        VALUES (:first_name, :last_name, :position)';

        $stm =$pdo->prepare($sql);
        $stm->execute();

        $employee = $pdo->lastInsertId();

        $sql = "SELECT * FROM employees WHERE id = :id ";
        
        $stm =$pdo->prepare($sql);
        $stm->execute();
        
        $employee = $stm->fetcAll(PDO::FETCH_ASSOC);

        echo json_encode(['employee' => $employee]);
    }



}