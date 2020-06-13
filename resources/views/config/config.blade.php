@extends('layouts.app')

@section('content')
<div class="container">   
   <div>
       config.balde.php
      
   </div>
   {{-- @php
       dd($apikey);
   @endphp --}}
<app-config fields="{{ $fields }}" apikey="{{ json_decode($apikey) }}"></app-config>
</div>
@endsection