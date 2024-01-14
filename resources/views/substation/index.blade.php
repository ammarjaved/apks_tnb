@extends('layouts.app_tnb', ['page_title' => 'Index'])

@section('css')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.js"></script>
    <script src="https://malsup.github.io/jquery.form.js"></script>
    <script>
        var $jq = $.noConflict(true);
    </script>
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

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
    </style>
@endsection

@section('script')

@section('content')
    {{-- <section class="content-header pb-0">
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
    </section> --}}


    <section class="content-">
        <div class="container-fluid">



            @include('components.message')







            <div class="row">
                @include('components.qr-filter', ['url' => 'generate-substation-excel'])


                <div class="col-md-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between ">
                            <p class="mb-0">{{ __('messages.substation') }}</p>
                            <div class="d-flex ml-auto">
                                {{-- <a href="{{ route('substation.create', app()->getLocale()) }}"><button
                                        class="btn text-white btn-success  btn-sm mr-4">Add Substation</button></a> --}}


                                <button class="btn text-white  btn-sm mr-4" type="button" data-toggle="collapse"
                                    style="background-color: #708090" data-target="#collapseQr" aria-expanded="false"
                                    aria-controls="collapseQr">
                                    QR Substation
                                </button>

                            </div>
                        </div>


                        <div class="card-body">
                            <div class="text-right mb-4">

                            </div>



                            {{-- <table id="pagination" class="table table-bordered table-hover"> --}}

                            <div class="table-responsive add-substation" id="add-substation">
                                <table id="" class="table table-bordered  table-hover data-table">


                                    <thead>
                                        <tr>
                                            <th rowspan="2">{{ __('messages.name') }}</th>
                                            <th rowspan="2">{{ __('messages.visit_date') }} </th>
                                            <th rowspan="2">asdas</th>
                                            <th colspan="3" class="text-center" style="border-bottom: 0px">
                                                {{ __('messages.gate') }}</th>
                                            <th colspan="2" class="text-center" style="border-bottom: 0px">
                                                {{ __('messages.tree') }}</th>
                                            <th colspan="4" class="text-center" style="border-bottom: 0px">
                                                {{ __('messages.building_defects') }}
                                            </th>
                                            <th class="nowrap" style="border-bottom: 0px">{{ __('messages.add_clean_up') }}
                                            </th>
                                            <th rowspan="2">{{ __('messages.total_defects') }} </th>
                                            @if (Auth::user()->ba !== '')
                                                <th rowspan="2">QA Status</th>
                                            @endif


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

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>





    </section>


    <x-remove-confirm />

    <x-reject-modal />
@endsection



    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>


    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>


    <script>
        var lang = "{{ app()->getLocale() }}";
        var url = "substation"
        var auth_ba = "{{ Auth::user()->ba }}"
      


        $(document).ready(function() {


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

            multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:44,
            searchResultLimit:44,
            renderChoiceLimit:44
          });
   

     

            var columns = [{
                    render: function(data, type, full) {
                        return `<a href="/{{ app()->getLocale() }}/substation/${full.id}/edit" class="text-decoration-none text-dark">${full.name}</a>`;
                    },
                    name: 'name'
                },
                {
                    data: 'visit_date',
                    name: 'visit_date',
                    orderable: true
                },
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                },
                {
                    data: 'unlocked',
                    name: 'unlocked'
                },
                {
                    data: 'demaged',
                    name: 'demaged'
                },

                {
                    data: 'other_gate',
                    name: 'other_gate'
                },
                {
                    data: 'grass_status',
                    name: 'grass_status'
                },
                {
                    data: 'tree_branches_status',
                    name: 'tree_branches_status'
                },
                {
                    data: 'broken_roof',
                    name: 'broken_roof'
                },
                {
                    data: 'broken_gutter',
                    name: 'broken_gutter'
                },
                {
                    data: 'broken_base',
                    name: 'broken_base'
                },
                {
                    data: 'building_other',
                    name: 'building_other'
                },

                {
                    data: 'advertise_poster_status',
                    name: 'advertise_poster_status'
                },
                {
                    data: 'total_defects',
                    name: 'total_defects'
                }
            ];
            if (auth_ba !== '') {
                columns.push({
                    data: null,
                    render: renderQaStatus
                });
            }

            columns.push({
                data: null,
                render: renderDropDownActions
            });






             table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,


                ajax: {
                    url: '{{ route('substation.index', app()->getLocale()) }}',
                    type: "GET",
                    data: function(d) {

                        if (from_date) {
                            d.from_date = from_date;
                        }

                        if (excel_ba) {
                            d.ba = excel_ba;
                        }

                        if (to_date) {
                            d.to_date = to_date;
                        }
                        if (f_status) {
                            d.status = f_status;
                            d.image = 'substation_image_1';
                        }
                        if (qa_status) {
                            d.qa_status = qa_status;
                        }

                        if (filters) {
                            d.arr = filters;
                        }
                    }
                },
                columns: columns,
                order: [
                    [1, 'desc'],
                    [0, 'desc']

                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:not(:first-child)').addClass('text-center');
                }
            })


            // $('.data-table').on( 'click', 'tr', function(e) {
            //     e.preventDefault();
            //     var id = console.log(table.row( this ).x) /// How can i get the UUID
            // } );


        });




