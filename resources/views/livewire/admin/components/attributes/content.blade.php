<div class='w-100 d-flex mb-2'>
    <div class="row w-100">
        <div class="col-lg-4">
            <div class="input-group d-flex flex-column modal-input-field">
                <input type="text" class="styled-rounded-accented-input" wire:model.defer="attribute.attribute_name">
                @error('attribute.attribute_name') <span class="error">{{ $message }}</span>  @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="input-group d-flex flex-column modal-input-field">
                <input type="text" class="styled-rounded-accented-input" wire:model.defer="attribute.attribute_value">
                @error('attribute.attribute_value') <span class="error">{{ $message }}</span>  @enderror
            </div>
        </div>
        <div class="col-lg-4">
            <div class="w-100 d-flex justify-content-evenly">
                <a href="#" wire:click.prevent="save" class="btn btn-success">Сохранить</a>
                <a href="#" wire:click.prevent="delete" class="btn btn-danger">Удалить</a>
            </div>
        </div>
    </div>
</div>
@once
    @push('scripts')
        <script>
            window.addEventListener('savedItem', function (){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Изменение сохранены!'
                })
            })

            window.addEventListener('deleteItem', function (){
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-end',
                    showConfirmButton: false,
                    timer: 1500,
                    timerProgressBar: true,
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Характеристика удалена!'
                })
            })
        </script>
    @endpush
@endonce
