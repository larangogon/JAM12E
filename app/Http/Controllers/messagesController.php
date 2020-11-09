<?php

namespace App\Http\Controllers;

use App\Entities\Message;
use App\Entities\Report;
use App\Entities\User;
use App\Http\Requests\RequestMessage;
use Illuminate\Http\Request;

class messagesController extends Controller
{
    /**
     * messagesController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verified');
        $this->middleware('Status');
    }

    public function index(Request $request)
    {
        if ($request) {
            $query = trim($request->get('search'));
        }

        $messages = Message::where('sender_id', 'LIKE', '%' . $query . '%')
            ->orderBy('id', 'asc')
            ->paginate(6);

        $users = User::where('id', '!=', auth()->id())->get();

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'Administrator');
        })->get();

        return view('messages.index', [
            'messages' => $messages,
            'users'    => $users,
            'admins'   => $admins,
            'search'   => $query
        ]);
    }

    public function Store(RequestMessage $request)
    {
        $message = Message::create($request->all());

        return redirect()->back()
            ->with('success', 'Mensaje enviado');
    }
}
