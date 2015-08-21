<?php
namespace Forward\TikonGenerator;

class TikonGenerator
{
    /**
     * Generates text representation for array of invoices
     * @param Invoice[] $invoices
     * @return string
     */
    public function generate(array $invoices)
    {
        return implode('', array_map([$this, 'generateOne'], $invoices));
    }

    /**
     * Generages text representation for one invoice
     * @param Invoice $invoice
     * @return string
     */
    public function generateOne(Invoice $invoice)
    {
        $headerText = $this->generateHeaderText($invoice);
        $linesText = implode("\n", array_map([$this, 'generateLineText'], $invoice->lines));
        return $headerText . "\n" . $linesText . "\n";
    }

    /**
     * Generages text representation for one invoice header
     * @param Invoice $invoice
     * @return string
     */
    protected function generateHeaderText(Invoice $invoice)
    {
        return 'RLW' //1
        . $this->getInt($invoice->companyNumber, 4) //4
        . $this->getInt($invoice->customerOrVendorNumber, 8) //8
        . $this->getInt($invoice->landingEvent, 2) //16
        . $this->getInt($invoice->invoiceNumber, 6) //18
        . $this->getInt($invoice->assetsOrLiabilitiesAccountNumber, 6) //24
        . $this->getString($invoice->supplierInvoiceNumberShort, 10) //30
        . $this->getInt($invoice->verifications, 2) //40
        . $this->getInt($invoice->documentNumber, 6) //42
        . $this->getInt($invoice->documentNumber1, 3) //48
        . $this->getInt($invoice->documentNumber2, 3) //51
        . $this->getDateWithZeroes($invoice->documentDate) //54
        . $this->getDateWithZeroes($invoice->invoiceDate) //64
        . $this->getDateWithZeroes($invoice->dueDate) //74
        . $this->getDateWithZeroes($invoice->discountDueDate) //84
        . $this->getString($invoice->vendorId, 8) //94
        . $this->getString($invoice->vendorName, 72) //102
        . $this->getString($invoice->type, 1) //174
        . $this->getInt($invoice->documentType, 2) //175
        . $this->getInt($invoice->termsOfPayment, 3) //177
        . $this->getDecimal($invoice->discountPercent, 3, 1) //180
        . $this->getString($invoice->basicCurrency, 3) //184
        . $this->getDecimal($invoice->amountInBaseCurrency, 14, 2) //187
        . $this->getString($invoice->invoiceCurrency, 3) //203
        . $this->getDecimal($invoice->exchangeRate, 3, 6) //206
        . $this->getDecimal($invoice->invoiceAmount, 14, 2) //215
        . $this->getBool($invoice->partPayment) //231
        . $this->getInt($invoice->payCode, 1) //232
        . $this->getInt($invoice->collectionNumbers, 2) //233
        . $this->getBool($invoice->interestTheft) //235
        . $this->getDateWithZeroes($invoice->interestDate) //236
        . $this->getInt($invoice->referenceNumber, 20) //246
        . $this->getString($invoice->bankMessage, 70) //266
        . $this->getInt($invoice->payCategory, 2) //336
        . $this->getInt($invoice->editorBankAccount, 16) //338
        . $this->getString($invoice->supplierInvoiceNumber, 20) //354
        . $this->getString($invoice->cacheAccount, 6) //374
        . $this->getInt($invoice->discountAmoountInLocalCurrency, 16) //380
        . $this->getInt($invoice->discountAmoountInOriginalCurrency, 16) //396
        . $this->getString($invoice->acceptor, 40) //412
        . $this->getString($invoice->workflowBidId, 10) //452
        . $this->getString($invoice->iban, 34) //462
        . $this->getString($invoice->accountNumberIfNoIban, 34) //496
        . $this->getString($invoice->bicSwift, 11) //530
        . $this->getString($invoice->bankNameAddress1, 35) //541
        . $this->getString($invoice->bankNameAddress2, 35) //576
        . $this->getString($invoice->bankNameAddress3, 35) //611
        . $this->getString($invoice->bankNameAddress4, 35) //646
        . $this->getString($invoice->paymentMethod, 1) //681
        . $this->getString($invoice->serviceFee, 1) //682
        . $this->getString($invoice->bankMessageRest, 70) //683
        . $this->getString($invoice->courseCondition, 14) //753
        . $this->getString($invoice->courseCourse, 11); //11
    }

