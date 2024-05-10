@extends('layout._template')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('page_header_right')
    <a href="{{url('master/corporate')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
    <button form="form" type="submit" class="btn btn-primary btn-fw">Submit</button>
@endsection

@section('content')
<form id="form" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('master/corporate') : url('master/corporate/'.$corporate->id)}}">
    
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
                    <div class="col-md-12">
                        <label>Municipio</label>
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
                    <div class="col-md-12">
                        <label>Posto</label>
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
                    <div class="col-md-12">
                        <label>Suco</label>
                        <select style="width:100%" class="form-control select2advance" name="suco_id" id="suco_id" data-select2-url="{{url('get-select/corporate')}}" >
                            @isset($corporate)
                            <option value="{{$corporate->suco_id}}">{{$corporate->suco->suco}}</option>
                            @else
                            <option value="">-- Choose suco --</option>
                            @endisset
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="form-group row">
                    <div class="col-md-12">
                        <label>Aldeia</label>
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
                <div class="col-md-10 col-md-10">
                    <input autofocus class="form-control" name="company" type="text" value="{{old('company',isset($corporate) ? $corporate->company : '')}}" placeholder="Company name" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Unique number</label>
                <div class="col-md-10 col-md-10">
                    <input autofocus class="form-control" name="number" type="number" value="{{old('number',isset($corporate) ? $corporate->number : '')}}" placeholder="Unique number" />
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Commercial Activity Authorized</label>
                <div class="col-md-10 col-md-10">
                    <div class="form-group row">
                        <div class="col-md-2">
                            <select style="width:100%" class="form-control select2advance" name="commactivity_auth_id" id="commactivity_auth_id" data-select2-url="{{url('get-select/comm-activity-auth')}}" >
                                @isset($corporate)
                                <option value="{{$corporate->commactivity_auth_id}}">{{$corporate->commactivity_auth->id_number}}</option>
                                @else
                                <option value="">-- Choose commercial activity authorized --</option>
                                @endisset
                            </select>
                        </div>
                        <div class="col-md-10">
                            <input readonly type="text" class="form-control" id="commactivity_auth_label" value="{{isset($corporate) ? $corporate->commactivity_auth->description : ''}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Office address</label>
                <div class="col-md-10 col-md-10">
                    <textarea class="form-control" col="3" name="address" id="address">{{old('address',isset($corporate) ? $corporate->address : '')}}</textarea>
                </div>
            </div>
        </div>
        <hr>
        <h2 class="h4 pd-20 mb-0 text-blue">Other Information</h2>
        <div class="pd-20">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Noted</label>
                <div class="col-md-10 col-md-10">
                    <textarea class="form-control" col="3" name="noted" id="noted">{{old('noted',isset($corporate) ? $corporate->noted : '')}}</textarea>
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

    $('#commactivity_auth_id').on('select2:select', function(evt){
        $("#commactivity_auth_label").val(evt.params.data.data.description);
    });
</script>
@endsection
