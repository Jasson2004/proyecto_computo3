<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $query = User::query()->orderBy('role', 'asc')->orderBy('name');

        if ($request->filled('search')) {
            $search = $request->string('search')->trim();
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('carnet', 'like', "%{$search}%");
            });
        }

        $users = $query->paginate(15)->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function toggleRole(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->id === $user->id) {
            return back()->with('error', 'No puedes cambiar tu propio rol de administrador.');
        }

        $newRole = $user->isAdmin() ? 'user' : 'admin';
        $user->update(['role' => $newRole]);

        $message = $newRole === 'admin'
            ? "El usuario {$user->name} ahora tiene permisos de Administrador."
            : "Se han revocado los permisos de Administrador a {$user->name}.";

        return back()->with('success', $message);
    }
}