import React from "react";
import { Link, usePage } from "@inertiajs/react";
import LanguageSwitcher from "./LanguageSwitcher";
import { useTranslation } from "react-i18next";
export default function Header() {
    const { auth, categories = [] } = usePage().props;
 const { t } = useTranslation();

    return (
        <header className="bg-white border-b sticky top-0 z-50 shadow-sm">

           

            {/* MAIN NAV */}
            <div className="max-w-7xl mx-auto px-4 py-3 flex items-center justify-between">

                {/* LOGO (matches Blade image logo) */}
                <Link href={route("home")} className="flex items-center">
                    <img
                        src="/images/logo.png"
                        alt="Umwambi Logo"
                        className="h-12 w-auto"
                    />
                </Link>

                {/* DESKTOP NAV (matches Blade categories layout) */}
                <nav className="hidden md:flex space-x-4 text-sm">

                    <Link href={route("home")} className="hover:text-red-500">
                       {t('home')}
                    </Link>

                    <Link href={route("categories.show", "politics")} className="hover:text-red-500">
                        {t('politics')}
                    </Link>
                     <Link href={route("categories.show", "education")} className="hover:text-red-500">
                        {t('education')}
                    </Link>

                    <Link href={route("categories.show", "sports")} className="hover:text-red-500">
                        {t('sport')}
                    </Link>

                    <Link href={route("categories.show", "world")} className="hover:text-red-500">
                        {t('world_news')}
                    </Link>

                    <Link href={route("categories.show", "technology")} className="hover:text-red-500">
                        {t('technology')}
                    </Link>

                    <Link href={route("categories.show", "business")} className="hover:text-red-500">
                        {t('economy')}
                    </Link>

                    <Link href={route("categories.show", "health")} className="hover:text-red-500">
                        {t('health')}
                    </Link>

                    <Link href={route("categories.show", "entertainment")} className="hover:text-red-500">
                        {t('entertainment')}
                    </Link>

                <LanguageSwitcher />
        
                </nav>

                {/* SEARCH */}
                <form
                    action={route("search")}
                    method="GET"
                    className="hidden md:block"
                >
                    <input
                        type="text"
                        name="q"
                        placeholder="Search news..."
                        className="border rounded px-3 py-1 text-sm focus:outline-none focus:ring-1 focus:ring-red-500"
                    />
                </form>

            </div>

        </header>
    );
}