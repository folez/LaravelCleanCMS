<?php

namespace App\Http\Livewire\Admin\Components;

use Livewire\Component;

class LoginForm extends Component
{
    public $username;
    public $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required|min:8',
    ];

    protected $messages = [
        'username.required' => 'Login required',
        'password.required' => 'Password required',
        'password.min' => 'Min length of password is 8 characters',
    ];

    /**
     * Get the view / contents that represent the component.
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view( 'livewire.admin.components.login-form' );
    }

    public function submit()
    {
        $this->validate();

        $success = \Auth::attempt([
            'name' => $this->username,
            'password' => $this->password
        ]);

        if($success)
            return redirect()->route('admin.home');

        $this->addError('loginError', 'Неверный логин или пароль');
    }
}
