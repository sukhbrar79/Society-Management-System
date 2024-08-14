@extends('backend.layouts.app')

@section('title') @lang("Dashboard") @endsection

@section('breadcrumbs')
<x-backend.breadcrumbs />
@endsection

@section('content')
<div class="card mb-4 ">
    <div class="card-body">

        <x-backend.section-header>
            @lang("Dashboard")

            
        </x-backend.section-header>

        
    </div>
</div>

{{-- Demo content --}}
@include("backend.includes.dashboard_demo_data")

@endsection