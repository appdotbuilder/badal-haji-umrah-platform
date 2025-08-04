<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceProviderRequest;
use App\Http\Requests\UpdateServiceProviderRequest;
use App\Models\Provider;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ServiceProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Provider::with('user')->verified();

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        $providers = $query->orderBy('rating', 'desc')
                          ->paginate(12);

        return Inertia::render('service-providers/index', [
            'providers' => $providers,
            'filters' => $request->only(['search']),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('service-providers/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceProviderRequest $request)
    {
        $provider = Provider::create([
            'user_id' => auth()->id(),
            ...$request->validated(),
        ]);

        // Update user role to service_provider
        auth()->user()->update(['role' => 'service_provider']);

        return redirect()->route('service-providers.show', $provider)
            ->with('success', 'Profil penyedia layanan berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Provider $serviceProvider)
    {
        $serviceProvider->load(['user', 'reviews.client']);

        return Inertia::render('service-providers/show', [
            'provider' => $serviceProvider,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Provider $serviceProvider)
    {
        // Authorization check would go here

        return Inertia::render('service-providers/edit', [
            'provider' => $serviceProvider,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceProviderRequest $request, Provider $serviceProvider)
    {
        // Authorization check would go here

        $serviceProvider->update($request->validated());

        return redirect()->route('service-providers.show', $serviceProvider)
            ->with('success', 'Profil penyedia layanan berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Provider $serviceProvider)
    {
        // Authorization check would go here

        $serviceProvider->delete();

        return redirect()->route('dashboard')
            ->with('success', 'Profil penyedia layanan berhasil dihapus.');
    }
}