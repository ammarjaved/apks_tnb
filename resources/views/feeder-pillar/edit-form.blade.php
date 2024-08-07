@extends('layouts.map_layout', ['page_title' => 'Feeder Pillar'])


@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />

    {{-- <link rel="stylesheet" href="{{ URL::asset('assets/test/css/style.css') }}" /> --}}
    <style>
        input[type='checkbox'],
        input[type='radio'] {
            min-width: 16px !important;
            margin-right: 12px;
        }

        .error {
            color: red;
        }

        label {
            margin-bottom: 0px !important;
            margin-top: 1rem;
        }

        input,
        select {
            /* color: black !important; */
            margin-bottom: 0px !important;
            margin-top: 1rem;
        }

        .adjust-height {
            height: 70px;
        }
        .form-input{border : 0}
        .navbar {
            display: none !important
        }
    </style>
@endsection


@section('content')


    <div class=" ">

        <div class="container-">

            <div class=" ">

                <div class=" card col-md-12 p-4 pt-0 ">
                    <div class="form-input ">


                     


                            @include('feeder-pillar.partials.form')

                            
                       
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script>
        const userBa = "{{ Auth::user()->ba }}";
        $(document).ready(function() {


            $("#myForm").validate();
            if (userBa == '') {
                getBa();
            }

        });

        function getBa() {
            const selectedValue = $('#search_zone').val()
            const zone = "{{ $data->zone }}";
            const areaSelect = $('#ba');
            var baValues = '';
            const ba = "{{ $data->ba }}";
            // Clear previous options
            areaSelect.empty();
            if (selectedValue === zone) {
                areaSelect.append(`<option value="${ba}" hidden>${ba}</option>`)
            } else {
                areaSelect.append(`<option value="" hidden>select ba</option>`)

            }


            if (selectedValue === 'W1') {
                baValues = ['KUALA LUMPUR PUSAT'];

            } else if (selectedValue === 'B1') {
                baValues = ['PETALING JAYA', 'RAWANG', 'KUALA SELANGOR'];
            } else if (selectedValue === 'B2') {
                baValues = ['KLANG', 'PELABUHAN KLANG'];


            } else if (selectedValue === 'B4') {
                baValues = ['CHERAS', 'BANTING', 'BANGI', 'PUTRAJAYA & CYBERJAYA'];
            }


            baValues.forEach((data) => {
                areaSelect.append(`<option value="${data}">${data}</option>`);
            });

        }



        function leaningStatus(event) {
            var val = event.value;
            if (val == 'No') {
                if (!$('#leaning-angle').hasClass('d-none')) {
                    $('#leaning-angle').addClass('d-none')
                }
            } else {
                $('#leaning-angle').removeClass('d-none')
            }
        }

        function getStatus(event) {
            var val = event.value;

            if (!$('#gate_status_other').hasClass('d-none')) {
                $('#gate_status_other').addClass('d-none')
            } else {
                $('#gate_status_other').removeClass('d-none')
            }



        }
    </script>
@endsection
