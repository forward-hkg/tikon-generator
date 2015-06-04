<?php
namespace Forward\TikonGenerator;

class InvoiceLine
{
    //TODO: описать поля содержащиеся в строке счёта

    /**
     *
     * No    Selite    Start Pos    Length    Type    Comp.    Format / Other Considerations
     * 1    Record Type    1    3    X    P    TKB (constant)
     * 2    Date    4    8    9    T    ppkkvvvv, if pp=00 so the opening balance of $ fiscal year kkvvvv
     * 3    VERIFICATIONS    12    2    9
     * 4    Document Number    14    6    9    T
     * 5    The document number specifier 1    20    3    9
     * 6    The document number 2 qualifier    23    3    9
     * 7    account    26    6    9    P
     * 8    Place    32    8    X
     * 9    project    40    8    X
     * 10    project Type    48    6    X
     * 11    section    54    4    9        vvkk
     * 12    Monetary aggregates sign    58    1    X    T    + = Debet,  - = Kredit
     * 13    amount    59    16    9    T    (14 + 2) 2 viim.sentit, not des.pistettä (incl. VAT = gross)
     * 14    number sign    75    1    X        +, -
     * 15    number    76    15    9        (14 + 1) 1 Book by. Parts, no des. points
     * 16    Legend    91    72    X
     * 17    Customer number    163    8    9    T
     * 18    Landing Event    171    2    9    T
     * 19    The invoice number    173    6    9    T
     * 20    Type of costs    179    6    X
     * 21    Group 3    185    8    X
     * 22    Group 3 species    193    6    X
     * 23    Group 4    199    8    X
     * 24    Group 4 species    207    6    X
     * 25    Number of two-sign    213    1    X        +, -
     * 26    Quantity 2    214    15    9        (14 + 1) 1 Book by. Parts, no des. points
     * 27    Number of three-sign    229    1    X        +, -
     * 28    Quantity 3    230    15    9        (14 + 1) 1 Book by. Parts, no des. points
     * 29    Company number    245    4    9    P    Company number Tikonissa, compulsory multi-company transfer.
     * 30    The payment batch identification    249    20    X        Used for liquidating batch identification
     * 31    The currency exchange    269    3    X    T    Choices: FIM, EUR or blank
     * in total    271
     *
     * 9=numerical
     * X=alphanumeric
     * P=Required value
     * T=The use is not mandatory, but desirable
     *
     * Fill the numerical fields with leading zeros.
     * Filling text fields start from the left and the empty space is filled with the chr $ (32) of
     * The record length of 271 + newline character.
     * Filename WTAPyyyy.ASC, where yyyy = number of the company (including other file name will do)
     */

}