function zoomToLoc(x,y){
        map.flyTo([parseFloat(y), parseFloat(x)], 16, {
                        duration: 1.5, // Animation duration in seconds
                        easeLinearity: 0.25,
                    });
                    L.marker([parseFloat(y), parseFloat(x)]).addTo(map);            
 }                


        function filter_data_withDefects(){
            var defect_vals=$("#choices-multiple-remove-button").val();
            filters = defect_vals;

            table.ajax.reload();
            // console.log( defect_vals);

            // $.ajax({
            //         url: '/{{app()->getLocale()}}/get_defect_data?arr='+defect_vals,
            //         method: 'GET',
            //         async: false,
            //         success: function callback(data) {
            //         }
            //     })

        }


    </script>
{{-- @endsection --}}

@section('content1')
@include('partials.map-css')
<style>
    #map {
        height: 60vh;
        z-index: 1;
    }
</style>
    @if (Session::has('failed'))
        <div class="alert {{ Session::get('alert-class', 'alert-secondary') }}" role="alert">
            {{ Session::get('failed') }}

            <button type="button" class="close border-0 bg-transparent" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>

        </div>
    @endif

   
    <div class="container-fluid bg-white pt-2">


        <div class="p-3 form-input  ">
            <label for="select_layer">Select Layer : </label>
            <span class="text-danger" id="er-select-layer"></span>
            <div class="d-sm-flex">
                <div class="">
                    <input type="radio" name="select_layer" id="select_layer_main" class="with_defects"
                        value="substation_with_defects" onchange="selectLayer(this.value)">
                    <label for="select_layer_main">Surveyed with defects</label>
                </div>

                <div class="mx-4">
                    <input type="radio" name="select_layer" id="substation_without_defects"
                        value="substation_without_defects" class="without_defects" onchange="selectLayer(this.value)">
                    <label for="substation_without_defects">Surveyed without defects</label>
                </div>
                @if (Auth::user()->ba != '')
                    <div class=" mx-4">
                        <input type="radio" name="select_layer" id="select_layer_unsurveyed" value="unsurveyed"
                            onchange="selectLayer(this.value)" class="unsurveyed">
                        <label for="select_layer_unsurveyed">Unsurveyed </label>
                    </div>

                    <div class=" mx-4">
                        <input type="radio" name="select_layer" id="select_layer_pending" value="sub_pending"
                            onchange="selectLayer(this.value)" class="pending">
                        <label for="select_layer_pending">Pending </label>
                    </div>


                    <div class=" mx-4">
                        <input type="radio" name="select_layer" id="select_layer_reject" value="sub_reject"
                            onchange="selectLayer(this.value)" class="reject">
                        <label for="select_layer_reject">Reject </label>
                    </div>
                @endif

                <div class=" mx-4">
                    <input type="radio" name="select_layer" id="select_layer_pano" value="pano"
                        onchange="selectLayer(this.value)">
                    <label for="select_layer_pano">Pano</label>
                </div>
                <div class="mx-4">
                    <div id="the-basics">
                        <input class="typeahead" type="text" placeholder="search substation" class="form-control">
                    </div>
                </div>


            </div>

          
        </div>

        <!--  START MAP CARD DIV -->
        <div class="row m-2">

            <div class="col-md-12 p-0 ">
                <div class="card p-0 m-0"
                    style="border: 1px solid rgb(177, 175, 175) !important; border-radius: 0px !important;">
                    <div class="card-header text-center"><strong> MAP</strong></div>
                    <div class="card-body p-0">
                        <div id="map">

                        </div>
                    </div>
                </div>

            </div>

            <div class="col-md-12">
                <div class="card p-0 m-0"
                    style="border: 1px solid rgb(177, 175, 175) !important; border-radius: 0px !important;">

                    <div class="card-header text-center"><strong>Detail</strong></div>

                    <div class="card-body p-0" style="height: 50vh ;overflow-y:scroll;" id='set-iframe'>

                    </div>
                </div>
            </div>
            <!-- END MAP  DIV -->
            <div id="wg" class="windowGroup">

            </div>

            <div id="wg1" class="windowGroup">

            </div>

        </div><!--  END MAP CARD DIV -->
    </div>


    <div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Site Data Info</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body ">
                    <table class="table table-bordered">
                        <tbody id="my_data"></tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>
@endsection

