@extends('layout._template')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_header_right')
    <a href="{{url('master/posto')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('master/posto') : url('master/posto/'.$posto->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($posto) ? $posto->id : ''}}">
    @include('layout._notification')

    <div class="pd-20 card-box mb-30">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Municipio</label>
            <div class="col-sm-12 col-md-10">
                <select style="width:100%" class="form-control select2advance" name="municipio_id" id="municipio_id" data-select2-url="{{url('get-select/municipio')}}" >
                    @isset($posto)
                    <option value="{{$posto->municipio_id}}">{{$posto->municipio_kode.' | '.$posto->municipio}}</option>
                    @else
                    <option value="">-- Choose Municipio --</option>
                    @endisset
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Code</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus required class="form-control" name="kode" type="number" value="{{old('kode',isset($posto) ? $posto->kode : '')}}" placeholder="Code" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Posto name</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus class="form-control" name="posto" type="text" value="{{old('posto',isset($posto) ? $posto->posto : '')}}" placeholder="Posto name" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Sort number</label>
            <div class="col-sm-12 col-md-10">
                <input class="form-control" name="urut" type="number" value="{{old('urut',isset($posto) ? $posto->urut : '')}}" placeholder="Sort number" />
            </div>
        </div>
    </div>
</form>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        initSelect2();
    })
</script>
@endsection
