<?php
require "dbconnection.php";
$dbcon = createDbConnection();

//Määritellään muuttujat
$multiplier1 = 2;
$address1 = "1 Microsoft Way";

try{
    $dbcon->beginTransaction();

    //Kerrotaan osoitteen 1 "Total"-sarake loudulla $multiplier1 muuttujalla
    $statement = $dbcon->prepare("UPDATE invoices SET Total=Total*? WHERE BillingAddress=? ");
    $statement->execute(array($multiplier1, $address1));

    //Vaihdetaan kahden työntekijän ammatit employees taulussa
    $statement = $dbcon->prepare("UPDATE employees
    SET Title = CASE
    WHEN EmployeeId = 1 THEN (SELECT Title FROM employees WHERE EmployeeId = 2)
    WHEN EmployeeId = 2 THEN (SELECT Title FROM employees WHERE EmployeeId = 1)
    END
    WHERE EmployeeId IN (1, 2)");
    $statement->execute();

    $dbcon->commit();
}catch(Exception $e){

    $dbcon->rollback();

    echo $e->getMessage();
}
