<tr>
    <td class="text-md-center text-end px-2" data-label="Название">{{$word->word_name}}</td>
    <td class="text-md-center text-end px-2" data-label="Ключ">{{$word->word_key}}</td>
    <td class="text-md-center text-end px-2" data-label="По умолчанию">{{$word->word_default}}</td>
    <td class="text-md-center text-end px-2" data-label="Перевод">
        <div class="modal-input-field">
            <textarea
                rows="1"
                cols="1"
                type="text" wire:model.debounce.500ms="word.word_custom" class="styled-rounded-accented-input"
            >{!! $word->word_custom !!}</textarea>
        </div>
    </td>
</tr>
@once
    @push('scripts')
        <script>
            window.addEventListener('wordUpdated', () => {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'bottom-right',
                    showConfirmButton: false,
                    timer: 3000,
                    timerProgressBar: true,
                })

                Toast.fire({
                    icon: 'success',
                    title: 'Перевод успешно обновлен',
                })
            })
        </script>
    @endpush
@endonce
