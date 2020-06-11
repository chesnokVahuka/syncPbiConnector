@extends('layouts.app')

@section('content')
<div class="container my_class">
    <div class="row tables_column_wrap">

        @foreach ($columns as $key => $value)           
            <div class="col-sm-4 col-xs-12">              
                @if ($value == '1')
                    <example-component columns="{{ $key }}" is-selected = "true" > </example-component>                    
                @else
                    <example-component columns="{{ $key }}" is-selected = "false" > </example-component>                    
                @endif             
            </div>  
        @endforeach
    </div>
    


</div>
@endsection
