@extends('layouts.app', ['page_title' => 'Index'])

@section('css')

<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
<script src="https://malsup.github.io/jquery.form.js"></script>
<script>
    var $jq = $.noConflict(true);
</script>
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @include('partials.map-css')

         <style>
        div#myTable_length,
        div#roads_length {
            display: none;
        }


        span.relative.inline-flex.items-center.px-4.py-2.-ml-px.text-sm.font-medium.text-gray-500.bg-white.border.border-gray-300.cursor-default.leading-5 {
            background: #007BFF !important;
            color: white !important;
        }

        .collapse {
            visibility: visible;
        }

        /* .table-responsive::-webkit-scrollbar {
                        display: none;
                    } */

        table.dataTable>thead>tr>th:not(.sorting_disabled),
        table.dataTable>thead>tr>td:not(.sorting_disabled) {
            padding-right: 14px;
        }

        .lower-header,
        td {
            font-size: 14px !important;
            padding: 5px !important;
        }

        th {
            font-size: 15px !important;

        }

        thead {
            background-color: #E4E3E3 !important;
        }

        .nowrap,
        th {
            white-space: nowrap;
        }

        #map {
            height: 60vh;
            z-index: 1;
        }

        select.form-select.form-select-sm {
    padding: 0px 0px 0px 10px;
    font-size: 12px;
    /* display: none; */
    min-width: 20px !important;
    width: 47px !important;
}

    </style>
 
@endsection



@section('script')

@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{__("messages.ffa")}}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">index</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">



            @if (Session::has('failed'))
                <div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
                    {{ Session::get('failed') }}

                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>

                </div>
            @endif
            @if (Session::has('success'))
                <div class="alert {{ Session::get('alert-class', 'alert-success') }}" role="alert">
                    {{ Session::get('success') }}
                    <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

                @include('components.qr-filter', ['url' => 'generate-ffa-excel'])

            <div class="row">
			<section class="col-md-6 connectedSortable ui-sortable">

                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">{{ __('messages.ffa') }}</h3>

                            <div class="card-tools">
                              <ul class="nav nav-pills ml-auto">
                                <li>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </li>
                              </ul>
                            </div>
                        </div>



                        <div class="card-body" id="yourMapElement">

                            <div class="table-responsive add-substation" id="add-substation">
							<table id="myTable" class="table table-bordered table-hover data-table">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>ID</th>
                                            <th>BA</th>
                                            <th>POLE ID</th>
                                            <th>POLE NO</th>
                                            <th></th>
                                            <th>QA Status</th>
                                            <th>ACTION</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                            </table>                                  
                            </div>
                        </div>
                    </div>
                </section>
			
			
			<!--
                <section class="col-md-6 connectedSortable ui-sortable">
                <div class="col-md-6">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between ">
                            <div class="card-title">SAVR FFW</div>

                            <div class="d-flex ml-auto">
                                {{-- <a href="{{ route('savt.create', app()->getLocale()) }}">
                                    <button class="btn text-white btn-success  btn-sm mr-4">Add SAVT</button>
                                </a> --}}
                                 

                            </div>
                        </div>

                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>
                            <div class="table-responsive">
                                <table id="myTable" class="table table-bordered table-hover data-table">


                                    <thead style="background-color: #E4E3E3 !important">
                                        <tr>
                                            <th>ID</th>
                                            <th>BA</th>
                                            <th>POLE ID</th>
                                            <th>POLE NO</th>
                                            <th></th>
                                            <th>QA Status</th>
                                            <th>ACTION</th>

                                        </tr>
                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>






                        </div>
                    </div>
                </section>
				-->
				
				 <section class="col-md-6 connectedSortable ui-sortable">

                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">{{ __('messages.ffa') }} MAP</h3>

                            <div class="card-tools">
                              <ul class="nav nav-pills ml-auto">
                                <li>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </li>
                              </ul>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="p-3 pt-0 mt-0  form-input  ">
           
                                <span class="text-danger" id="er-select-layer"></span>
                                <div class="d-sm-flex">
                                   

                                    <div class="mx-4 d-flex">
                                        <input type="radio" name="select_layer" id="substation_without_defects"
                                            value="sub_ffa" class="without_defects" onchange="selectLayer(this.value)">
                                        <label for="substation_without_defects">FFA</label>
                                    </div>

                                    <div class="  d-flex">
                                        <input type="radio" name="select_layer" id="select_layer_pano" value="pano"
                                            onchange="selectLayer(this.value)">
                                        <label for="select_layer_pano">Pano</label>
                                    </div>

                             
                                </div>

                                <div id="map">

                                </div>


                            </div>
                        </div>
                    </div>


                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">{{ __('messages.ffa') }} Detail</h3>

                            <div class="card-tools">
                              <ul class="nav nav-pills ml-auto">
                                <li>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </li>
                              </ul>
                            </div>
                        </div>

                        <div class="card-body p-0" style="height: 60vh ;" id='set-iframe'>

                        </div>
                    </div>
                </section>

				
				
				
				
				
				
            </div>
        </div>
		
    </section>
	
	 <div id="wg" class="windowGroup">

    </div>

    <div id="wg1" class="windowGroup">

    </div>
    <x-remove-confirm />
    <x-reject-modal />

