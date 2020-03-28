
<div>
    {!! Form::open(['route' => 'enposts.index', 'method' => 'get']) !!}
        <div style="display:inline-flex;">
            {!! Form::select('sort',\Constant::sort, null, ['class' => 'form-control mb-3']) !!}
            {!! Form::submit('並べ替え', ['class' => 'btn btn-primary btn-block ml-2 mb-3', 'style'=>'width:90px']) !!}
        </div>
    {!! Form::close() !!}
</div>