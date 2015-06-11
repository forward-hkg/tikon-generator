<?php
namespace Forward\TikonGenerator;

class Invoice
{
    const TYPE_SALESDECLINE = 'M';
    const TYPE_INVOICE = 'O';

    const DOCUMENTTYPE_INVOICE = 1;
    const DOCUMENTTYPE_CREDIT = 2;
    const DOCUMENTTYPE_PENI = 3;
    const DOCUMENTTYPE_ADVANCE = 4;

    const PAYCODE_SALESINVOICE_NORMAL_RECOVERIES = 0;
    const PAYCODE_SALESINVOICE_NOTPRINT_COLLECTION_LETTERS = 1;

    const PAYCODE_PURCHINVOICE_NORMAL_PAYMENTS = 0;
    const PAYCODE_PURCHINVOICE_INVOICE_PAYMENTS = 1;
    const PAYCODE_PURCHINVOICE_DECLINE_IN_DIRECT_DEBIT = 2;
    const PAYCODE_PURCHINVOICE_PAID_BILL = 3;
    const PAYCODE_PURCHINVOICE_CURRENCY_PAYMENTS = 4;
    const PAYCODE_PURCHINVOICE_NOT_RECOGNIZED_IN_DECLINE = 5;
    const PAYCODE_PURCHINVOICE_VALUUTTAMAKASTUSLASKU = 5;

    /** @var InvoiceLine[] $lines array of InvoiceLine objects*/
    public $lines = [];

    /**
     * @var int
     * Yritysnumero
     * Yritysnumero Tikonissa, pakollinen moniyrityssiirrossa.
     *
     * Company number Tikonissa, compulsory multi-company transfer.
     *
     * Start at pos. 4
     * Output as 4 digits
     */
    public $companyNumber = 0;

    /**
     * @var int The
     * Asiakas/toimittajanumero
     * Asiakkaan/toimittajan tunnus Asiakas-taulussa.
     *
     * Customer / supplier identification Customer table.
     *
     * Start at pos. 8
     * Output as 8 digits
     */
    public $customerOrVendorNumber = 0;

    /**
     * @var int
     * Laskulaji
     * Laskulaji ja laskunumero muodostavat reskontran laskunumeron. Laskulaji on tositelaji (kirjanpidon Tositelajit-taulussa).
     * Laskulaji on nolla, jos tositelajit eivät ole käytössä.
     *
     * The billing type and the invoice number form the ledger invoice number. The billing type is VERIFICATIONS (accounting Voucher types-table).
     * The billing type is zero, if the Document types are not in use."
     *
     * Start at pos. 16
     * Output as 2 digits
     */
    public $landingEvent = 0;

    /**
     * @var int
     * Laskunumero
     *
     * The billing type and the invoice number form the ledger invoice number. The billing type is VERIFICATIONS (accounting Voucher types-table).
     * The billing type is zero, if the Document types are not in use."
     *
     * The invoice number
     *
     * Start at pos. 18
     * Output as 6 digits
     */
    public $invoiceNumber = 0;

    /**
     * @var int
     * Saatava/velkatili
     * Saatava/velkatili on myyntilaskulla kirjanpidon myyntisaamistili ja ostolaskulla kirjanpidon ostovelkatili.
     *
     * Assets / liabilities account is a sales invoice accounting myyntisaamistili and purchase invoice of purchase accounting liability account.
     *
     * Start at pos. 24
     * Output as 6 digits
     */
    public $assetsOrLiabilitiesAccountNumber = 0;

    /**
     * @var string
     * Toimittajan laskunumero
     * vain ostolaskulla (vanha lyhyt muoto, uusi kentässä 35)
     *
     * The supplier invoice number
     * Only the purchase invoice (the old short form, a new field of 35)
     *
     * Start at pos. 30
     * Output as 10 alphanumeric
     */
    public $supplierInvoiceNumberShort = '';

    /**
     * @var int
     * Tositelaji
     * Tositelaji, tositenumero, tositenumeron tarkenne 1 ja tositenumeron tarkenne 2 yhdessä muodostavat kirjanpidon tositenumeron.
     * Tositelaji on kirjanpidon Tositelajit-taulussa oleva tositelaji. Tositelaji on nolla, jos tositelajit eivät ole käytössä.
     *
     * VERIFICATIONS
     * The sorts of vouchers, voucher number, the document number and the document number 1 qualifier qualifier two together make up the accounting document number.
     * VERIFICATIONS is the accounting-panel voucher types Voucher types. VERIFICATIONS is zero, if the Document types are not in use.
     *
     * Start at pos. 40
     * Output as 2 digits
     */
    public $verifications = 0;

