<?php

namespace Modules\Libranza\Http\Controllers\Front\Subscriptions;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\Libranza\Entities\Subscriptions\Services\Interfaces\SubscriptionServiceInterface;

class SubscriptionController extends Controller
{
    protected $subscriptionInterface;

    public function __construct(SubscriptionServiceInterface $subscriptionServiceInterface)
    {
        $this->subscriptionInterface = $subscriptionServiceInterface;
    }

    public function index()
    {
        return view('libranza::index');
    }

    public function create()
    {
        return view('libranza::create');
    }

    public function store(Request $request)
    {
        $this->subscriptionInterface->saveSubscription(['data' => $request->except('_token', '_method', 'src')]);
        return redirect()->back()->with(['status' => 'success']);
    }
    
    public function edit($id)
    {
        return view('libranza::edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

