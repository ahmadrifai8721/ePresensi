@extends('admin/layout')

@section('pluginsCSS')
@endsection

@section('pluginsJS')

@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">{{ $pageTitle }}</h4>
            </div>
        </div>
    </div>

    @livewire('get-school-dapodik')

</div>
<!-- container -->
@endsection
