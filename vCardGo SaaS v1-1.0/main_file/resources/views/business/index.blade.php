@extends('layouts.admin')
@section('page-title')
   {{__('Business')}}
@endsection
@section('content')
<div class="page-title">
  <div class="row justify-content-between align-items-center">
          <div class="col-xl-4 col-lg-4 col-md-4 d-flex align-items-center justify-content-between justify-content-md-start mb-3 mb-md-0">
            <div class="d-inline-block">
              <h5 class="h4 d-inline-block font-weight-400 mb-0 ">{{__('Business')}}</h5>
            </div>
          </div>
    <div class="col-xl-8 col-lg-8 col-md-8 d-flex align-items-center justify-content-between justify-content-md-end">
      <div class="all-button-box row d-flex justify-content-end">
        <div class="col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6">
          <a href="#" class="btn btn-xs btn-white btn-icon-only width-auto" data-ajax-popup="true" data-title="{{__('Create Business')}}" data-url="{{ route('business.create') }}"><i class="fas fa-plus"></i> Add New </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-12">
      <div class="card" style="border-radius:20px">
        <div>
          <table class="dataTable table w-100" style="border:0;">
            <thead>
                <tr>
                  <th></th>
                  <th>{{__('No')}}</th>
                  <th>{{__('Businesses')}}</th>
                  <th>{{__('Operations')}}</th>
                </tr>
              </thead>
              <tbody>
              @foreach($business as $val)
               <tr>
                 <td></td>
                  <td>{{ $loop->index+1 }}</td>
                  <td class="align-middle">
                    <a href="{{ route('business.edit',$val->id) }}"><b>{{ $val->title }}</b></a>
                  </td>
                  <td class="w-15 align-middle">
                      @if($val->status !='lock')
                      <a href="#" class="edit-icon align-middle bg-success cp_link" data-link="{{url('/'.$val->slug)}}" data-toggle="tooltip" data-original-title="{{__('Click to copy card link')}}"><i class="fas fa-file text-white"></i></a>
                      <a href="{{ route('business.analytics',$val->id) }}" class="edit-icon align-middle bg-info"><i class="fas fa-chart-area  text-white"></i></a>
                      <a href="{{ route('appointment.calendar',$val->id) }}" class="edit_btn align-middle edit-icon bg-warning"><i class="fas fa-calendar text-white"></i></a>
                      <a href="{{ route('business.edit',$val->id) }}" class="analytics align-middle edit-icon"><i class="fas fa-eye text-white"></i></a>
                      <a class="delteuser delete-icon trigger--fire-modal-1" data-confirm="Are You Sure?|This action can not be undone. Do you want to continue?" data-confirm-yes="document.getElementById('delete-form-{{$val->id}}').submit();">
                          <i class="fas fa-trash text-white" ></i>
                     </a>
                    {!! Form::open(['method' => 'DELETE', 'route' => ['business.destroy',$val->id], 'id' => 'delete-form-'.$val->id]) !!}{!! Form::close() !!}
                    @else
                      <span class="edit-icon align-middle bg-gray" ><i class="fas fa-lock text-white"></i></span>
                    @endif
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
