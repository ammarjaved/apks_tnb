<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Substation;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Traits\Filter;
use App\Repositories\SubstationRepository;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class SubstationController extends Controller
{
    use Filter;

    private $substationRepository;

    public function __construct(SubstationRepository $substationRepository)
    {
        $this->substationRepository = $substationRepository;
    }


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
                $getIds = DB::table('substation_all_defects');

                foreach($request->arr as $res)
                {
                    $getIds->orWhere($res,'Yes');

                }
                $ids = $getIds->pluck('id');
             }


            $result = Substation::query();

            $result = $this->filter($result, 'visit_date', $request);

            if ($request->filled('arr')) {
               $result->whereIn('tbl_substation.id',$ids);
            }

            $result->leftJoin('tbl_substation_geom', 'tbl_substation.geom_id', '=', 'tbl_substation_geom.id')
                ->orderByRaw('visit_date IS NULL, visit_date DESC')
                ->select(
                    'tbl_substation.id',
                    'tbl_substation.updated_at',
                    DB::raw("ST_X(tbl_substation_geom.geom::geometry) as x, ST_Y(tbl_substation_geom.geom::geometry) as y"),
                    'name',
                    DB::raw("CASE WHEN (tbl_substation.gate_status->>'unlocked')::text='true' THEN 'Yes' ELSE 'No' END as unlocked"),
                    DB::raw("CASE WHEN (tbl_substation.gate_status->>'demaged')::text='true' THEN 'Yes' ELSE 'No' END as demaged"),
                    DB::raw("CASE WHEN (tbl_substation.gate_status->>'other')::text='true' THEN 'Yes' ELSE 'No' END as other_gate"),
                    DB::raw("CASE WHEN (tbl_substation.building_status->>'broken_roof')::text='true' THEN 'Yes' ELSE 'No' END as broken_roof"),
                    DB::raw("CASE WHEN (tbl_substation.building_status->>'broken_gutter')::text='true' THEN 'Yes' ELSE 'No' END as broken_gutter"),
                    DB::raw("CASE WHEN (tbl_substation.building_status->>'broken_base')::text='true' THEN 'Yes' ELSE 'No' END as broken_base"),
                    DB::raw("CASE WHEN (tbl_substation.building_status->>'other')::text='true' THEN 'Yes' ELSE 'No' END as building_other"),
                    'tbl_substation.grass_status',
                    'tbl_substation.tree_branches_status',
                    'tbl_substation.advertise_poster_status',
                    'tbl_substation.total_defects',
                    'tbl_substation.visit_date',
                    'tbl_substation.substation_image_1',
                    'tbl_substation.substation_image_2',
                    'tbl_substation.qa_status' ,
                    'tbl_substation.reject_remarks'
                    );


            return DataTables::eloquent($result)
                    ->addColumn('substation_id', function ($row) {
                        return "SUB-" . $row->id;
                    })
                    ->make(true);




        }

        return view('substation.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $team_id = auth()->user()->id_team;
        $team = Team::find($team_id)->team_name;
        return view('substation.create', ['team' => $team]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $user = Auth::user()->id;

            $data = new Substation();
            $data->created_by = $user;
            $data->geom = DB::raw("ST_GeomFromText('POINT(" . $request->log . ' ' . $request->lat . ")',4326)");
            $data->coordinate = $request->coordinate;
            // $data->qa_status = 'pending';

            $res = $this->substationRepository->store($data, $request);

            $res->save();

            Session::flash('success', 'Request Success');

        } catch (\Throwable $th) {
            Session::flash('failed', 'Request Failed');
        }

        return redirect()->route('substation.index', app()->getLocale());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        $data = $this->substationRepository->getSubstation($id );

        if ($data) {
            return view('substation.show', ['data' => $data, 'disabled' => true]);
        }
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
    {
       $data = $this->substationRepository->getSubstation($id);

        if ($data) {
            return view('substation.edit', ['data' => $data, 'disabled' => false]);
        }
        return abort('404');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $language, $id)
    {
        try
        {

            $data = Substation::find($id);
            if ($data  && $data->repair_date == '' )
            {
                $data->repair_date = $request->repair_date;
                $data->update();
            }
            Session::flash('success', 'Request Success');
        }
        catch (\Throwable $th)
        {
            return $th->getMessage();
            return "something wrong...";
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
    public function destroy($language, $id)
    {
        try {
            Substation::find($id)->delete();

        Session::flash('success', 'Request Success');

        } catch (\Throwable $th) {
            Session::flash('failed', 'Request Failed');
        }

        return redirect()->route('substation.index', app()->getLocale());
    }

    public function updateQAStatus(Request $req)
    {
        try {
            // return $req;
            $qa_data = Substation::find($req->id);
            $qa_data->qa_status = $req->status;
            if ($req->status == 'Reject') {
                $qa_data->reject_remarks = $req->reject_remakrs;
            }
            $user = Auth::user()->id;

            $qa_data->updated_by = $user;
            $qa_data->update();

            return redirect()->back();
        } catch (\Throwable $th) {
            return $th->getMessage();
            return response()->json(['status' => 'Request failed']);
        }
    }
}
