
<div class="row">
    <div class="col-md-4 col-sm-4 "><label for="zone">{{ __('messages.zone') }}</label></div>
    <div class="col-md-4 col-sm-6">
        <input type="text" name=""  id="" value="{{ $data->zone }}" class="form-control" {{$disabled ? 'disabled' : ''}}>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4 "><label for="ba">{{ __('messages.ba') }}</label></div>
    <div class="col-md-4 col-sm-6 ">
        <input type="text" name=""  id="" value="{{ $data->ba }}" class="form-control" {{$disabled ? 'disabled' : ''}}>
    </div>
</div>


<div class="row">
    <div class="col-md-4 col-sm-4 "><label for="fl">{{ __('messages.fl_substation') }}</label></div>
    <div class="col-md-4 col-sm-6 ">
        <input type="text" name="fl" id="fl" {{$disabled ? 'disabled' : ''}} value="{{ $data->fl }}" class="form-control" required>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4 "><label for="name">{{ __('messages.substation_feeder_pillar_name') }}</label></div>
    <div class="col-md-4 col-sm-6 ">
        <input type="text" name="name" id="name" class="form-control" required value="{{ $data->name }}" {{$disabled ? 'disabled' : ''}}>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4"><label for="type">{{ __('messages.type') }}</label></div>
    <div class="col-md-4 col-sm-6">
        <input type="text" name="name" id="name" class="form-control" required value="{{ $data->type }}" {{$disabled ? 'disabled' : ''}}>

    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4"><label for="area">{{ __('messages.voltage') }}</label></div>
    <div class="col-md-4 col-sm-6">
        <input type="text" name="name" id="name" class="form-control" required value="{{ $data->voltage }}" {{$disabled ? 'disabled' : ''}}>
    </div>
</div>



<div class="row">
    <div class="col-md-4 col-sm-4"><label for="visit_date">{{ __('messages.survey_date') }}</label></div>
    <div class="col-md-4 col-sm-6">
        <input type="date" name="name" id="name" class="form-control" required value="{{ $data->visit_date }}" {{$disabled ? 'disabled' : ''}}>
    </div>
</div>




<div class="row">
    <div class="col-md-4 col-sm-4"><label for="patrol_time">{{ __('messages.patrol_time') }}</label></div>
    <div class="col-md-4 col-sm-6">
        <input type="time" name="name" id="name" class="form-control" required value="{{ $data->patrol_time }}" {{$disabled ? 'disabled' : ''}}>
     </div>
</div>



  <div class="row">
    <div class="col-md-4 col-sm-4"><label for="coordinate">{{ __('messages.coordinate') }}</label>
    </div>
    <div class="col-md-4 col-sm-6">
        <input type="text" name="coordinate" id="coordinate"
            value="{{ $data->coordinate }}" class="form-control" required readonly disabled>
    </div>
</div>


<div class="row">
    <div class="col-md-4 col-sm-4"><label for="pipe_staus">{{ __('messages.gate') }}</label></div>
    <div class="col-md-4 col-sm-6">
        <div class="  d-flex">
            <input type="radio" name="gate_status[locked]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('locked', $data->gate_status) }} id="gate_status_locked" value="locked" >
            <label for="gate_status_locked">{{ __('messages.locked') }}</label>
        </div>
        <div class=" d-flex">
            <input type="radio" name="gate_status[locked]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('unlocked', $data->gate_status) }}
                id="gate_status_unlocked" value="unlocked" >
            <label for="gate_status_unlocked">{{ __('messages.unlocked') }}</label>
        </div>
        <div class=" d-flex">
            <input type="checkbox" name="gate_status[demaged]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('demaged', $data->gate_status) }}
                id="gate_status_demaged">
            <label for="gate_status_demaged">{{ __('messages.demaged') }}</label>
        </div>

        <div class="d-flex">
            <input type="checkbox" name="gate_status[other]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('other', $data->gate_status) }} id="gate_status_others"
                onclick="getStatus(this)">
            <label for="gate_status_others">{{ __('messages.others') }}</label>


        </div>
        <input type="text" name="gate_status[other_value]" id="gate_status_other" {{$disabled ? 'disabled' : ''}}
            class="form-control  @if (substaionCheckBox('other', $data->gate_status) !== 'checked') d-none @endif"
            value="@if (substaionCheckBox('other', $data->gate_status) == 'checked') {{ $data->gate_status->other_value }} @endif"
            placeholder="please enter other gate defect">

    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4"><label for="grass_status">{{ __('messages.long_grass') }}</label>
    </div>
    <div class="col-md-4 col-sm-6">
        <input type="text" name="name" id="name" class="form-control" required value="{{ $data->grass_status }}" {{$disabled ? 'disabled' : ''}}>
    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4"><label  for="tree_branches_status">{{ __('messages.tree_branches_in_PE') }}</label></div>
    <div class="col-md-4 col-sm-6">
        <input type="text" name="name" id="name" class="form-control" required value="{{ $data->tree_branches_status }}" {{$disabled ? 'disabled' : ''}}>

    </div>
</div>

<div class="row">
    <div class="col-md-4 col-sm-4"><label for="building_status">{{ __('messages.building_defects') }}</label></div>

    <div class="col-md-4 col-sm-6">
        <div class="d-flex">
            <input type="checkbox" name="building_status[broken_roof]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('broken_roof', $data->building_status) }}
                id="building_status_broken_roof">
            <label for="building_status_broken_roof">{{ __('messages.broken_roof') }}</label>
        </div>

        <div class="d-flex">
            <input type="checkbox" name="building_status[broken_gutter]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('broken_gutter', $data->building_status) }}
                id="building_status_broken_gutter">
            <label
                for="building_status_broken_gutter">{{ __('messages.broken_gutter') }}</label>
        </div>

        <div class="d-flex">
            <input type="checkbox" name="building_status[broken_base]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('broken_base', $data->building_status) }}
                id="building_status_broken_base">
            <label for="building_status_broken_base">{{ __('messages.broken_base') }}</label>
        </div>

        <div class="d-flex">
            <input type="checkbox" name="building_status[other]" {{$disabled ? 'disabled' : ''}}
                {{ substaionCheckBox('other', $data->building_status) }}
                id="building_status_other" onclick="bulidingStatus(this)">
            <label for="building_status_other">{{ __('messages.others') }}</label>
        </div>

        <input type="text" name="building_status[other_value]" id="other_building_defects" {{$disabled ? 'disabled' : ''}}
            placeholder="please enter other buliding defects"
            class="form-control @if (substaionCheckBox('other', $data->building_status) !== 'checked') d-none @endif"
            value="@if (substaionCheckBox('other', $data->building_status) == 'checked') {{ $data->building_status->other_value }} @endif">

    </div>

</div>


<div class="row">
    <div class="col-md-4 col-sm-4">
        <label for="collapsed_status">{{ __('messages.cleaning_illegal_ads_banners') }}</label>
    </div>
    <div class="col-md-4 col-sm-6">
        <input type="text" name="name" id="name" class="form-control" required value="{{ $data->advertise_poster_status }}" {{$disabled ? 'disabled' : ''}}>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <label for="image_pipe">{{ __('messages.substation') }} {{__('messages.images')}} </label>
    </div>
    <div class="col-md-8 row">
        {!!  viewAndUpdateImage($data->substation_image_1 , 'substation_image_1' , $disabled )  !!}

        {!!  viewAndUpdateImage($data->substation_image_2 , 'substation_image_2' , $disabled )  !!}

        </div>


</div>


<div class="row">
    <div class="col-md-4">
        <label for="image_pipe">{{ __('messages.image_gate') }}</label>
    </div>
    <div class="col-md-8 row">

        {!!  viewAndUpdateImage($data->image_gate , 'image_gate' , $disabled )  !!}

        {!!  viewAndUpdateImage($data->image_gate_2 , 'image_gate_2' , $disabled )  !!}


        </div>


