<?php

require_once 'db.php';

class Customer
{
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Methods: GET");

    //  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // get posted data
    function createCustomer(
        $firstName,
        $lastName,
        $company,
        $address,
        $city,
        $state,
        $country,
        $postalCode,
        $phone,
        $fax,
        $email,
        $password,
        $password_repeat
    ) {

        global $dbConn;

        //check if password and password repeat is the same
        if ($password == $password_repeat) {

            //hash the password
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);




            // check if some of the data are null or empty.
            if (
                $firstName == null || $firstName == "" || $lastName == null || $lastName == "" || $address == null || $address == ""
                || $city == null || $city == "" || $state == null || $state == "" || $country == null || $country == ""
                || $postalCode == null || $postalCode == "" || $phone == null || $phone == "" || $email == null || $email == ""
                || $password == null || $password == ""
            ) {
                echo json_encode(array('status' => 'Some data are missing, please fill all the input fields'));
            } else {
                // Check if email exist in the database
                $check_email = "SELECT Email FROM customer WHERE Email=?";
                $statment = mysqli_stmt_init($dbConn);
                if (!mysqli_stmt_prepare($statment, $check_email)) {
                    echo json_encode(array('status' => 'SQL Error'));
                } else {
                    mysqli_stmt_bind_param($statment, "s", $email);
                    mysqli_stmt_execute($statment);
                    mysqli_stmt_store_result($statment);
                    $resultCheck = mysqli_stmt_num_rows($statment);

                    if ($resultCheck > 0) {
                        echo json_encode(array('status' => 'User is taken, please try with another email'));
                    } else {
                        // If not than the data will be saved in the database.
                        $sql = "INSERT INTO customer(FirstName, LastName, Password, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_stmt_init($dbConn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            echo json_encode(array('status' => 'SQL Error'));
                        } else {
                            mysqli_stmt_bind_param($stmt, "ssssssssiiis", $firstName, $lastName, $hashedPwd, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);
                            mysqli_stmt_execute($stmt);
                            echo json_encode(array('status' => 'Customer Created'));
                        }
                    }
                }
            }
        } else {
            echo json_encode(array('status' => 'Password is not the same as the repeated password'));
        }
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    function getCustomerEmail($id)
    {
        $sql = "SELECT * FROM customer WHERE CustomerId = " . $id . " LIMIT 1";
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        echo json_encode($row);
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])) {
    function deleteCustomer($id)
    {
        $sql = "DELETE FROM customer WHERE CustomerId = " . $id;
        dbQuery($sql);
        echo json_encode(array('status' => 'Customer Deleted'));
    }
    //} else if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    function updateCustomer(
        $firstName,
        $lastName,
        $company,
        $address,
        $city,
        $state,
        $country,
        $postalCode,
        $phone,
        $fax,
        $email,
        $password,
        $password_repeat,
        $id
    ) {

        global $dbConn;

        // check if password is the same as password repeat
        if ($password == $password_repeat) {

            //hash the password
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            // check if some of the data are null or empty.
            if (
                $firstName == null || $firstName == "" || $lastName == null || $lastName == "" || $address == null || $address == ""
                || $city == null || $city == "" || $state == null || $state == "" || $country == null || $country == ""
                || $postalCode == null || $postalCode == "" || $phone == null || $phone == "" || $email == null || $email == ""
                || $password == null || $password == ""
            ) {
                echo json_encode(array('status' => 'Some data are missing, please fill all the input fields'));
            } else {

                $sql = "UPDATE customer SET FirstName = ?, LastName = ?, Password = ? , Company = ?, Address = ?, City = ?,
    State = ?, Country = ?, PostalCode = ?, Phone = ?, Fax = ?, Email = ? WHERE CustomerId = " . $id;

                $stmt = mysqli_stmt_init($dbConn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    echo json_encode(array('status' => 'SQL Error'));
                } else {
                    mysqli_stmt_bind_param(
                        $stmt,
                        "ssssssssiiis",
                        $firstName,
                        $lastName,
                        $hashedPwd,
                        $company,
                        $address,
                        $city,
                        $state,
                        $country,
                        $postalCode,
                        $phone,
                        $fax,
                        $email
                    );
                    mysqli_stmt_execute($stmt);
                    echo json_encode(array('status' => 'Customer Updated'));
                }
            }
        } else {
            echo json_encode(array('status' => 'Password is not the same as password repeat'));
        }
    }
    //} else {
    function getCustomer()
    {
        $sql = "SELECT * FROM customer";
        $results = dbQuery($sql);

        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        echo json_encode($rows);
    }
}