    /**
     * Generages text representation for one invoice line
     * @param InvoiceLine $line
     * @return string
     */
    protected function generateLineText(InvoiceLine $line)
    {
        return 'TKB' //1
        . $this->getDate($line->documentDate) //4
        . $this->getInt($line->verifications, 2) //12
        . $this->getInt($line->documentNumber, 6) //14
        . $this->getInt($line->documentNumber1, 3) //20
        . $this->getInt($line->documentNumber2, 3) //23
        . $this->getInt($line->account, 6) //26
        . $this->getString($line->place, 8) //32
        . $this->getString($line->project, 8) //40
        . $this->getString($line->projectType, 6) //48
        . $this->getString($line->accountingPeriod, 4) //54
        . $this->getString($line->debetOrCredit, 1) //58
        . $this->getDecimal($line->amount, 14, 2) //59
        . $this->getString($line->numberSign, 1) //75
        . $this->getInt($line->number, 15) //76
        . $this->getString($line->description, 72) //91
        . $this->getInt($line->customerNumber, 8) //163
        . $this->getInt($line->landingEvent, 2) //171
        . $this->getInt($line->invoiceNumber, 6) //173
        . $this->getString($line->typeOfCost, 6) //179
        . $this->getString($line->group3, 8) //185
        . $this->getString($line->group3species, 6) //193
        . $this->getString($line->group4, 8) //199
        . $this->getString($line->group4species, 6) //207
        . $this->getString($line->number2Sign, 1) //213
        . $this->getDecimal($line->number2, 14, 1) //214
        . $this->getString($line->number2Sign, 1) //229
        . $this->getDecimal($line->number3, 14, 1) //230
        . $this->getInt($line->companyNumber, 4) //245
        . $this->getString($line->paymentBatchIdentification, 20) //249
        . $this->getString($line->currency, 3); //269

    }

    protected function getDate(\DateTimeInterface $date = null)
    {
        if ($date === null) {
            return str_repeat('0', 8);
        }
        return $date->format('dmY');
    }

    protected function getDateWithZeroes(\DateTimeInterface $date = null)
    {
        return '00' . $this->getDate($date);
    }

    /**
     * @param string $value
     * @param int $length
     * @return string
     */
    protected function getString($value, $length)
    {
        return $this->strPad($value, $length, ' ', STR_PAD_RIGHT);
    }

    /**
     * @param int $value
     * @param int $length
     * @return string
     */
    protected function getInt($value, $length)
    {
        return $this->strPad($value, $length, '0', STR_PAD_LEFT);
    }

    /**
     * @param float $value
     * @param int $lenBeforeComa
     * @param int $lenAfterComa
     * @return string
     */
    protected function getDecimal($value, $lenBeforeComa, $lenAfterComa)
    {
        $value = (string)$value;
        $parts = explode('.', $value);
        $valBeforeComa = $parts[0];
        $valAfterComa = isset($parts[1]) ? $parts[1] : '';
        $valBeforeComa = $this->strPad($valBeforeComa, $lenBeforeComa, '0', STR_PAD_LEFT);
        $valAfterComa = $this->strPad($valAfterComa, $lenAfterComa, '0', STR_PAD_RIGHT);
        return $valBeforeComa . $valAfterComa;
    }

    /**
     * @param bool $value
     * @return string
     */
    protected function getBool($value)
    {
        return $value ? '1' : '0';
    }

    /**
     * @param string|int|float $value
     * @param int $length
     * @param string $padString
     * @param int $padType
     * @return string
     */
    protected function strPad($value, $length, $padString, $padType)
    {
        $value = (string)$value;
        $actualLength = strlen($value);
        if ($actualLength > $length) {
            $value = substr($value, 0, $length);
        } elseif ($actualLength < $length) {
            $value = str_pad($value, $length, $padString, $padType);
        }

        return $value;
    }
}