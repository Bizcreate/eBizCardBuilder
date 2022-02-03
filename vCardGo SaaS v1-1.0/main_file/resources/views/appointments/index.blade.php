@extends('layouts.admin')
@section('content')
@section('page-title')
   {{__('Appointments')}}
@endsection
<div class="page-title">
  <div class="row justify-content-between align-items-center">
          <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
            <div class="d-inline-block">
              <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Appointments')}}</h5>
            </div>
          </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
      <div class="card" style="border-radius:20px">
        <div>
          <table class="dataTable table h-125 w-100" style="border:0;">
            <thead>
                <tr>
                  <th>{{__('no')}}</th>
                  <th>{{__('Business Name')}}</th>
                  <th>{{__('Name')}}</th>
                  <th>{{__('Email')}}</th>
                  <th>{{__('Date')}}</th>
                  <th>{{__('Time')}}</th>
                  <th>{{__('Action')}}</th>
                </tr>
              </thead>
              <tbody>
              @foreach($appointment_deatails as $val)
               <tr> 
                  <td>{{ $val->no }}</td>
                  <td>{{ $val->business_name }}</td>
                  <td>{{ $val->name }}</td>
                  <td>{{ $val->email }}</td>
                  <td>{{ $val->date }}</td>
                  <td>{{ $val->time }}</td>
                  <td>
                    <a href="#" class="delete-icon " data-toggle="tooltip" data-original-title="{{__('Delete')}}" data-confirm="{{__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')}}" data-confirm-yes="document.getElementById('delete-form-{{ $val->id }}').submit();">
                    <i class="fas fa-trash"></i>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['appointments.destroy', $val->id],'id'=>'delete-form-'. $val->id]) !!}
                                                    {!! Form::close() !!}
                  </td>
                  
                </tr> 
              @endforeach  
            </tbody>
          </table>
        </div>
      </div>
   </div>
</div>

@endsection
@push('custom-scripts')
<script type="text/javascript">
   

   $('.cp_link').on('click', function () {
            var value = $(this).attr('data-link');
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val(value).select();
            document.execCommand("copy");
            $temp.remove();
            show_toastr('Success', '{{__('Link Copy on Clipboard')}}', 'success')
        });
</script>
@endpush