    /**
     * @var int
     * Tositenumero
     * Tositelaji, tositenumero, tositenumeron tarkenne 1 ja tositenumeron tarkenne 2 yhdessä muodostavat kirjanpidon tositenumeron.
     * Tositelaji on kirjanpidon Tositelajit-taulussa oleva tositelaji. Tositelaji on nolla, jos tositelajit eivät ole käytössä.
     *
     * Document Number
     * The sorts of vouchers, voucher number, the document number and the document number 1 qualifier qualifier two together make up the accounting document number.
     * VERIFICATIONS is the accounting-panel voucher types Voucher types. VERIFICATIONS is zero, if the Document types are not in use.
     *
     * Start at pos. 42
     * Output as 6 digits
     */
    public $documentNumber = 0;

    /**
     * @var int
     * Tositenumeron tarkenne 1
     * Tositelaji, tositenumero, tositenumeron tarkenne 1 ja tositenumeron tarkenne 2 yhdessä muodostavat kirjanpidon tositenumeron.
     * Tositelaji on kirjanpidon Tositelajit-taulussa oleva tositelaji. Tositelaji on nolla, jos tositelajit eivät ole käytössä.
     *
     * The document number specifier 1
     * The sorts of vouchers, voucher number, the document number and the document number 1 qualifier qualifier two together make up the accounting document number.
     * VERIFICATIONS is the accounting-panel voucher types Voucher types. VERIFICATIONS is zero, if the Document types are not in use.
     *
     * Start at pos. 48
     * Output as 3 digits
     */
    public $documentNumber1 = 0;

    /**
     * @var int
     * Tositenumeron tarkenne 2
     * Tositelaji, tositenumero, tositenumeron tarkenne 1 ja tositenumeron tarkenne 2 yhdessä muodostavat kirjanpidon tositenumeron.
     * Tositelaji on kirjanpidon Tositelajit-taulussa oleva tositelaji. Tositelaji on nolla, jos tositelajit eivät ole käytössä.
     *
     * The document number 2 qualifier
     * The sorts of vouchers, voucher number, the document number and the document number 1 qualifier qualifier two together make up the accounting document number.
     * VERIFICATIONS is the accounting-panel voucher types Voucher types. VERIFICATIONS is zero, if the Document types are not in use.
     *
     * Start at pos. 51
     * Output as 3 digits
     */
    public $documentNumber2 = 0;

    /**
     * @var \DateTimeInterface
     * Tositepvm
     *
     * Document date
     *
     * Start at pos. 54
     * Output as 10 digits DDMMYYYY, NB, in front of two zeros.
     */
    public $documentDate;

    /**
     * @var \DateTimeInterface
     * Laskun pvm
     *
     * Invoice date
     *
     * Start at pos. 64
     * Output as 10 digits DDMMYYYY, NB, in front of two zeros.
     */
    public $invoiceDate;

    /**
     * @var \DateTimeInterface
     * Eräpvm
     *
     * Due Date
     *
     * Start at pos. 74
     * Output as 10 digits DDMMYYYY, NB, in front of two zeros.
     */
    public $dueDate;

    /**
     * @var \DateTimeInterface
     * Käteisalennuksen eräpvm
     *
     * Discount Due Date
     *
     * Start at pos. 84
     * Output as 10 digits DDMMYYYY, NB, in front of two zeros.
     */
    public $discountDueDate;

    /**
     * @var string
     * Myyjätunnus/kustannuspaikka
     * Myyntilaskulla myyjätunnus (reskontran Myyja-taulu), ostolaskulla kustannuspaikka (kirjanpidon Kustannuspaikka-taulu).
     *
     * Sales Invoice Vendor ID (ledger Seller-flat), the purchase invoice cost center (cost center accounting-flat).
     *
     * Vendor ID / cost center
     *
     * Start at pos. 94
     * Output as 8 alphanumeric
     */
    public $vendorId = '';

    /**
     * @var string
     * Selite
     *
     * Vendor Name
     *
     * Start at pos. 102
     * Output as 72 alphanumeric
     */
    public $vendorName = '';

