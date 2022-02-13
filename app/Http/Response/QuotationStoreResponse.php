<?php

namespace App\Http\Response;

class QuotationStoreResponse
{
    public $total;
    public $currency_id;
    public $quotation_id;

    public function __construct(string $total, string $currency_id, int $quotation_id)
    {
        $this->total = $total;
        $this->currency_id = $currency_id;
        $this->quotation_id = $quotation_id;
    }

}
