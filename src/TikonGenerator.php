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
        //TODO: сгенерировать текстовую строку описывающую поля из шапки счёта
        return '';
    }

    /**
     * Generages text representation for one invoice line
     * @param InvoiceLine $line
     * @return string
     */
    protected function generateLineText(InvoiceLine $line)
    {
        //TODO: сгенерировать текстовую строку описывающую описывающую стркоу счёта
        return '';
    }
}