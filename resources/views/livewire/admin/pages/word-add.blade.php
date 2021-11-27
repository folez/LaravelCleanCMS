<div>
    <section class="header">
        <div class="row w-100">
            <div class="col-12">
                <div class="route-back d-flex flex-wrap p-2 align-items-end">
                    <h5 class="ps-3 m-0">Добавление фразы</h5>
                </div>
            </div>
        </div>
    </section>
    <section class="content pb-3">
        <form action="" wire:submit.prevent="save" class="w-100 px-2">
            <div class="row g-0">
                <div class="row w-100">
                    <div class="col-12 col-lg-4">
                        <div class="input-group d-flex flex-column modal-input-field">
                            <label>Название</label>
                            <input type="text" class="styled-rounded-accented-input" wire:model.debounce.500ms="langInputs.word_name">
                            @error('langInputs.word_name') <span class="error">{{ $message }}</span>  @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="input-group d-flex flex-column modal-input-field">
                            <label>Ключ</label>
                            <input type="text" class="styled-rounded-accented-input" wire:model.debounce.500ms="langInputs.word_key">
                            @error('langInputs.word_key') <span class="error">{{ $message }}</span>  @enderror
                        </div>
                    </div>
                    <div class="col-12 col-lg-4">
                        <div class="input-group d-flex flex-column modal-input-field">
                            <label>По умолчанию( Для всех языков )</label>
                            <input type="text" class="styled-rounded-accented-input" wire:model.debounce.500ms="langInputs.word_default">
                            @error('langInputs.word_default') <span class="error">{{ $message }}</span>  @enderror
                        </div>
                    </div>
                    @foreach($languages as $language)
                        <div class="col-12 col-lg-6">
                            <div class="input-group d-flex flex-column modal-input-field">
                                <label>{{$language->name}} ({{strtoupper($language->code)}})</label>
                                <textarea
                                    rows="2"
                                    cols="1"
                                    type="text" wire:model.debounce.500ms="langInputs.{{$language->code}}.word_custom" class="styled-rounded-accented-input"
                                ></textarea>
                                @error('langInputs.'.$language->code.'.word_custom') <span class="error">{{ $message }}</span>  @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row w-100 mt-5">
                    <div class="col-12 d-flex justify-content-start">
                        <div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" wire:click="cancel">Отмена</button>
                            <button type="submit"  class="btn btn-primary">Сохранить</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
