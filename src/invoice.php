<?php

require_once 'db.php';


class Invoice
{
    function createInvoice($data)
    {
        try {
            global $dbConn;

            $dbConn->autocommit(false);


            date_default_timezone_set("Europe/Copenhagen");
            $invoiceDate = date('Y-m-d h:i:s', time());


            $sql = 'INSERT INTO invoice(CustomerId, InvoiceDate, BillingAddress, BillingCity, BillingState, BillingCountry, BillingPostalCode, Total)
        VALUES(?,?,?,?,?,?,?,?)';

            $stmt = mysqli_stmt_init($dbConn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                return array('status' => 'SQL Error');
            } else {
                mysqli_stmt_bind_param($stmt, 'isssssid', $data['customerId'], $invoiceDate, $data['billingAddress'], $data['billingCity'], $data['billingState'], $data['billingCountry'], $data['billingPostalCode'], $data['total']);
                mysqli_stmt_execute($stmt);
                // return array('status' => 'Invoice created');
                $invoiceId = $dbConn->insert_id;

                // print_r($data['invoiceLines']);
                // echo 'Hello' . gettype(json_decode($data['invoiceLines']));

                if (gettype($data['invoiceLines']) == 'string') {

                    $arr = json_decode($data['invoiceLines'], true);
                } else {
                    $arr = $data['invoiceLines'];
                }


                // print_r($data['invoiceLines']);

                // print_r($arr);
                // print_r($data['invoiceLines']);

                foreach ($arr as $value) {

                    $sql2 = 'INSERT INTO invoiceline(InvoiceId, Quantity, TrackId, UnitPrice)
                VALUES(?,?,?,?)';

                    $stmt2 = mysqli_stmt_init($dbConn);
                    if (!mysqli_stmt_prepare($stmt2, $sql2)) {
                        return array('status' => 'SQL Error');
                    } else {
                        $quantity = $value['quantity'];
                        $trackId = $value['trackId'];
                        $unitPrice = $value['unitPrice'];

                        mysqli_stmt_bind_param($stmt2, 'iiid', $invoiceId, $quantity, $trackId, $unitPrice);
                        mysqli_stmt_execute($stmt2);
                    }
                }
                $dbConn->commit();
                return array('status' => 'Invoice and Invoicelines created');
            }
        } catch (\Throwable $e) {
            $dbConn->rollback();
            throw $e;
            return $e->getMessage();
        }
    }
}
