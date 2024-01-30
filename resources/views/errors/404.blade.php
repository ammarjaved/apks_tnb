@extends('layouts.app', ['page_title' => 'PageNotFound'])
@section('content')
    <section class="content-header">
        <div class="container-  ">
            <div class="row  " style="flex-wrap:nowrap">
                <div class="col-sm-6">
                    <h3>Page Not Found</h3>
                </div>
                <div class="col-sm-6 text-right">
                    <ol class="breadcrumb float-right">
                        <li class="breadcrumb-item text-lowercase"><a
                                href="{{ route('feeder-pillar.index', app()->getLocale()) }}">{{__('messages.index')}}</a></li>
                        <li class="breadcrumb-item active text-lowercase">404</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <div class=" ">

        <div class="container">

            <div class=" ">

                <div class=" card col-md-12 p-4 ">
                    <div class="form-input ">
                        <h3 class="text-center p-2"></h3>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
