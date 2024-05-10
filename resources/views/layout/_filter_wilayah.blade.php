
<div class="row">
    <div class="col-md-12 col-sm-12 grid-margin stretch-card mb-3">
        <div class="card">
            <div class="card-body p-1">

                <div class="row w-100" style="align-items: center;min-height:40px;">
                    <div class="col-2 h-100 d-flex align-items-center">
                        <span class="ms-2 btn btn-sm btn-primary w-100"><i class="menu-icon tf-icons bx bx-filter-alt"></i> <span class="d-none d-sm-inline">Filter</span></span>
                    </div>
                    <div class="col-10 h-100">
                        <div class="row h-100">
                            <div class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" style="width:100%" class="form-select select2advance" id="provinsi_id" data-select2-placeholder="Pilih provinsi" data-select2-url="{{ url('get-select/provinsi?'.(isset($paramProvinsi) ? $paramProvinsi : 'all=0')) }}" aria-label="Default select example">
                                        
                                        @if(auth()->user()->provinsi_id == null)
                                            <option value="{{isset($pro) ? $pro : ''}}">{{isset($provinsi) ? $provinsi : ''}}</option>
                                        @elseif(auth()->user()->provinsi_id != null)
                                            <option value="{{auth()->user()->provinsi_id}}">{{session()->get('provinsi_name')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" class="form-select select2advance" name="kota_id" id="kota_id" data-select2-placeholder="Pilih kota / kabupaten" data-select2-url="{{url('get-select/kota'.(isset($paramKota) ? $paramKota : 'all=0').(auth()->user()->provinsi_id != null ? '&provinsi='.auth()->user()->provinsi_id : (isset($pro) ? '&provinsi='.$pro  : '')))}}" aria-label="Default select example"> 
                                       
                                        @if(auth()->user()->kota_id == null)
                                            <option value="{{isset($kot) ? $kot : ''}}">{{isset($kota) ? $kota : ''}}</option>
                                        @elseif(auth()->user()->kota_id != null)
                                            <option value="{{auth()->user()->kota_id}}">{{session()->get('kota_name')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div {{isset($kecHide) ? "style=display:none" : ""}} class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" class="form-select select2advance" name="kecamatan_id" id="kecamatan_id" data-select2-placeholder="Pilih kecamatan" data-select2-url="{{url('get-select/kecamatan?'.(isset($paramKecamatan) ? $paramKecamatan : 'all=0').(auth()->user()->kota_id != null ? '?kota='.auth()->user()->kota_id : (isset($kot) ? (isset($paramKecamatan) ? $paramKecamatan : 'all=0').'&kota='.$kot : '')))}}" aria-label="Default select example"> 
                                        
                                        @if(auth()->user()->kecamatan_id == null)
                                            <option value="{{isset($kec) ? $kec : ''}}">{{isset($kecamatan) ? $kecamatan : ''}}</option>
                                        @elseif(auth()->user()->kecamatan_id != null)
                                            <option value="{{auth()->user()->kecamatan_id}}">{{session()->get('kecamatan_name')}}</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div {{isset($kelHide) ? "style=display:none" : ""}} class="col-md-3 h-100 py-1">
                                <div class="form-group h-100">
                                    <select form="form-list" class="form-select select2advance" name="kelurahan_id" id="kelurahan_id" data-select2-placeholder="Pilih desa / kelurahan" data-select2-url="{{url('get-select/kelurahan?'.(isset($paramKelurahan) ? $paramKelurahan : 'all=0').(auth()->user()->kecamatan_id != null ? '&kecamatan='.auth()->user()->kecamatan_id : (isset($kec) ? (isset($paramKelurahan) ? $paramKelurahan : 'all=0').'&kecamatan='.$kec : '')))}}" aria-label="Default select example"> 
                                        
                                        @if(auth()->user()->kelurahan_id == null)
                                            <option value="{{isset($kel) ? $kel : ''}}">{{isset($kelurahan) ? $kelurahan : ''}}</option>
                                        @elseif(auth()->user()->kelurahan_id != null)
                                            <option value="{{auth()->user()->kelurahan_id}}">{{session()->get('kelurahan_name')}}</option>
                                        @endif
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