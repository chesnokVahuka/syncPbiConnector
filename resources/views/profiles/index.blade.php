@extends('layouts.app')

@section('content')
<div class="container my_class">
  
    <div class="row">
        <label for="bitrix_api_key" class="col-md-4 control-label"> Укажите API key </label>
            <input id="bitrix_api_key" name = "bitrix_api_key" type="text" class="url_input">                 

    </div>

    <div class="row">
        <div class="col-3">
         <div>
             Your username is {{$user->username}}
         </div> 
         <div>
             Your title is {{$user->profile->title ?? 'no title'}}
         </div> 
         <div>
             Your description is {{$user->profile->description ?? 'no description'}}
         </div> 
         <div>
             Your url is {{$user->profile->url ?? 'no link'}}
         </div> 
         <div>
            posts:  {{$user->posts->count() ?? '0'}}
        </div> 
          <div>
             <!-- @foreach ($user->posts as $post)
          <div style="max-width:100px;">
            <img src="/storage/{{ $post->image }}" style="width:300px;">
          </div> 
             @endforeach -->
         </div>
        </div>
        <div class="col-9">
            <a href="/p/create"> Add new posts</a>
        </div>
    </div>
    <example-component user-id="{{  $user->id  }}"></example-component>

</div>
@endsection
