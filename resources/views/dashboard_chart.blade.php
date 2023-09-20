@extends('layouts.master')

@section('title') @lang('translation.Dashboards') @endsection

@section('content')

{{-- @component('components.breadcrumb')
@slot('li_1') Dashboard @endslot
@slot('title') Dashboard @endslot
@endcomponent --}}

{{-- <div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <img src="{{ asset('build/images/users/avatar-1.jpg') }}" alt="" class="avatar-md rounded-circle img-thumbnail">
                            </div>
                            <div class="flex-grow-1 align-self-center">
                                <div class="text-muted">
                                    <p class="mb-2">Welcome to Skote Dashboard</p>
                                    <h5 class="mb-1">Henry wells</h5>
                                    <p class="mb-0">UI / UX Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 align-self-center">
                        <div class="text-lg-center mt-4 mt-lg-0">
                            <div class="row">
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Total Projects</p>
                                        <h5 class="mb-0">48</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Projects</p>
                                        <h5 class="mb-0">40</h5>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div>
                                        <p class="text-muted text-truncate mb-2">Clients</p>
                                        <h5 class="mb-0">18</h5>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 d-none d-lg-block">
                        <div class="clearfix mt-4 mt-lg-0">
                            <div class="dropdown float-end">
                                <button class="btn btn-primary" type="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bxs-cog align-middle me-1"></i> Setting
                                </button>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>
</div> --}}
<!-- end row -->

