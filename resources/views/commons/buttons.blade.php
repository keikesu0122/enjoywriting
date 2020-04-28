<div class="form-inline mt-2">
    @if(Auth::user()->id==$enpost->user->id)
        @if($enpost->status==\Constant::open)
            {!! link_to_route('enposts.edit', '編集', ['id'=>$enpost->id], ['class' => 'btn btn-primary mr-2']) !!}
        @endif
        <button class="btn btn-danger commons-buttons-modal-open">削除</button>
        <div class="commons-buttons-modal">
            <div class="modal-content">
                <p>本当に削除しますか？</p>
                <ul>
                    <li>
                       {!! Form::open(['route' => ['enposts.destroy', $enpost->id], 'method' => 'delete']) !!}
                          {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                       {!! Form::close() !!}
                    </li>
                    <li>
                        <button class="btn btn-default modal-return">戻る</button>
                    </li>
                </ul>
            </div>
        </div>
        <!--<div class="commons-buttons-delete">
            <button class="btn btn-danger" v-on:click="ModalOpen">削除</button>
            <div class="overlay" v-show="show" v-on:click="ModalClose">
                <div class="overlay-content"  v-on:click.stop="EventStop">
                    <p>本当に削除しますか？</p>
                    <ul>
                        <li>
                           {!! Form::open(['route' => ['enposts.destroy', $enpost->id], 'method' => 'delete']) !!}
                              {!! Form::submit('削除', ['class' => 'btn btn-danger']) !!}
                           {!! Form::close() !!}
                        </li>
                        <li>
                            <button class="btn btn-default" v-on:click="ModalClose" class="overlay-return">戻る</button>
                        </li>
                    </ul>
                </div>
            </div>
        </div>-->
    @else
        @if($enpost->status==\Constant::open)
            {!! link_to_route('corrections.correct', '添削', ['user_id'=>$enpost->user_id, 'enpost_id'=>$enpost->id], ['class' => 'btn btn-secondary mr-2']) !!}
        @endif
    @endif
</div>