    /**
     * @var string
     * Laji
     * "M" = myyntilasku, "O" = ostolasku
     *
     * Type
     * "M" = the sales decline, "O" = invoice
     *
     * Start at pos. 174
     * Output as 1 char: "M" or "O"
     */
    public $type = '';

    /**
     * @var int
     * Vientilaji
     * 1 = tavall.lasku, 2 = hyvitysl., 3 = korkol., 4 = ennakko
     *
     * Document Type
     * 1 = invoice, 2 = credit, 3 = peni, 4 = advance (prepaid)
     *
     * Start at pos. 175
     * Output as 2 digits
     */
    public $documentType = 0;

    /**
     * @var int
     * Maksuehto
     *
     * Terms of payment
     *
     * Start at pos. 177
     * Output as 3 digits
     */
    public $termsOfPayment = 0;

    /**
     * @var int
     * Käteisalennus%
     * 3 kokonaista, 1 desimaali, ei desim.erotinta
     *
     * Discount %
     * 3 full, 1 decimal, not desim.erotinta
     *
     * Start at pos. 180
     * Output as 4 digits
     */
    public $discountPercent = 0;

    /**
     * @var string
     * Perusrahayksikkö
     * isoilla kirjaimilla, virallinen lyhenne: esim. FIM, EUR.
     * Jos perusrahayksikköä ei ole annettu, niin sitä tullaan tapahtumia noudettaessa kysymään
     *
     * Basic currency
     * In capital letters, the official abbreviation. eg FIM, EUR.
     *
     * Start at pos. 184
     * Output as 3 alphanumeric
     */
    public $basicCurrency = '';

    /**
     * @var float
     * Lasku perusrahayksiköissä
     * mk- tai euro-määrä, 14 kokonaista, 2 desimaalia, ei desim.erotinta
     *
     * Amount in Base Currency
     * k- or euro-denominated, 14 full, 2 decimals, not desim.erotinta
     *
     * Start at pos. 187
     * Output as 16 digits
     */
    public $amountInBaseCurrency = 0;

    /**
     * @var string
     * Valuuttakoodi
     * isoilla kirjaimilla, virallinen lyhenne
     *
     * Invoice Currency
     * in capital letters, the official abbreviation
     *
     * Start at pos. 203
     * Output as 3 alphanumeric
     */
    public $invoiceCurrency = '';

    /**
     * @var float
     * Valuuttakurssi
     * 3 kokonaista, 6 desimaalia, ei desim.erotinta, (Ei käytössä)
     *
     * Exchange Rate
     * 3 whole, 6 decimals, not desim.erotinta, (Off)
     *
     * Start at pos. 206
     * Output as 9 digits
     */
    public $exchangeRate = 0;

    /**
     * @var float
     * Lasku valuutassa
     * 14 kokonaista, 2 desimaalia, ei desim.erotinta
     *
     * Invoice Amount
     * 14 full, 2 decimals, not desim.erotinta
     *
     * Start at pos. 215
     * Output as 16 digits
     */
    public $invoiceAmount = 0;

    /**
     * @var bool
     * Osamaksulasku
     * 1 = osamaksulasku
     *
     * Part payment invoice
     * 1 = installment bill
     *
     * Start at pos. 231
     * Output as 1 or 0
     */
    public $partPayment = false;

    /**
     * @var int
     * Perintä/maksat. koodi
     * myyntilaskulla: 0= normaali perintä, 1 = lasku ei tulostu perintäkirjeelle,
     * ostolaskulla: 0= normaali maksatus,  1=lasku maksukiellossa, 2=lasku suoraveloituksessa, 3=valuuttamaksatuksella maksettava lasku,
     * 4=valuuttamaksatuksen lasku maksukiellossa, 5=esikirjattu lasku, 6=esikirjattu valuuttamakastuslasku
     *
     * Payment Code
     * a sales invoice: 0 = normal recoveries, 1 = invoice does not print collection letters,
     * the purchase invoice: 0 = normal payment, 1 = invoice's payments, 2 = decline in direct debit, 3 = paid valuuttamaksatuksella bill
     * 4 = currency payments fall's payments, 5 = not recognized in decline, ancestor recorded 6 = valuuttamakastuslasku
     *
     * Start at pos. 232
     * Output as 1 digit
     */
    public $payCode = 0;

    /**
     * @var int
     * Perintäkertojen lkm
     * Vain myyntilaskulla. Montako perintäkirjettä laskusta on lähetetty.
     *
     * Debt collection number of times
     * Only the sales invoice. How many collection letters invoice has been sent."
     *
     * Start at pos. 233
     * Output as 2 digits
     */
    public $collectionNumbers = 0;

