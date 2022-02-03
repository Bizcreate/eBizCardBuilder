<div class="card bg-none card-box">
    {{ Form::open(array('url' => route('business.store')))}}
    <div class="row">
        <div class="col-12">
            {{Form::label('Business',__('Business'),['class'=>'form-control-label'])}}
            {{Form::text('title',null,array('class'=>'form-control'))}}
            @error('title')
                <span class="invalid-favicon text-xs text-danger" role="alert">{{ $message }}</span>
            @enderror


        </div>  
        
    </div>
    <div class="form-group col-12 text-right">
            <input type="submit" value="{{__('Create')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancle')}}" class="btn-create bg-gray" data-dismiss="modal">
    </div>
</div>