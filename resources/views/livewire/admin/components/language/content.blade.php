<div class="row">
    @foreach($modelInstance->mapFillable as $input => $data)
        <div class="input-group d-flex flex-column modal-input-field" @if($data['type'] == 'editor') wire:ignore @endif>
            <label>{{$mappedInputsTitle[$input] ?? $input}} <span class="text-uppercase">{{$language->code}}</span></label>
            @switch($mappedInputsType[$input])
                @case('textarea')
                <textarea
                    rows="10"
                    type="text" wire:model="modelInstance.{{$input}}" class="styled-rounded-accented-input"
                >
                        {!! $modelInstance->$input !!}
                    </textarea>
                @break
                @case('editor')
                <textarea
                    rows="10"
                    type="text" data-tiny data-tinymce-id="{{$input}}_{{$language->code}}" id="{{$input}}_{{$language->code}}" class="styled-rounded-accented-input"
                >
                        {!! $modelInstance->$input !!}
                    </textarea>
                @break
                @case('input')
                @default
                <input type="text" class="styled-rounded-accented-input" wire:model="modelInstance.{{$input}}">
                @break
            @endswitch
        </div>
    @endforeach
</div>
