<?php
require 'receipt.php';
$information = array();
$information['companyLogoLocation'] = "/var/www/images/hswlaskulogo.png";
$information['companyName'] = 'COMPANY_NAME_HERE';
$information['name'] = 'CONTACT_PERSON';
$information['address'] = 'ADDRESS_COMES_HERE_MIGHT_BE_LONG';
$information['postalCode'] = 'POSTALCODE';
$information['city'] = 'CITY';
$information['countryName'] = 'COUNTRY_NAME'; // usually empty
$information['billingDate'] = '20.2.2013';
$information['id'] = 'INVOICE_NUMBER';
$information['referenceNumber'] = 'REFERENCE_NUMBER';
$information['paymentTerm'] = 'PAYMENT_TERM';
$information['dueDate'] = '20.2.2013';
$information['interestPercent'] = 'INTEREST_PRECENTAGE';
$information['billingReference'] = 'BILLING:REFERENCE';
$information['myCompanyName'] = 'MY_COMPANY_NAME';
$information['myCompanyAddress'] = 'MY_COMPANY_ADDRESS';
$information['myPostalCode'] = 'MY_POSTALCODE';
$information['myCity'] = 'MY_CITY';
$information['myBusinessId'] = 'BUSINESS_ID_AND_VATREGISTRY';
$information['myTelephone1'] = 'MY_TELEPHONE_1_AND_DESCRIPTION';
$information['myTelephone2'] = 'MY_TELEPHONE_2_AND_DESCRIPTION';
$information['myUrl'] = 'MY_URL_COMES_HERE';
$information['myEmail'] = 'MY_EMAIL_HERE';
$information['myBankName'] = 'BANK_NAME';
$information['myIbanNumber'] = 'IBAN_ACCOUNT_NUMBER';
$information['mySwift'] = 'SWIFT_BIC_HERE';
$sales = array();
$sum = 0;
for ($index = 0; $index < 20; $index++) {
    $vat = 24;
    $price = rand(1, 200) * 1000;
    $q = rand(1, 50);
    $sales[] = array(
        'sellDate' => date('d.m.Y'),
        'productName' => 'fdsfdfdsfdfds',
        'vatPercent' => $vat,
        'price' => number_format($price, 2),
        'vatSum' => ( 1 + ($vat / 100) * $price),
        'quantity' => $q,
        'sum' => ( 1 + ($vat / 100) * $price) * $q
    );
    
    $sum += ( 1 + ($vat / 100) * $price) * $q;
}
$sums = array();
$sums['productSaleSum'] = 'PR_SUM';
$sums['productSaleVat'] = 'PR_VAT';
$sums['serviceSaleSum'] = 'SV_SUM';
$sums['serviceSaleVat'] = 'SV_VAT';
$sums['totalSum'] = 'TOT_SUM';
$sums['totalVat'] = 'TO_VAT';
$sums['total'] = $sum;
$jobReports = array();
for ($index1 = 0; $index1 < 6; $index1++) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
    $randomString = '';
    for ($i = 0; $i < 200; $i++) {
        if ($i % 10 == 0) {
            $randomString .= ' ';
        }
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    $jobReports[] = $randomString;
}
//If you want to print a receipt add (whatever) text to contstructor call
//$invoice_pdf = new Invoice_Receipt_PDF('r');
$invoice_pdf = new Invoice_Receipt_PDF();
$invoice_pdf->AliasNbPages();
$invoice_pdf->setInvoiceInformation($information);
$invoice_pdf->setSales($sales);
$invoice_pdf->setSums($sums);
$invoice_pdf->setJobReports($jobReports);
$invoice_pdf->generate();
$invoice_pdf->Output('/tmp/invoice.pdf', 'F');
echo "PDF löytyy /tmp/invoice.pdf";
?>