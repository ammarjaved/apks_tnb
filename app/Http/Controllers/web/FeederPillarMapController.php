<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\FeederPillar;
use App\Repositories\FeederPillarRepo;
use Illuminate\Http\Request;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class FeederPillarMapController extends Controller
{
    //
    public function editMap($lang, $id)
    {
        $data = FeederPillar::find($id);

        if ($data) {
            $data->gate_status = json_decode($data->gate_status);


        return view('feeder-pillar.edit-form', ['data' => $data, 'disabled' => true]) ;
        }
        abort(404);
    }

    public function update(Request $request, $language, $id, FeederPillarRepo $feederPillar)
    {
        //

        try {
            $data = FeederPillar::find($id);
            $user = Auth::user()->id;

            $data->updated_by = $user;
            $feederPillar->store($data, $request);
            $data->update();

            return view('components.map-messages', ['id' => $id, 'success' => true, 'url' => 'feeder-pillar'])->with('success', 'Form Update');
        } catch (\Throwable $th) {
            return $th->getMessage();
            return view('components.map-messages', ['id' => $id, 'success' => false, 'url' => 'feeder-pillar'])->with('failed', 'Form Update Failed');
        }
    }

    public function seacrh($lang, $q, $cycle)
    {
        $ba = \Illuminate\Support\Facades\Auth::user()->ba;

        $data = FeederPillar::query();
        if (!empty($ba)) {
            $data->where('ba',  $ba );
        }
        $data =    $data->where('id', 'LIKE', '%' . $q . '%')->where('cycle',$cycle)
            ->select('id')
            ->limit(10)
            ->get();

        return response()->json($data, 200);
    }

    public function seacrhCoordinated($lang, $name)
    {
        $name = urldecode($name);
        $data = FeederPillar::where('id', $name)->pluck('geom_id')->first();

        $geom = \DB::table('tbl_feeder_pillar_geom')
                    ->where('id',$data)
                    ->select(
                        \DB::raw('ST_X(geom) as x'),
                        \DB::raw('ST_Y(geom) as y')
                    )->first();

        return response()->json($geom, 200);
    }
}
