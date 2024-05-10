@extends('layout._template')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_header_right')
    <a href="{{url('master/posto')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form-user" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form-user" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('master/suco') : url('master/suco/'.$suco->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($suco) ? $suco->id : ''}}">
    @include('layout._notification')

    <div class="pd-20 card-box mb-30">
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Suco name</label>
            <div class="col-sm-12 col-md-10">
                <input autofocus class="form-control" name="suco" type="text" value="{{old('suco',isset($suco) ? $suco->suco : '')}}" placeholder="Suco name" />
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-12 col-md-2 col-form-label">Posto</label>
            <div class="col-sm-12 col-md-10">
                <select style="width:100%" class="form-control select2advance" name="posto_id" id="posto_id" data-select2-url="{{url('get-select/posto')}}" >
                    @isset($suco)
                    <option value="{{$suco->posto_id}}">{{$suco->posto}}</option>
                    @else
                    <option value="">-- Choose Posto --</option>
                    @endisset
                </select>
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
