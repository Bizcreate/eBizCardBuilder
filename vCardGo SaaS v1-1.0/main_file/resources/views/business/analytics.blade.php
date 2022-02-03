@extends('layouts.admin')
@section('page-title')
   {{__('Business Analytics')}}
@endsection
@section('content')
<div class="page-title">
    <div class="row justify-content-between align-items-center">
        <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
            <div class="d-inline-block">
            <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Business Analytics')}}</h5>
            </div>
        </div>
        <div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
       
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-6 col-md-12 col-sm-12">
        <div class="card card-fluid">
            <div class="card-header">
                <h6 class="mb-0 float-left">{{__('Device Analytics')}}</h6>
                <span class="mb-0 float-right">{{__('Last 15 Days')}}</span>
            </div>
            <div class="card-body">
                <!-- Chart -->
                <div id="pie-storedashborad" data-color="primary" data-height="280"></div>
            </div>
        </div>
    </div>
    <div class="col-xl-6 col-md-12 col-sm-12">
        <div class="card card-fluid">
            <div class="card-header">
                <h6 class="mb-0 float-left">{{__('Browser Analytics')}}</h6>
                <span class="mb-0 float-right">{{__('Last 15 Days')}}</span>
            </div>
            <div class="card-body">
                <!-- Chart -->
                <div id="pie-storebrowser" data-color="primary" data-height="280"></div>
            </div>
        </div>
    </div>
</div>
<div class="row">
   
   <div class="col-xl-12 col-md-6 col-sm-12">
       <div class="card card-fluid">
           <div class="card-header">
               <h6 class="mb-0 float-left">{{('Platform Analytics')}}</h6>
               <span class="mb-0 float-right">{{__('Last 15 Days')}}</span>
           </div>
           <div id="user_platform-chart" data-color="primary"></div>
       </div>
   </div>
</div>

@endsection
@push('custom-scripts')
    <script>
        var options = {
            series:{!! json_encode($devicearray['data']) !!},
            chart: {
                width: 550,
                height:400,
                type: 'pie',
            },
            labels:{!! json_encode($devicearray['label']) !!},
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom',
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#pie-storedashborad"), options);
        chart.render();
        var options = {
            series:{!! json_encode($browserarray['data']) !!},
            chart: {
                width: 600,
                 height:400,
                type: 'pie',
            },
            labels:{!! json_encode($browserarray['label']) !!},
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 200
                    },
                    legend: {
                        position: 'bottom',
                    }
                }
            }]
        };
        var chart = new ApexCharts(document.querySelector("#pie-storebrowser"), options);
        chart.render();
    </script>
    <script>
        var WorkedHoursChart = (function () {
            var $chart = $('#user_platform-chart');

            function init($this) {
                var options = {
                    chart: {
                        width: '100%',
                        type: 'bar',
                        zoom: {
                            enabled: false
                        },
                        toolbar: {
                            show: false
                        },
                        shadow: {
                            enabled: false,
                        },

                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            distributed: true,
                            columnWidth: '30%',
                            endingShape: 'rounded'
                        },
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    series: [{
                        name: 'Platform',
                        data: {!! json_encode($platformarray['data']) !!},
                    }],
                    xaxis: {
                        labels: {
                            // format: 'MMM',
                            style: {
                                colors: PurposeStyle.colors.gray[600],
                                fontSize: '14px',
                                fontFamily: PurposeStyle.fonts.base,
                                cssClass: 'apexcharts-xaxis-label',
                            },
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: true,
                            borderType: 'solid',
                            color: PurposeStyle.colors.gray[300],
                            height: 6,
                            offsetX: 0,
                            offsetY: 0
                        },
                        title: {
                            text: '{{__('Platform')}}'
                        },
                        categories: {!! json_encode($platformarray['label']) !!},
                    },
                    yaxis: {
                        labels: {
                            style: {
                                color: PurposeStyle.colors.gray[600],
                                fontSize: '12px',
                                fontFamily: PurposeStyle.fonts.base,
                            },
                        },
                        axisBorder: {
                            show: false
                        },
                        axisTicks: {
                            show: true,
                            borderType: 'solid',
                            color: PurposeStyle.colors.gray[300],
                            height: 6,
                            offsetX: 0,
                            offsetY: 0
                        }
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1

                    },
                    markers: {
                        size: 4,
                        opacity: 0.7,
                        strokeColor: "#fff",
                        strokeWidth: 3,
                        hover: {
                            size: 7,
                        }
                    },
                    grid: {
                        borderColor: PurposeStyle.colors.gray[300],
                        strokeDashArray: 5,
                    },
                    dataLabels: {
                        enabled: false
                    }
                }
                // Get data from data attributes
                var dataset = $this.data().dataset,
                    labels = $this.data().labels,
                    color = $this.data().color,
                    height = $this.data().height,
                    type = $this.data().type;

                // Inject synamic properties
                // options.colors = [
                //     PurposeStyle.colors.theme[color]
                // ];
                // options.markers.colors = [
                //     PurposeStyle.colors.theme[color]
                // ];
                options.chart.height = height ? height : 350;
                // Init chart
                var chart = new ApexCharts($this[0], options);
                // Draw chart
                setTimeout(function () {
                    chart.render();
                }, 300);
            }

            // Events
            if ($chart.length) {
                $chart.each(function () {
                    init($(this));
                });
            }
        })();
    </script>
@endpush

