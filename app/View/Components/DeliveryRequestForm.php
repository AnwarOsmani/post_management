<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DeliveryRequestForm extends Component
{
    public $title, $nameId, $nameValue, $phoneId, $phoneValue, $postalCodeId, $postalCodeValue;

    public function __construct(
        $title,
        $nameId,
        $nameValue = '',
        $phoneId,
        $phoneValue = '',
        $postalCodeId,
        $postalCodeValue = ''
    ) {
        $this->title = $title;
        $this->nameId = $nameId;
        $this->nameValue = $nameValue;
        $this->phoneId = $phoneId;
        $this->phoneValue = $phoneValue;
        $this->postalCodeId = $postalCodeId;
        $this->postalCodeValue = $postalCodeValue;
    }

    public function render()
    {
        return view('components.delivery-request-form');
    }
}
