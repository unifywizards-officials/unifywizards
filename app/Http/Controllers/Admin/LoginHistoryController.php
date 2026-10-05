<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LoginHistory;
use Illuminate\Http\Request;

class LoginHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:view login history');
    }

    public function index(Request $request)
    {
        $query = LoginHistory::with('user')->latest();

        if ($request->filled('event')) {
            $query->where('event', $request->event);
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        $history = $query->paginate(25)->withQueryString();

        return view('admin.login-history.index', compact('history'));
    }
}
