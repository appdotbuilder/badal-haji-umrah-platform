import React from 'react';
import { Link } from '@inertiajs/react';
import { Button } from '@/components/ui/button';

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

interface Stats {
    total_providers: number;
    total_orders: number;
    average_rating: number;
}

interface Props {
    featuredProviders: ServiceProvider[];
    stats: Stats;
    [key: string]: unknown;
}

export default function Welcome({ featuredProviders, stats }: Props) {
    return (
        <div className="min-h-screen bg-gradient-to-br from-amber-50 via-orange-50 to-red-50">
            {/* Hero Section */}
            <section className="relative overflow-hidden bg-gradient-to-r from-amber-600 via-orange-600 to-red-600 text-white">
                <div className="absolute inset-0 bg-black/20"></div>
                <div className="relative container mx-auto px-4 py-20 text-center">
                    <div className="max-w-4xl mx-auto">
                        <h1 className="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-yellow-200 to-white bg-clip-text text-transparent">
                            🕋 Badal Haji & Umrah
                        </h1>
                        <p className="text-xl md:text-2xl mb-8 text-amber-100 leading-relaxed">
                            Platform terpercaya untuk menghubungkan pencari layanan dengan penyedia Badal Haji dan Badal Umrah berpengalaman
                        </p>
                        <div className="flex flex-col sm:flex-row gap-4 justify-center">
                            <Link href="/register">
                                <Button size="lg" className="bg-white text-orange-600 hover:bg-amber-50 font-semibold px-8 py-4 text-lg">
                                    🚀 Mulai Sekarang
                                </Button>
                            </Link>
                            <Link href="/service-providers">
                                <Button size="lg" variant="outline" className="border-white text-white hover:bg-white hover:text-orange-600 font-semibold px-8 py-4 text-lg">
                                    👀 Lihat Penyedia Layanan
                                </Button>
                            </Link>
                        </div>
                    </div>
                </div>
                
                {/* Decorative Islamic Pattern */}
                <div className="absolute bottom-0 left-0 right-0 h-20 bg-gradient-to-t from-amber-50 to-transparent"></div>
            </section>

            {/* Stats Section */}
            <section className="py-16 bg-white">
                <div className="container mx-auto px-4">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8 text-center">
                        <div className="p-6 rounded-lg bg-gradient-to-br from-green-50 to-emerald-100 border border-green-200">
                            <div className="text-4xl font-bold text-green-600 mb-2">
                                {stats.total_providers}+
                            </div>
                            <div className="text-gray-700 font-medium">🏅 Penyedia Terverifikasi</div>
                        </div>
                        <div className="p-6 rounded-lg bg-gradient-to-br from-blue-50 to-sky-100 border border-blue-200">
                            <div className="text-4xl font-bold text-blue-600 mb-2">
                                {stats.total_orders}+
                            </div>
                            <div className="text-gray-700 font-medium">✅ Pesanan Selesai</div>
                        </div>
                        <div className="p-6 rounded-lg bg-gradient-to-br from-yellow-50 to-amber-100 border border-yellow-200">
                            <div className="text-4xl font-bold text-amber-600 mb-2">
                                {stats.average_rating.toFixed(1)}⭐
                            </div>
                            <div className="text-gray-700 font-medium">📊 Rating Rata-rata</div>
                        </div>
                    </div>
                </div>
            </section>

            {/* Features Section */}
            <section className="py-20 bg-gradient-to-r from-amber-50 to-orange-50">
                <div className="container mx-auto px-4">
                    <div className="text-center mb-16">
                        <h2 className="text-4xl font-bold text-gray-800 mb-4">
                            ✨ Fitur Unggulan Platform
                        </h2>
                        <p className="text-xl text-gray-600 max-w-3xl mx-auto">
                            Solusi lengkap untuk kebutuhan Badal Haji dan Badal Umrah Anda
                        </p>
                    </div>

                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-orange-100">
                            <div className="text-4xl mb-4">🔍</div>
                            <h3 className="text-xl font-bold text-gray-800 mb-3">Pencarian Mudah</h3>
                            <p className="text-gray-600">Temukan penyedia layanan Badal Haji dan Umrah terpercaya dengan mudah dan cepat.</p>
                        </div>
                        
                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-orange-100">
                            <div className="text-4xl mb-4">✅</div>
                            <h3 className="text-xl font-bold text-gray-800 mb-3">Penyedia Terverifikasi</h3>
                            <p className="text-gray-600">Semua penyedia layanan telah melalui proses verifikasi ketat untuk memastikan kualitas.</p>
                        </div>
                        
                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-orange-100">
                            <div className="text-4xl mb-4">💬</div>
                            <h3 className="text-xl font-bold text-gray-800 mb-3">Chat Langsung</h3>
                            <p className="text-gray-600">Komunikasi langsung dengan penyedia layanan untuk koordinasi yang lebih baik.</p>
                        </div>
                        
                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-orange-100">
                            <div className="text-4xl mb-4">📹</div>
                            <h3 className="text-xl font-bold text-gray-800 mb-3">Bukti Visual</h3>
                            <p className="text-gray-600">Pilihan beragam bukti penyelesaian: video, foto, atau live streaming.</p>
                        </div>
                        
                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-orange-100">
                            <div className="text-4xl mb-4">⭐</div>
                            <h3 className="text-xl font-bold text-gray-800 mb-3">Sistem Rating</h3>
                            <p className="text-gray-600">Berikan dan lihat ulasan untuk membantu komunitas memilih layanan terbaik.</p>
                        </div>
                        
                        <div className="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-orange-100">
                            <div className="text-4xl mb-4">🛡️</div>
                            <h3 className="text-xl font-bold text-gray-800 mb-3">Aman & Terpercaya</h3>
                            <p className="text-gray-600">Platform yang aman dengan sistem keamanan berlapis untuk melindungi pengguna.</p>
                        </div>
                    </div>
                </div>
            </section>

            {/* Featured Providers */}
            {featuredProviders.length > 0 && (
                <section className="py-20 bg-white">
                    <div className="container mx-auto px-4">
                        <div className="text-center mb-16">
                            <h2 className="text-4xl font-bold text-gray-800 mb-4">
                                🏆 Penyedia Layanan Terbaik
                            </h2>
                            <p className="text-xl text-gray-600">
                                Penyedia layanan dengan rating tertinggi dan pengalaman terpercaya
                            </p>
                        </div>

                        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                            {featuredProviders.map((provider) => (
                                <div key={provider.id} className="bg-gradient-to-br from-amber-50 to-orange-50 p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow border border-orange-200">
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
                                    <Link href={`/service-providers/${provider.id}`}>
                                        <Button className="w-full bg-gradient-to-r from-orange-500 to-red-500 hover:from-orange-600 hover:to-red-600 text-white">
                                            Lihat Profil
                                        </Button>
                                    </Link>
                                </div>
                            ))}
                        </div>

                        <div className="text-center mt-12">
                            <Link href="/service-providers">
                                <Button size="lg" variant="outline" className="border-orange-500 text-orange-600 hover:bg-orange-50">
                                    Lihat Semua Penyedia Layanan
                                </Button>
                            </Link>
                        </div>
                    </div>
                </section>
            )}

            {/* CTA Section */}
            <section className="py-20 bg-gradient-to-r from-orange-600 to-red-600 text-white">
                <div className="container mx-auto px-4 text-center">
                    <h2 className="text-4xl font-bold mb-6">
                        🚀 Siap Memulai Perjalanan Spiritual Anda?
                    </h2>
                    <p className="text-xl mb-8 text-orange-100 max-w-2xl mx-auto">
                        Bergabunglah dengan ribuan orang yang telah mempercayakan layanan Badal Haji dan Umrah mereka kepada platform kami.
                    </p>
                    <div className="flex flex-col sm:flex-row gap-4 justify-center">
                        <Link href="/register">
                            <Button size="lg" className="bg-white text-orange-600 hover:bg-amber-50 font-semibold px-8 py-4">
                                📝 Daftar Sebagai Pencari Layanan
                            </Button>
                        </Link>
                        <Link href="/register">
                            <Button size="lg" variant="outline" className="border-white text-white hover:bg-white hover:text-orange-600 font-semibold px-8 py-4">
                                👨‍💼 Daftar Sebagai Penyedia Layanan
                            </Button>
                        </Link>
                    </div>
                </div>
            </section>

            {/* Footer */}
            <footer className="bg-gray-900 text-white py-12">
                <div className="container mx-auto px-4">
                    <div className="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div>
                            <h3 className="text-2xl font-bold mb-4 text-amber-400">🕋 Badal Haji & Umrah</h3>
                            <p className="text-gray-300">
                                Platform terpercaya untuk menghubungkan pencari layanan dengan penyedia Badal Haji dan Badal Umrah.
                            </p>
                        </div>
                        <div>
                            <h4 className="text-lg font-semibold mb-4">Layanan</h4>
                            <ul className="space-y-2 text-gray-300">
                                <li>🕌 Badal Haji</li>
                                <li>🌙 Badal Umrah</li>
                                <li>📹 Dokumentasi Visual</li>
                                <li>💬 Konsultasi Online</li>
                            </ul>
                        </div>
                        <div>
                            <h4 className="text-lg font-semibold mb-4">Kontak</h4>
                            <ul className="space-y-2 text-gray-300">
                                <li>📧 info@badalhajiumerah.com</li>
                                <li>📱 +62 812-3456-7890</li>
                                <li>🌐 www.badalhajiumerah.com</li>
                            </ul>
                        </div>
                    </div>
                    <div className="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                        <p>&copy; 2024 Badal Haji & Umrah. Semua hak dilindungi.</p>
                    </div>
                </div>
            </footer>
        </div>
    );
}