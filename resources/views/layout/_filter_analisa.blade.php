
<div class="row">
    <div class="col-md-12 col-sm-12 grid-margin stretch-card mb-3">
        <div class="card">
            <div class="card-body p-1">

                <div class="row w-100" style="align-items: center;min-height:40px;">
                    <div class="col-2 h-100 d-flex align-items-center">
                        <span class="ms-2 btn btn-sm btn-danger w-100"><i class="menu-icon tf-icons bx bx-slider"></i> <span class="d-none d-sm-inline">Analisis</span> </span>
                    </div>
                    <div class="col-10 h-100">
                        <div class="row h-100">
                            <div class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" style="width:100%" class="form-select select2advance" id="analisa_fraud" data-select2-placeholder="Filter data fraud" data-select2-url="{{ url('get-select/fraud') }}" aria-label="Default select example">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" style="width:100%" class="form-select select2advance" id="verifikasi_data" data-select2-placeholder="Verifikasi Data" data-select2-url="{{ url('get-select/verifikasi-data') }}" aria-label="Default select example">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div hidden class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" style="width:100%" class="form-select select2advance" id="multiple_surveyor" data-select2-placeholder="Input Surveyor Berbeda" data-select2-url="{{ url('get-select/multiple-surveyor') }}" aria-label="Default select example">
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