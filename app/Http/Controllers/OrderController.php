<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Provider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $query = Order::with(['client', 'serviceProvider.user']);

        if ($user->role === 'client') {
            $query->where('client_id', $user->id);
        } elseif ($user->role === 'service_provider') {
            $query->whereHas('serviceProvider', function ($q) use ($user) {
                $q->where('user_id', $user->id);
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->orderBy('created_at', 'desc')->paginate(10);

        return Inertia::render('orders/index', [
            'orders' => $orders,
            'filters' => $request->only(['status']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $serviceProvider = null;
        if ($request->filled('provider_id')) {
            $serviceProvider = Provider::with('user')->findOrFail($request->provider_id);
        }

        return Inertia::render('orders/create', [
            'serviceProvider' => $serviceProvider,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request)
    {
        $order = Order::create([
            'client_id' => auth()->id(),
            ...$request->validated(),
        ]);

        return redirect()->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat dan menunggu konfirmasi penyedia layanan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        // Authorization check would go here

        $order->load(['client', 'serviceProvider.user', 'messages.sender', 'review']);

        return Inertia::render('orders/show', [
            'order' => $order,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        // Authorization check would go here

        return Inertia::render('orders/edit', [
            'order' => $order,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        // Authorization check would go here

        $order->update($request->validated());

        return redirect()->route('orders.show', $order)
            ->with('success', 'Status pesanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        // Authorization check would go here

        $order->delete();

        return redirect()->route('orders.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }
}