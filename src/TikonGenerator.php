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
        return implode("\n", array_map([$this, 'generateOne'], $invoices));
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
        return $headerText . "\n" . $linesText;
    }

    /**
     * Generages text representation for one invoice header
     * @param Invoice $invoice
     * @return string
     */
    protected function generateHeaderText(Invoice $invoice)
    {
        return 'RWL'
        . $this->getInt($invoice->companyNumber, 4)
        . $this->getInt($invoice->customerOrVendorNumber, 8)
        . $this->getInt($invoice->landingEvent, 2)
        . $this->getInt($invoice->invoiceNumber, 6)
        . $this->getInt($invoice->assetsOrLiabilitiesAccountNumber, 6)
        . $this->getString($invoice->supplierInvoiceNumberShort, 10)
        . $this->getInt($invoice->verifications, 2)
        . $this->getInt($invoice->documentNumber, 6)
        . $this->getInt($invoice->documentNumber1, 3)
        . $this->getInt($invoice->documentNumber2, 3)
        . $this->getDateWithZeroes($invoice->documentDate)
        . $this->getDateWithZeroes($invoice->invoiceDate)
        . $this->getDateWithZeroes($invoice->dueDate)
        . $this->getDateWithZeroes($invoice->discountDueDate)
        . $this->getString($invoice->vendorId, 8)
        . $this->getString($invoice->vendorName, 72)
        . $this->getString($invoice->type, 1)
        . $this->getInt($invoice->documentType, 2)
        . $this->getInt($invoice->termsOfPayment, 3)
        . $this->getDecimal($invoice->discountPercent, 3, 1)
        . $this->getString($invoice->basicCurrency, 3)
        . $this->getDecimal($invoice->amountInBaseCurrency, 14, 2)
        . $this->getString($invoice->invoiceCurrency, 3)
        . $this->getDecimal($invoice->amountInBaseCurrency, 3, 6)
        . $this->getDecimal($invoice->invoiceAmount, 14, 2)
        . $this->getBool($invoice->partPayment)
        . $this->getInt($invoice->payCode, 1)
        . $this->getInt($invoice->collectionNumbers, 2)
        . $this->getBool($invoice->interestTheft)
        . $this->getDateWithZeroes($invoice->interestDate)
        . $this->getInt($invoice->referenceNumber, 20)
        . $this->getString($invoice->bankMessage, 70)
        . $this->getInt($invoice->payCategory, 2)
        . $this->getInt($invoice->editorBankAccount, 16)
        . $this->getString($invoice->supplierInvoiceNumber, 20)
        . $this->getString($invoice->cacheAccount, 6)
        . $this->getInt($invoice->discountAmoountInLocalCurrency, 16)
        . $this->getInt($invoice->discountAmoountInOriginalCurrency, 16)
        . $this->getString($invoice->acceptor, 40)
        . $this->getString($invoice->workflowBidId, 10)
        . $this->getString($invoice->iban, 34)
        . $this->getString($invoice->accountNumberIfNoIban, 34)
        . $this->getString($invoice->bicSwift, 11)
        . $this->getString($invoice->bankNameAddress1, 35)
        . $this->getString($invoice->bankNameAddress2, 35)
        . $this->getString($invoice->bankNameAddress3, 35)
        . $this->getString($invoice->bankNameAddress4, 35)
        . $this->getString($invoice->paymentMethod, 1)
        . $this->getString($invoice->serviceFee, 1)
        . $this->getString($invoice->bankMessageRest, 70)
        . $this->getString($invoice->courseCondition, 14)
        . $this->getString($invoice->courseCourse, 11);
    }

    /**
     * Generages text representation for one invoice line
     * @param InvoiceLine $line
     * @return string
     */
    protected function generateLineText(InvoiceLine $line)
    {
        return 'TKB'
        . $this->getDate($line->invoiceDate)
        . $this->getInt($line->verifications, 2)
        . $this->getInt($line->documentNumber, 6)
        . $this->getInt($line->documentNumber1, 3)
        . $this->getInt($line->documentNumber2, 3)
        . $this->getInt($line->account, 6)
        . $this->getString($line->place, 8)
        . $this->getString($line->project, 8)
        . $this->getString($line->projectType, 6)
        . $this->getString($line->accountingPeriod, 4)
        . $this->getString($line->debetOrCredit, 1)
        . $this->getInt($line->amount, 16)
        . $this->getString($line->numberSign, 1)
        . $this->getInt($line->number, 15)
        . $this->getString($line->description, 72)
        . $this->getInt($line->customerNumber, 8)
        . $this->getInt($line->landingEvent, 2)
        . $this->getInt($line->invoiceNumber, 6)
        . $this->getInt($line->typeOfCost, 6)
        . $this->getString($line->group3, 8)
        . $this->getString($line->group3species, 6)
        . $this->getString($line->group4, 8)
        . $this->getString($line->group4species, 6)
        . $this->getString($line->number2Sign, 1)
        . $this->getDecimal($line->number2, 14, 1)
        . $this->getString($line->number2Sign, 1)
        . $this->getDecimal($line->number3, 14, 1)
        . $this->getInt($line->companyNumber, 4)
        . $this->getString($line->paymentBatchIdentification, 20)
        . $this->getString($line->currency, 3);

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
        return $this->getDate($date) . '00';
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