<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeederPillar;
use App\Models\Team;
use App\Traits\Filter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Repositories\FeederPillarRepo;

class FPController extends Controller
{

    use Filter;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) 
        {
            if ($request->filled('arr')) 
            {
                $getIds = DB::table('feeder_pillar_all_defects');
                foreach($request->arr as $res)
                {
                    $getIds->orWhere($res,'Yes');
                }
                $ids = $getIds->pluck('id');
            }

            $result = $this->filter(FeederPillar::query(),'visit_date',$request);

            if ($request->filled('arr')){  $result->whereIn('id',$ids);  }


            $result->when(true, function ($query) {
                return $query->select(
                    'id',
                    'ba',
                    'visit_date',
                    DB::raw("st_x(geom) as x,st_y(geom) as y"),
                    DB::raw("CASE WHEN (gate_status->>'unlocked')::text='true' THEN 'Yes' ELSE 'No' END as unlocked"),
                    DB::raw("CASE WHEN (gate_status->>'demaged')::text='true' THEN 'Yes' ELSE 'No' END as demaged"),
                    DB::raw("CASE WHEN (gate_status->>'other')::text='true' THEN 'Yes' ELSE 'No' END as other_gate"),
                    DB::raw("st_x(geom) as x,st_y(geom) as y"),
                    'vandalism_status',
                    'leaning_status',
                    'rust_status',
                    'advertise_poster_status',
                    'total_defects',
                    'qa_status',
                    'qa_status' , 'reject_remarks',
                );
            });

            return datatables()->of($result->get())->addColumn('feeder_pillar_id', function ($row) {

                return "FP-" .$row->id;
            })->make(true);
        }
        return view('feeder-pillar.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request , FeederPillarRepo $feederPillar)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language,$id)
    {
        $data = FeederPillar::find($id);
        if ($data) 
        {
            $data->gate_status = json_decode($data->gate_status);
            return view('feeder-pillar.show', ['data' => $data ,'disabled'=>true]);
        }
        return abort('404');


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language,$id)
    {
        return abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$language,$id)
    {
        try {
            $data = FeederPillar::find($id);
            if ($data  && $data->repair_date == '' ) 
            {
                $data->repair_date = $request->repair_date;
                $data->update();
            }
            Session::flash('success', 'Request Success');
        } 
        catch (\Throwable $th) 
        {
            Session::flash('failed', 'Request Failed');
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($language,$id)
    {
        return abort(404);
    }



    public function updateQAStatus(Request $req)
    {
        try {
            $qa_data = FeederPillar::find($req->id);
            $qa_data->qa_status = $req->status;
            if ($req->status == 'Reject') {
                $qa_data->reject_remarks = $req->reject_remakrs;
            }
            $user = Auth::user()->id;

            $qa_data->updated_by = $user;
            $qa_data->update();

            return redirect()->back();
        } catch (\Throwable $th) {
            return response()->json(['status' => 'Request failed']);
        }
    }
}
