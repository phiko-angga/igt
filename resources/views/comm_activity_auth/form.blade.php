@extends('layout._template')


@section('page_header_right')
    <a href="{{url('master/comm-activity-auth')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form-user" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form-user" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('master/comm-activity-auth') : url('master/comm-activity-auth/'.$commActivityAuth->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($commActivityAuth) ? $commActivityAuth->id : ''}}">
    @include('layout._notification')

    <div class="pd-20 card-box mb-30">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">ID number</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus required class="form-control" name="id_number" type="number" value="{{old('id_number',isset($commActivityAuth) ? $commActivityAuth->id_number : '')}}" placeholder="ID number" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Description</label>
            <div class="col-sm-12 col-md-10">
                <textarea required name="description" class="form-control" placeholder="Description">{{old('description',isset($commActivityAuth) ? $commActivityAuth->description : '')}}</textarea>
            </div>
        </div>
    </div>
</form>
@endsection
