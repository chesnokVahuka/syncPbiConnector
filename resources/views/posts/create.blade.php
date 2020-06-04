@extends('layouts.app')

@section('content')
<div class="container my_class">
    <div class="row">
            <div class="form-group{{ $errors->has('caption') ? ' has-error' : '' }}">
                <form action="/p" enctype="multipart/form-data" method="POST">     
                    {{ csrf_field() }}       

                    <label for="caption" class="col-md-4 control-label">Caption</label>
                        <input id="caption" type="text" class="form-control" name="caption" value="{{ old('caption') }}" required autofocus>
                            @if ($errors->has('caption'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('caption') }}</strong>
                                </span>
                            @endif

                    <label for="image" class="col-md-4 control-label">Image</label>
                    <div>
                        <input type="file" class="form-control-file" id="image" name="image">
                        @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                        @endif
                    </div>
                    <div>
                        <button> Save image </button>
                    </div>
                </form>
            </div>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h3>Fields to sync</h3>
        </div>

        <div class="col-md-6 fields">
            <span>
                Deal_id
            </span>
        </div>
    </div>  
</div>
@endsection