</div>


    <div class="row">
        <div class="col-md-4"><label for="images_gate_after_lock">{{ __('messages.images_gate_after_lock') }}</label>
        </div>
        <div class="col-md-8 row">
            {!!  viewAndUpdateImage($data->image_building , 'images_gate_after_lock' , $disabled )  !!}
            {!!  viewAndUpdateImage($data->image_building_2 , 'image_building_2' , $disabled )  !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><label for="image_grass">{{ __('messages.image_grass') }}</label></div>
        <div class="col-md-8 row">
            {!!  viewAndUpdateImage($data->image_grass , 'image_grass' , $disabled )  !!}
            {!!  viewAndUpdateImage($data->image_grass_2 , 'image_grass_2' , $disabled )  !!}
        </div>
    </div>


    <div class="row">
        <div class="col-md-4"><label for="image_tree_branches">{{ __('messages.image_tree_branches') }}</label></div>
        <div class="col-md-8 row">
            {!!  viewAndUpdateImage($data->image_tree_branches , 'image_tree_branches' , $disabled )  !!}
            {!!  viewAndUpdateImage($data->image_tree_branches_2 , 'image_tree_branches_2' , $disabled )  !!}
        </div>
    </div>


    <div class="row">
        <div class="col-md-4"><label for="image_building">{{ __('messages.image_building') }}</label></div>
        <div class="col-md-8 row">
            {!!  viewAndUpdateImage($data->image_building , 'image_building' , $disabled )  !!}
            {!!  viewAndUpdateImage($data->image_building_2 , 'image_building_2' , $disabled )  !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><label for="image_building">{{ __('messages.image_advertise_poster') }}</label></div>
        <div class="col-md-8 row">
            {!!  viewAndUpdateImage($data->image_advertisement_before_1 , 'image_advertisement_before_1' , $disabled )  !!}
            {!!  viewAndUpdateImage($data->image_advertisement_before_2 , 'image_advertisement_before_2' , $disabled )  !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-4"><label for="image_building">{{ __('messages.image_advertise_poster_removal') }}</label></div>
        <div class="col-md-8 row">
            {!!  viewAndUpdateImage($data->image_advertisement_after_1 , 'image_advertisement_after_1' , $disabled )  !!}
            {!!  viewAndUpdateImage($data->image_advertisement_after_2 , 'image_advertisement_after_2' , $disabled )  !!}
        </div>
    </div>




<div class="row">
    <div class="col-md-4 col-sm-4"><label for="other_image">{{ __('messages.other_image') }}</label>
    </div>


        @if (!$disabled)
            <div class="col-md-4 form-input pr-3">
                <input type="file" accept="image/*" name="other_image" id="other_image" class="form-control">
            </div>
        @endif


    <div class="col-md-4 col-sm-8 text-center mb-3">
        @if (file_exists(public_path($data->other_image)) && $data->other_image != '')
            <a href="{{ URL::asset($data->other_image) }}" data-lightbox="roadtrip">
                <img src="{{ URL::asset($data->other_image) }}" alt=""
                    height="70" class="adjust-height ml-5  "></a>
        @else
            <strong>{{ __('messages.no_image_found') }}</strong>
        @endif
    </div>
</div>

@if ($data->total_defects > 0)
<form action="{{ route('substation.update', [app()->getLocale(), $data->id]) }} " id="myForm"
    method="POST" enctype="multipart/form-data">
    @method('PATCH')
    @csrf

    @if ($data->repair_date != '')
    <div class="row">
        <div class="col-md-4 col-sm-6"><label for="repair_date">Repair Date</label></div>
        <div class="col-md-4 col-sm-6">
            <input  disabled  type="date"    id="repair_date" class="form-control"
                value="{{ date('Y-m-d' , strtotime($data->repair_date)) }}" required>
        </div>
    </div>

    @endif
    <div class="row">
        <div class="col-md-4 col-sm-6"><label for="repair_date">{{$data->repair_date != '' ?'Update ' : 'Add '}}Repair Date</label></div>
        <div class="col-md-4 col-sm-6">
            <input type="date" name="repair_date" id="repair_date" class="form-control" required>
        </div>
    </div>

    <div class="text-center p-4"><button class="btn btn-sm btn-success"> <strong>{{ __('messages.update') }}</strong></button></div>

</form>
@endif