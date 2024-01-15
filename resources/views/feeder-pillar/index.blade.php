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

        .collapse {
            visibility: visible;
        }
    </style>
@endsection


@section('script')
@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row mb-2" style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{ __('messages.feeder_pillar') }}</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item text-lowercase "><a
                                href="/{{ app()->getLocale() }}/dashboard">{{ __('messages.dashboard') }}</a></li>
                        <li class="breadcrumb-item text-lowercase active">{{ __('messages.index') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>


    <section class="content">
        <div class="container-fluid">



            @include('components.message')


            <div class="row">
                @include('components.qr-filter', ['url' => 'generate-feeder-pillar-excel'])
                <div class="col-12">
                    <div class="card">

                        <div class="card-header d-flex justify-content-between ">
                            <p class="mb-0">{{ __('messages.feeder_pillar') }}</p>
                            <div class="d-flex ml-auto">
                                {{-- <a href="{{ route('feeder-pillar.create', app()->getLocale()) }}"><button
                                        class="btn text-white btn-success  btn-sm mr-4">Add Fedder Pillar</button></a> --}}

                                <button class="btn text-white  btn-sm mr-4" type="button" data-toggle="collapse"
                                    style="background-color: #708090" data-target="#collapseQr" aria-expanded="false"
                                    aria-controls="collapseQr">
                                    QR Feeder Pillar
                                </button>
                                {{-- <a href="{{route('generate-feeder-pillar-excel',app()->getLocale())}}"> <button class="btn text-white  btn-sm mr-4" style="background-color: #708090">QR Feeder Pillar</button></a> --}}
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
                                            <th>VISIT DATE</th>
                                            <th>UNLOCKED</th>
                                            <th>DEMAGED</th>
                                            <th>OTHER</th>
                                            <th>VANDALISM</th>
                                            <th>LEANING</th>
                                            <th>RUST</th>
                                            <th>ADVERTISE POSTER</th>
                                            <th>TOTAL DEFECTS</th>
                                            @if (Auth::user()->ba !== '')
                                            <th >QA Status</th>
                                            @endif
                                            <th>ACTION</th>

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


{{-- @section('script') --}}
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('assets/js/generate-qr.js') }}"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.11.3/datatables.min.js"></script>

    <script>
        var lang = "{{ app()->getLocale() }}";
        var url = "feeder-pillar"
 var auth_ba = "{{Auth::user()->ba}}"


        $(document).ready(function() {
            $('#choices-multiple-remove-button').append(`
            <option value="vandalism_status">vandalism_status</option>
                        <option value="leaning_staus">leaning_status</option>
                        <option value="gate_loc">gate_loc</option>
                        <option value="gate_demage">gate_demage</option>
                        <option value="gate_other">gate_other</option>
                        <option value="rust_status">rust_status</option>
                        <option value="advertise_poster_status">advertise_poster_status</option>
            `)

             multipleCancelButton = new Choices('#choices-multiple-remove-button', {
            removeItemButton: true,
            maxItemCount:44,
            searchResultLimit:44,
            renderChoiceLimit:44
          });

            var columns = [{
                        data: 'feeder_pillar_id',
                        name: 'feeder_pillar_id'
                    },
                    {
                        data: 'ba',
                        name: 'ba',
                        orderable: true
                    },
                    {
                        data: 'visit_date',
                        name: 'visit_date'
                    },

                    {
                        data: 'unlocked',
                        name: 'unlocked',
                    }, {
                        data: 'demaged',
                        name: 'demaged',
                    },
                    {
                        data: 'other_gate',
                        name: 'other_gate'
                    },
                    {
                        data: 'vandalism_status',
                        name: 'vandalism_status'
                    }, {
                        data: 'leaning_status',
                        name: 'leaning_status'
                    },
                    {
                        data: 'rust_status',
                        name: 'rust_status'
                    },
                    {
                        data: 'advertise_poster_status',
                        name: 'advertise_poster_status'
                    },
                    {
                        data: 'total_defects',
                        name: 'total_defects'
                    },

                ];
                if (auth_ba !== '') {
        columns.push({ data: null, render: renderQaStatus });
    }

    columns.push({ data: null, render: renderDropDownActions });

            table = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,


                ajax: {
                    url: '{{ route('feeder-pillar.index', app()->getLocale()) }}',
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
                            d.image = 'feeder_pillar_image_1';
                        }
                        if (qa_status) {
                            d.qa_status = qa_status;
                        }
                        if (filters) {
                            d.arr = filters;
                        }
                    }
                },
                columns : columns,
                order: [
                    [0, 'desc']
                ],
                createdRow: function(row, data, dataIndex) {
                    $(row).find('td:not(:first-child)').addClass('text-center');
                }
            })




        });
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


        <div class="p-3 form-input w-">
            <label for="select_layer">Select Layer : </label>
            <span class="text-danger" id="er-select-layer"></span>
            <div class="d-sm-flex">
                





                <div class=" mx-4 d-flex">
                    <input type="radio" name="select_layer" id="fp_surveyed" value="fp_without_defects" class="without_defects"
                        onchange="selectLayer(this.value)">
                    <label for="fp_surveyed">Surveyed without defects</label>
                </div>


                <div class=" mx-4 d-flex">
                    <input type="radio" name="select_layer" id="fp_with_defects" value="fp_with_defects"
                        class="with_defects" onchange="selectLayer(this.value)">
                    <label for="fp_with_defects">Surveyed with defects</label>
                </div>
                @if (Auth::user()->ba != '')



                <div class=" mx-4 d-flex">
                    <input type="radio" name="select_layer" id="fp_unsurveyed" value="fp_unsurveyed" class="unsurveyed"
                        onchange="selectLayer(this.value)">
                    <label for="fp_unsurveyed">Unsurveyed</label>
                </div>

                <div class=" mx-4">
                    <input type="radio" name="select_layer" id="select_layer_pending" value="fp_pending"
                        onchange="selectLayer(this.value)" class="pending">
                    <label for="select_layer_pending">Pending </label>
                </div>


                <div class=" mx-4">
                    <input type="radio" name="select_layer" id="select_layer_reject" value="fp_reject"
                        onchange="selectLayer(this.value)" class="reject">
                    <label for="select_layer_reject">Reject </label>
                </div>
                @endif
                <div class=" mx-4 d-flex">
                    <input type="radio" name="select_layer" id="select_layer_pano" value="pano"
                        onchange="selectLayer(this.value)">
                    <label for="select_layer_pano">Pano</label>
                </div>

                <div class="mx-4">
                    <div id="the-basics">
                        <input class="typeahead" type="text" placeholder="search id" class="form-control">
                    </div>
                </div>

            </div>

        </div>

        <!--  START MAP CARD DIV -->
        <div class="row m-2">




            <!-- START MAP  DIV -->
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
                    url: '/{{ app()->getLocale() }}/search/find-feeder-pillar/' + q,
                    dataType: 'JSON',
                    //data: data,
                    method: 'GET',
                    async: false,
                    success: function callback(data) {
                        $.each(data, function(i, str) {

                            matches.push(str.id);

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
                url: '/{{ app()->getLocale() }}/search/find-feeder-pillar-cordinated/' + encodeURIComponent(
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


            if (fp_without_defects != '') {
                map.removeLayer(fp_without_defects)
            }
            fp_without_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:fp_without_defects',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(fp_without_defects)
            fp_without_defects.bringToFront()



            if (fp_with_defects != '') {
                map.removeLayer(fp_with_defects)
            }

            fp_with_defects = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:fp_with_defects',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })


            map.addLayer(fp_with_defects)
            fp_with_defects.bringToFront()

            if (ba !== '') {


            if (fp_reject != '') {
                map.removeLayer(fp_reject)
            }

            fp_reject = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:fp_reject',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })


            map.addLayer(fp_reject)
            fp_reject.bringToFront()


            if (fp_pending != '') {
                map.removeLayer(fp_pending)
            }

            fp_pending = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:fp_pending',
                format: 'image/png',
                cql_filter: q_cql,
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })


            map.addLayer(fp_pending)
            fp_pending.bringToFront()

            if (fp_unsurveyed != '') {
                map.removeLayer(fp_unsurveyed)
            }
            fp_unsurveyed = L.tileLayer.wms("http://121.121.232.54:7090/geoserver/cite/wms", {
                layers: 'cite:fp_unsurveyed',
                format: 'image/png',
                cql_filter: "ba ILIKE '%" + param + "%'",
                maxZoom: 21,
                transparent: true
            }, {
                buffer: 10
            })

            map.addLayer(fp_unsurveyed)
            fp_unsurveyed.bringToFront()
        }
            addGroupOverLays()

        }



        // add group overlayes
        function addGroupOverLays() {
            if (layerControl != '') {
                // console.log("inmsdanssdkjnasjnd");
                map.removeControl(layerControl);
            }
            // console.log("sdfsdf");
            if (ba !== '') {
            groupedOverlays = {
                "POI": {
                    'BA': boundary,
                    'Pano': pano_layer,
                    'Unsurveyed': fp_unsurveyed,
                    'Surveyed with defects': fp_with_defects,
                    'Surveyed Without defects': fp_without_defects,
                    'Work Package': work_package,
                    'Pending':fp_pending,
                    'Reject':fp_reject

                }
            };
        }else{
            groupedOverlays = {
                "POI": {
                    'BA': boundary,
                    'Pano': pano_layer,
                    'Surveyed with defects': fp_with_defects,
                    'Surveyed Without defects': fp_without_defects,
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
            console.log(id);
            var str = '';
            // console.log(id);
            // var idSp = id.split('.');

            //     $('#exampleModalLabel').html("FeederPillar Info")
            //     str = ` <tr><th>Zone</th><td>${data.zone}</td> </tr>
        // <tr><th>Ba</th><td>${data.ba}</td> </tr>
        // <tr><th>Area</th><td>${data.area}</td> </tr>
        // <tr><th>Feeder Involved</th><td>${data.feeder_involved}</td> </tr>
        // <tr><th>Coordinate</th><td>${data.coordinate}</td> </tr>
        // <tr><th>Created At</th><td>${data.created_at}</td> </tr>
        // <tr><th>Detail</th><td class="text-center">    <a href="/{{ app()->getLocale() }}/feeder-pillar/${idSp[1]}" target="_blank" class="btn btn-sm btn-secondary">Detail</a>
        //     </td> </tr>

        // `

            // $("#my_data").html(str);
            // $('#myModal').modal('show');
            openDetails(data.id);

        }

        function openDetails(id) {
            // $('#myModal').modal('hide');
            $('#set-iframe').html('');

            $('#set-iframe').html(
                `<iframe src="/{{ app()->getLocale() }}/get-feeder-pillar-edit/${id}" frameborder="0" style="height:50vh; width:100%" ></iframe>`
                )


        }

        function zoomToLoc(x,y){
        map.flyTo([parseFloat(y), parseFloat(x)], 16, {
                        duration: 1.5, // Animation duration in seconds
                        easeLinearity: 0.25,
                    });
                    L.marker([parseFloat(y), parseFloat(x)]).addTo(map);            
 }       
    </script>
@endsection
