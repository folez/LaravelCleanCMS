<div class="row">
    @foreach($attributeMapping as $attr => $vl)
        @continue($attr == 'language_id')

        <div @class([
             'col-12',
    'col-lg-6'  => $inputTypes[$attr] != 'ckeditor'
             ])>
            <div class="input-group d-flex flex-column modal-input-field" @if($inputTypes[$attr] == 'ckeditor') wire:ignore @endif>
                <label>{{$attr}} <span class="text-uppercase">{{$lang->code}}</span></label>
                @if($inputTypes[$attr] == 'input')
                    <input type="text" class="styled-rounded-accented-input" wire:model="attributeMapping.{{$attr}}">
                @elseif($inputTypes[$attr] == 'ckeditor')
                    <textarea
                        rows="10"
                        type="text" data-ckeditor data-ckeditor-id="{{$attr}}_{{$lang->code}}" class="styled-rounded-accented-input"
                    >
                            {!! $attributeMapping[$attr] !!}
                        </textarea>
                @elseif($inputTypes[$attr] == 'textarea')
                    <textarea
                        rows="3"
                        type="text" wire:model.defer="attributeMapping.{{$attr}}" class="styled-rounded-accented-input"
                    >
                            {!! $attributeMapping[$attr] !!}
                        </textarea>
                @endif
            </div>
            @error('attributeMapping.'.$attr) <span class="error">{{ $message }}</span>  @enderror
        </div>
    @endforeach
</div>
@push('adminFunctionsExtension')
    <script>
        {{--adminFunctions.bindCkEditor(@this,'message','content');--}}
        @foreach($attributeMapping as $attr => $vl)
            @continue( $attr == 'language_id' || $inputTypes[$attr] != 'ckeditor' )
            adminFunctions.ckeditorInstances()['{{$attr}}_{{$lang->code}}'].model.document.on( 'change:data', () => {
                @this.set('attributeMapping.{{$attr}}', adminFunctions.ckeditorInstances()['{{$attr}}_{{$lang->code}}'].getData());
            } );
        @endforeach
    </script>
@endpush


id
setting_name
setting_key
setting_type
setting_value
Setting::getByKey('TELEGRAM_BOT_TOKEN');
Setting::getByNameAndKey('google','tag')
Setting::getByKeyAndType('google','analytic')
Setting::getByKeyAndType('facebook','pixel')
