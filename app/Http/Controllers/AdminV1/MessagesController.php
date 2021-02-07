<?php

namespace App\Http\Controllers\AdminV1;

use App\Entities\Message;
use App\Entities\User;
use App\Http\Requests\RequestMessage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

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

        $messagesUserSee = Message::where('sender_id', '=', auth()->user()->id)
            ->get();

        return view('messages.index', [
            'messages' => $messages,
            'search'   => $query,
            'messagesUserSee' => $messagesUserSee
        ]);
    }

    public function create(): View
    {
        $users = User::where('id', '!=', auth()->id())->get();

        $admins = User::whereHas('roles', function ($query) {
            $query->where('name', 'Administrator');
        })->get();

        return view('messages.create', [
            'users'    => $users,
            'admins'   => $admins,
        ]);
    }

    /**
     * @param RequestMessage $request
     * @return RedirectResponse
     */
    public function store(RequestMessage $request): RedirectResponse
    {
        $message = Message::create($request->all());

        return redirect('messages')
            ->with('success', 'Mensaje enviado');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(int $id): RedirectResponse
    {
        $this->authorize('destroy.message');

        Message::destroy($id);

        return Redirect()->back()
            ->with('success', 'Eliminado Satisfactoriamente !');
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $msg = Message::where('id', '=', $id)->firstOrFail();

        return view('messages.show', compact('msg'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function response(int $id): View
    {
        $msg = Message::where('id', '=', $id)->firstOrFail();

        return view('messages.response', compact('msg'));
    }
}
