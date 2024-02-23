
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

            @if (!empty($repairDates) && isset($repairName ,$repairDates ) && $repairDates[$repairName] != '')
                {{-- {{$repairDates[$repairName]}} --}}
            @else
                <input id='repair_date-{{$repairName}}' type='date' class='form-control'><span id='err-{{$repairName}}'></span>
                <button class='btn btn-sm btn-success mt-2' id='reapir_date_button-{{$repairName}}' type='button' onclick="addRepairDate('{{$repairName}}')">Update</button>
            
            @endif
                        
        @endif
    </td>

    {{-- $lab_name = __('messages.' . $lab_name);
    $html = '';

    // Check for checked checkbox
    $key_exist = !empty($arr) && array_key_exists($key, $arr) && $arr[$key] == true;

    $id = $arr_name . '_' . $key;
    $name = $arr_name . '[' . $key . ']';

    // Check if $key is "other" to decide the CSS classes
    $class = $key != 'other' ? 'd-flex' : '';

    if ($key  !== 'creepers_after') {
        // Check for checked checkbox
        $key_exist = !empty($arr) && array_key_exists($key, $arr) && $arr[$key] == true;
        $html .= "<td class='$class'>
                        <input type='checkbox' name='$name' id='$id' " . ($key_exist? 'checked' : '') . " disabled class='form-check'>
                <label class='text-capitalize' for='$id'> $lab_name</label>";
    }else{
        // Check for checked checkbox
        $key_exist = !empty($arr) && array_key_exists('creepers', $arr) && $arr['creepers'] == true;
        $html .=
        "<td class='$class'><label class='text-capitalize' for='$id'> $lab_name After</label>";
    }
    if ($key == 'other') {
        $key2 = $key . '_value';
        $otherValue = isset($arr[$key2]) ? $arr[$key2] : '';
        $html .= "<input type='text'  id='{$id}-input'  value='$otherValue' class='form-control " . ($key_exist ? '' : 'd-none') . "' placeholder='mention other defect' disabled>";
    }

    $html .= "</td>
    <td class=''>";

    if ($key_exist && $img_arr != '') {
        $image1 = $key == 'creepers_after' ? 'creepers_after1' : $key;
        if (array_key_exists($image1, $img_arr) && file_exists(public_path($img_arr[$image1])) && $img_arr[$image1] != '') {
             
            $html .=
                "<a href='" . URL::asset($img_arr[$image1]) . "' data-lightbox='roadtrip'>
                    <img src='" . URL::asset($img_arr[$image1]) . "' class='adjust-height mb-1' style='height:30px; width:30px !important'>
                </a>";
        }

        if (array_key_exists($key . '2', $img_arr) && file_exists(public_path($img_arr[$key . '2'])) && $img_arr[$key . '2'] != '') {
            $html .=
                "<a href='" .
                URL::asset($img_arr[$key . '2']) .
                "' data-lightbox='roadtrip'>
                    <img src='" .
                URL::asset($img_arr[$key . '2']) .
                "' class='adjust-height mb-1' style='height:30px; width:30px !important'>
                </a>";
        }
    }
    $html .= '</td>';

    return $html;
} --}}
