<?php

// require_once './src/db.php';
// require './vendor/autoload.php';

use \PHPUnit\Framework\TestCase;

require_once("src/invoice.php");



class InvoiceTest extends TestCase
{
    public function testCreateInvoice()
    {
        $invoice = new Invoice();

        $data['customerId'] = 82;
        $data['billingAddress'] = 'Primulavej 3';
        $data['billingCity'] = 'Næstved';
        $data['billingState'] = 'Næstved';
        $data['billingCountry'] = 'Denmark';
        $data['billingPostalCode'] = 4700;
        $data['total'] = 150;
        $data['invoiceLines'][0]['quantity'] = 1;
        $data['invoiceLines'][0]['trackId'] = 2;
        $data['invoiceLines'][0]['unitPrice'] = 100;
        $data['invoiceLines'][1]['quantity'] = 2;
        $data['invoiceLines'][1]['trackId'] = 5;
        $data['invoiceLines'][1]['unitPrice'] = 200;


        $result = $invoice->createInvoice($data);

        $this->assertEquals(array('status' => 'Invoice and Invoicelines created'), $result);
    }
}
