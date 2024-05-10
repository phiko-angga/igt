@extends('layout._template')

@section('content')

<div class="row pb-10">
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">75</div>
                    <div class="font-14 text-secondary weight-500">
                        Municipio
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#00eccf">
                        <i class="icon-copy bi bi-pin-map-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">250</div>
                    <div class="font-14 text-secondary weight-500">
                        Posto
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#ff5b5b">
                        <i class="icon-copy bi bi-pin-map-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">400</div>
                    <div class="font-14 text-secondary weight-500">
                        Suco
                    </div>
                </div>
                <div class="widget-icon">
                    <div class="icon">
                        <i class="icon-copy bi bi-pin-map-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-3 col-md-6 mb-20">
        <div class="card-box height-100-p widget-style3">
            <div class="d-flex flex-wrap">
                <div class="widget-data">
                    <div class="weight-700 font-24 text-dark">3,000</div>
                    <div class="font-14 text-secondary weight-500">Aldeia</div>
                </div>
                <div class="widget-icon">
                    <div class="icon" data-color="#09cc06">
                        <i class="icon-copy bi bi-pin-map-fill"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row pb-10">
    <div class="col-md-8 mb-20">
        <div class="card-box height-100-p pd-20">
            <div
                class="d-flex flex-wrap justify-content-between align-items-center pb-0 pb-md-3"
            >
                <div class="h5 mb-md-0">IGT Activities</div>
                <div class="form-group mb-md-0">
                    <select class="form-control form-control-sm selectpicker">
                        <option value="">Last Week</option>
                        <option value="">Last Month</option>
                        <option value="">Last 6 Month</option>
                        <option value="">Last 1 year</option>
                    </select>
                </div>
            </div>
            <div id="activities-chart"></div>
        </div>
    </div>
    <div class="col-md-4 mb-20">
        <div
            class="card-box min-height-200px pd-20 mb-20"
            data-bgcolor="#455a64"
        >
            <div class="d-flex justify-content-between pb-20 text-white">
                <div class="icon h1 text-white">
                    <i class="icon-copy bi bi-people"></i>
                </div>
                <div class="font-14 text-right">
                    <div><i class="icon-copy ion-arrow-up-c"></i> 2.69%</div>
                    <div class="font-12">Since last month</div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end">
                <div class="text-white">
                    <div class="font-14">Worker</div>
                    <div class="font-24 weight-500">1865</div>
                </div>
                <div class="max-width-150">
                    <div id="appointment-chart"></div>
                </div>
            </div>
        </div>
        <div class="card-box min-height-200px pd-20" data-bgcolor="#265ed7">
            <div class="d-flex justify-content-between pb-20 text-white">
                <div class="icon h1 text-white">
                    <i class="icon-copy bi bi-person-workspace"></i>
                </div>
                <div class="font-14 text-right">
                    <div><i class="icon-copy ion-arrow-down-c"></i> 3.69%</div>
                    <div class="font-12">Since last month</div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-end">
                <div class="text-white">
                    <div class="font-14">Supervision</div>
                    <div class="font-24 weight-500">250</div>
                </div>
                <div class="max-width-150">
                    <div id="surgery-chart"></div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection