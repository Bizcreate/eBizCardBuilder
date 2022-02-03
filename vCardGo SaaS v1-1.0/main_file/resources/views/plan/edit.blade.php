<div class="card bg-none card-box">
    {{Form::model($plan, array('route' => array('plans.update', $plan->id), 'method' => 'PUT', 'enctype' => "multipart/form-data")) }}
    <div class="row">
        <div class="form-group col-md-6">
            {{Form::label('name',__('Name'),['class'=>'form-control-label'])}}
            {{Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter Plan Name'),'required'=>'required'))}}
        </div>
        @if($plan->price >0)
            <div class="form-group col-md-6">
                {{Form::label('price',__('Price'),['class'=>'form-control-label'])}}
                {{Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Plan Price'),'required'=>'required'))}}
            </div>
        @endif
        <div class="form-group col-md-6">
            {{ Form::label('duration', __('Duration'),['class'=>'form-control-label']) }}
            {!! Form::select('duration', $arrDuration, null,array('class' => 'form-control select2','required'=>'required')) !!}
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('business', __('Max Business'),['class'=>'form-control-label']) }}
            {{Form::number('business',null,array('class'=>'form-control','placeholder'=>__('Enter Max Business Create Limite')))}}
            <span class="small">{{__('Note: "-1" for Unlimited')}}</span>
        </div>
        <div class="horizontal">

            <div class="verticals twelve">
                <div class="form-group col-md-6">
                  {{ Form::label('Selecr Themes', __('Selecr Themes'),['class'=>'form-control-label']) }}
                </div>
                <ul class="uploaded-pics">
                    @foreach(\App\Models\Utility::themeOne() as $key => $v)
                        @php 
                            if(in_array($key,$plan->getThemes())){
                                $checked = 'checked';
                            }else{
                                $checked = '';
                            }
                        @endphp
                    <li>
                        <input type="checkbox" id="checkthis{{$loop->index}}" value="{{$key}}" name="themes[]" {{$checked}}/>
                        <label for="checkthis{{$loop->index}}"><img src="{{asset(Storage::url('uploads/card_theme/'.$key.'/color1.png'))}}" /></label>
                    </li>
                   @endforeach
                </ul>
            </div>
            
         
        </div>
        
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-control-label']) }}
            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']) !!}
        </div>
        <div class="form-group col-md-12">
            <input type="submit" value="{{__('Update')}}" class="btn-create badge-blue">
            <input type="button" value="{{__('Cancel')}}" class="btn-create bg-gray" data-dismiss="modal">
        </div>
    </div>
    {{ Form::close() }}
</div>
