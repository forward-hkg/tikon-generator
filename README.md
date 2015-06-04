# Personec Tikon Accounting Transfer File (RWL/TKB) Generator written in PHP

## Requirements
- PHP 5.4

## Installation
``composer install forward/tikon-generator``

## Usage
```php

use Forward\TikonGenerator\Invoice;
use Forward\TikonGenerator\InvoiceLine;
use Forward\TikonGenerator\TikonGenerator;

$invoice = new Invoice();
//set header fields values
$invoice->field1 = 'field 1 value';
$invoice->field2 = 'field 2 value';

//create invoice lines and attach them to invoice
$line = new InvoiceLine();
$line->lineField1 = 'line 1 field 1 value';
$line->lineField2 = 'line 1 field 2 value';
$invoice->lines[] = $line;

$line = new InvoiceLine();
$line->lineField1 = 'line 2 field 1 value';
$line->lineField2 = 'line 2 field 2 value';
$invoice->lines[] = $line;

//run generator passing the Invoice
$generator = new TikonGenerator();
$resultText = $generator->generateOne($invoice);

```
