<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Tiang;
use App\Models\TiangRepairDate;
use Illuminate\Http\Request;
use App\Repositories\TiangRepository;
use Illuminate\Support\Facades\Auth;

class TiangMapController extends Controller
{
    //
    private $tiangRepository;

    public function __construct(TiangRepository $tiaRepository)
    {
        $this->tiangRepository = $tiaRepository;
    }

    public function editMap($lang, $id)
    {
        // return $id;
       $data = $this->tiangRepository->getRecoreds($id);

       $dates = TiangRepairDate::where('savr_id',$data->id)->get();

       $repairDates = [];
        foreach ($dates as $value) {
           $repairDates[$value->name] = $value->date;
        }
// return  $repairDates;
        return $data ? view('Tiang.edit-form', ['data' => $data,'disabled' => true , 'repairDates'=>$repairDates]) : abort(404);
    }


    public function addReapirDate(Request $request, $language)
    {
        //
        try {
            $data = new TiangRepairDate();
            $data->name = $request->name;
            $data->date = $request->date;
            $data->savr_id = $request->id;
            $data->save();

            return response()->json(['success'=>true],200);
        } catch (\Throwable $th) {
            return $th->getMessage();
            return response()->json(['success'=>false],400);

        }
    }

    public function seacrh($lang ,  $q, $cycle)
    {

        $ba = \Illuminate\Support\Facades\Auth::user()->ba;

        $data = Tiang::query();
        if (!empty($ba)) {
            $data->where('ba',  $ba );
        }
        $data =    $data->where('tiang_no' , 'LIKE' , '%' . $q . '%')->where('cycle',$cycle)->select('tiang_no')->limit(10)->get();
        //  $data;
        return response()->json($data, 200);
    }

    public function seacrhCoordinated($lang , $name)
    {

        $name = urldecode($name);
        $data = Tiang::query();


        $data =  $data->where('tiang_no' ,$name );

        $geomId = $data->pluck('geom_id')->first();

        $geom =  \DB::table('tbl_savr_geom')
                    ->where('id',$geomId)
                    ->select(
                        \DB::raw('ST_X(geom) as x'),
                        \DB::raw('ST_Y(geom) as y')
                    )->first();


        return response()->json($geom, 200);
    }

}
