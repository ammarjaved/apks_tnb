

<table class="table table-bordered w-100">
    <thead style="background-color: #E4E3E3 !important">
        <th class="col-4">{{ __('messages.title') }}</th>
        <th class="col-4">{{ __('messages.defects') }}</th>
        <th class="col-3">{{ __('messages.images') }}</th>
        <th>Repair Date</th>
    </thead>

    {{-- POLE --}}
    <tr>
        <th rowspan="7">{{ __('messages.pole') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'cracked' ,  'arr_name' =>'tiang_defect' , 'lab_name' =>'cracked'])
       
    </tr>
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'leaning' , 'arr_name' =>'tiang_defect' , 'lab_name' =>'leaning'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'dim' ,  'arr_name' =>'tiang_defect', 'lab_name' =>'no_dim_post_none'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'creepers' ,  'arr_name' =>'tiang_defect' ,  'lab_name' =>'creepers'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'creepers_after' ,  'arr_name' =>'tiang_defect' ,  'lab_name' =>'creepers_after'])
    </tr>  

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'current_leakage' ,  'arr_name' =>'tiang_defect' ,  'lab_name' =>'current_leakage'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'tiang_defect' ,  'lab_name' =>'others'])
    </tr>

    

    {{-- Line (Main / Service) --}}
    <tr>
        <th rowspan="4">{{ __('messages.line_main_service') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'joint' ,  'arr_name' =>'talian_defect' ,  'lab_name' =>'joint'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'need_rentis' ,  'arr_name' =>'talian_defect' ,  'lab_name' =>'need_rentis'])
    </tr>
    
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'ground' ,  'arr_name' =>'talian_defect' ,  'lab_name' =>'Does_Not_Comply_With_Ground_Clearance'])
    </tr>
    
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'talian_defect' ,  'lab_name' =>'others'])
    </tr>
    
   

    {{-- Umbang --}}
    <tr>
        <th rowspan="7">{{ __('messages.Umbang') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'breaking' ,  'arr_name' =>'umbang_defect' ,  'lab_name' =>'Sagging_Breaking'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'creepers' ,  'arr_name' =>'umbang_defect' ,  'lab_name' =>'creepers'])
    </tr>
    
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'creepers_after' ,  'arr_name' =>'umbang_defect' ,  'lab_name' =>'creepers_after'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'cracked' ,  'arr_name' =>'umbang_defect' ,  'lab_name' =>'No_Stay_Insulator_Damaged'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'stay_palte' ,  'arr_name' =>'umbang_defect' ,  'lab_name' =>'Stay_Plate_Base_Stay_Blocked'])
    </tr>
    
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'current_leakage' ,  'arr_name' =>'umbang_defect' ,  'lab_name' =>'current_leakage'])
    </tr>
    
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'umbang_defect' ,  'lab_name' =>'others'])
    </tr>


    {{-- IPC --}}
    <tr>
        <th rowspan="2">{{ __('messages.IPC') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'burn' ,  'arr_name' =>'ipc_defect' ,  'lab_name' =>'Burn Effect'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'ipc_defect' ,  'lab_name' =>'others'])
    </tr>


    {{-- Black Box --}}
    <tr>
        <th rowspan="2">{{ __('messages.Black_Box') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'cracked' ,  'arr_name' =>'blackbox_defect' ,  'lab_name' =>'Kesan_Bakar'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'blackbox_defect' ,  'lab_name' =>'others'])
    </tr>


    {{-- Jumper --}}
    <tr>
        <th rowspan="3">{{ __('messages.jumper') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'sleeve' ,  'arr_name' =>'jumper' ,  'lab_name' =>'no_uv_sleeve'])
    </tr>
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'burn' ,  'arr_name' =>'jumper' ,  'lab_name' =>'Burn Effect'])
    </tr>
    
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'jumper' ,  'lab_name' =>'others'])
    </tr>

    
    {{-- Lightning catcher --}}
    <tr>
        <th rowspan="2">{{ __('messages.lightning_catcher') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'broken' ,  'arr_name' =>'kilat_defect' ,  'lab_name' =>'broken'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'kilat_defect' ,  'lab_name' =>'others'])
    </tr>


    {{-- Service --}}

    <tr>
        <th rowspan="3">{{ __('messages.Service') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'roof' ,  'arr_name' =>'servis_defect' ,  'lab_name' =>'the_service_line_is_on_the_roof'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'won_piece' ,  'arr_name' =>'servis_defect' ,  'lab_name' =>'won_piece_date'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'servis_defect' ,  'lab_name' =>'others'])
    </tr>


    {{-- Grounding --}}
    <tr>
        <th rowspan="2">{{ __('messages.grounding') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'netural' ,  'arr_name' =>'pembumian_defect' ,  'lab_name' =>'no_connection_to_neutral'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'pembumian_defect' ,  'lab_name' =>'others'])
    </tr>



    {{-- Signage - OFF Point / Two Way Supply --}}
    <tr>
        <th rowspan="2">{{ __('messages.signage_off_point_two_way_supply') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'damage' ,  'arr_name' =>'bekalan_dua_defect' ,  'lab_name' =>'faded_damaged_missing_signage'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'pembumian_defect' ,  'lab_name' =>'others'])
    </tr>



    {{-- Main Street --}}
    <tr>
        <th rowspan="3">{{ __('messages.main_street') }}</th>
        @include('Tiang.partials.kejagallan',['key'=>'date_wire' ,  'arr_name' =>'kaki_lima_defect' ,  'lab_name' =>'date_wire'])
    </tr>
    
    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'burn' ,  'arr_name' =>'kaki_lima_defect' ,  'lab_name' =>'junction_box_date_burn_effect'])
    </tr>

    <tr>
        @include('Tiang.partials.kejagallan',['key'=>'other' ,  'arr_name' =>'kaki_lima_defect' ,  'lab_name' =>'others'])
    </tr>

   
</table>