{{-- @section('script') --}}
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
        function addRemoveBundary(param, paramY, paramX) {




            if (work_package) {
                map.removeLayer(work_package);
            }

            work_package = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_workpackage',
                format: 'image/png',
                cql_filter: "ba ILIKE '%" + param + "%'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(work_package)
            // work_package.bringToFront()



            if (boundary !== '') {
                map.removeLayer(boundary)
            }



            boundary = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:ba',
                format: 'image/png',
                cql_filter: "station ILIKE '%" + param + "%'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })
            map.addLayer(boundary)
            boundary.bringToFront()


            if (pano_layer !== '') {
                map.removeLayer(pano_layer)
            }
            pano_layer = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:pano_apks',
                format: 'image/png',
                cql_filter: "ba ILIKE '%" + param + "%'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            });
            // map.addLayer(pano_layer);
            // map.addLayer(pano_layer)




            map.flyTo([parseFloat(paramY), parseFloat(paramX)], zoom, {
                duration: 1.5, // Animation duration in seconds
                easeLinearity: 0.25,
            });

            updateLayers(param);

        }


        function updateLayers(param) {

            var q_cql = "ba ILIKE '%" + param + "%' "
            if (from_date != '') {
                q_cql = q_cql + "AND visit_date >=" + from_date;
            }
            if (to_date != '') {
                q_cql = q_cql + "AND visit_date <=" + to_date;
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

            if (ba !== '') {



                if (sub_reject != '') {
                    map.removeLayer(sub_reject)
                }

                sub_reject = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                    layers: 'cite:sub_reject',
                    format: 'image/png',
                    cql_filter: q_cql,
                    maxZoom: 21,
                    transparent: true
                }, {
                    buffer: 10
                })


                map.addLayer(sub_reject)
                sub_reject.bringToFront()


                if (sub_pending != '') {
                    map.removeLayer(sub_pending)
                }

                sub_pending = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                    layers: 'cite:sub_pending',
                    format: 'image/png',
                    cql_filter: q_cql,
                    maxZoom: 21,
                    transparent: true
                }, {
                    buffer: 10
                })


                map.addLayer(sub_pending)
                sub_pending.bringToFront()

                if (unservey != '') {
                    map.removeLayer(unservey)
                }
                unservey = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                    layers: 'cite:sub_unserveyed',
                    format: 'image/png',
                    cql_filter: "ba ILIKE '%" + param + "%'",
                    maxZoom: 21,
                    transparent: true
                }, {
                    buffer: 10
                })

                map.addLayer(unservey)
                unservey.bringToFront()

            }

            addGroupOverLays()

        }


        // add group overlayes
        function addGroupOverLays() {
            if (layerControl != '') {
                // console.log("inmsdanssdkjnasjnd");
                map.removeControl(layerControl);
            }

            if (ba !== '') {


            groupedOverlays = {
                "POI": {
                    'BA': boundary,
                    'Pano': pano_layer,
                    'With defects': substation_with_defects,
                    'Without defects': substation_without_defects,
                    'Unsurveyed': unservey,

                    'Work Package': work_package,
                    'Pending': sub_pending,
                    'Reject': sub_reject
                }
            };
        }else{

            groupedOverlays = {
                "POI": {
                    'BA': boundary,
                    'Pano': pano_layer,
                    'With defects': substation_with_defects,
                    'Without defects': substation_without_defects,
                    'Work Package': work_package,
                }
            };

        }
            //add layer control on top right corner of map
            layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
                collapsed: true,
                position: 'topright'
                // groupCheckboxes: true
            }).addTo(map);
        }








        function showModalData(data, id) {
            var str = '';
            var idSp = id; //.split('.');

            $('#exampleModalLabel').html("Substation Info")
            str = ` <tr><th>Zone</th><td>${data.zone}</td> </tr>
        <tr><th>Ba</th><td>${data.ba}</td> </tr>
        <tr><th>Type</th><td>${data.type}</td> </tr>
        <tr><th>Voltage</th><td>${data.voltage}</td> </tr>
        <tr><th>Coordinate</th><td>${data.coordinate}</td> </tr>
        <tr><th>Created At</th><td>${data.created_at}</td> </tr>
        <tr><th>Detail</th><td class="text-center">    <a href="/{{ app()->getLocale() }}/substation/${idSp[1]}" target="_blank" class="btn btn-sm btn-secondary">Detail</a>
            </td> </tr>
        `


            console.log(data.id);
            openDetails(data.id);

        }

        function openDetails(id) {
            // $('#myModal').modal('hide');
            $('#set-iframe').html('');

            $('#set-iframe').html(
                `<iframe src="/{{ app()->getLocale() }}/get-substation-edit/${id}" frameborder="0" style="height:50vh; width:100%" ></iframe>`
            )


        }
    </script>
@endsection
