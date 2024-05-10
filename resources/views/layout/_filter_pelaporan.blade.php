
<div class="row">
    <div class="col-md-12 col-sm-12 grid-margin stretch-card mb-3">
        <div class="card">
            <div class="card-body p-1">

                <div class="row w-100" style="align-items: center;min-height:40px;">
                    <div class="col-2 h-100 d-flex align-items-center">
                        <span class="ms-2 btn btn-sm btn-warning w-100"><i class="menu-icon tf-icons bx bx-file"></i> <span class="d-none d-sm-inline">Status</span></span>
                    </div>
                    <div class="col-10 h-100">
                        <div class="row h-100">
                            <div class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" style="width:100%" class="form-select select2advance" id="pelaporan_dpt" data-select2-placeholder="Status C6 & DPT" data-select2-url="{{ url('get-select/pelaporan-c6-dpt') }}" aria-label="Default select example">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" class="form-select select2advance" id="pelaporan_suara" data-select2-placeholder="Status hasil suara" data-select2-url="{{url('get-select/pelaporan-hasil-suara')}}" aria-label="Default select example"> 
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