<div class="row">
    <div class="col-xl-12">
        <div class="row">
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted mb-4"><i class="mdi mdi-package h2 text-warning align-middle mb-0 me-3"></i> No of packages </p>

                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h5>10</h5>
                                    {{-- <p class="text-muted text-truncate mb-0">+ 0.0012 ( 0.2 % ) <i class="mdi mdi-arrow-up ms-1 text-success"></i></p> --}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <div id="area-sparkline-chart-1" data-colors='["--bs-warning"]' class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted mb-4"><i class="mdi mdi-file-document h2 text-primary align-middle mb-0 me-3"></i> No of documents </p>

                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h5>40</h5>
                                    {{-- <p class="text-muted text-truncate mb-0">- 4.102 ( 0.1 % ) <i class="mdi mdi-arrow-down ms-1 text-danger"></i></p> --}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                   
                                    <div id="area-sparkline-chart-2" data-colors='["--bs-primary"]' class="apex-charts"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted mb-4"><i class="mdi mdi-table h2  align-middle mb-0 me-3" style="color: var(--bs-green);"></i>
                            No of tables </p>

                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h5>25</h5>
                                    {{-- <p class="text-muted text-truncate mb-0">+ 1.792 ( 0.1 % ) <i class="mdi mdi-arrow-up ms-1 text-success"></i></p> --}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <div id="area-sparkline-chart-3" data-colors='["--bs-green"]' class="apex-charts"></div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-sm-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-muted mb-4"><i class="mdi mdi-book h2 text-info align-middle mb-0 me-3"></i>
                            No of pages </p>

                        <div class="row">
                            <div class="col-6">
                                <div>
                                    <h5>30</h5>
                                    {{-- <p class="text-muted text-truncate mb-0">+ 1.792 ( 0.1 % ) <i class="mdi mdi-arrow-up ms-1 text-success"></i></p> --}}
                                </div>
                            </div>
                            <div class="col-6">
                                <div>
                                    <div id="area-sparkline-chart-4" data-colors='["--bs-info"]' class="apex-charts"></div>
                                    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div>
</div>

<div class="row">
    <div class="col-xl-8">
        {{-- <div class="card">
            <div class="card-body">
                <div class="clearfix">
                    <div class="float-end">
                        <div class="input-group input-group-sm">
                            <select class="form-select form-select-sm">
                                <option value="JA" selected>Jan</option>
                                <option value="DE">Dec</option>
                                <option value="NO">Nov</option>
                                <option value="OC">Oct</option>
                            </select>
                            <label class="input-group-text">Month</label>
                        </div>
                    </div>
                    <h4 class="card-title mb-4">Earning</h4>
                </div>

                <div class="row">
                    <div class="col-lg-4">
                        <div class="text-muted">
                            <div class="mb-4">
                                <p>This month</p>
                                <h4>$2453.35</h4>
                                <div><span class="badge badge-soft-success font-size-12 me-1"> + 0.2% </span> From previous period</div>
                            </div>

                            <div>
                                <a href="javascript: void(0);" class="btn btn-primary waves-effect waves-light btn-sm">View Details <i class="mdi mdi-chevron-right ms-1"></i></a>
                            </div>

                            <div class="mt-4">
                                <p class="mb-2">Last month</p>
                                <h5>$2281.04</h5>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div id="line-chart" data-colors='["--bs-primary"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="card h-100">
            <div class="card-body">
                <div class="d-sm-flex flex-wrap">
                    <h4 class="card-title mb-4">Statistics </h4>
                    <div class="ms-auto">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a id="chartWeek" class="nav-link" href="javascript:void(0);">Week</a>
                            </li>
                            <li class="nav-item">
                                <a id="chartMonth" class="nav-link" href="javascript:void(0);">Month</a>
                            </li>
                            <li class="nav-item">
                                <a id="chartYear" class="nav-link active" href="javascript:void(0);">Year</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div data-colors='["--bs-primary", "--bs-success", "--bs-warning", "--bs-info"]' dir="ltr" id="chart"></div>
            </div>
        </div>
    </div>

    <div class="col-xl-4">
        <div class="card h-100">
            <div class="card-body">
                <h4 class="card-title mb-4">Types of Documents</h4>

                <div id="donut-charts"
                    data-colors='["--bs-info","--bs-warning", "--bs-danger", "--bs-success", "--bs-primary"]'
                    dir="ltr"></div>
            </div>
        </div>
       
    </div>
</div>
<!-- end row -->
<div class="row mt-4" style="display: none;">
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-sm-flex flex-wrap">
                    <h4 class="card-title mb-4"> No of packages </h4>
                    <div class="ms-auto">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">Week</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">Month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript:void(0);">Year</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div data-colors='["--bs-primary"]' dir="ltr" id="barchart1"></div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-sm-flex flex-wrap">
                    <h4 class="card-title mb-4">No of documents </h4>
                    <div class="ms-auto">
                        <ul class="nav nav-pills">
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">Week</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="javascript:void(0);">Month</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="javascript:void(0);">Year</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div data-colors='["--bs-success"]' dir="ltr" id="barchart2"></div>
            </div>
        </div>
    </div>
</div>
<!-- end row -->
<div class="row mt-4" >
    <div class="col-md-12">
        <div class="card h-100">
            <div class="card-body">
                <div class="float-end">
                    <select class="form-select form-select-sm ms-2">
                        <option value="MA" selected="">March</option>
                        <option value="FE">February</option>
                        <option value="JA">January</option>
                        <option value="DE">December</option>
                    </select>
                </div>
                <h4 class="card-title mb-4">Pages analyzed</h4>

                <div> 
                    <div id="donut-chart" data-colors='["--bs-primary", "--bs-success", "--bs-danger"]' class="apex-charts"></div>
                </div>

                <div class="text-center text-muted">
                    <div class="row">
                        <div class="col-4">
                            <div class="mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-primary me-1"></i> 1 Pages</p>
                                <h5>300</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-success me-1"></i> 5 pages</p>
                                <h5>100</h5>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="mt-4">
                                <p class="mb-2 text-truncate"><i class="mdi mdi-circle text-danger me-1"></i> 10 Pages</p>
                                <h5>200</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="toolbar d-flex flex-wrap gap-2 justify-content-center" style="display: none !important;">
    <button type="button" class="btn btn-light btn-sm active" id="one_month">
        1M
    </button>
    <button type="button" class="btn btn-light btn-sm" id="six_months">
        6M
    </button>
    <button type="button" class="btn btn-light btn-sm" id="one_year">
        1Y
    </button>
    <button type="button" class="btn btn-light btn-sm" id="all">
        ALL
    </button>
</div>


@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>

<!-- Saas dashboard init -->
<script src="{{ asset('build/js/pages/saas-dashboard.init.js') }}"></script>
<script src="{{ asset('build/js/pages/crypto-dashboard.init.js') }}"></script>
{{-- <script src="{{ asset('build/js/pages/dashboard-job.init.js') }}"></script> --}}
<!-- app js -->

<!-- tui charts plugins -->
<script src="{{ asset('build/libs/tui-chart/tui-chart-all.min.js') }}"></script>

<!-- tui charts map -->
<script src="{{ asset('build/libs/tui-chart/maps/usa.js') }}"></script>

<script src="{{ asset('build/js/app.js') }}"></script>
<script>
    var statisticsApplicationColors = getChartColorsArray("chart");
    if (statisticsApplicationColors) {
        var options = {
            series: [{
                name: 'Packages',
                type: 'column',
                data: [30, 48, 28, 74, 39, 87, 54, 36, 50, 87, 84]
            }, 
            // {
            //     name: 'Documents',
            //     type: 'column',
            //     data: [20, 50, 42, 10, 24, 28, 60, 35, 47, 64, 78]
            // },
            //  {
            //     name: 'Tables',
            //     type: 'area',
            //     data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
            // }, 
            {
                name: 'Pages',
                type: 'column',
                data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: true,
                offsetY: 10,
            },
            stroke: {
                width: [0, 0, 2, 2],
                curve: 'smooth'
            },  
            plotOptions: {
                bar: {
                    columnWidth: '30%'
                }
            },
            fill: {
                opacity: [1, 1, 0.1, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: ['01/01/2022', '02/01/2022', '03/01/2022', '04/01/2022', '05/01/2022', '06/01/2022', '07/01/2022',
                '08/01/2022', '09/01/2022', '10/01/2022', '11/01/2022'
            ],
            colors: statisticsApplicationColors,
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime'
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            // return y.toFixed(0) + " points";
                            return y.toFixed(0);
                        }
                        return y;

                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#chart"), options);
        chart.render();
    }
    var barcartcolor1 = getChartColorsArray("barchart1");
    if (barcartcolor1) {
        var options = {
            series: [{
                name: 'Packages',
                type: 'column',
                data: [30, 48, 28, 74, 39, 87, 54, 36, 50, 87, 84]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: true,
                offsetY: 10,
            },
            stroke: {
                width: [0, 0, 2, 2],
                curve: 'smooth'
            },  
            plotOptions: {
                bar: {
                    columnWidth: '30%'
                }
            },
            fill: {
                opacity: [1, 1, 0.1, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: ['01/01/2022', '02/01/2022', '03/01/2022', '04/01/2022', '05/01/2022', '06/01/2022', '07/01/2022',
                '08/01/2022', '09/01/2022', '10/01/2022', '11/01/2022'
            ],
            colors: barcartcolor1,
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime'
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            // return y.toFixed(0) + " points";
                            return y.toFixed(0);
                        }
                        return y;

                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#barchart1"), options);
        chart.render();
    }
    var barcartcolor1 = getChartColorsArray("barchart2");
    if (barcartcolor1) {
        var options = {
            series: [{
                name: 'Packages',
                type: 'column',
                data: [20, 50, 42, 10, 24, 28, 60, 35, 47, 64, 78]
            }],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: true,
                offsetY: 10,
            },
            stroke: {
                width: [0, 0, 2, 2],
                curve: 'smooth'
            },  
            plotOptions: {
                bar: {
                    columnWidth: '30%'
                }
            },
            fill: {
                opacity: [1, 1, 0.1, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: ['01/01/2022', '02/01/2022', '03/01/2022', '04/01/2022', '05/01/2022', '06/01/2022', '07/01/2022',
                '08/01/2022', '09/01/2022', '10/01/2022', '11/01/2022'
            ],
            colors: barcartcolor1,
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime'
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            // return y.toFixed(0) + " points";
                            return y.toFixed(0);
                        }
                        return y;

                    }
                }
            }
        };

        var chart = new ApexCharts(document.querySelector("#barchart2"), options);
        chart.render();
    }
    // Area sparkline 4
    var areaSparkline4Colors = getChartColorsArray("area-sparkline-chart-4");
    if (areaSparkline3Colors) {
    var options = {
        series: [{
        name: '',
        data: [23, 43, 11, 22, 6, 43, 24, 55, 66, 44, 88]
        }],
        chart: {
        type: 'area',
        height: 40,
        sparkline: {
            enabled: true
        }
        },
        stroke: {
        curve: 'smooth',
        width: 2,
        },
        colors: areaSparkline4Colors,
        fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            inverseColors: false,
            opacityFrom: 0.45,
            opacityTo: 0.05,
            stops: [25, 100, 100, 100]
        },
        },
        tooltip: {
        fixed: {
            enabled: false
        },
        x: {
            show: false
        },
        marker: {
            show: false
        }
        }
    };

    var chart = new ApexCharts(document.querySelector("#area-sparkline-chart-4"), options);
    chart.render();
    }
    const data = {
                    labels: ["January", "February", "March", "April", "May", "June"],
                    datasets: [
                        {
                            label: "No of Packages",
                            data: [10, 15, 20, 25, 30, 35],
                            backgroundColor: "rgba(75, 192, 192, 0.2)",
                            borderColor: "rgba(75, 192, 192, 1)",
                            borderWidth: 1,
                        },
                        {
                            label: "No of Documents",
                            data: [5, 10, 15, 20, 25, 30],
                            backgroundColor: "rgba(255, 99, 132, 0.2)",
                            borderColor: "rgba(255, 99, 132, 1)",
                            borderWidth: 1,
                        },
                    ],
                };

        var cartoptions = {
            series: [],
            chart: {
                height: 350,
                type: 'line',
                stacked: false,
                toolbar: {
                    show: false,
                },
            },
            legend: {
                show: true,
                offsetY: 10,
            },
            stroke: {
                width: [0, 0, 2, 2],
                curve: 'smooth'
            },  
            plotOptions: {
                bar: {
                    columnWidth: '30%'
                }
            },
            fill: {
                opacity: [1, 1, 0.1, 1],
                gradient: {
                    inverseColors: false,
                    shade: 'light',
                    type: "vertical",
                    opacityFrom: 0.85,
                    opacityTo: 0.55,
                    stops: [0, 100, 100, 100]
                }
            },
            labels: [],
            colors: statisticsApplicationColors,
            markers: {
                size: 0
            },
            xaxis: {
                type: 'datetime'
            },
            tooltip: {
                shared: true,
                intersect: false,
                y: {
                    formatter: function (y) {
                        if (typeof y !== "undefined") {
                            // return y.toFixed(0) + " points";
                            return y.toFixed(0);
                        }
                        return y;

                    }
                }
            }
        };
        var chartYear = [{
                name: 'Packages',
                type: 'column',
                data: [30, 48, 28, 74, 39, 87, 54, 36, 50, 87, 84]
            }, {
                name: 'Documents',
                type: 'column',
                data: [20, 50, 42, 10, 24, 28, 60, 35, 47, 64, 78]
            }, {
                name: 'Tables',
                type: 'area',
                data: [44, 55, 41, 67, 22, 43, 21, 41, 56, 27, 43]
            }, {
                name: 'Pages',
                type: 'line',
                data: [30, 25, 36, 30, 45, 35, 64, 52, 59, 36, 39]
            }]
       
</script>
<script>
    // Donut pie chart

var donutPieChartColors = getChartColorsArray("donut-charts");
if (donutPieChartColors) {
    var donutpieChartWidth = $("#donut-charts").width();
    var container = document.getElementById('donut-charts');
    var data1 = {
        categories: ['Documents'],
        series: [
            {
                name: 'PDF',
                data: 46.02
            },
            {
                name: 'PNG',
                data: 20.47
            },
            {
                name: 'JPEG',
                data: 17.71
            },
            {
                name: 'TIFF',
                data: 5.45
            },
            {
                name: 'JPG',
                data: 10.35
            }
        ]
    };
    var options = {
        chart: {
            width: donutpieChartWidth,
            height: 380,
            title: 'Analyzed Types of Documents',
            format: function(value, chartType, areaType, valuetype, legendName) {
                if (areaType === 'makingSeriesLabel') { // formatting at series area
                    value = value + '%';
                }

                return value;
            }
        },
        series: {
            radiusRange: ['40%', '100%'],
            showLabel: true
        },
        tooltip: {
            suffix: '%'
        },
        legend: {
            align: 'bottom'
        }
    };
    var theme = {
        chart: {
            background: {
                color: '#fff',
                opacity: 0
            },
        },
        title: {
            color: '#fff',
        },

        plot: {
            lineColor: 'rgba(166, 176, 207, 0.1)'
        },
        legend: {
            label: {
                color: '#fff'
            }
        },
        series: {
            colors: donutPieChartColors,
            label: {
                color: '#fff',
                fontFamily: 'sans-serif'
            }
        }
    };

    // For apply theme

    tui.chart.registerTheme('myTheme', theme);
    options.theme = 'myTheme';

    var donutChart = tui.chart.pieChart(container, data1, options);
}

$( window ).resize(function() {
    donutpieChartWidth = $("#donut-charts").width();
    donutChart.resize({
        width: donutpieChartWidth,
        height: 350
    });
});
</script>
@endsection