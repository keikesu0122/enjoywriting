 
<div>
    {!! Form::open(['route' => 'enposts.search', 'method' => 'get']) !!}
        <div style="display:inline-flex;">
            <div class="form-group mr-4">
                {!! Form::label('user', 'ユーザ名') !!}
                {!! Form::text('user','', ['class' => 'form-control', 'style'=>'width:150px;']) !!}
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
    
            {!! Form::submit('検索', ['class' => 'btn btn-primary btn-block mr-4', 'style'=>'width:80px; height:40px; margin-top:30px;']) !!}
        </div>
    {!! Form::close() !!}
</div>