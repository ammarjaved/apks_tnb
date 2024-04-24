@extends('layouts.app', ['page_title' => 'Index'])

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

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

        .tt-menu {
            z-index: 9999999999999 !important;
        }

        .tt-query,
        /* UPDATE: newer versions use tt-input instead of tt-query */
        .tt-hint {
            width: 200px;
            height: 30px;
            padding: 8px 12px;
            font-size: 24px;
            line-height: 30px;
            border: 2px solid #ccc;
            border-radius: 8px;
            outline: none;
        }

        .tt-query {
            /* UPDATE: newer versions use tt-input instead of tt-query */
            box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075);
        }

        .tt-hint {
            color: #999;
        }

        .tt-menu {
            /* UPDATE: newer versions use tt-menu instead of tt-dropdown-menu */
            width: 422px;
            margin-top: 12px;
            padding: 8px 0;
            background-color: #fff;
            border: 1px solid #ccc;
            border: 1px solid rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            box-shadow: 0 5px 10px rgba(0, 0, 0, .2);
        }

        .tt-suggestion {
            padding: 3px 20px;
            font-size: 18px;
            line-height: 24px;
            cursor: pointer;
        }

        .tt-suggestion:hover {
            color: #f0f0f0;
            background-color: #0097cf;
        }

        .tt-suggestion p {
            margin: 0;
        }


        input.typeahead.tt-hint,
        input.typeahead-substation.tt-hint {
            border: 0px !important;
            background: transparent !important;
            padding: 20px 14px;
            font-size: 15px !important;

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
                    <h3>Tiang</h3>
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
            @include('components.qr-filter', ['url' => 'generate-tiang-talian-vt-and-vr-excel'])

            <div class="row">
                {{-- START TABLE --}}
                <section class="col-md-6 connectedSortable ui-sortable">

                    <div class="card" style="position: relative; left: 0px; top: 0px;">
                        <div class="card-header ui-sortable-handle" style="cursor: move;">

                            <h3 class="card-title">Tiang</h3>

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
                                        <th>TIANG NO</th>
                                        <th>BA</th>
                                        <th></th>
                                        <th>REVIEW DATE</th>
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

                            <h3 class="card-title">Tiang MAP</h3>

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
                                        <input type="radio" name="select_layer" id="select_layer_main"
                                            class="with_defects" value="ts_with_defects" onchange="selectLayer(this.value)">
                                        <label for="select_layer_main">Defects</label>
                                    </div>

                                    <div class="mx-4 d-flex">
                                        <input type="radio" name="select_layer" id="substation_without_defects"
                                            value="ts_without_defects" class="without_defects"
                                            onchange="selectLayer(this.value)">
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

                            <h3 class="card-title">Tiang Detail</h3>

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

                
                if (q == '' && searchTH != '') {
                    searchTH = '';
                    table.ajax.reload();
                }


                var matches;

                
                matches = [];
                $.ajax({
                    url: '/{{ app()->getLocale() }}/search/find-tiang/' + q,
                    dataType: 'JSON',
                    //data: data,
                    method: 'GET',
                    async: false,
                    success: function callback(data) {
                        $.each(data, function(i, str) {

                            matches.push(str.tiang_no);

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
            searchTH = suggestion;
            
            table.ajax.reload();

            if (marker != '') {
                map.removeLayer(marker)
            }
            $.ajax({
                url: '/{{ app()->getLocale() }}/search/find-tiang-cordinated/' + encodeURIComponent(
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

        function typeaheadSearch(event){
            if (marker != '') {
                map.removeLayer(marker)
            }
            searchTH = '';    
            $('.typeahead').val('');
            table.ajax.reload();
        }           
    </script>

    <script>
        var layers = [];
        layers = ['']

        // for add and remove layers



        function updateLayers(param, cql) {
            console.log(cql);

            var q_cql = cql + " AND qa_status ='Accept' "



            if (from_date != '') {
                q_cql += " AND review_date >=" + from_date;
            }

            if (to_date != '') {
                q_cql += " AND review_date <=" + to_date;
            }

            var q_f_cql = q_cql;
            for (let index = 0; index < filters.length; index++) {
                const element = filters[index];
                if (index == 0) {
                    q_f_cql += " AND " + element + "= 'YES' ";
                } else {
                    q_f_cql += " OR " + element + "= 'YES' AND " + q_cql;
                }

            }

            if (road != '') {
                map.removeLayer(road)
            }
            road = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:tbl_roads',
                format: 'image/png',
                cql_filter: "ba ILIKE '%" + param + "%'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })


            if (ts_with_defects != '') {
                map.removeLayer(ts_with_defects)
            }

            ts_with_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:ts_with_filters_defects',
                format: 'image/png',
                cql_filter: q_f_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(ts_with_defects)
            ts_with_defects.bringToFront()

            if (ts_without_defects != '') {
                map.removeLayer(ts_without_defects)
            }

            ts_without_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:ts_without_defects',
                format: 'image/png',
                cql_filter: q_f_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(ts_without_defects)
            ts_without_defects.bringToFront()


            addGroupOverLays()

        }


        // add group overlayes
        function addGroupOverLays() {
            if (layerControl != '') {
                map.removeControl(layerControl);
            }


            groupedOverlays = {
                "POI": {
                    'BA': boundary,
                    'Pano': pano_layer,
                    'Surveyed with defects': ts_with_defects,
                    'Surveyed Without defects': ts_without_defects,
                    'Roads': road,
                    'Work Package': work_package

                }
            };

            //add layer control on top right corner of map
            layerControl = L.control.groupedLayers(baseLayers, groupedOverlays, {
                collapsed: true,
                position: 'topright'
                // groupCheckboxes: true
            }).addTo(map);
        }








        function showModalData(data, id) {
            $('#set-iframe').html('');
            $('#set-iframe').html(
                `<iframe src="/{{ app()->getLocale() }}/get-tiang-edit/${data.id}" frameborder="0" style="height:50vh; width:100%" ></iframe>`
            )

        }
    </script>

    <script>
        var lang = "{{ app()->getLocale() }}";
        var url = "tiang-talian-vt-and-vr"
        var auth_ba = "{{ Auth::user()->ba }}"
        

        const defectsNames = {
            bekalan_dua_damage: 'bekalan_dua_rosak/tiada',
            bekalan_dua_other: 'bekalan_dua_lain-lain',
            blackbox_cracked: 'blackbox_bakar',
            blackbox_other: 'blackbox_lain-lain',
            ipc_burn: 'ipc_terbakar',
            ipc_other: 'ipc_lain-lain',
            jumper_burn: 'jumper_terbakar',
            jumper_other: 'jumper_lain-lain',
            jumper_sleeve: 'jumper_sleeve',
            kaki_lima_burn: 'kaki_lima_terbakar',
            kaki_lima_date_wire: 'kaki_lima_wayar_tanggal',
            kaki_lima_other: 'kaki_lima_other',
            kawasan_bend: 'kawasan_bendang',
            kawasan_forest: 'kawasan_hutan',
            kawasan_other: 'kawasan_lain-lain',
            kawasan_road: 'kawasan_jalanraya',
            kilat_broken: 'penangkap_kilat_rosak',
            kilat_other: 'penangkap_kilat_lain-lain',
            pembumian_neutral: 'pembumian_neutral',
            pembumian_other: 'pembumian_lain-lain',
            servis_other: 'servis_lain-lain',
            servis_roof: 'servis_bumbung',
            servis_won_piece: 'servis_won_piece',
            talian_ground: 'talian_ground_clearance',
            talian_joint: 'talian_maruku_joint',
            talian_need_rentis: 'talian_perlu rentis',
            talian_other: 'talian_lain-lain',
            tapak_condition_road: 'tapak_condition_melintasi_jalanraya',
            tapak_condition_side_walk: 'tapak_condition_bahu_jalan',
            tapak_condition_vehicle_entry: 'tapak_condition_tidak_dimasuki_kenderaan',
            tiang_cracked: 'tiang_reput/retak',
            tiang_creepers: 'tiang_creepers',
            tiang_leaning: 'tiang_condong',
            tiang_other: 'tiang_lain-lain',
            tinag_dimm: 'tiang_pudar',
            umbang_breaking: 'umbang_tiada_stay_insulator',
            umbang_cracked: 'umbang_kendur/putus',
            umbang_creepers: 'umbang_creepers',
            umbang_other: 'umbang_lain-lain',
            umbang_stay_palte: 'umbang_stay_plate'
        };



        $(document).ready(function() {


            // ADD DEFECTS  IN SLECT OPTIONS
            for (const key in defectsNames) {
                const value = defectsNames[key];
                $('#choices-multiple-remove-button').append(`<option value="${key}">${value}</option>`);
            }

            // DECLARE DROPDOWN AS CHOICE
            multipleCancelButton = new Choices('#choices-multiple-remove-button', {
                removeItemButton: true,
                maxItemCount: 44,
                searchResultLimit: 44,
                renderChoiceLimit: 44
            });

            



            // DEFINE TABLE  COLUMNS 
            var columns = [{
                    data: 'tiang_no',
                    name: 'tiang_no'
                },
                {
                    data: 'ba',
                    name: 'ba',
                    orderable: true
                },
                {
                    data: 'review_date',
                    name: 'review_date'
                },
                {
                    data: 'id',
                    name: 'id',
                    visible: false,
                },
                {
                    data: 'total_defects',
                    name: 'total_defects'
                },
                {
                    data: null,
                    render: renderDropDownActions
                }
            ];



            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,

                ajax: {
                    url: '{{ route('tiang-talian-vt-and-vr.index', app()->getLocale()) }}',
                    type: "GET",
                    data: function(d) {
                        if (from_date) {
                            d.from_date = from_date
                        }
                        if (excel_ba) {
                            d.ba = excel_ba
                        }
                        if (to_date) {
                            d.to_date = to_date
                        }
                        if (filters) {
                            d.arr = filters
                        }
                        if (qa_status) {
                            d.qa_status = qa_status
                        }
                        if (f_status) {
                            d.status = f_status;
                            d.image = 'pole_image_1';
                        }
                        if (searchTH) {
                            d.searchTH = searchTH 
                        }
                    }
                },
                columns: columns, // ADD COLUMNS
                order: [
                    [1, 'desc'],
                    [0, 'desc']
                ],

                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:not(:first-child)').addClass('text-center');
                }
            })
        });
    </script>
@endsection
