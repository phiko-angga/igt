@extends('layout._template')


@section('page_header_right')
    <a href="{{url('master/position')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form-user" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form-user" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('master/position') : url('master/position/'.$position->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($position) ? $position->id : ''}}">
    @include('layout._notification')

    <div class="pd-20 card-box mb-30">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Position name</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus class="form-control" name="name" type="text" value="{{old('name',isset($position) ? $position->name : '')}}" placeholder="Position name" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Description</label>
            <div class="col-sm-12 col-md-10">
                <textarea name="description" class="form-control" placeholder="Description">{{old('description',isset($position) ? $position->description : '')}}</textarea>
            </div>
        </div>
    </div>
</form>
@endsection
