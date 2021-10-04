<div class="row">
    @foreach($attributeMapping as $attr => $vl)
        <div class="col-12">
            <div class="input-group d-flex flex-column modal-input-field">
                <label>Заголовок <span class="text-uppercase">ru</span></label>
                <input type="text" class="styled-rounded-accented-input" wire:model="attributeMapping.{{$attr}}">
                @error('attributeMapping.'.$attr) <span class="error">{{ $message }}</span>  @enderror
            </div>
        </div>
    @endforeach
</div>