    /**
     * @var bool
     * Korkoesto
     * 1 = lasku ei tulostu korkolaskulle
     *
     * Interest theft
     * 1 = decrease in the interest rate does not print the invoice
     *
     * Start at pos. 235
     * Output as 1 or 0
     */
    public $interestTheft = false;

    /**
     * @var \DateTimeInterface
     * Korkopvm
     * vain myyntilaskulla, PPKKVVVV, Huom, eteen kaksi nollaa.
     * Korkopvm on päivämäärä, johon asti korko on laskettu
     *
     * Interest Date
     * just a sales invoice
     * Interest date is the date until which the interest rate is calculated
     *
     * Start at pos. 236
     * Output as 10 digits DDMMYYYY, NB, in front of two zeros.
     */
    public $interestDate;

    /**
     * @var string
     * Viitenumero
     *
     * Reference Number
     *
     * Start at pos. 246
     * Output as 20 digits
     */
    public $referenceNumber = '';

    /**
     * @var string
     * Pankkiviesti
     * Pankkiviestiä käytetään ostolaskujen maksatuksessa.  Pankkiviesti välitetään maksunsaajalle,
     * jos laskulla ei ole viitenumeroa.
     *
     * Bank Message
     * Only the purchase invoice.
     * The Bank of message is used to invoice payment. Bank message is transmitted to the payee,
     * if the bill is not the reference number.
     *
     * Start at pos. 266
     * Output as 70 alphanumeric
     */
    public $bankMessage = '';

    /**
     * @var int
     * Maksuluokka
     *
     * Pay Category
     *
     * Start at pos. 336
     * Output as 2 digits
     */
    public $payCategory = 0;

    /**
     * @var int
     * Toimittajan pankkitili
     * vain ostolaskulla, konekielisessä muodossa
     *
     * Editor's bank account
     * Only the purchase invoice in electronic format
     *
     * Start at pos. 338
     * Output as 16 digits
     */
    public $editorBankAccount = 0;

    /**
     * @var string
     * Toimittajan laskunumero
     * vain ostolaskulla
     *
     * The supplier invoice number
     * Only the purchase invoice
     *
     * Start at pos. 338
     * Output as 20 aplpanumeric
     */
    public $supplierInvoiceNumber = '';

    /**
     * @var string
     * Käteisalennustili
     *
     * Cash Account
     *
     * Start at pos. 354
     * Output as 6 alphanumeric
     */
    public $cacheAccount = '';

    /**
     * @var int
     * Kät.ale.kotival.
     *
     * The amount of the cash discount in the local currency
     *
     * Start at pos. 374
     * Output as 16 digits
     */
    public $discountAmoountInLocalCurrency = 0;

    /**
     * @var int
     * Kät.ale.valuutt.
     * Käteisalennuksen määrä valuuttana
     *
     * The amount of the cash discount currency
     *
     * Start at pos. 380
     * Output as 16 digits
     */
    public $discountAmoountInOriginalCurrency = 0;

    /**
     * @var string
     * Hyväksyjä
     * Laskun hyväksyjä Laskuhotellissa tai Personec workflow:ssa
     *
     * The invoice shall Landing hotel or Personec workflow for
     *
     * Start at pos. 396
     * Output as 40 alphanumeric
     */
    public $acceptor = '';

    /**
     * @var string
     * WF laskun Id
     * Workflow laskun Id
     *
     * Start at pos. 412
     * Output as 10 alphanumeric
     */
    public $workflowBidId = '';

    /**
     * @var string
     * IBAN-tilinumero
     * IBAN-tilinumero (LUM2:n maksutietueen pos.300-333,  pituus 34)
     *
     * IBAN
     * IBAN (LUM2's payment record pos.300-333, length 34)
     *
     * Start at pos. 462
     * Output as 34 alphanumeric
     */
    public $iban = '';

    /**
     * @var string
     * Tilinumero
     * Ulkomainen kansallinen tilinumero. Käytetään vain, jos ei ole IBAN-tilinumeroa. (LUM2:n maksutietueen pos.300-333,  pituus 34)
     *
     * Account Number
     * A foreign national account number. Applies only if there is no IBAN. (LUM2 of the payment pos.300-333, length 34)
     *
     * Start at pos. 496
     * Output as 34 alphanumeric
     */
    public $accountNumberIfNoIban = '';

