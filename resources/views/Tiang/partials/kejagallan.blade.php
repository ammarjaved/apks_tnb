
{{-- function getImageShow($key, $arr, $arr_name, $img_arr, $lab_name)
{ --}}

@php

    $arr = $data->$arr_name;
    $img_arr = $data->{$arr_name.'_image'};
    $key_exist = !empty($arr) && array_key_exists($key, $arr) && $arr[$key] == true;
    $checked = $key_exist ? 'checked' : '';
    $repairName = $arr_name.'_'.$key;

    
 
@endphp

    <td class="d-flex">
        @if ($key != 'creepers_after')
            <input type="checkbox"  {{$checked}}  disabled class="form-check {{$key_exist}}">
        @endif
        <label class="text-capitalize"  > {{__("messages.$lab_name")}}</label>

        @if ($key == 'other')
            <input type='text'  value="{{$arr['other_value'] }}" class="form-control {{$key_exist ? '' : 'd-none'}}" placeholder='mention other defect' disabled>
        @endif
    </td>

    {{-- IMAGES --}}
    <td>
        @if ($key_exist && $img_arr != '')    
            {!! getSingleJsonImage($key =='creepers_after' ? 'creepers_after1' : $key , $img_arr) !!}
            {!! getSingleJsonImage($key.'2' , $img_arr) !!}
        @endif
    </td>

    {{-- REPAIR DATE --}}
    <td>
        @if ( $key != 'creepers_after' && $key_exist )

            @if (!empty($repairDates) && isset($repairDates[$repairName] ) && $repairDates[$repairName] != '')
                {{$repairDates[$repairName]}}
            @else
                <input id='repair_date-{{$repairName}}' type='date' class='form-control'><span id='err-{{$repairName}}'></span>
                <button class='btn btn-sm btn-success mt-2' id='reapir_date_button-{{$repairName}}' type='button' onclick="addRepairDate('{{$repairName}}')">Update</button>
            
            @endif
                        
        @endif
    </td>

   