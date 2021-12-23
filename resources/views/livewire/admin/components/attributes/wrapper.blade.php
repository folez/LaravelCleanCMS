<div class="w-100 d-flex flex-column my-2">
    <a data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample" class="collapse-btn py-1 px-3 d-flex w-100 justify-content-between align-items-center">
        Характеристики
        <i class="fas fa-chevron-down fs-4"></i>
    </a>

    <div class="w-100 mt-2">
        <div class="collapse show" id="collapseExample">
            <div class="w-100 py-3">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="input-group d-flex flex-column modal-input-field">
                            <label>Название характеристики: </label>
                            <input type="text" class="styled-rounded-accented-input" wire:model.defer="option.attribute_name">
                            @error('option.attribute_name') <span class="error">{{ $message }}&nbsp</span>  @enderror
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="input-group d-flex flex-column modal-input-field">
                            <label>Значение: </label>
                            <input type="text" class="styled-rounded-accented-input" wire:model.defer="option.attribute_value">
                            @error('option.attribute_value') <span class="error">{{ $message }} &nbsp</span>  @enderror
                        </div>
                    </div>
                    <div class="col-lg-12 mt-3">
                        <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                            <button wire:click.prevent="addOption" class="btn-accent w-100">Добавить</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="w-100 d-flex flex-column mt-4">
                @foreach($attributes as $attr)
                    <livewire:admin.components.attributes.content key="{{$attr->id}}" wire:key="{{$attr->id}}" temp-id="{{$temp_id}}" id="{{$attr->id}}" />
                @endforeach
            </div>
        </div>
    </div>
</div>
