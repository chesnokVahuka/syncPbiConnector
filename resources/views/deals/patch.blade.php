@extends('layouts.app')

@section('content')
<div class="container my_class">
    <div class="row">
        
        @foreach ($arDeals as $deal)
        {{ dd($deal) }}
            <div>
                <span>deal: </span> <span> {{  $deal['TITLE']  }}</span>
            </div>
                @foreach ($deal as $key=> $value)
               
                    <div>
                        <span> prop: </span> <span> {{ $item }}</span>
                    </div>
                @endforeach
        @endforeach
    </div>
</div>
@endsection
