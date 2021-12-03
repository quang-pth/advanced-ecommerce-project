<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipState;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function DistrictGetAjax($division_id) {
        $relatedDistricts = ShipDistrict::where('division_id', $division_id)->orderBy('district_name', 'ASC')->get();
        return json_encode($relatedDistricts);
    } // end DistrictGetAjax

    public function StateGetAjax($district_id) {
        $relatedStates = ShipState::where('district_id', $district_id)->orderBy('state_name', 'ASC')->get();
        return json_encode($relatedStates);
    } // end StateGetAjax


}
