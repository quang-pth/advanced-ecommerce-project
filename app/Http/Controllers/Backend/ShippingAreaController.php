<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    public function DivisionView() {
        $divisions = ShipDivision::orderBy('id', 'DESC')->get();
        return view('backend.ship.division.view_division', compact('divisions'));
    }

    public function DivisionStore(Request $request) {
        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Division Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DivisionEdit($id) {
        $division = ShipDivision::findOrFail($id);
        return view('backend.ship.division.edit_division', compact('division'));
    }

    public function DivisionUpdate(Request $request, $id) {
        $request->validate([
            'division_name' => 'required'
        ]);

        ShipDivision::findOrFail($id)->update([
            'division_name' => $request->division_name
        ]);

        $notification = array(
            'message' => 'Division Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-division')->with($notification);
    }

    public function DivisionDelete($id) {
        ShipDivision::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Division Deleted Successfully',
            'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }
//    end DIVISION SHIPPING

//    start DISTRICT SHIPPING
    public function DistrictView() {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        return view('backend.ship.district.view_district', compact('districts', 'divisions'));
    }

    public function DistrictStore(Request $request) {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required',
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'District Inserted Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DistrictEdit($id) {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.ship.district.edit_district', compact('district', 'divisions'));
    }

    public function DistrictUpdate(Request $request, $id) {
        $request->validate([
            'division_id' => 'required',
            'district_name' => 'required'
        ]);

        ShipDistrict::findOrFail($id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
        ]);

        $notification = array(
            'message' => 'District Updated Successfully',
            'alert-type' => 'info',
        );

        return redirect()->route('manage-district')->with($notification);
    }

    public function DistrictDelete($id) {
        ShipDistrict::findOrFail($id)->delete();

        $notification = array(
            'message' => 'District Deleted Successfully',
            'alert-type' => 'info',
        );
        return redirect()->back()->with($notification);
    }
//    end DISTRICT SHIPPING
    public function StateView() {
        $divisions = ShipDivision::orderBy('division_name', 'ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id', 'DESC')->get();
        $states = ShipState::orderBy('id', 'DESC')->get();
        return view('backend.ship.state.view_state', compact('divisions', 'districts', 'states'));
    }

    public function GetDistrict($division_id) {
        $districts = ShipDistrict::where('division_id', '=', $division_id)->get();
        return response()->json($districts);
    }

//    start ship STATE


//    end ship STATE

}
