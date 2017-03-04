<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ReservationFormRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        //any user is allowed to use the form
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // TODO testen ob name oder id-Attribut angesprochen wird!

            'name' => 'required',
            'mail' => 'required|email',
            'choiceOfSpace' => 'required',
            'reservationdate' => 'required',
            'startingtime' => 'required',
            'endtime' => 'required',
        ];
    }
}
