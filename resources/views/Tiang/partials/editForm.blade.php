    <form id="framework-wizard-form"
            action="/{{app()->getLocale()}}/tiang-talian-vt-and-vr/{{$data->id}}"
            enctype="multipart/form-data" style="display: none" method="POST">
            
            @method('PATCH')
            @csrf
            
            <h3>{{ __('messages.info') }} </h3>


            {{-- START Info (1) --}}
            <fieldset class=" form-input">

                {{-- ID --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4"><label for="ba">ID</label></div>
                    <div class="col-md-4 col-sm-6">
                        <input type="text" class="form-control" value="{{ $data->id }}" id="" disabled> 
                    </div>
                </div>

                {{-- BA --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4"><label for="ba">{{ __('messages.ba') }}</label></div>
                    <div class="col-md-4 col-sm-6">
                        <input type="text" class="form-control" value="{{ $data->ba }}" id="" disabled> 
                    </div>
                </div>

                {{-- NAME OF SUBSTATION --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <label for="fp_name"> {{ __('messages.name_of_substation') }} / {{ __('messages.Name_of_Feeder_Pillar') }} </label>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <input type="text" name="fp_name" value="{{ $data->fp_name }}" id="fp_name" class="form-control" required {{'disabled'}}>
                    </div>
                </div>

                {{-- STREET NAME --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4">
                        <label for="fp_road"> {{ __('messages.Feeder_Name') }} / {{ __('messages.Street_Name') }}</label>
                    </div>
                    <div class="col-md-4 col-sm-6">
                        <input type="text" name="fp_road" value="{{ $data->fp_road }}" id="fp_road" class="form-control" required {{'disabled'}}>
                    </div>
                </div>

                {{-- SECTION --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4"><label for="">{{ __('messages.Section') }} </label></div>
                </div>

                {{-- SECTION FROM --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4"><label for="section_from">{{ __('messages.from') }} </label></div>
                    <div class="col-md-4 col-sm-6">
                        <input type="text" name="section_from" value="{{ $data->section_from }}" id="section_from" class="form-control" {{'disabled'}}>
                    </div>
                </div>

                {{-- SECTION TO --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4"><label for="section_to">{{ __('messages.to') }}</label></div>
                    <div class="col-md-4 col-sm-6">
                        <input type="text" name="section_to" value="{{ $data->section_to }}" id="section_to" class="form-control" {{'disabled'}}>
                    </div>
                </div>

                {{-- TIANG NO --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4"><label for="tiang_no">{{ __('messages.Tiang_No') }}</label></div>
                    <div class="col-md-4 col-sm-6">
                        <input type="text" name="tiang_no" value="{{ $data->tiang_no }}" id="tiang_no" class="form-control" required {{'disabled'}}>
                    </div>
                </div>

                {{-- VISIT DATE --}}
                <div class="row">
                    <div class="col-md-4 col-sm-4"><label for="review_date">{{__('messages.visit_date')}}</label></div>
                    <div class="col-md-4 col-sm-6">
                        <input type="date" name="review_date" id="review_date" class="form-control" required  value="{{ $data->review_date }}" {{'disabled'}}>
                    </div>
                </div>

                {{-- MAIN LINE SERVICE LINE --}}
        <div class="row">
            <div class="col-md-4">
                <label for="main_line">{{__('messages.main_line_service_line')}}</label>
            </div>
            <div class="col-md-5 d-sm-flex">
                <div class="col-md-6">
                    <input type="checkbox" name="main_line" id="main_line" {{$data->service_line != '' ? 'checked' : ''}}>
                    <label for="main_line">Main Line</label>
                </div>
                <div class="col-md-6">
                    <input type="checkbox" name="service_line" id="service_line"  {{$data->main_line != '' ? 'checked' : ''}}>
                    <label for="service_line">Service Line</label>
                </div>
            </div>
        </div>

                {{-- NUMBER OF SERVICE INVOLVES --}}
                <div class="row " id="main_line_connection">
                    <div class="col-md-4 col-sm-4">  <label for=""> Number of Services Involves 1 user only </label> </div>
                    <div class="col-md-4 col-sm-6">
                        <input type="number" name="talian_utama_connection" value="{{$data->talian_utama}}" class="form-control" id="main_line_connection_one"   {{'disabled'}}>  
                    </div>
                </div>

 

            </fieldset>
            {{-- END Info (1) --}}


             {{-- IMAGES --}}
             <h3>{{__('messages.images')}}</h3>

             <fieldset class="form-input">
                 
                 {{-- POLE IMAGE 1 --}}
                 <div class="row">
                     <div class="col-md-4"><label for="pole_image-1">{{ __('messages.pole') }} Image 1 </label></div>
                     <div class="col-md-8 row">{!!  viewAndUpdateImage($data->pole_image_1 , 'pole_image_1' , true )  !!}</div>
                 </div>

                 {{-- POLE IMAGE 2 --}}

                 <div class="row">
                     <div class="col-md-4"><label for="pole_image-2">{{ __('messages.pole') }} Image 2</label></div>
                     <div class="col-md-8 row">{!!  viewAndUpdateImage($data->pole_image_1 , 'pole_image_1' , true )  !!}</div>

                 </div>

                 {{-- POLE IMAGE 3 --}}

                 <div class="row">
                     <div class="col-md-4"><label for="pole_image-3">{{ __('messages.pole') }} Image 3 </label></div>
                     <div class="col-md-8 row">{!!  viewAndUpdateImage($data->pole_image_3 , 'pole_image_3' , true )  !!}</div>
                 </div>

                 {{-- POLE IMAGE 4 --}}
                 <div class="row">
                     <div class="col-md-4"><label for="pole_image-4">{{ __('messages.pole') }} Image 4</label></div>
                     <div class="col-md-8 row">{!!  viewAndUpdateImage($data->pole_image_4 , 'pole_image_4' , true )  !!}</div>
                 </div>

                 {{-- POLE IMAGE 5 --}}
                 <div class="row">
                     <div class="col-md-4"><label for="pole_image-5">{{ __('messages.pole') }} Image 5 </label></div>
                     <div class="col-md-8 row">{!!  viewAndUpdateImage($data->pole_image_5 , 'pole_image_5' , true )  !!}</div>
                 </div>

             </fieldset>

             {{-- END IMAGES --}}

            {{-- START Asset Register (2) --}}
            <h3> {{ __('messages.Asset_Register') }} </h3>


            <fieldset class="form-input">
                <div class="row">

                    {{-- POLE SIZE BILL --}}
                    <div class="col-md-6">
                        <div class="card p-4">
                            <label for="st7">{{ __('messages.Pole_Size_Bill') }} </label>
                            <div class="row">
                                <div class="col-md-12 row">
                                    
                                    {{-- OPTION 7.5 --}}
                                    <div class="d-flex col-md-4">
                                        <input type="radio" name="size_tiang" value="7.5" id="st7"  {{ $data->size_tiang == '7.5' ? 'checked' : '' }} class="  "  {{'disabled'}}>
                                        <label for="st7" class="fw-400"> 7.5</label>
                                    </div>

                                    {{-- OPTION 9 --}}
                                    <div class="d-flex col-md-4">
                                        <input type="radio" name="size_tiang" value="9" id="st9" {{ $data->size_tiang == '9' ? 'checked' : '' }} class=" "  {{'disabled'}}>
                                        <label for="st9" class="fw-400"> 9</label>
                                    </div>

                                    {{-- OPTION 10 --}}
                                    <div class="d-flex col-md-4">
                                        <input type="radio" name="size_tiang" value="10" id="st10" {{ $data->size_tiang == '10' ? 'checked' : '' }} class=" "  {{'disabled'}}>
                                        <label for="st10" class="fw-400"> 10</label>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- POLE TYPE NO --}}
                    <div class="col-md-6">
                        <div class="card p-4">
                            <label for="">{{ __('messages.Pole_type_No') }} </label>
                            <div class="row">
                                <div class="col-md-12 row">

                                    {{-- OPTION SPUN --}}
                                    <div class="d-flex col-md-4">
                                        <input type="radio" name="jenis_tiang" value="spun" id="spun" class=" " {{ $data->jenis_tiang == 'spun' ? 'checked' : '' }}  {{'disabled'}}>
                                        <label for="spun" class="fw-400">{{ __('messages.Spun') }}</label>
                                    </div>

                                    {{-- OPTION CONCRETE --}}
                                    <div class="d-flex col-md-4">
                                        <input type="radio" name="jenis_tiang" value="concrete" id="concrete" class=" " {{ $data->jenis_tiang == 'concrete' ? 'checked' : '' }}  {{'disabled'}}>
                                        <label for="concrete" class="fw-400">{{ __('messages.Concrete') }}</label>
                                    </div>

                                    {{-- OPTION IRON --}}
                                    <div class="d-flex col-md-4">
                                        <input type="radio" name="jenis_tiang" value="iron" id="iron" class=" " {{ $data->jenis_tiang == 'iron' ? 'checked' : '' }}  {{'disabled'}}>
                                        <label for="iron" class="fw-400">{{ __('messages.Iron') }}</label>
                                    </div>

                                    {{-- OPTION WOOD --}}
                                    <div class="d-flex col-md-4">
                                        <input type="radio" name="jenis_tiang" value="wood" id="wood" class=" " {{ $data->jenis_tiang == 'wood' ? 'checked' : '' }}  {{'disabled'}}>
                                        <label for="wood" class="fw-400">{{ __('messages.Wood') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ABC SPAN --}}
                    <div class="col-md-6">
                        <div class="card p-4">

                            {{-- ABC SPAN 3 X 185 --}}
                            <label for="section_to">{{ __('messages.ABC_Span') }} 3 X 185</label>
                                {!! tiangSpanRadio(  $data->abc_span, 'abc_span', 's3_185',  false) !!}

                            {{-- ABC SPAN 3 X 95 --}}
                            <label for="s3_95">{{ __('messages.ABC_Span') }}3 X 95</label>
                                {!! tiangSpanRadio(  $data->abc_span, 'abc_span', 's3_95',  false) !!}
                            
                            {{-- ABC SPAN 3 X 16 --}}
                            <label for="s3_16">{{ __('messages.ABC_Span') }}>3 X 16</label>
                                {!! tiangSpanRadio(  $data->abc_span, 'abc_span', 's3_16',  false) !!}

                            {{-- ABC SPAN 1 X 16 --}}
                            <label for="s1_16">{{ __('messages.ABC_Span') }}1 X 16</label>
                                {!! tiangSpanRadio(  $data->abc_span, 'abc_span', 's1_16',  false) !!}
                        </div>
                    </div>

                    {{-- PVC SPAN --}}
                    <div class="col-md-6 ">
                        <div class="card p-4"  {{'disabled'}}>
                            {{-- PVC SPAN 19/064 --}}
                            <label for="s19_064">{{ __('messages.PVC_Span') }}19/064</label>
                                {!! tiangSpanRadio(    $data->pvc_span, 'pvc_span', 's19_064',  false) !!}

                            {{-- PVC SPAN 7/083 --}}
                            <label for="s7_083"  >{{ __('messages.PVC_Span') }}7/083</label>
                                {!! tiangSpanRadio($data->pvc_span, 'pvc_span', 's7_083',  false) !!}

                            {{-- PVC SPAN 7/044 --}}
                            <label for="s7_044"  >{{ __('messages.PVC_Span') }}7/044</label>
                                {!! tiangSpanRadio(  $data->pvc_span, 'pvc_span', 's7_044',  false) !!}

                        </div>
                    </div>

                    {{-- BARE SPAN --}}
                    <div class="col-md-6">
                        <div class="card p-4"  {{'disabled'}}>

                            {{-- BARE SPAN 7/173 --}}
                            <label for="s7_173">{{ __('messages.BARE_Span') }} 7/173</label>
                                {!! tiangSpanRadio(  $data->bare_span, 'bare_span', 's7_173',  false) !!}

                            {{-- BARE SPAN 7/122 --}}
                            <label for="s7_122">{{ __('messages.BARE_Span') }} 7/122</label>
                                {!! tiangSpanRadio(  $data->bare_span, 'bare_span', 's7_122',  false) !!}

                            {{-- BARE SPAN 3/132 --}}
                            <label for="s3_132">{{ __('messages.BARE_Span') }} 3/132</label>
                                {!! tiangSpanRadio(  $data->bare_span, 'bare_span', 's3_132',  false) !!}
                        </div>
                    </div>



                </div>
            </fieldset>

            {{-- END Asset Register (2) --}}


            <h3>{{ __('messages.kejanggalan') }}</h3>

            {{-- START KEJANGGALAN --}}

            <fieldset class="form-input defects">

                <h3>{{ __('messages.kejanggalan') }}</h3>

                <div class="table-responsive">
                   @include('TIANG.partials.kejagallan-table')
                </div>
                <input type="hidden" name="total_defects" id="total_defects">
            </fieldset>

            {{-- END KEJANGGALAN --}}


            <h3>{{ __('messages.Heigh_Clearance') }}</h3>

            {{-- START Heigh Clearance (4) --}}

            <fieldset class="form-input">
                <h3>{{ __('messages.Heigh_Clearance') }}</h3>
                <div class="table-responsive">
                    <table class="table table-bordered w-100">
                        <thead style="background-color: #E4E3E3 !important">
                            <th class="col-4">{{ __('messages.title') }}</th>
                            <th class="col-4">{{ __('messages.defects') }}</th>
                            <th class="col-3">{{ __('messages.images') }}</th>
                        </thead>

                        <tbody>

                            {{-- Site Conditions --}}
                            <tr>
                                <th rowspan="3">{{ __('messages.Site_Conditions') }}</th>

                                {{-- SITE CONDITIONS CROSSING THE ROAD --}}
                                <td class="d-flex">
                                    <input type="checkbox" name="tapak_condition[road]" id="site_road" disabled class="form-check" {{ checkCheckBox('road', $data->tapak_condition) }}>
                                    <label for="site_road">{{ __('messages.Crossing_the_Road') }}</label>
                                </td>

                                {{-- SITE CONDITIONS CROSSING THE ROAD IMAGE--}}
                                <td>
                                    @if ($data->tapak_road_img != '' && checkCheckBox('road', $data->tapak_condition)  == 'checked')
                                        <a href="{{config('custom.image_url').$data->tapak_road_img}}"  data-lightbox="roadtrip">
                                            <img src="{{config('custom.image_url').$data->tapak_road_img}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>

                                {{-- SITE CONDITIONS SIDE WALK --}}
                                <td>
                                    <input type="checkbox" name="tapak_condition[side_walk]"disabled id="side_walk" class="form-check" {{ checkCheckBox('side_walk', $data->tapak_condition) }}>
                                    <label for="side_walk">{{ __('messages.Sidewalk') }}</label>
                                </td>

                                {{-- SITE CONDITIONS SIDE WALK IMAGE --}}
                                <td>
                                    @if ($data->tapak_sidewalk_img != '' && checkCheckBox('side_walk', $data->tapak_condition)  == 'checked')
                                        <a href="{{config('custom.image_url').$data->tapak_sidewalk_img}}" data-lightbox="roadtrip">
                                            <img src="{{config('custom.image_url').$data->tapak_sidewalk_img}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>

                                {{-- SITE CONDITIONS VEHICLE ENTRY --}}
                                <td>
                                    <input type="checkbox" name="tapak_condition[vehicle_entry]" disabled id="vehicle_entry" class="form-check" {{ checkCheckBox('vehicle_entry', $data->tapak_condition) }}>
                                    <label for="vehicle_entry">{{ __('messages.No_vehicle_entry_area') }}
                                    </label>
                                </td>

                                {{-- SITE CONDITIONS VEHICLE ENTRY IMAGE --}}
                                <td>
                                    @if ($data->tapak_no_vehicle_entry_img != '' &&    checkCheckBox('vehicle_entry', $data->tapak_condition)  == 'checked')
                                        <a href="{{config('custom.image_url').$data->tapak_no_vehicle_entry_img}}" data-lightbox="roadtrip">
                                            <img src="{{config('custom.image_url').$data->tapak_no_vehicle_entry_img}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                        </a>
                                    @endif
                                </td>
                            </tr>

                            {{-- Area --}}
                            <tr>
                                <th rowspan="4">{{ __('messages.Area') }}</th>

                                {{-- AREA BEND --}}
                                <td class="d-flex">
                                    <input type="checkbox" name="kawasan[bend]" id="area_bend" disabled class="form-check" {{ checkCheckBox('bend', $data->kawasan) }}>
                                    <label for="area_bend">{{ __('messages.Bend') }}</label>
                                </td>

                                {{-- AREA BEND IMAGE --}}
                                <td>
                                    @if ($data->kawasan_bend_img != '' && checkCheckBox('bend', $data->kawasan)  == 'checked')
                                        <a href="{{config('custom.image_url').$data->kawasan_bend_img}}" data-lightbox="roadtrip">
                                            <img src="{{config('custom.image_url').$data->kawasan_bend_img}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>

                                {{-- AREA ROAD --}}
                                <td>
                                    <input type="checkbox" name="kawasan[road]" id="area_road" disabled class="form-check" {{ checkCheckBox('road', $data->kawasan) }}>
                                    <label for="area_road"> {{ __('messages.Road') }}</label>
                                </td>

                                {{-- AREA RAD IMAGE --}}
                                <td>
                                    @if ($data->kawasan_road_img != '' && checkCheckBox('road', $data->kawasan)  == 'checked')
                                        <a href="{{config('custom.image_url').$data->kawasan_road_img}}" data-lightbox="roadtrip">
                                            <img src="{{config('custom.image_url').$data->kawasan_road_img}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>

                                {{-- AREA FOREST --}}
                                <td>
                                    <input type="checkbox" name="kawasan[forest]" id="area_forest" disabled class="form-check" {{ checkCheckBox('forest', $data->kawasan) }}>
                                    <label for="area_forest">{{ __('messages.Forest') }} </label>
                                </td>

                                {{-- AREA FOREST IMAGE --}}
                                <td>
                                    @if ($data->kawasan_forest_img != '' && checkCheckBox('forest', $data->kawasan)  == 'checked')
                                        <a href="{{config('custom.image_url').$data->kawasan_forest_img}}" data-lightbox="roadtrip">
                                            <img src="{{config('custom.image_url').$data->kawasan_forest_img}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>

                                {{-- AREA OTHER --}}
                                <td>
                                    <input type="checkbox" name="kawasan[other]" id="area_other" disabled class="form-check" {{ checkCheckBox('other', $data->kawasan) }}>
                                    <label for="area_other">{{ __('messages.others') }} </label>
                                </td>

                                {{-- AREA OTHER IMAGE --}}
                                <td>
                                    @if ($data->kawasan_other_img != '' && checkCheckBox('other', $data->kawasan)  == 'checked')
                                        <a href="{{config('custom.image_url').$data->kawasan_other_img}}" data-lightbox="roadtrip">
                                            <img src="{{config('custom.image_url').$data->kawasan_other_img}}" alt="" class="adjust-height " style="height:30px; width:30px !important">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- CLEARENCE DISTANCE --}}
                <div class="row">
                    <div class="col-md-4"><label for="jarak_kelegaan">{{ __('messages.Clearance_Distance') }}</label></div>
                    <div class="col-md-4">
                        <input type="number" name="jarak_kelegaan" disabled value="{{ $data->jarak_kelegaan }}" id="jarak_kelegaan" class="form-control">
                    </div>
                </div>

                {{-- LINE CLEARANCE SPECIFICATIONS --}}
                <div class="row">
                    <div class="col-md-4"><label for="">{{ __('messages.Line_clearance_specifications') }}</label></div>
                    <div class="col-md-8">
                        <div class="row">

                            {{-- LINE CLEARANCE SPECIFICATIONS COMPLY --}}
                            <div class="col-md-4 d-flex">
                                <input type="radio" name="talian_spec" id="line-comply" {{ $data->talian_spec == 'comply' ? 'checked' : '' }} value="comply" disabled class="form-check">
                                <label for="line-comply">{{ __('messages.Comply') }}</label>
                            </div>

                            {{-- LINE CLEARANCE SPECIFICATIONS UNCOMPLY --}}
                            <div class="col-md-4 d-flex">
                                <input type="radio" name="talian_spec" {{ $data->talian_spec == 'uncomply' ? 'checked' : '' }} value="uncomply" disabled id="line-disobedient" class="form-check">
                                <label for="line-disobedient"> Uncomply </label>
                            </div>
                        </div>
                    </div>
                </div>

            </fieldset>
            
            {{-- END Heigh Clearance (4) --}}



            <h3>{{ __('messages.Kebocoran_Arus') }}</h3>

            {{-- START Kebocoran Arus (5) --}}

            <fieldset class="form-input">
                <div class="row">
                    <div class="col-md-4"><label
                            for="">{{ __('messages.Inspection_of_current_leakage_on_the_pole') }}
                        </label></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4 d-flex">
                                <input type="radio" name="tiang_defect_current_leakage" id="arus_pada_tiang_no" disabled
                                    class="form-check" value="No"
                                    {{ $data->arus_pada_tiang === 'No' ? 'checked' : '' }}>
                                <label for="arus_pada_tiang_no">{{ __('messages.no') }}</label>
                            </div>

                            <div class="col-md-4 d-flex">
                                <input type="radio" name="tiang_defect_current_leakage" id="arus_pada_tiang_yes" disabled
                                    class="form-check" value="Yes"
                                    {{ $data->arus_pada_tiang === 'Yes' ? 'checked' : '' }}>
                                <label for="arus_pada_tiang_yes">{{ __('messages.yes') }}</label>
                            </div>

                            <div class="col-md-4 @if ($data->arus_pada_tiang == 'No' || $data->arus_pada_tiang == '') d-none @endif"
                                id="arus_pada_tiang_amp_div">
                                <label for="arus_pada_tiang_amp">{{ __('messages.Amp') }}</label>
                                <input type="text" name="tiang_defect[current_leakage_val]" id="arus_pada_tiang_amp" disabled
                                    class="form-control" value="{{ $data->arus_pada_tiang_amp }}"
                                    required>

                            </div>
                        </div>
                    </div>

                </div>


                <div class="row">
                    <div class="col-md-4"><label
                            for="">{{ __('messages.Inspection_of_current_leakage_on_the_umbang') }}
                        </label></div>
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-4 d-flex">
                                <input type="radio" name="umbang_defect_current_leakage" id="arus_pada_umbgan_no"
                                    class="form-check" value="No" disabled
                                    {{ array_key_exists('current_leakage' , $data->umbang_defect) && $data->umbang_defect['current_leakage'] === false ? 'checked' : '' }}>
                                <label for="arus_pada_umbgan_no">{{ __('messages.no') }}</label>
                            </div>

                            <div class="col-md-4 d-flex">
                                <input type="radio" name="umbang_defect_current_leakage" id="arus_pada_umbgan_yes"
                                    class="form-check" value="Yes" disabled
                                    {{ array_key_exists('current_leakage' , $data->umbang_defect) && $data->umbang_defect['current_leakage'] === true ? 'checked' : '' }}>

                                <label for="arus_pada_umbgan_yes">{{ __('messages.yes') }}</label>
                            </div>

                            <div class="col-md-4 @if(!array_key_exists('current_leakage' , $data->umbang_defect) || $data->umbang_defect['current_leakage'] !== true) d-none @endif"
                                id="arus_pada_umbgan_amp_div">
                                <label for="arus_pada_tiang_amp">{{ __('messages.Amp') }}</label>
                                <input type="text" name="umbang_defect[current_leakage_val]" id="arus_pada_tiang_amp" disabled
                                    class="form-control" value="{{array_key_exists('current_leakage_val' , $data->umbang_defect) ? $data->umbang_defect['current_leakage_val'] : ''}}"
                                    required>

                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="col-md-4">
                        <label for="five_feet_away">{{ __('messages.five_feet_away') }} </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="five_feet_away" value="{{$data->five_feet_away}}" disabled id="five_feet_away" class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4">
                        <label for="ffa_no_of_houses">{{ __('messages.ffa_no_of_houses') }} </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="ffa_no_of_houses" value="{{$data->ffa_no_of_houses}}" disabled id="ffa_no_of_houses" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 ">
                        <label for="ffa_house_no">{{ __('messages.ffa_house_no') }} </label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="ffa_house_no" value="{{$data->ffa_house_no}}" disabled id="ffa_house_no" class="form-control">
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-4"><label for="clean_banner_image">{{ __('messages.clean_banner') }} Image </label></div>
                    <div class="col-md-8 row">{!!  viewAndUpdateImage($data->clean_banner_image , 'clean_banner_image' , true )  !!}</div>
                </div>

                <div class="row">
                    <div class="col-md-4"><label for="remove_creepers_image">{{ __('messages.remove_creepers') }} Image </label></div>
                    <div class="col-md-8 row">{!!  viewAndUpdateImage($data->remove_creepers_image , 'remove_creepers_image' , true )  !!}</div>
                </div>

                <div class="row">
                    <div class="col-md-4"><label for="current_leakage_image">{{ __('messages.current_leakage') }} Image </label></div>
                    <div class="col-md-8 row">{!!  viewAndUpdateImage($data->current_leakage_image , 'current_leakage_image' , true )  !!}</div>
                </div>


                <style>
                    a[href='#finish'] {
                        display: none !important;
                    }
                </style>
           
            </fieldset>
            {{-- END Kebocoran Arus (5) --}}

        </form>



