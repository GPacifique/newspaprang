import React, { useState } from 'react';
import { Link, usePage } from '@inertiajs/react';
import ApplicationLogo from '@/Components/ApplicationLogo';

// Maps a role to its dedicated dashboard route + a tone for the sidebar accent stripe.
const ROLE_DASHBOARDS = {
    'super-admin': { route: 'super-admin.dashboard', label: 'Super Admin', tone: '#C1401F' },
    admin: { route: 'admin.dashboard', label: 'Admin', tone: '#25406B' },
    editor: { route: 'editor.dashboard', label: 'Editor', tone: '#B8862E' },
    author: { route: 'author.dashboard', label: 'Author', tone: '#25406B' },
    moderator: { route: 'moderator.dashboard', label: 'Moderator', tone: '#C1401F' },
    subscriber: { route: 'subscriber.dashboard', label: 'Subscriber', tone: '#3A4048' },
    premium: { route: 'premium.dashboard', label: 'Premium', tone: '#B8862E' },
};

// Roles that can reach the article management area under /manage.
const CAN_MANAGE_ARTICLES = ['super-admin', 'admin', 'editor', 'author'];

export default function AuthenticatedLayout({ header, children }) {
    const { auth, url } = usePage().props;
    const user = auth?.user ?? { name: 'User', role: 'subscriber' };
    const roleInfo = ROLE_DASHBOARDS[user.role] ?? { route: 'dashboard', label: 'Overview', tone: '#25406B' };
    const [mobileOpen, setMobileOpen] = useState(false);

    const navItem = (href, label, active) => (
        <Link
            href={href}
            className={`block font-mono text-xs uppercase tracking-wider px-4 py-2.5 border-l-2 transition-colors
                ${active
                    ? 'border-white text-white bg-white/10'
                    : 'border-transparent text-white/60 hover:text-white hover:bg-white/5'}`}
        >
            {label}
        </Link>
    );

    return (
        <div className="min-h-screen bg-[#EEF1F3] font-body text-[#14171F] flex">
            {/* Sidebar */}
            <aside className="hidden md:flex md:flex-col w-64 shrink-0 bg-[#14171F] text-white min-h-screen">
                <div className="h-16 flex items-center px-5 border-b border-white/10">
                    <Link href={route('home')} className="font-display font-bold text-xl">
    <ApplicationLogo/>
</Link>
                </div>

                <div className="px-5 py-4 border-b border-white/10">
                    <p className="font-mono text-[10px] uppercase tracking-wider text-white/40">Signed in as</p>
                    <p className="font-body text-sm mt-1">{user.name}</p>
                    <span
                        className="inline-block mt-2 font-mono text-[10px] uppercase tracking-wider px-2 py-0.5"
                        style={{ backgroundColor: roleInfo.tone }}
                    >
                        {roleInfo.label}
                    </span>
                </div>

                <nav className="flex-1 py-4">
                    <p className="px-4 font-mono text-[10px] uppercase tracking-wider text-white/30 mb-2">Dashboard</p>
                    {navItem(route('dashboard'), 'Overview', route().current('dashboard'))}
                    {roleInfo.route !== 'dashboard' &&
                        navItem(route(roleInfo.route), `${roleInfo.label} panel`, route().current(roleInfo.route))}

                    {CAN_MANAGE_ARTICLES.includes(user.role) && (
                        <>
                            <p className="px-4 font-mono text-[10px] uppercase tracking-wider text-white/30 mt-6 mb-2">Content</p>
                            {navItem(route('articles.create'), 'Write article', route().current('articles.create'))}
                            {navItem(route('articles.index'), 'All articles', route().current('articles.index'))}
                        </>
                    )}

                    <p className="px-4 font-mono text-[10px] uppercase tracking-wider text-white/30 mt-6 mb-2">Site</p>
                    {navItem(route('home'), 'View site', false)}
                    {navItem(route('search'), 'Search', route().current('search'))}
                </nav>

                <div className="p-4 border-t border-white/10">
                    <Link
                        href={route('logout')}
                        method="post"
                        as="button"
                        className="w-full font-mono text-xs uppercase tracking-wider px-4 py-2.5 border border-white/20 text-white/70 hover:text-white hover:border-white/40 text-left"
                    >
                        Sign out
                    </Link>
                </div>
            </aside>

            {/* Mobile top bar */}
            <div className="md:hidden fixed top-0 left-0 right-0 z-40 bg-[#14171F] text-white h-14 flex items-center justify-between px-4">
                <Link href={route('home')} className="font-display font-bold text-lg">The Bulletin</Link>
                <button onClick={() => setMobileOpen(!mobileOpen)} className="font-mono text-xs uppercase tracking-wider">
                    {mobileOpen ? 'Close' : 'Menu'}
                </button>
            </div>
            {mobileOpen && (
                <div className="md:hidden fixed top-14 left-0 right-0 z-30 bg-[#14171F] text-white pb-4">
                    {navItem(route('dashboard'), 'Overview', route().current('dashboard'))}
                    {roleInfo.route !== 'dashboard' && navItem(route(roleInfo.route), `${roleInfo.label} panel`, route().current(roleInfo.route))}
                    {CAN_MANAGE_ARTICLES.includes(user.role) && navItem(route('articles.create'), 'Write article', false)}
                    {navItem(route('logout'), 'Sign out', false)}
                </div>
            )}

            {/* Main content */}
            <div className="flex-1 min-w-0 md:pt-0 pt-14">
                {header && (
                    <div className="bg-white border-b border-[#D7DBDE] px-4 md:px-8 py-6">
                        {header}
                    </div>
                )}
                <div className="p-4 md:p-8">{children}</div>
            </div>
        </div>
    );
}
