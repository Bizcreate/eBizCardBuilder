<script src="{{ asset('assets/js/site.core.js') }}"></script>
  <!-- Page JS -->
  <script src="{{ asset('assets/libs/progressbar.js/dist/progressbar.min.js') }}"></script>
  <script src="{{ asset('assets/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
  <script src="{{ asset('assets/libs/moment/min/moment.min.js') }}"></script>
  <script src="{{ asset('assets/libs/fullcalendar/dist/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('assets/libs/select2/dist/js/select2.min.js')}}"></script>
  <!-- Purpose JS -->
  <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap-notify/bootstrap-notify.min.js')}}"></script>
  <script src="{{ asset('assets/js/site.js') }}"></script>
  <!-- Demo JS - remove it when starting your project -->
  <script src="{{ asset('assets/js/demo.js') }}"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <script type="text/javascript">
    var toster_pos = "right";
  </script>
  @if($message = Session::get('success'))
    <script>show_toastr('Success','{!! $message !!}','success')</script>
  @endif
  @if($message = Session::get('error'))
    
    <script>show_toastr('Error','{!! $message !!}','error')</script>
  @endif
  <script>
    var dataTabelLang = {
                        paginate: {
                        previous: "{{__('Previous')}}",
                        next: "{{__('Next')}}",
                        last: "{{__('Last')}}"
                    },
                    lengthMenu: "{{__('Display')}} _MENU_ {{__('records per page')}}",
                    zeroRecords: '{{__('No data available in table')}}',
                    info: "<span><p class='text-primary d-inline-block mb-0'>{{__('Showing page')}} </p>   _PAGE_ {{__('of')}} _PAGES_</span>",
                    infoEmpty: "<span><p class='text-primary d-inline-block mb-0'>{{__('No page available')}} </p></span>",
                    infoFiltered: "({{__('filtered from')}} _MAX_ {{__('total records')}})",
                    search: "{{__('Search:')}}"
                }

</script>
   @stack('custom-scripts')