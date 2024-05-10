
<div class="row">
    <div class="col-md-12 col-sm-12 grid-margin stretch-card mb-3">
        <div class="card">
            <div class="card-body p-1">

                <div class="row w-100" style="align-items: center;min-height:40px;">
                    <div class="col-2 h-100 d-flex align-items-center">
                        <span class="ms-2 btn btn-sm btn-warning w-100"><i class="menu-icon tf-icons bx bx-file"></i> <span class="d-none d-sm-inline">Surveyor</span></span>
                    </div>
                    <div class="col-10 h-100">
                        <div class="row h-100">
                            <div hidden class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" style="width:100%" class="form-select select2advance" id="tipe_surveyor" data-select2-placeholder="Tipe Surveyor" data-select2-url="{{ url('get-select/tipe-surveyor') }}" aria-label="Default select example">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" class="form-select select2advance" id="trigger_word" data-select2-placeholder="Trigger Word" data-select2-url="{{url('get-select/trigger-word?tipe_surveyor='.$tipe_surveyor)}}" aria-label="Default select example"> 
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 h-100 py-1 tw-sudah">
                                <div class="form-group h-100">
                                    <select form="form-list" class="form-select select2advance" id="trigger_word_sudah" data-select2-placeholder="Trigger Word Sudah" data-select2-url="{{url('get-select/trigger-word/sudah')}}" aria-label="Default select example"> 
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>