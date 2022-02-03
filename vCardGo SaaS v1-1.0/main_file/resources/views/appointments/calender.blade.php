@extends('layouts.admin')
@section('page-title')
   {{__('Appointments')}}
@endsection
@section('content')
<link rel="stylesheet" href="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.css')}}">
<div class="page-title">
    <div class="row justify-content-between align-items-center">
            <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
              <div class="d-inline-block">
                <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Calendar')}}</h5>
              </div>
            </div>
    </div>
  </div>
  
<div class="card author-box card-primary">
    <div class="card-header">
        <div class="row justify-content-between align-items-center full-calender">
            <div class="col d-flex align-items-center">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="fullcalendar-btn-prev btn btn-sm btn-neutral">
                        <i class="fas fa-angle-left"></i>
                    </a>
                    <a href="#" class="fullcalendar-btn-next btn btn-sm btn-neutral">
                        <i class="fas fa-angle-right"></i>
                    </a>
                </div>
                <h5 class="fullcalendar-title h4 d-inline-block font-weight-400 mb-0"></h5>
            </div>
            <div class="col-lg-6 mt-3 mt-lg-0 text-lg-right">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="month">{{__('Month')}}</a>
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicWeek">{{__('Week')}}</a>
                    <a href="#" class="btn btn-sm btn-neutral" data-calendar-view="basicDay">{{__('Day')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div id='calendar-container'>
            <div id='calendar' data-toggle="task-calendar"></div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script src="{{ asset('assets/libs/moment/min/moment.min.js')}}"></script>
    <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.js')}}"></script>
<script type="text/javascript">
   
   $(document).ready(function () {
        var SITEURL = "{{ url('/') }}";
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var e, t, a = $('[data-toggle="task-calendar"]');
            a.length && (t = {
                header: {right: "", center: "", left: ""},
                buttonIcons: {prev: "calendar--prev", next: "calendar--next"},
                theme: !1,
                                selectable: !0,
                selectHelper: !0,
                editable: !0,
                events: <?php echo json_encode($arrayJson) ?>,
                eventStartEditable: !1,
                locale: 'en',
                dayClick: function (e) {
                    var t = moment(e).toISOString();
                },
                eventResize: function (event) {
                    
                },
                viewRender: function (t) {
                    e.fullCalendar("getDate").month(), $(".fullcalendar-title").html(t.title)
                },
                eventClick: function (e, t) {

                    var title = e.title;
                    var url = e.url;

                    if (typeof url != 'undefined') {
                        $("#commonModal .modal-title").html(title);
                        $("#commonModal .modal-dialog").addClass('modal-md');
                        $("#commonModal").modal('show');
                        $.get(url, {}, function (data) {
                            console.log()
                            $('#commonModal .modal-body ').html(data);
                           
                        });
                        return false;
                    }
                                    }
            }, (e = a).fullCalendar(t),
                $("body").on("click", "[data-calendar-view]", function (t) {
                    t.preventDefault(), $("[data-calendar-view]").removeClass("active"), $(this).addClass("active");
                    var a = $(this).attr("data-calendar-view");
                    e.fullCalendar("changeView", a)
                }), $("body").on("click", ".fullcalendar-btn-next", function (t) {
                t.preventDefault(), e.fullCalendar("next")
            }), $("body").on("click", ".fullcalendar-btn-prev", function (t) {
                t.preventDefault(), e.fullCalendar("prev")
            }));
                       
    });
</script>
@endpush