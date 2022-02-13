<?php

namespace App\Http\Services;

use App\Http\Constant;
use Carbon\Carbon;

class QuotationService
{
    public $total = 0.00;

    public function calculateTotal($quotation){

        $ages = explode(",", $quotation["age"]);

        foreach ($ages as $key => $age) {
            $this->total += Constant::FIXED_RATE * $this->getAgeLoad($age) * $this->getDiffInDays($quotation);
        }
        
        return $this;
    }

    public function getDiffInDays($quotation){
        $end = Carbon::parse($quotation['end_date']);
        $start = Carbon::parse($quotation['start_date']);
        return $end->diffInDays($start);
    }

    private function getAgeLoad($age){
        switch ($age) {
            case $age >= 18 && $age <= 30:
                return 0.6;
                break;
            case $age >= 31 && $age <= 40:
                return 0.7;
                break;
            case $age >= 41 && $age <= 50:
                return 0.8;
                break;
            case $age >= 51 && $age <= 60:
                return 0.9;
                break;
            case $age >= 61 && $age <= 70:
                return 1;
                break;
        }

    }
}
