import React from 'react';
import { Link } from '@inertiajs/react';
import { useTranslation } from 'react-i18next';
import Header from '@/Components/Header';

export default function GuestLayout({ children }) {
    const { t } = useTranslation();

    return (
        <div className="min-h-screen bg-white text-gray-900">
            <Header />

            <main>{children}</main>

            <footer className="bg-white border-t mt-20">
                <div className="max-w-7xl mx-auto px-4 py-12 grid grid-cols-2 md:grid-cols-4 gap-8">
                    <div className="col-span-2">
                        <h2 className="font-bold text-xl">STL</h2>
                        <p className="text-sm text-gray-500 mt-2 max-w-sm">
                            {t('Learn Modern Software Development')}
                        </p>
                    </div>

                    <div>
                        <p className="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-3">
                            {t('Browse')}
                        </p>
                        <ul className="space-y-2 text-sm text-gray-700">
                            <li>
                                <Link href={route('home')} className="hover:text-red-600">{t('Home')}</Link>
                            </li>
                            <li>
                                <Link href={route('search')} className="hover:text-red-600">{t('Search')}</Link>
                            </li>
                        </ul>
                    </div>

                    <div>
                        <p className="text-xs font-semibold uppercase tracking-wide text-gray-400 mb-3">
                            {t('Account')}
                        </p>
                        <ul className="space-y-2 text-sm text-gray-700">
                            <li>
                                <Link href={route('login')} className="hover:text-red-600">{t('Login')}</Link>
                            </li>
                            <li>
                                <Link href={route('register')} className="hover:text-red-600">{t('Register')}</Link>
                            </li>
                        </ul>
                    </div>
                </div>

                <div className="border-t py-4 text-center text-xs text-gray-400">
                    © {new Date().getFullYear()} STL — {t('All rights reserved')}
                </div>
            </footer>
        </div>
    );
}
