


@if ( verifyDefectExistOrNot(['cracked' , 'leaning' , 'dim' , 'creepers' , 'current_leakage' , 'other'] , $data->tiang_defect) == true)
    @if ( $data->tiang_defect_repair_date != '')
        {!! showRepairDate(  $data->tiang_defect_repair_date ) !!}
    @else
    {!! addRepairDate(  'tiang_defect' ) !!}
    @endif
@endif