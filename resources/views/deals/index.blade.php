@extends('layouts.app')

@section('content')
<div class="container my_class">
    <div class="row tables_column_wrap">
       
        @foreach ($columns as $column)
            {{-- <div>
                <span>column name:</span> <span> {{  $column  }}</span>
            </div> --}}

            <div class="col-sm-4 col-xs-12">
                <example-component columns="{{ $column }}"> </example-component>
            </div>
        @endforeach
    </div>
    


</div>
@endsection
