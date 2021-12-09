<?php

// require_once './src/db.php';
// require './vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

require_once("src/customer.php");



class CustomerTest extends TestCase
{
    // public function testCreateCustomer()
    // {
    //     $customer = new Customer();
    //     $result = $customer->createCustomer(
    //         'A',
    //         'AA',
    //         'AAA',
    //         'AStreet',
    //         'ACity',
    //         'AState',
    //         'ACountry',
    //         1234,
    //         12345678,
    //         12345678,
    //         'A@a1.com',
    //         'ABC',
    //         'ABC'
    //     );

    //     $this->assertEquals(array('status' => 'Customer Created'), $result);
    // }

    public function testUpdateCustomer()
    {
        $customer = new Customer();
        $result = $customer->updateCustomer(
            'A',
            'AA',
            'AAA',
            'AStreet',
            'ACity',
            'AState',
            'ACountry',
            1234,
            12345678,
            12345678,
            'A@a.com',
            84
        );

        $this->assertEquals(array('status' => 'Customer Updated'), $result);
    }

    public function testDeleteCustomer()
    {

        $customer = new Customer();
        $result = $customer->deleteCustomer(80);

        $this->assertEquals(array('status' => 'Customer Deleted'), $result);
    }

    public function testGetCustomerEmail()
    {

        $customer = new Customer();
        $result = $customer->getCustomerEmail(84);

        $this->assertEquals(array(
            "CustomerId" => "84",
            "FirstName" => "A",
            "LastName" => "AA",
            "Password" => '$2y$10$62jqRwHIdErc0NYPTtN2LeXvDvU16NUC2g.FLj/VG6R8yNME2SeZy',
            "Company" => "AAA",
            "Address" => "AStreet",
            "City" => "ACity",
            "State" => "AState",
            "Country" => "ACountry",
            "PostalCode" => "1234",
            "Phone" => "12345678",
            "Fax" => "12345678",
            "Email" => "A@a.com"
        ), $result);
    }

    public function testUpdateCustomerPwd()
    {

        $customer = new Customer();
        $result = $customer->updatePwd('ABC', 'ABC', 80);

        $this->assertEquals(array('status' => 'Customer password updated'), $result);
    }
}
