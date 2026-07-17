import React from 'react';
import { Head } from '@inertiajs/react';
import GuestLayout from '@/Layouts/GuestLayout';
import ArticleCard from '@/Components/ArticleCard';
import CategoryPill from '@/Components/CategoryPill';
import WireStrip from '@/Components/WireStrip';
/**
 * props: { featured: Article, latest: Article[], categories: Category[] }
 */
export default function Home({ featured = null, latest = [], categories = [] }) {
    return (
        <GuestLayout>
            <Head title="Home" />

            {/* Hero */}
            <section className="max-w-7xl mx-auto px-4 md:px-6 pt-10 md:pt-16 pb-10 border-b border-[#D7DBDE]">
                <WireStrip code="LEAD-01" timestamp="ON THE WIRE" tone="wire" className="mb-4" />
                {featured ? (
                    <a href={route('articles.show', featured.slug)} className="group block">
                        <h1 className="font-display font-bold text-4xl md:text-6xl leading-[1.05] text-[#14171F] group-hover:text-[#25406B] transition-colors max-w-4xl">
                            {featured.title}
                        </h1>
                        {featured.excerpt && (
                            <p className="font-body text-lg text-[#3A4048] mt-4 max-w-2xl">{featured.excerpt}</p>
                        )}
                    </a>
                ) : (
                    <h1 className="font-display font-bold text-4xl md:text-6xl leading-[1.05] text-[#14171F] max-w-4xl">
                        Reporting, filed as it happens.
                    </h1>
                )}
            </section>

            {/* Category strip */}
            {categories.length > 0 && (
                <section className="max-w-7xl mx-auto px-4 md:px-6 py-5 flex flex-wrap gap-2 border-b border-[#D7DBDE]">
                    {categories.map((c) => <CategoryPill key={c.id} category={c} />)}
                </section>
            )}

            {/* Latest grid */}
            <section className="max-w-7xl mx-auto px-4 md:px-6 py-10">
                <p className="font-mono text-xs uppercase tracking-wider text-[#3A4048]/60 mb-4">Latest dispatches</p>
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                    {latest.map((article) => (
                        <ArticleCard key={article.id} article={article} />
                    ))}
                </div>
                {latest.length === 0 && (
                    <p className="font-mono text-xs uppercase tracking-wider text-[#3A4048]/50 py-10">
                        No dispatches filed yet.
                    </p>
                )}
            </section>
        </GuestLayout>
    );
}
