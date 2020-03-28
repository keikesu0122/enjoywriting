 
<div>
    {!! Form::open(['route' => 'enposts.search', 'method' => 'get']) !!}
        <div style="display:inline-flex;">
            <div class="form-group mr-4">
                {!! Form::label('user', 'ユーザ名') !!}
                {!! Form::select('user',$users, null, ['class' => 'form-control', 'placeholder'=>'', 'style'=>'width:150px;']) !!}
            </div>

            <div class="form-group mr-4">
                {!! Form::label('title', 'タイトル') !!}
                {!! Form::text('title','', ['class' => 'form-control','style'=>'width:150px;']) !!}
            </div>
    
            <div class="form-group mr-4">
                {!! Form::label('entext', '英文') !!}
                {!! Form::text('entext','', ['class' => 'form-control', 'style'=>'width:150px;']) !!}
            </div>
    
            <div class="form-group mr-4">
                {!! Form::label('tag', 'タグ') !!}
                {!! Form::text('tag', '', ['class' => 'form-control', 'style'=>'width:150px;']) !!}
            </div>
            
            {!!Form::checkbox('correction', 1, '', ['class' => 'mt-5'])!!}
            {!!Form::label('correction','添削可能',['class' => 'mt-5 mr-3 ml-1'])!!}
            
            <div style="form-group mr-4">
                {!! Form::label('sort', '表示順') !!}
                {!! Form::select('sort',\Constant::sort, null, ['class' => 'form-control']) !!}
            </div>
    
            {!! Form::submit('検索', ['class' => 'btn btn-primary btn-block ml-4', 'style'=>'width:90px; height:40px; margin-top:30px;']) !!}
        </div>
    {!! Form::close() !!}
</div>