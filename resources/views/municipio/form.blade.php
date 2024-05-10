@extends('layout._template')


@section('page_header_right')
    <a href="{{url('master/municipio')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form-user" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form-user" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('master/municipio') : url('master/municipio/'.$municipio->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($municipio) ? $municipio->id : ''}}">
    @include('layout._notification')

    <div class="pd-20 card-box mb-30">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Municipio name</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus class="form-control" name="municipio" type="text" value="{{old('municipio',isset($municipio) ? $municipio->municipio : '')}}" placeholder="Municipio name" />
            </div>
        </div>
    </div>
</form>
@endsection
