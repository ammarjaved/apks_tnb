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
#fullscreenOverlay {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    width: 100vw !important;
    height: 100vh !important;
    background-color: #fff !important; /* Set your desired background color */
    z-index: 9999 !important; /* Make sure the overlay is on top */
    display: none !important; /* Initially hide the overlay */
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
                    <h3>{{ __('messages.substation') }}</h3>
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
            @include('components.qr-filter', ['url' => 'generate-substation-excel'])

            <div class="row">
                {{-- START TABLE --}}
                <section class="col-md-6 connectedSortable ui-sortable">

                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">{{ __('messages.substation') }}</h3>

                            <div class="card-tools">
                              <ul class="nav nav-pills ml-auto">
                                <li>
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </li>
                                {{-- <li>
                                    <button id="fullscreenButton">
                                        <i class="fas fa-expand-arrows-alt text-white"></i>
                                    </button>
                                    <button id="exitFullscreenButton">
                                        <i class="fas fa-expand-arrows-alt text-white"></i>
                                    </button>
                                </li> --}}
                              </ul>
                            </div>
                        </div>
 


                        <div class="card-body" id="yourMapElement">
                            {{-- <div class="text-right mb-4">
                                <button class="btn text-white  btn-sm mr-4" type="button" data-toggle="collapse"
                                style="background-color: #708090" data-target="#collapseQr" aria-expanded="false"
                                aria-controls="collapseQr">
                                QR Substation
                              </button>
                            </div> --}}


                            <div class="table-responsive add-substation" id="add-substation">
                                <table id="" class="table table-bordered  table-hover data-table">
                                    <thead>
                                        <tr>
                                            <th rowspan="2">{{ __('messages.name') }}</th>
                                            <th rowspan="2">{{ __('messages.visit_date') }} </th>
                                            <th rowspan="2">asdas</th>
                                            <th colspan="3" class="text-center" style="border-bottom: 0px">{{ __('messages.gate') }}</th>
                                            <th colspan="2" class="text-center" style="border-bottom: 0px">{{ __('messages.tree') }}</th>
                                            <th colspan="4" class="text-center" style="border-bottom: 0px">{{ __('messages.building_defects') }}</th>
                                            <th class="nowrap" style="border-bottom: 0px">{{ __('messages.add_clean_up') }}</th>
                                            <th rowspan="2">{{ __('messages.total_defects') }} </th>
                                            <th rowspan="2">ACTION</th>
                                        </tr>
                                        <tr class="lower-header">
                                            <th>{{ __('messages.unlocked') }}</th>
                                            <th>{{ __('messages.demaged') }}</th>
                                            <th>{{ __('messages.others') }} </th>
                                            <th class="nowrap">{{ __('messages.long_grass') }} </th>
                                            <th class="nowrap">{{ __('messages.tree_branches_in_PE') }} </th>
                                            <th class="nowrap">{{ __('messages.broken_roof') }} </th>
                                            <th>{{ __('messages.broken_gutter') }} </th>
                                            <th>{{ __('messages.broken_base') }} </th>
                                            <th>{{ __('messages.others') }} </th>
                                            <th>{{ __('messages.cleaning_illegal_ads_banners') }} </th>
                                        </tr>
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

                            <h3 class="card-title">{{ __('messages.substation') }} MAP</h3>

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
                                            value="substation_with_defects" onchange="selectLayer(this.value)">
                                        <label for="select_layer_main">Defects</label>
                                    </div>
                    
                                    <div class="mx-4 d-flex">
                                        <input type="radio" name="select_layer" id="substation_without_defects"
                                            value="substation_without_defects" class="without_defects" onchange="selectLayer(this.value)">
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

                            <h3 class="card-title">{{ __('messages.substation') }} Detail</h3>

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
 
        var substringMatcher = function(strs) {

            return function findMatches(q, cb) {

                var matches;

                matches = [];
                $.ajax({
                    url: '/{{ app()->getLocale() }}/search/find-substation/' + q,
                    dataType: 'JSON',
                    //data: data,
                    method: 'GET',
                    async: false,
                    success: function callback(data) {
                        $.each(data, function(i, str) {

                            matches.push(str.name);

                        });
                    }
                })

                cb(matches);
            };
        };


        var marker = '';
        $('#the-basics .typeahead').typeahead({
            hint: true,
            highlight: true,
            minLength: 1
        }, {
            name: 'states',
            source: substringMatcher()
        });

        $('.typeahead').on('typeahead:select', function(event, suggestion) {
            var name = encodeURIComponent(suggestion);

            if (marker != '') {
                map.removeLayer(marker)
            }
            $.ajax({
                url: '/{{ app()->getLocale() }}/search/find-substation-cordinated/' + encodeURIComponent(
                    name),
                dataType: 'JSON',
                //data: data,
                method: 'GET',
                async: false,
                success: function callback(data) {
                    console.log(data);
                    map.flyTo([parseFloat(data.y), parseFloat(data.x)], 16, {
                        duration: 1.5, // Animation duration in seconds
                        easeLinearity: 0.25,
                    });

                    marker = new L.Marker([data.y, data.x]);
                    map.addLayer(marker);
                }
            })

        });
    </script>
    
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


            if (substation_without_defects != '') {
                map.removeLayer(substation_without_defects)
            }
            substation_without_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:substation_without_defects',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(substation_without_defects)
            substation_without_defects.bringToFront()



            if (substation_with_defects != '') {
                map.removeLayer(substation_with_defects)
            }

            substation_with_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:surved_with_defects',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })


            map.addLayer(substation_with_defects)
            substation_with_defects.bringToFront()

             
            addGroupOverLays()

        }


        // add group overlayes
        function addGroupOverLays() 
        {
            if (layerControl != '') 
            {
                map.removeControl(layerControl);
            }

          
            groupedOverlays = 
            {
                "POI": 
                {
                    'BA': boundary,
                    'Pano': pano_layer,
                    'With defects': substation_with_defects,
                    'Without defects': substation_without_defects,
                    'Work Package': work_package,
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
                `<iframe src="/{{ app()->getLocale() }}/get-substation-edit/${data.id}" frameborder="0" style="height:50vh; width:100%" ></iframe>`
            )
           
        }

       
    </script>

    <script>
        var lang = "{{ app()->getLocale() }}";
        var url = "substation"
        var auth_ba = "{{ Auth::user()->ba }}"
      
//         var fullscreenElement = document.getElementById('yourMapElement'); // replace 'yourMapElement' with the actual ID or class of your map container


// // You can trigger full screen like this (e.g., on a button click)
// document.getElementById('fullscreenButton').addEventListener('click', function() {
//     openFullscreen();
// });

// // You can also exit full screen similarly (e.g., on another button click)
// document.getElementById('exitFullscreenButton').addEventListener('click', function() {
//     closeFullscreen();
// });



        $(document).ready(function() {

          
            // ADD DEFECTS  IN SLECT OPTIONS
            $('#choices-multiple-remove-button').append(`
                        <option value="grass">grass</option>
                        <option value="treebranches">tree_branches_status</option>
                        <option value="gate_loc">gate_loc</option>
                        <option value="gate_demage">gate_demage</option>
                        <option value="gate_other">gate_other</option>
                        <option value="broken_gutter">broken_gutter</option>
                        <option value="broken_roof">broken_roof</option>
                        <option value="broken_base">broken_base</option>
                        <option value="building_other">building_others</option>
                        <option value="poster_status">poster_status</option>
            `)

            // DECLARE DROPDOWN AS CHOICE
            multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:44,
            searchResultLimit:44,
            renderChoiceLimit:44 });
   

     
                // DEFINE TABLE  COLUMNS 
            var columns = [
                { render: function(data, type, full) 
                    { return `<a href="/{{ app()->getLocale() }}/substation/${full.id}/edit" class="text-decoration-none text-dark">${full.name}</a>`;},
                    name: 'name'
                },
                {data: 'visit_date', name: 'visit_date', orderable: true },
                {data: 'id', name: 'id', visible: false },
                {data: 'unlocked', name: 'unlocked' },
                {data: 'demaged', name: 'demaged' },
                {data: 'other_gate', name: 'other_gate' },
                {data: 'grass_status', name: 'grass_status' },
                {data: 'tree_branches_status', name: 'tree_branches_status' },
                {data: 'broken_roof', name: 'broken_roof' },
                {data: 'broken_gutter', name: 'broken_gutter' },
                {data: 'broken_base', name: 'broken_base' },
                {data: 'building_other', name: 'building_other' },
                {data: 'advertise_poster_status', name: 'advertise_poster_status' },
                {data: 'total_defects', name: 'total_defects'},
                {data: null, render: renderDropDownActions }
            ];
            


             table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,

                ajax: 
                {
                    url: '{{ route('substation.index', app()->getLocale()) }}',
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
                            d.image = 'substation_image_1';
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



           


        function openFullscreen() {
    if (fullscreenElement.requestFullscreen) {
        fullscreenElement.requestFullscreen();
    } else if (fullscreenElement.mozRequestFullScreen) { // Firefox
        fullscreenElement.mozRequestFullScreen();
    } else if (fullscreenElement.webkitRequestFullscreen) { // Chrome, Safari and Opera
        fullscreenElement.webkitRequestFullscreen();
    } else if (fullscreenElement.msRequestFullscreen) { // IE/Edge
        fullscreenElement.msRequestFullscreen();
    }
}

function closeFullscreen() {
    if (document.exitFullscreen) {
        document.exitFullscreen();
    } else if (document.mozCancelFullScreen) {
        document.mozCancelFullScreen();
    } else if (document.webkitExitFullscreen) {
        document.webkitExitFullscreen();
    } else if (document.msExitFullscreen) {
        document.msExitFullscreen();
    }
}


    </script>
@endsection

