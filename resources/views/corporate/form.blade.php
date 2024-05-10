@extends('layout._template')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_header_right')
    <a href="{{url('master/corporate')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form-user" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form-user" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('master/suco') : url('master/suco/'.$corporate->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($corporate) ? $corporate->id : ''}}">
    @include('layout._notification')

    <div class="card-box mb-30">
        <h2 class="h4 pd-20 mb-0 text-blue">Dados Regional</h2>
        <div class="pd-20 row">
            <div class="col-md-3">
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10">
                        <select style="width:100%" class="form-control select2advance" name="municipio_id" id="municipio_id" data-select2-url="{{url('get-select/municipio')}}" >
                            @isset($corporate)
                            <option value="{{$corporate->municipio_id}}">{{$corporate->municipio->municipio}}</option>
                            @else
                            <option value="">-- Choose municipio --</option>
                            @endisset
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10">
                        <select style="width:100%" class="form-control select2advance" name="posto_id" id="posto_id" data-select2-url="{{url('get-select/posto')}}" >
                            @isset($corporate)
                            <option value="{{$corporate->posto_id}}">{{$corporate->posto->posto}}</option>
                            @else
                            <option value="">-- Choose posto --</option>
                            @endisset
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10">
                        <select style="width:100%" class="form-control select2advance" name="suco_id" id="suco_id" data-select2-url="{{url('get-select/suco')}}" >
                            @isset($corporate)
                            <option value="{{$corporate->suco_id}}">{{$corporate->suco->suco}}</option>
                            @else
                            <option value="">-- Choose suco --</option>
                            @endisset
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="pd-20 row">
            <div class="col-md-3">
                <div class="form-group row">
                    <div class="col-sm-12 col-md-10">
                        <select style="width:100%" class="form-control select2advance" name="aldeia_id" id="aldeia_id" data-select2-url="{{url('get-select/aldeia')}}" >
                            @isset($corporate)
                            <option value="{{$corporate->aldeia_id}}">{{$corporate->aldeia->aldeia}}</option>
                            @else
                            <option value="">-- Choose aldeia --</option>
                            @endisset
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <h2 class="h4 pd-20 mb-0 text-blue">Detail Information</h2>
        <div class="pd-20">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Company name</label>
                <div class="col-sm-12 col-md-10">
                    <input autofocus class="form-control" name="company" type="text" value="{{old('company',isset($corporate) ? $corporate->company : '')}}" placeholder="Company name" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Posto</label>
                <div class="col-sm-12 col-md-10">
                    <select style="width:100%" class="form-control select2advance" name="posto_id" id="posto_id" data-select2-url="{{url('get-select/corporate')}}" >
                        @isset($corporate)
                        <option value="{{$corporate->posto_id}}">{{$corporate->posto}}</option>
                        @else
                        <option value="">-- Choose Posto --</option>
                        @endisset
                    </select>
                </div>
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
