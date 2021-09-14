<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function loginView ()
    {
        return view('components.admin.login');
    }

    public function logout (Request $request): RedirectResponse
    {
        \Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->redirectToRoute('admin.login');
    }
}
