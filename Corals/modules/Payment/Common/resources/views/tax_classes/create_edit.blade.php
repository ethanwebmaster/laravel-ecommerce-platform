@section('content')
    <div class="row">
        <div class="col-md-12">
            @component('components.box')
                {!! Form::model($tax_class, ['url' => url($resource_url.'/'.$tax_class->hashed_id),'method'=>$tax_class->exists?'PUT':'POST','files'=>false,'class'=>'ajax-form']) !!}

                <div class="row">
                    <div class="col-md-12">
                        {!! CoralsForm::text('name','Payment::attributes.tax_class.name',true,$tax_class->name,
                        ['help_text'=>'']) !!}
                        {!! CoralsForm::formButtons(trans('Corals::labels.save',['title' => $title_singular]), [], ['show_cancel' => false])  !!}
                    </div>

                </div>
                {!! Form::close() !!}
            @endcomponent
        </div>
    </div>
