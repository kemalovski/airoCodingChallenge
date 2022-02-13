<?php

namespace App\Http\Controllers;

use App\Models\Quotation;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\QuotationStoreRequest;
use App\Http\Services\QuotationService;
use App\Http\Response\QuotationStoreResponse as ApiResponse;

class QuotationController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\QuotationStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuotationStoreRequest $request)
    {
        $quotation = Quotation::create($request->all())->getAttributes();
        
        return response()->json(
            (new ApiResponse(
                (new QuotationService())->calculateTotal($quotation)->total,
                $quotation['currency_id'], 
                $quotation['id'])
            )
            , Response::HTTP_OK);
    }

}
