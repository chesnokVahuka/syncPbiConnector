@extends('layouts.app')

@section('content')
<div class="container my_class">
  
    <div class="row">
       ID {$deal->ID}                 

    </div>

    <div>
        <!--@foreach ($deal->posts as $post)
          <div style="max-width:100px;">
            <img src="/storage/{{ $post->image }}" style="width:300px;">
          </div> 
        @endforeach -->
    </div>

    
</div>
@endsection
