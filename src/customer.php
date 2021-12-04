<?php

require_once 'db.php';

class Customer
{

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
                return array('status' => 'Some data are missing, please fill all the input fields');
            } else {
                // Check if email exist in the database
                $check_email = 'SELECT Email FROM customer WHERE Email=?';
                $statment = mysqli_stmt_init($dbConn);
                if (!mysqli_stmt_prepare($statment, $check_email)) {
                    return array('status' => 'SQL Error');
                } else {
                    mysqli_stmt_bind_param($statment, 's', $email);
                    mysqli_stmt_execute($statment);
                    mysqli_stmt_store_result($statment);
                    $resultCheck = mysqli_stmt_num_rows($statment);

                    if ($resultCheck > 0) {
                        return array('status' => 'User is taken, please try with another email');
                    } else {
                        // If not than the data will be saved in the database.
                        $sql = 'INSERT INTO customer(FirstName, LastName, Password, Company, Address, City, State, Country, PostalCode, Phone, Fax, Email)
                VALUES(?,?,?,?,?,?,?,?,?,?,?,?)';
                        $stmt = mysqli_stmt_init($dbConn);
                        if (!mysqli_stmt_prepare($stmt, $sql)) {
                            return array('status' => 'SQL Error');
                        } else {
                            mysqli_stmt_bind_param($stmt, 'ssssssssiiis', $firstName, $lastName, $hashedPwd, $company, $address, $city, $state, $country, $postalCode, $phone, $fax, $email);
                            mysqli_stmt_execute($stmt);
                            return array('status' => 'Customer Created');
                        }
                    }
                }
            }
        } else {
            return array('status' => 'Password is not the same as the repeated password');
        }
    }


    function getCustomerEmail($id)
    {
        $sql = 'SELECT * FROM customer WHERE CustomerId = ' . $id . ' LIMIT 1';
        $result = dbQuery($sql);

        $row = dbFetchAssoc($result);

        return $row;
    }


    function deleteCustomer($id)
    {
        $sql = 'DELETE FROM customer WHERE CustomerId = ' . $id;
        dbQuery($sql);
        return array('status' => 'Customer Deleted');
    }


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
        $id
    ) {

        global $dbConn;

        // check if some of the data are null or empty.
        if (
            $firstName == null || $firstName == "" || $lastName == null || $lastName == "" || $address == null || $address == ""
            || $city == null || $city == "" || $state == null || $state == "" || $country == null || $country == ""
            || $postalCode == null || $postalCode == "" || $phone == null || $phone == "" || $email == null || $email == ""
        ) {
            return array('status' => 'Some data are missing, please fill all the input fields');
        } else {

            $sql = 'UPDATE customer SET FirstName = ?, LastName = ?, Company = ?, Address = ?, City = ?,
                    State = ?, Country = ?, PostalCode = ?, Phone = ?, Fax = ?, Email = ? WHERE CustomerId = ' . $id;

            $stmt = mysqli_stmt_init($dbConn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return array('status' => 'SQL Error');
            } else {
                mysqli_stmt_bind_param(
                    $stmt,
                    'sssssssiiis',
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
                    $email
                );
                mysqli_stmt_execute($stmt);
                return array('status' => 'Customer Updated');
            }
        }
    }

    // A function for updating password.
    function updatePwd($password, $password_repeat, $customerId)
    {
        // Check if password and password_repeat are equal to each other.
        //Check if password is not null or empty.
        // Check if customerId is not null or empty.
        if ($password == $password_repeat && $password != null && $password != '' && $customerId != null && $customerId != '') {

            global $dbConn;

            //hash the password
            $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

            $sql = 'UPDATE customer SET Password = ? WHERE CustomerId = ' . $customerId;

            $stmt = mysqli_stmt_init($dbConn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return array('status' => 'SQL Error');
            } else {
                mysqli_stmt_bind_param($stmt, 's', $hashedPwd);
                mysqli_stmt_execute($stmt);
                return array('status' => 'Customer password updated');
            }
        } else {
            return array('status' => 'Customer password could not be updated');
        }
    }


    function getCustomer()
    {
        $sql = 'SELECT * FROM customer';
        $results = dbQuery($sql);

        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        return $rows;
    }
}