@endsection


@section('script')
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
  @include('partials.map-js')
    <script>
        var lang = "{{ app()->getLocale() }}";
        var url = "ffa"
        var auth_ba = "{{ Auth::user()->ba }}"

        $(document).ready(function() {

  $('#choices-multiple-remove-button').append(`
                <option value="wayar_tertanggal">wayar_tertanggal</option>
                <option value="ipc_terbakar">ipc_terbakar</option>
                <option value="joint_box">joint_box</option>
                <option value="house_renovation">house_renovation</option>
            `);

            // DECLARE DROPDOWN AS CHOICE
            multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:44,
            searchResultLimit:44,
            renderChoiceLimit:44 });



            var columns = [
                {
                name:"ffa_id",
                data:'ffa_id'
                },
                {
                    data: 'ba',
                    name: 'ba',
                    orderable: true
                },
                {
                    data: 'pole_id',
                    name: 'pole_id'
                },
                {
                    data: 'pole_no',
                    name: 'pole_no'
                },
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                },
            ];
            // if (auth_ba !== '') {
                columns.push({
                    data: null,
                    render: renderQaStatus
                });
            // }

            columns.push({
                data: null,
                render: renderDropDownActions
            });
            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{{ route('ffa.index', app()->getLocale()) }}',
                    type: "GET",
                    data: function(d) {
                        if (from_date) {
                            d.from_date = from_date;
                        }
						
						 if (to_date) {
                            d.to_date = to_date;
                        }

                        if (excel_ba) {
                            d.ba = excel_ba;
                        }


                        if (qa_status) {
                            d.qa_status = qa_status;
                        }
                        if(cycle){
                            d.cycle = cycle;
                        }
                    }
                },
                columns: columns,
                order: [
                    [3, 'desc'],
                    [4,'desc']
                ]
            });




        });
    </script>
	
	
    <script>
        var layers = [];
        layers = ['']

        // for add and remove layers



        function updateLayers(param , cql)
        {

            var q_cql = cql ;
            q_cql = q_cql +` AND cycle=${cycle} `;

            if (from_date != '')
            {
                q_cql += "AND savr_review_date >=" + from_date;
            }

            if (to_date !=  '')
            {
                q_cql +=  "AND savr_review_date <=" + to_date;
            }



            if (sub_ffa != '') {
                map.removeLayer(sub_ffa)
            }

            sub_ffa = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/apks/wms", {
                layers: 'apks:tbl_savr_ffa_sub1',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(sub_ffa)
            sub_ffa.bringToFront()

           

           


            addGroupOverLays()

        }


        // add group overlayes
        function addGroupOverLays()
        {
            if (layerControl != '')
            {
                map.removeControl(layerControl);
            }


            groupedOverlays = {
                "POI": {
                    'BA': boundary,
                    'Pano': pano_layer,
                    'FFA' : sub_ffa,
                    'Work Package':work_package

                }
            };

            //add layer control on top right corner of map
            layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
                collapsed: true,
                position: 'topright'
                // groupCheckboxes: true
            }).addTo(map);
        }








        function showModalData(data, id)
        {
            $('#set-iframe').html('');
            $('#set-iframe').html(
                `<iframe src="/{{ app()->getLocale() }}/ffa-edit/${data.id}" frameborder="0" style="height:50vh; width:100%" ></iframe>`
            )

        }


    </script>



 
	
@endsection
