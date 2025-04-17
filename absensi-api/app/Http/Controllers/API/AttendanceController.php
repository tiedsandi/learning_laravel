<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Offices;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{

  public function attendanceIn(Request $request)
  {

    $id_office = $request->office_id;
    $office = Offices::where('is_active', 1)->where('id', $id_office)->first();

    if (!$office) {
      return response()->json(['message' => 'Office not found or inactive'], 404);
    }

    $lat_employee = $request->lat_from_employee;
    $long_employee = $request->long_from_employee;
    $lat_office = $office->office_lat;
    $long_office = $office->office_long;

    $radius = $this->getDistanceBetweenPoints($lat_employee, $long_employee, $lat_office, $long_office);
    $meter = round($radius['meters']);

    if ($meter > 100) {
      return response()->json(['message' => 'Oops, radius out of range', 'data' => ($meter - 100) . " meters away."]);
    }

    return response()->json(['message' => 'Mantap']);;
  }

  protected function getDistanceBetweenPoints($lat1, $lon1, $lat2, $lon2)
  {
    $theta = $lon1 - $lon2;
    $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
    $miles = acos($miles);
    $miles = rad2deg($miles);
    $miles = $miles * 60 * 1.1515;
    $feet  = $miles * 5280;
    $yards = $feet / 3;
    $kilometers = $miles * 1.609344;
    $meters = $kilometers * 1000;
    return compact('miles', 'feet', 'yards', 'kilometers', 'meters');
  }
}
