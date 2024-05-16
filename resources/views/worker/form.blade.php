@extends('layout._template')

@section('style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
<form id="form" method="post" enctype="multipart/form-data" action="{{$action == 'store' ? url('transaction/worker') : url('transaction/worker/'.$worker->id)}}">
    
    @csrf   
    @if($action == 'update')
    <input name="_method" type="hidden" value="PUT">
    @endif
    <input type="hidden" name="id" value="{{isset($worker) ? $worker->id : ''}}">
    @include('layout._notification')

    <div class="card-box mb-30">
        <h2 class="h4 pd-20 mb-0 text-blue">Basic Information</h2>
        <div class="pd-20">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Unique number company</label>
                <div class="col-md-10 col-md-10">
                    <select required style="width:100%" class="form-control select2advance" name="corporate_id" id="corporate_id" data-select2-url="{{url('get-select/corporate')}}" >
                        @isset($worker)
                        <option value="{{$worker->corporate->id}}">{{$worker->corporate->number.' | '.$worker->corporate->company}}</option>
                        @else
                        <option value="">-- Choose unique number company --</option>
                        @endisset
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Naran compania</label>
                <div class="col-md-10 col-md-10">
                    <input readonly type="text" class="form-control" id="corporate_company" value="{{isset($worker) ? $worker->corporate->company : ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Unique number company</label>
                <div class="col-md-10 col-md-10">
                    <input readonly type="text" class="form-control" id="corporate_number" value="{{isset($worker) ? $worker->corporate->number : ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Main office address</label>
                <div class="col-md-10 col-md-10">
                    <input readonly type="text" class="form-control" id="corporate_address" value="{{isset($worker) ? $worker->corporate->address : ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Commercial activity authorized</label>
                <div class="col-md-10 col-md-10">
                    <input readonly type="text" class="form-control mb-2" id="corporate_comm_actauth" value="{{isset($worker) ? $worker->corporate->commactivity_auth->description : ''}}">
                    <input readonly type="text" class="form-control" id="corporate_comm_actauth2" value="{{isset($worker) ? $worker->corporate->commactivity_auth->description2 : ''}}">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Type worker</label>
                <div class="col-md-10 col-md-10 d-flex flex-row">
                    <div class="custom-control custom-radio mb-5 mr-3">
                        <input type="radio" id="type_local" name="type" value="Local" {{isset($worker) ? ($worker->type == 'Local' ? 'checked' : '') : 'checked'}} class="custom-control-input">
                        <label class="custom-control-label" for="type_local">Local worker</label>
                    </div>
                    <div class="custom-control custom-radio mb-5">
                        <input type="radio" id="type_foreign" name="type" value="Foreign" {{isset($worker) ? ($worker->type == 'Foreign' ? 'checked' : '') : ''}} class="custom-control-input">
                        <label class="custom-control-label" for="type_foreign">Foreign worker</label>
                    </div>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Code & Name worker</label>
                <div class="col-md-10 col-md-10 d-flex">
                    <input required type="text" class="form-control mr-3" name="name" value="{{isset($worker) ? $worker->name : ''}}" aria-describedby="name" placeholder="Name">
                    <input readonly type="text" class="form-control" value="{{isset($worker) ? $worker->code : ''}}" aria-describedby="code" placeholder="Code generate automatically">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Place & date birth</label>
                <div class="col-md-10 col-md-10 d-flex">
                    <input required type="text" class="form-control mr-3" name="pob" placeholder="Place" value="{{isset($worker) ? $worker->pob : ''}}">
                    <input required type="date" max="{{date('Y-m-d',strtotime('- 17 year'))}}" class="form-control" name="dob" id="dob" value="{{isset($worker) ? $worker->dob : ''}}" placeholder="Date">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Position</label>
                <div class="col-md-10 col-md-10">
                    <select required style="width:100%" class="form-control select2advance" name="position_id" id="position_id" data-select2-url="{{url('get-select/position')}}" >
                        @isset($worker)
                        <option value="{{$worker->position->id}}">{{$worker->position->name}}</option>
                        @else
                        <option value="">-- Choose position --</option>
                        @endisset
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Phone number</label>
                <div class="col-md-10 col-md-10">
                    <input required type="text" class="form-control" name="phone" value="{{isset($worker) ? $worker->phone : ''}}" aria-describedby="Phone number" placeholder="Phone number">
                </div>
            </div>
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Start & Period of Work</label>
                <div class="col-md-10 col-md-10 d-flex">
                    <input required type="date" class="form-control mr-3" id="work_startdate" name="work_startdate" value="{{isset($worker) ? $worker->work_startdate : ''}}" placeholder="Start working">
                    <input readonly type="text" class="form-control" id="work_period" name="work_period" value="{{isset($worker) ? date('Y',strtotime($worker->work_startdate)) - date('Y').' years' : ''}}" placeholder="Work period">
                </div>
            </div>
        </div>

        <hr>
        <h2 class="h4 pd-20 mb-0 text-blue">Latest Education</h2>
        <div class="pd-20">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Education</label>
                <div class="col-md-10 col-md-10 row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_university" id="c_university" value="1" {{isset($worker) ? ($worker->c_university == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_university"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="University">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_institute" id="c_institute" value="1" {{isset($worker) ? ($worker->c_institute == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_institute"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Institute">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_diploma" id="c_diploma" value="1" {{isset($worker) ? ($worker->c_diploma == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_diploma"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Diploma">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_academy" id="c_academy" value="1" {{isset($worker) ? ($worker->c_academy == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_academy"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Academy">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_senior_hs" id="c_senior_hs" value="1" {{isset($worker) ? ($worker->c_senior_hs == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_senior_hs"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Senior High School">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_junior_hs" id="c_junior_hs" value="1" {{isset($worker) ? ($worker->c_junior_hs == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_junior_hs"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Junior High School">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <h2 class="h4 pd-20 mb-0 text-blue">Others Requirements</h2>
        <div class="pd-20">
            <div class="form-group row">
                <label class="col-sm-12 col-md-2 col-form-label">Others requirements</label>
                <div class="col-md-10 col-md-10 row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_good_behavior_letter" id="c_good_behavior_letter" value="1" {{isset($worker) ? ($worker->c_good_behavior_letter == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_good_behavior_letter"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Good Behavior Letter">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_health_certificate" id="c_health_certificate" value="1" {{isset($worker) ? ($worker->c_health_certificate == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_health_certificate"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Health Certificate">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_photo_3x4" id="c_photo_3x4" value="1" {{isset($worker) ? ($worker->c_photo_3x4 == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_photo_3x4"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Photo 3x4">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_diploma2" id="c_diploma2" value="1" {{isset($worker) ? ($worker->c_diploma2 == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_diploma2"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Diplomas">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_birth_certificate" id="c_birth_certificate" value="1" {{isset($worker) ? ($worker->c_birth_certificate == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_birth_certificate"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Birth Certificate">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend bg-white">
                                <div class="custom-control custom-checkbox mb-5 mt-2 mx-2">
                                    <input type="checkbox" class="custom-control-input" name="c_identity_card" id="c_identity_card" value="1" {{isset($worker) ? ($worker->c_identity_card == 1 ? 'checked' : '') : ''}}>
                                <label class="custom-control-label" for="c_identity_card"></label>
                                </div>
                            </div>
                            <input readonly type="text" class="form-control" value="Identity Card">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr>
        <div class="pd-20 text-center">
            <a href="{{url('transaction/worker')}}" class="btn btn-secondary btn-fw mr-2">Cancel</a>
            <button form="form" type="submit" class="btn btn-primary btn-fw">Submit</button>
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

    $('#corporate_id').on('select2:select', function(evt){
        $("#corporate_company").val(evt.params.data.data.company);
        $("#corporate_number").val(evt.params.data.data.number);
        $("#corporate_address").val(evt.params.data.data.address);
        $("#corporate_comm_actauth").val(evt.params.data.data.commactivity_auth.description);
        $("#corporate_comm_actauth2").val(evt.params.data.data.commactivity_auth.description2);
    });

    $(document).on("change","#work_startdate",function(){
        let startdate = parseInt($(this).val().substring(0,4));
		let CurrentDate = parseInt(new Date().getFullYear());
        console.log(CurrentDate - startdate);
        $("#work_period").val((CurrentDate - startdate)+" years");
    })
</script>
@endsection
