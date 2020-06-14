@extends('layouts.app')

@section('content')
<div class="container">   
    <div class="row">
        <app-config tables="{{ $tables }}" apikey="{{ json_decode($apikey) }}"></app-config>

        {{-- <div class="col-sm-4 col-xs-6">
            <app-config fields="{{ $fields }}" apikey="{{ json_decode($apikey) }}"></app-config>
        </div> --}}
    </div>
</div>
@endsection