<div>
    <section class="header">
        <div class="row w-100">
            <div class="col-12">
                <div class="route-back d-flex flex-wrap p-2 justify-content-between align-items-center">
                    <h5 class="ps-3 m-0">Языки</h5>
                    <a href="#" data-bs-target="#createLanguage" data-bs-toggle="modal" class="btn btn-accent py-1 px-2">Добавить <i class="far fa-plus ms-2"></i></a>
                </div>
            </div>
        </div>
    </section>
    <section class="content">
        <div class="row w-100 justify-content-between align-items-end my-2 px-2">
            <div class="table-responsive px-2 w-100">
                <table class="table-collapse styled-table w-100 fs-7">
                    <thead>
                        <tr class="noselect">
                            <td class="text-md-center">#</td>
                            <td class="text-md-center">Имя</td>
                            <td class="text-md-center">Код</td>
                            <td class="text-md-center">По умолчанию</td>
                            <td class="text-md-center">&nbsp;</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($languages as $language)
                            <tr>
                                <td class="text-md-center text-end px-2" data-label="#">{{$language->id}}</td>
                                <td class="text-md-center text-end px-2" data-label="Имя">{{$language->name}}</td>
                                <td class="text-md-center text-end px-2" data-label="Код">{{$language->code}}</td>
                                <td class="text-md-center" data-label="По умолчанию">
                                    <span wire:click.prevent="changeDefault({{$language->id}})" style="cursor:pointer;" @class([ 'status', 'status-success' => $language->is_default, 'status-error' => !$language->is_default ])>
                                        <i @class([
                                           'fas',
                                            'fa-check' => $language->is_default, 'fa-times' => !$language->is_default
                                           ])></i>
                                    </span>
                                </td>
                                <td class="text-lg-center text-end px-2" width="150" data-label="">
                                    <div class="w-100 d-flex flex-md-row flex-column align-items-center justify-content-between justify-content-md-evenly">
                                        <a href="{{route('admin.languages.translate', [ 'id' => $language->id])}}" class="mx-lg-0 m-2 color-black text-decoration-none button-unstyled" title="Перевести" data-bs-toggle="tooltip">
                                            <i class="fal fa-globe fs-4"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <div class="modal fade" id="createLanguage" wire:ignore.self tabindex="-1" aria-labelledby="createLanguage" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="w-100 modal-booked">
                        <form wire:submit.prevent="saveLanguage" id="bookedModalForm" class="row">
                            <div class="col-12 text-center mb-2">
                                <h4 class="text-uppercase fw-bold">Добавление языка</h4>
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="input-group d-flex flex-column modal-input-field">
                                    <label>Название языка</label>
                                    <input type="text" class="styled-rounded-accented-input" wire:model="language.name">
                                </div>
                                @error('language.name') <span class="error">{{ $message }}</span>  @enderror
                            </div>

                            <div class="col-12 col-lg-6">
                                <div class="input-group d-flex flex-column modal-input-field">
                                    <label>Код языка</label>
                                    <input type="text" class="styled-rounded-accented-input" wire:model="language.code">
                                </div>
                                @error('language.code') <span class="error">{{ $message }}</span>  @enderror
                            </div>
                            <div class="col-12 mt-2">
                                <div class="w-100 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-accent">Добавить</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
