@extends('layouts.app')

@section('content')
<div class="container my_class">
    <div class="row config_wrap">

        @foreach ($columns as $key => $value)           
            <div class="col-sm-4 col-xs-6">              
                @if ($value == '1')
                    <entity-fields columns="{{ $key }}" is-selected = "true" > </entity-fields>                    
                @else
                    <entity-fields columns="{{ $key }}" is-selected = "false" > </entity-fields>                    
                @endif             
            </div>  
        @endforeach
    </div>
    


</div>
@endsection
