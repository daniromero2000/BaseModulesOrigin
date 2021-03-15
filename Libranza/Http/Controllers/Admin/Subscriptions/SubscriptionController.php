<?php

namespace Modules\Libranza\Http\Controllers\Admin\Subscriptions;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\Libranza\Entities\Subscriptions\Services\Interfaces\SubscriptionServiceInterface;

class SubscriptionController extends Controller
{

    protected $subscriptionInterface;

    public function __construct(SubscriptionServiceInterface $subscriptionServiceInterface)
    {
        $this->subscriptionInterface = $subscriptionServiceInterface;
    }

    public function index(Request $request)
    {
        $response = $this->subscriptionInterface->listSubscriptions(['search' => request()->input()]);

        if ($response['search']) {
            $request->session()->flash('message', 'Resultado de la Busqueda');
        }

        return view('libranza::admin.subscriptions.index', $response['data']);
    }

    public function create()
    {
        return view('libranza::admin.subscription.create');
    }

    public function store(Request $request)
    {
        $this->subscriptionInterface->saveSubscription(['data' => $request->except('_token', '_method', 'src')]);

        return redirect()->route('admin.subscription.index')
            ->with('message', config('messaging.create'));
    }

    public function show($id)
    {
        return view('libranza::admin.subscription.show', [
            'category' => $this->subscriptionInterface->showSubscription($id)
        ]);
    }

    public function edit($id)
    {
        return view('libranza::admin.subscription.edit', [
            'category' => $this->subscriptionInterface->showSubscription($id)
        ]);
    }


    public function update(Request $request, $id)
    {
        $data = [
            'data'  => $request->input(),
            'id'    => $id
        ];

        $this->subscriptionInterface->updateSubscription($data);

        return redirect()->route('admin.subscription.edit', $id)
            ->with('message', 'Actualizado correctamente');
    }


    public function updateSortOrder(Request $request, int $id)
    {
        $res = $this->subscriptionInterface->updateSortOrder($request->json());
        return $res;
    }
}
