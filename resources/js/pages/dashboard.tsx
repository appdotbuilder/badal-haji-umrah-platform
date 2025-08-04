import React from 'react';
import { Link } from '@inertiajs/react';
import AppLayout from '@/layouts/app-layout';
import { Button } from '@/components/ui/button';
import { type BreadcrumbItem } from '@/types';
import { Head } from '@inertiajs/react';

const breadcrumbs: BreadcrumbItem[] = [
    {
        title: 'Dashboard',
        href: '/dashboard',
    },
];

interface Props {
    auth: {
        user: {
            id: number;
            name: string;
            email: string;
            role: 'admin' | 'client' | 'service_provider';
        };
    };
    [key: string]: unknown;
}

export default function Dashboard({ auth }: Props) {
    const user = auth.user;

    return (
        <AppLayout breadcrumbs={breadcrumbs}>
            <Head title="Dashboard" />
            <div className="container mx-auto px-4 py-8">
                <div className="mb-8">
                    <h1 className="text-3xl font-bold text-gray-800 mb-2">
                        🏠 Dashboard
                    </h1>
                    <p className="text-gray-600">
                        Selamat datang, {user.name}!
                    </p>
                </div>

                {/* Quick Actions */}
                <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    {user.role === 'client' && (
                        <>
                            <div className="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200">
                                <div className="text-3xl mb-3">🔍</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Cari Penyedia Layanan
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Temukan penyedia layanan Badal Haji dan Umrah terpercaya
                                </p>
                                <Link href="/service-providers">
                                    <Button className="w-full">
                                        Mulai Pencarian
                                    </Button>
                                </Link>
                            </div>

                            <div className="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200">
                                <div className="text-3xl mb-3">📋</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Pesanan Saya
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Lihat dan kelola pesanan yang sudah dibuat
                                </p>
                                <Link href="/orders">
                                    <Button className="w-full bg-green-600 hover:bg-green-700">
                                        Lihat Pesanan
                                    </Button>
                                </Link>
                            </div>

                            <div className="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-200">
                                <div className="text-3xl mb-3">👤</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Jadi Penyedia Layanan
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Bergabung sebagai penyedia layanan Badal Haji/Umrah
                                </p>
                                <Link href="/service-providers/create">
                                    <Button className="w-full bg-purple-600 hover:bg-purple-700">
                                        Daftar Sekarang
                                    </Button>
                                </Link>
                            </div>
                        </>
                    )}

                    {user.role === 'service_provider' && (
                        <>
                            <div className="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-lg border border-orange-200">
                                <div className="text-3xl mb-3">📊</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Profil Layanan
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Kelola profil dan informasi layanan Anda
                                </p>
                                <Button className="w-full bg-orange-600 hover:bg-orange-700">
                                    Kelola Profil
                                </Button>
                            </div>

                            <div className="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200">
                                <div className="text-3xl mb-3">📋</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Pesanan Masuk
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Lihat dan kelola pesanan dari klien
                                </p>
                                <Link href="/orders">
                                    <Button className="w-full bg-blue-600 hover:bg-blue-700">
                                        Lihat Pesanan
                                    </Button>
                                </Link>
                            </div>

                            <div className="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg border border-green-200">
                                <div className="text-3xl mb-3">⭐</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Ulasan & Rating
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Lihat ulasan dan rating dari klien
                                </p>
                                <Button className="w-full bg-green-600 hover:bg-green-700">
                                    Lihat Ulasan
                                </Button>
                            </div>
                        </>
                    )}

                    {user.role === 'admin' && (
                        <>
                            <div className="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-lg border border-red-200">
                                <div className="text-3xl mb-3">👥</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Kelola Pengguna
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Kelola pengguna dan penyedia layanan
                                </p>
                                <Button className="w-full bg-red-600 hover:bg-red-700">
                                    Kelola Pengguna
                                </Button>
                            </div>

                            <div className="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg border border-blue-200">
                                <div className="text-3xl mb-3">📊</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Laporan
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Lihat laporan dan statistik platform
                                </p>
                                <Button className="w-full bg-blue-600 hover:bg-blue-700">
                                    Lihat Laporan
                                </Button>
                            </div>

                            <div className="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-lg border border-purple-200">
                                <div className="text-3xl mb-3">📝</div>
                                <h3 className="text-lg font-semibold text-gray-800 mb-2">
                                    Kelola Blog
                                </h3>
                                <p className="text-gray-600 mb-4">
                                    Kelola konten blog dan artikel
                                </p>
                                <Button className="w-full bg-purple-600 hover:bg-purple-700">
                                    Kelola Blog
                                </Button>
                            </div>
                        </>
                    )}
                </div>

                {/* Recent Activity */}
                <div className="bg-white rounded-lg shadow-md p-6">
                    <h2 className="text-xl font-semibold text-gray-800 mb-4">
                        📈 Aktivitas Terbaru
                    </h2>
                    <div className="space-y-4">
                        <div className="flex items-center p-4 bg-gray-50 rounded-lg">
                            <div className="text-2xl mr-4">🔔</div>
                            <div>
                                <p className="font-medium text-gray-800">
                                    Selamat datang di platform Badal Haji & Umrah!
                                </p>
                                <p className="text-sm text-gray-600">
                                    Mulai jelajahi fitur-fitur yang tersedia untuk Anda.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AppLayout>
    );
}