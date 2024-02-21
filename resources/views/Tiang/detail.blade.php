@extends('layouts.app')

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

        .fw-400 {
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

        span.number {
            display: none
        }
    </style>
@endsection


@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>{{ __('messages.tiang') }} </h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item"><a
                                href="{{ route('tiang-talian-vt-and-vr.index', app()->getLocale()) }}">{{ __('messages.index') }}
                            </a></li>
                        <li class="breadcrumb-item active">{{ __('messages.deatil') }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>
    <div class="container m-2">

        <div class=" ">

            <div class=" card row p-4  ">
                <div class=" ">
                    {{-- <h3 class="text-center p-2">{{ __('messages.qr_savr') }}</h3> --}}

                    @include('Tiang.partials.editForm', ['data'=>$data , 'url' => "tiang-talian-vt-and-vr"])

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="{{ URL::asset('assets/test/js/jquery.steps.js') }}"></script>


    <script>
        var form = $("#framework-wizard-form").show();
        form
            .steps({
                headerTag: "h3",
                bodyTag: "fieldset",
                transitionEffect: "slideLeft",
                

            })

            $('form li').removeClass('disabled')

            $('form li').addClass('done')
    </script>
@endsection
