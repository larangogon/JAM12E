<?php

namespace App\Http\Controllers;

use App\Entities\Message;
use App\Entities\User;
use App\Http\Requests\RequestMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class MessagesController extends Controller
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

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request): View
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

    /**
     * @param RequestMessage $request
     * @return RedirectResponse
     */
    public function store(RequestMessage $request): RedirectResponse
    {
        $message = Message::create($request->all());

        return redirect()->back()
            ->with('success', 'Mensaje enviado');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Message::destroy($id);

        return Redirect()->back()
            ->with('success', 'Eliminado Satisfactoriamente !');
    }
}
