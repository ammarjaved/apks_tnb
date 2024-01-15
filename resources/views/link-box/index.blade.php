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

    {{-- bread crumbs start --}}
    <section class="content-header pb-0">
        <div class="container-  ">
            <div class="row  mb-0 pb-0" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{ __('messages.link_box_pelbagai_voltan') }}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a
                                href="/{{ app()->getLocale() }}/dashboard">{{ __('messages.dashboard') }}</a></li>
                        <li class="breadcrumb-item active">{{ __('messages.index') }} </li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    {{-- bread crumb end --}}

    @include('components.message')



    

    {{-- section content --}}
    <section class="content-  ">

        <div class="container-fluid">

            {{-- ADD FILTERS --}}
            @include('components.qr-filter', ['url' => 'generate-link-box-excel'])

            <div class="row">
                {{-- START TABLE --}}
                <section class="col-md-6 connectedSortable ui-sortable">

                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">{{ __('messages.link_box_pelbagai_voltan') }}</h3>

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
                                <table id="" class="table table-bordered  table-hover data-table">
                                    <thead>
                                        <th>ID</th>
                                        <th>ZONE</th>
                                        <th>BA</th>
                                        <th>TEAM</th>
                                        <th>VISIT DATE</th>
                                        <th>TOTAL DEFECTS</th> 
                                        <th>ACTION</th>
                                    
                                    </thead>

                                    <tbody>  
                                        {{-- comming from script --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </section>
                {{-- END TABLE  --}}


                <section class="col-md-6 connectedSortable ui-sortable">
                    
                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">{{ __('messages.link_box_pelbagai_voltan') }} MAP</h3>

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
                                {{-- <label for="select_layer">Select Layer : </label> --}}
                                <span class="text-danger" id="er-select-layer"></span>
                                <div class="d-sm-flex">
                                    <div class="d-flex">
                                        <input type="radio" name="select_layer" id="select_layer_main" class="with_defects"
                                            value="lb_with_defects" onchange="selectLayer(this.value)">
                                        <label for="select_layer_main">Defects</label>
                                    </div>
                    
                                    <div class="mx-4 d-flex">
                                        <input type="radio" name="select_layer" id="substation_without_defects"
                                            value="lb_without_defects" class="without_defects" onchange="selectLayer(this.value)">
                                        <label for="substation_without_defects">Without defects</label>
                                    </div>
                    
                                    <div class="  d-flex">
                                        <input type="radio" name="select_layer" id="select_layer_pano" value="pano"
                                            onchange="selectLayer(this.value)">
                                        <label for="select_layer_pano">Pano</label>
                                    </div>

                                    {{-- <div class="mx-4">
                                        <div id="the-basics">
                                            <input class="typeahead" type="text" placeholder="search substation" class="form-control">
                                        </div>
                                    </div>
                                    --}}
                    
                                </div>

                                <div id="map">

                                </div>
                    
                              
                            </div>
                        </div>
                    </div>


                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">{{ __('messages.link_box_pelbagai_voltan') }} Detail</h3>

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
 
@endsection


@section('script')

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>
    @include('partials.map-js')

 
    
    <script>
        var layers = [];
        layers = ['']

        // for add and remove layers
      


        function updateLayers(param) 
        {

            var q_cql = "ba ILIKE '%" + param + "%' AND qa_status ='Accept' "
            if (from_date != '') 
            {
                q_cql += "AND visit_date >=" + from_date;
            }

            if (to_date !=  '') 
            {
                q_cql +=  "AND visit_date <=" + to_date;
            }

            
           

            if (lb_with_defects != '') {
                map.removeLayer(lb_with_defects)
            }

            lb_with_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:lb_with_defects',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(lb_with_defects)
            lb_with_defects.bringToFront()

            if (lb_without_defects != '') {
                map.removeLayer(lb_without_defects)
            }

            lb_without_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:lb_without_defects',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(lb_without_defects)
            lb_without_defects.bringToFront()

             
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
                    'Surveyed with defects' : lb_with_defects,
                    'Surveyed Without defects' : lb_without_defects, 
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
                `<iframe src="/{{ app()->getLocale() }}/get-link-box-edit/${data.id}" frameborder="0" style="height:50vh; width:100%" ></iframe>`
            )
           
        }

       
    </script>

    <script>
        var lang = "{{ app()->getLocale() }}";
        var url = "link-box-pelbagai-voltan"
        var auth_ba = "{{ Auth::user()->ba }}"
      
       


        $(document).ready(function() {

          
            // ADD DEFECTS  IN SLECT OPTIONS
            $('#choices-multiple-remove-button').append(`
                <option value="vandalism_status">vandalism_status</option>
                <option value="leaning_staus">leaning_status</option>
                <option value="rust_status">rust_status</option>
                <option value="advertise_poster_status">advertise_poster_status</option>
                <option value="bushes_status">bushes_status</option>
                <option value="cover_status">cover_status</option>
            `);

            // DECLARE DROPDOWN AS CHOICE
            multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:44,
            searchResultLimit:44,
            renderChoiceLimit:44 });
   

     
                // DEFINE TABLE  COLUMNS 
                var columns = [
                    { data: "link_box_id", name: "link_box_id" },
                    { data: 'zone', name: 'zone' },
                    { data: 'ba', name: 'ba', orderable: true },
                    { data: 'team', name: 'team' },
                    { data: 'visit_date', name: 'visit_date' },
                    { data: 'total_defects', name: 'total_defects' },
                    { data: null, render: renderDropDownActions }
                ];
            


             table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,

                ajax: 
                {
                    url: '{{ route('link-box-pelbagai-voltan.index', app()->getLocale()) }}',
                    type: "GET",
                    data: function(d) 
                    {
                        if (from_date) { d.from_date = from_date }
                        if (excel_ba)  { d.ba        = excel_ba }
                        if (to_date)   { d.to_date   = to_date }
                        if (filters)   { d.arr       = filters }
                        if (qa_status) { d.qa_status = qa_status }
                        if (f_status) 
                        { 
                            d.status = f_status; 
                            d.image = 'link_box_image_1';
                        }
                    }
                },
                columns: columns,  // ADD COLUMNS
                order: [ [1, 'desc'], [0, 'desc'] ],

                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:not(:first-child)').addClass('text-center');
                }
            })
        });



 


    </script>
@endsection

