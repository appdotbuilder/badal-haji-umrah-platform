import React from 'react';
import { Link } from '@inertiajs/react';
import { AppShell } from '@/components/app-shell';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { router } from '@inertiajs/react';

interface ServiceProvider {
    id: number;
    name: string;
    description: string;
    rating: number;
    total_orders: number;
    user: {
        name: string;
    };
}

interface Props {
    providers: {
        data: ServiceProvider[];
        links: Array<{
            url: string | null;
            label: string;
            active: boolean;
        }>;
        meta: {
            current_page: number;
            total: number;
        };
    };
    filters: {
        search?: string;
    };
    [key: string]: unknown;
}

export default function ServiceProvidersIndex({ providers, filters }: Props) {
    const handleSearch = (e: React.FormEvent<HTMLFormElement>) => {
        e.preventDefault();
        const formData = new FormData(e.currentTarget);
        const search = formData.get('search') as string;
        
        router.get('/service-providers', { search }, {
            preserveState: true,
            preserveScroll: true,
        });
    };

    return (
        <AppShell>
            <div className="container mx-auto px-4 py-8">
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-800 mb-4">
                        🏅 Penyedia Layanan Badal Haji & Umrah
                    </h1>
                    <p className="text-gray-600">
                        Temukan penyedia layanan terpercaya untuk kebutuhan Badal Haji dan Badal Umrah Anda
                    </p>
                </div>

                {/* Search Bar */}
                <div className="mb-8">
                    <form onSubmit={handleSearch} className="flex gap-4">
                        <Input
                            type="text"
                            name="search"
                            placeholder="Cari penyedia layanan..."
                            defaultValue={filters.search || ''}
                            className="flex-1"
                        />
                        <Button type="submit">
                            🔍 Cari
                        </Button>
                    </form>
                </div>

                {/* Providers Grid */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    {providers.data.map((provider) => (
                        <div key={provider.id} className="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow border">
                            <div className="flex items-center mb-4">
                                <div className="w-12 h-12 bg-gradient-to-r from-orange-400 to-red-400 rounded-full flex items-center justify-center text-white font-bold text-xl">
                                    {provider.user.name.charAt(0)}
                                </div>
                                <div className="ml-3">
                                    <h3 className="font-bold text-gray-800">{provider.name}</h3>
                                    <div className="flex items-center text-sm text-gray-600">
                                        <span className="text-yellow-500">⭐</span>
                                        <span className="ml-1">{provider.rating.toFixed(1)}</span>
                                        <span className="mx-2">•</span>
                                        <span>{provider.total_orders} pesanan</span>
                                    </div>
                                </div>
                            </div>
                            <p className="text-gray-700 mb-4 line-clamp-3">
                                {provider.description}
                            </p>
                            <div className="flex gap-2">
                                <Link href={`/service-providers/${provider.id}`} className="flex-1">
                                    <Button variant="outline" className="w-full">
                                        Lihat Profil
                                    </Button>
                                </Link>
                                <Link href={`/orders/create?provider_id=${provider.id}`}>
                                    <Button className="bg-orange-500 hover:bg-orange-600">
                                        📝 Pesan
                                    </Button>
                                </Link>
                            </div>
                        </div>
                    ))}
                </div>

                {providers.data.length === 0 && (
                    <div className="text-center py-12">
                        <div className="text-6xl mb-4">🔍</div>
                        <h3 className="text-xl font-semibold text-gray-700 mb-2">
                            Tidak ada penyedia layanan ditemukan
                        </h3>
                        <p className="text-gray-500">
                            Coba ubah kata kunci pencarian Anda
                        </p>
                    </div>
                )}

                {/* Pagination */}
                {providers.links && providers.links.length > 3 && (
                    <div className="mt-8 flex justify-center">
                        <div className="flex space-x-2">
                            {providers.links.map((link, index: number) => (
                                <Link
                                    key={index}
                                    href={link.url || '#'}
                                    className={`px-3 py-2 rounded ${
                                        link.active
                                            ? 'bg-orange-500 text-white'
                                            : 'bg-white text-gray-700 hover:bg-gray-50'
                                    } ${!link.url ? 'cursor-not-allowed opacity-50' : ''}`}
                                    dangerouslySetInnerHTML={{ __html: link.label }}
                                />
                            ))}
                        </div>
                    </div>
                )}
            </div>
        </AppShell>
    );
}