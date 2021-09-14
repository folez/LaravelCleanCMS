<form class="admin-login-form m-2 p-4 bg-white" wire:submit.prevent="submit">
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-center">
                        <a href="https://digitallab.com.ua/" target="_blank">
                            <img src="{{asset('admin-resources/img/digital-logo.svg')}}" class="img-fluid">
                        </a>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <x-components.forms.floating-label-input
                    class="col-lg-12"
                    type="text"
                    name="username"
                    inputAttributes='wire:model=username'
                    placeholder="Введите логин">
                    Login
                </x-components.forms.floating-label-input>
                @error('username') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="row mt-4">
                <x-components.forms.floating-label-input
                    class="col-lg-12"
                    type="password"
                    name="password"
                    inputAttributes='wire:model=password'
                    placeholder="Введите пароль">
                    Password
                </x-components.forms.floating-label-input>
                @error('password') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="row">
                <div class="col-12">
                    @error('loginError') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="row my-4 d-flex justify-content-center">
                <button type="submit" class="default-red-button w-fit-content">
                    Войти
                </button>
            </div>
        </div>
    </div>
</form>
