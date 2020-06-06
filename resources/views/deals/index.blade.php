@extends('layouts.app')

@section('content')
<div class="container my_class">
    <div class="row">
        @foreach ($columns as $column)
            <div>
                <span>column name:</span> <span> {{  $column  }}</span>
            </div>
            <example-component columns="{{ $column }}"> </example-component>
        @endforeach
    </div>
    


</div>
@endsection
