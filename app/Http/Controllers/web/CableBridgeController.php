<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\CableBridge;
use App\Traits\Filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class CableBridgeController extends Controller
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
                $getIds = DB::table('cable_bridge_all_defects');
                foreach($request->arr as $res)
                {
                    $getIds->orWhere($res,'Yes');
                }
                $ids = $getIds->pluck('id');
            }

            $result = CableBridge::query();

            $result = $this->filter($result , 'visit_date',$request);
            if ($request->filled('arr'))
            {
                $result->whereIn('tbl_cable_bridge.id',$ids);
            }

            $result->leftJoin('tbl_cable_bridge_geom', 'tbl_cable_bridge.geom_id', '=', 'tbl_cable_bridge_geom.id')
                    ->orderByRaw('visit_date IS NULL, visit_date DESC')
                    ->select(
                        'tbl_cable_bridge.id',
                        'tbl_cable_bridge.ba',
                        'tbl_cable_bridge.zone',
                        'tbl_cable_bridge.team',
                        'tbl_cable_bridge.visit_date',
                        'tbl_cable_bridge.total_defects',
                        'tbl_cable_bridge.qa_status',
                        'tbl_cable_bridge.qa_status' ,
                        'tbl_cable_bridge.reject_remarks',
                        DB::raw("st_x(tbl_cable_bridge_geom.geom) as x,st_y(tbl_cable_bridge_geom.geom) as y")
                    );

            return DataTables::eloquent($result)
            ->addColumn('cable_bridge_id', function ($row) {
                return "CB-" . $row->id;
            })
            ->make(true);
 
        }
        return view('cable-bridge.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($language, $id)
    {
        //
        $data = CableBridge::find($id);
        return $data ? view('cable-bridge.show', ['data' => $data, 'disabled' => true]) : abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($language, $id)
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
    public function update(Request $request, $language, $id)
    {
        try
        {
            $data = CableBridge::find($id);
            if ($data && $data->repair_date == '' )
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
    public function destroy($language, $id)
    {
        // try {
        //     CableBridge::find($id)->delete();

        //     return redirect()
        //         ->route('cable-bridge.index', app()->getLocale())
        //         ->with('success', 'Recored Removed');
        // } catch (\Throwable $th) {
        //     // return $th->getMessage();
        //     return redirect()
        //         ->route('cable-bridge.index', app()->getLocale())
        //         ->with('failed', 'Request Failed');
        // }
    }


}
