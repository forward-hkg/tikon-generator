<?php
namespace Forward\TikonGenerator;

class InvoiceLine
{
    const DEBET = '+';
    const CREDIT = '-';

    /**
     * @var \DateTimeInterface
     * Päivämäärä
     * ppkkvvvv, jos pp=00 niin avaussaldoksi tilikaudelle kkvvvv
     *
     * Date
     * ppkkvvvv, if pp=00 so the opening balance of $ fiscal year kkvvvv
     *
     * Start at pos. 4
     * Output as 8 digits
     */
    public $invoiceDate;

    /**
     * @var int
     * Tositelaji
     *
     * VERIFICATIONS
     *
     * Start at pos. 12
     * Output as 2 digits
     */
    public $verifications = 0;

    /**
     * @var int
     * Tositenumero
     *
     * Start at pos. 14
     * Output as 6 digits
     */
    public $documentNumber = 0;

    /**
     * @var int
     * Tositenumeron tarkenne 1
     *
     * Start at pos. 20
     * Output as 3 digits
     */
    public $documentNumber1 = 0;

    /**
     * @var int
     * Tositenumeron tarkenne 2
     *
     * Start at pos. 23
     * Output as 3 digits
     */
    public $documentNumber2 = 0;

    /**
     * @var int
     * Tili
     *
     * Start at pos. 26
     * Output as 6 digits
     */
    public $account = 0;

    /**
     * @var string
     * Kustannuspaikka
     *
     * Start at pos. 32
     * Output as 8 alphanumeric
     */
    public $place = '';

    /**
     * @var string
     * Projekti
     *
     * Start at pos. 40
     * Output as 8 alphanumeric
     */
    public $project = '';

    /**
     * @var string
     * Projektilaji
     *
     * Start at pos. 48
     * Output as 6 alphanumeric
     */
    public $projectType = '';

    /**
     * @var string
     * Jakso
     * vvkk
     *
     * Accounting Period
     * Format: YYMM
     *
     * Start at pos. 54
     * Output as 4 alphanumeric
     */
    public $accountingPeriod = '';

    /**
     * @var int
     * Rahamäärän etumerkki
     * + = Debet,  - = Kredit
     *
     * Start at pos. 58
     * Output as 1 char: + = Debet,  - = Kredit
     */
    public $debetOrCredit = self::DEBET;

    /**
     * @var int
     * Rahamäärä
     * (14+2) 2 viim.sentit, ei des.pistettä (sis. Alv=brutto)
     *
     * Amount
     * (14 + 2) 2 viim.sentit, not des.pistettä (incl. VAT = gross)
     *
     * Start at pos. 59
     * Output as 16 digits
     */
    public $amount = 0;

    /**
     * @var string
     * Määrän etumerkki
     *
     * Start at pos. 75
     * Output as 1 char: + or -
     */
    public $numberSign = '+';

    /**
     * @var int
     * Määrä
     * (14+1) 1 viim. osat, ei des. pistettä
     *
     * (14 + 1) 1 Book by. Parts, no des. points
     *
     * Start at pos. 76
     * Output as 15 digits
     */
    public $number = 0;

    /**
     * @var string
     * Selite
     *
     * Start at pos. 91
     * Output as 72 alphanumeric
     */
    public $description = '';

    /**
     * @var int
     * Asiakasnumero
     *
     * Start at pos. 163
     * Output as 8 digits
     */
    public $customerNumber = 0;

    /**
     * @var int
     * Laskulaji
     *
     * Start at pos. 171
     * Output as 2 digits
     */
    public $landingEvent = 0;

    /**
     * @var int
     * Laskunumero
     *
     * The invoice number
     *
     * Start at pos. 173
     * Output as 6 digits
     */
    public $invoiceNumber = 0;

    /**
     * @var string
     * Kustannuslaji
     *
     * Start at pos. 179
     * Output as 6 alphanumeric
     */
    public $typeOfCost = '';

    /**
     * @var string
     * Ryhmä 3
     *
     * Start at pos. 185
     * Output as 8 alphanumeric
     */
    public $group3 = '';

    /**
     * @var string
     * RRyhmä 3 laji
     *
     * Start at pos. 193
     * Output as 6 alphanumeric
     */
    public $group3species = '';

    /**
     * @var string
     * Ryhmä 4
     *
     * Start at pos. 199
     * Output as 8 alphanumeric
     */
    public $group4 = '';

    /**
     * @var string
     * RRyhmä 4 laji
     *
     * Start at pos. 207
     * Output as 6 alphanumeric
     */
    public $group4species = '';

    /**
     * @var string
     * Määrä kahden etumerkki
     *
     * Start at pos. 213
     * Output as 1 char: + or -
     */
    public $number2Sign = '+';

    /**
     * @var int
     * Määrä 2
     * (14+1) 1 viim. osat, ei des. pistettä
     *
     * (14 + 1) 1 Book by. Parts, no des. points
     *
     * Start at pos. 214
     * Output as 15 digits
     */
    public $number2 = 0;

    /**
     * @var string
     * Määrä kolmen etumerkki
     *
     * Start at pos. 229
     * Output as 1 char: + or -
     */
    public $number3Sign = '+';

    /**
     * @var int
     * Määrä 3
     * (14+1) 1 viim. osat, ei des. pistettä
     *
     * (14 + 1) 1 Book by. Parts, no des. points
     *
     * Start at pos. 230
     * Output as 15 digits
     */
    public $number3 = 0;

    /**
     * @var int
     * Yritysnumero
     * Yritysnumero Tikonissa, pakollinen moniyrityssiirrossa.
     *
     * Company Number
     * Company number Tikonissa, compulsory multi-company transfer.
     *
     * Start at pos. 145
     * Output as 4 digits
     */
    public $companyNumber = 0;

    /**
     * @var int
     * Maksatuserätunnus
     * Maksatuksessa käytetty erätunnus
     *
     * The payment batch identification
     * Used for liquidating batch identification
     *
     * Start at pos. 149
     * Output as 20 alphanumeric
     */
    public $paymentBatchIdentification = 0;

    /**
     * @var int
     * Rahayksikön valuutta
     * Vaihto ehdot: FIM, EUR tai tyhjä
     *
     * Choices: FIM, EUR or blank
     *
     * Start at pos. 169
     * Output as 3 alphanumeric
     */
    public $currency = '';

}