    /**
     * @var string
     * BIC / SWIFT
     * Pankin BIC-/SWIFT-koodi (LUM2:n maksutietueen pos.149-159,  pituus 11)
     *
     * BIC / SWIFT
     * The bank's BIC / SWIFT code (LUM2's payment record pos.149-159, length 11)
     *
     * Start at pos. 530
     * Output as 11 alphanumeric
     */
    public $bicSwift = '';

    /**
     * @var string
     * Pankin nimi/osoite, 1. rivi. (LUM2:n maksutietueen pos.160-194,  pituus 35)
     *
     * Bank name / address on the 1st line. (LUM2 of the payment pos.160-194, length 35)
     *
     * Start at pos. 541
     * Output as 35 alphanumeric
     */
    public $bankNameAddress1 = '';

    /**
     * @var string
     * Pankin nimi/osoite, 2. rivi. (LUM2:n maksutietueen pos.195-229,  pituus 35)
     *
     * Bank Name / Address, 2nd line. (LUM2 of the payment pos.195-229, length 35)
     *
     * Start at pos. 576
     * Output as 35 alphanumeric
     */
    public $bankNameAddress2 = '';

    /**
     * @var string
     * Pankin nimi/osoite, 3. rivi. (LUM2:n maksutietueen pos.230-264,  pituus 35)
     *
     * Bank name / address, 3rd line. (LUM2 of the payment pos.230-264, length 35)
     *
     * Start at pos. 611
     * Output as 35 alphanumeric
     */
    public $bankNameAddress3 = '';

    /**
     * @var string
     * Pankin nimi/osoite, 4. rivi. (LUM2:n maksutietueen pos.265-299,  pituus 35)
     *
     * Bank Name / Address 4th row. (LUM2 of the payment pos.265-299, length 35)
     *
     * Start at pos. 646
     * Output as 35 alphanumeric
     */
    public $bankNameAddress4 = '';

    /**
     * @var string
     * Maksutapa
     * Maksutapa ( M, P, Q, S, T, K, R tai B). Huomioi, että kaikki maksutapakoodit eivät ole käytössä kaikissa pankeissa. (LUM2:n maksutietueen pos.509-509,  pituus 1)
     *
     * Payment method (M, P, Q, S, T, K, R or B). Please note that all payment codes are not available in all banks. (LUM2 of the payment pos.509-509, the length of one)
     *
     * Start at pos. 681
     * Output as 1 char
     */
    public $paymentMethod = '';

    /**
     * @var string
     * Palvelumaksu
     * Tieto pankkipalvelumaksujen maksajasta ( J, T tai V). Huomioi, että kaikki palvelumaksukoodit eivät ole käytössä kaikissa pankeissa. (LUM2:n maksutietueen pos.510-510,  pituus 1)
     *
     * Information on the payer bank charges (J, T or V). Please note that all payment service tags are not enabled for all banks. (LUM2 of the payment pos.510-510, the length of one)
     *
     * Start at pos. 682
     * Output as 1 char
     */
    public $serviceFee = '';

    /**
     * @var string
     * Viestin loppuosa
     *
     * Beneficiary bank to deliver to the remainder of the message (LUM2 of the payment pos.404-473, length 70)
     *
     * Start at pos. 683
     * Output as 70 alphanumeric
     */
    public $bankMessageRest = '';

    /**
     * @var string
     * Kurssisopimus
     * Pankin kanssa tehdyn valuuttakaupan kurssisopimustunnus (LUM2:n maksutietueen pos.495-508,  pituus 14)
     *
     * Agreement with the Bank's foreign exchange trading price of the contract ID (LUM2's payment record pos.495-508, length 14)
     *
     * Start at pos. 753
     * Output as 14 alphanumeric
     */
    public $courseCondition = '';

    /**
     * @var string
     * Kurssis. Kurssi
     * Kurssisopimuksen informatiivinen kurssi, jota ei välitetä pankkiin. Käytetään maksatuksen tulosteilla muunnettaessa valuutta-arvoja euroiksi. Pituus 5 kokonaista ja 6 desimaalia.
     *
     * The course of the contract informative course, which is not transmitted to the bank. Used for payment of prints for converting monetary values into euros. Length 5 full and 6 decimal places.
     *
     * Start at pos. 767
     * Output as 11 alphanumeric
     */
    public $courseCourse = '';
}
