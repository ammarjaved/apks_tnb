@extends('layouts.map_layout', ['page_title' => 'Tiang Svar'])

@section('css')
    <!-- Fonts and icons -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700" rel="stylesheet" />

    <link rel="stylesheet" href="{{ URL::asset('assets/test/css/style.css') }}" />
    <style>
        input[type='checkbox'],
        input[type='radio'] {
            min-width: 16px !important;
            margin-right: 12px;
        }
        /* a[href='#finish'] {
            display: none !important;
        } */
        input[type='radio'] {
            border-radius: 50% !important;
        }
        .fw-400{
            font-weight: 400 !important;
        }

        input[type='file'],
        table input {
            margin: 0px !important;
        }

        table label {
            font-size: 14px !important;
            font-weight: 400 !important;
            margin-left: 10px !important;
            margin-bottom: 0px !important
        }

        th {
            font-size: 14px !important;
        }

        th,
        td {
            padding: 6px 16px !important
        }

        table,
        input[type='file'] {
            width: 90% !important;
        }


        table input[type="file"] {
            font-size: 11px !important;
            height: 33px !important;
        }

        td.d-flex {
            border-bottom: 0px !important;
            border-left: 0px !important;
            border-right: 0px !important;
        }

        textarea {
            border: 1px solid #999999 !important;
        }

        body::-webkit-scrollbar {
            display: none !important;
        }

        span.number {
            display: none
        }

        .navbar {
            display: none !important
        }
    </style>
@endsection


@section('content')
    <div class=" ">

        <div class="container- m-2">

            <div class=" ">

                <div class=" card row   ">
                    <div class=" ">
                        {{-- <h3 class="text-center p-2">{{ __('messages.qr_savr') }}</h3> --}}

                        @include('Tiang.partials.editForm', ['data'=>$data , 'url' => "tiang-talian-vt-and-vr"])

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="{{ URL::asset('assets/test/js/jquery.steps.js') }}"></script>


    <script>
        var id = {{$data->id}};
        var form = $("#framework-wizard-form").show();
        form
            .steps({
                headerTag: "h3",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                autoHeight: true,
            })

            $('form li').removeClass('disabled')
            $('form li').addClass('done')


            function addRepairDate(name) 
            {
                var dateInput = $(`#repair_date-${name}`);
                var dateErr = $(`#err-${name}`);
                var button = $(`#reapir_date_button-${name}`);

                var date = dateInput.val();
                if (date == '') {
                    dateErr.html('This feild is required');
                }else{

                    $.ajax(
                    {
                        url: `/{{app()->getLocale()}}/add-tiang-repair-date?name=${name}&date=${date}&id=${id}`,
                        method: 'GET',
                        success: function(response)
                        {
                            button.remove();
                            dateInput.remove();
                            dateErr.html(date);

                        },
                        error: function(error)
                        {
                            console.error('Error:', error);
                            alert('Request  Failed')
                        }
                    });

                }
            }
     


     

        
        
    </script>
@endsection
