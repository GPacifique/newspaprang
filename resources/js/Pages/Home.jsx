import React from "react";
import { Link, usePage, Head } from "@inertiajs/react";
import Header from "@/Components/Header";
import { useTranslation } from "react-i18next";

export default function Home() {
    const {
        latestArticles = [],
        trending = [],
        breakingNews = [],
        featured = null,
    } = usePage().props;

    const { t } = useTranslation();

    const articleImage = (image) => {
        return image
            ? `/articles/${image}`
            : "https://via.placeholder.com/1200x700?text=News";
    };

    return (
        <div className="bg-gray-50 min-h-screen text-gray-900 antialiased font-sans">
            <Head title="Global Newsroom - Stay Informed" />

            <Header />

            {/* BREAKING NEWS */}
            {breakingNews?.length > 0 && (
                <div className="bg-red-600 text-white border-y border-red-700/50 shadow-sm relative z-10 overflow-hidden h-11 flex items-center">
                    <div className="absolute left-0 top-0 bottom-0 bg-red-700 px-5 flex items-center font-black text-xs uppercase z-20 gap-1.5">
                        <span className="w-2 h-2 rounded-full bg-white animate-ping" />
                        {t("breaking")}
                    </div>

                    <div className="w-full pl-32 overflow-hidden">
                        <div className="inline-block whitespace-nowrap animate-[marquee_30s_linear_infinite] hover:[animation-play-state:paused] text-sm font-medium">
                            {breakingNews.map((news) => (
                                <Link
                                    key={news.id}
                                    href={`/articles/${news.slug || "#"}`}
                                    className="inline-flex items-center mx-6 hover:text-red-100 font-semibold"
                                >
                                    {news.title}
                                    <span className="ml-10 text-red-300">/</span>
                                </Link>
                            ))}
                        </div>
                    </div>
                </div>
            )}

            {/* HERO */}
            <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-8 grid lg:grid-cols-3 gap-8">

                {/* FEATURED */}
                <div className="lg:col-span-2">
                    {featured ? (
                        <Link
                            href={`/articles/${featured.slug}`}
                            className="group block relative bg-white rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm hover:shadow-xl transition-all duration-300"
                        >
                            <div className="relative aspect-[16/9] md:h-[420px] overflow-hidden bg-gray-900">
                                <img
                                    src={articleImage(featured.featured_image)}
                                    alt={featured.title}
                                    className="absolute inset-0 w-full h-full object-cover group-hover:scale-[1.02] transition-transform duration-500 opacity-90"
                                />
                                <div className="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent" />

                                <div className="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <span className="inline-block bg-red-600 text-white text-[11px] uppercase px-2.5 py-1 rounded mb-3">
                                        {featured.category?.name || t("featured")}
                                    </span>

                                    <h1 className="text-2xl sm:text-4xl font-black">
                                        {featured.title}
                                    </h1>

                                    <p className="text-gray-200 mt-3 text-sm line-clamp-2">
                                        {featured.excerpt}
                                    </p>
                                </div>
                            </div>
                        </Link>
                    ) : (
                        <div className="h-[420px] bg-white border border-dashed border-gray-300 rounded-2xl flex items-center justify-center text-gray-400">
                            {t("no_featured")}
                        </div>
                    )}
                </div>

                {/* TRENDING */}
                <aside className="bg-white border border-gray-200/80 rounded-2xl p-6 shadow-sm flex flex-col justify-between">

                    <div>
                        <div className="border-b pb-4 mb-4">
                            <h2 className="text-lg font-black uppercase">
                                {t("trending_feed")}
                            </h2>
                        </div>

                        <div className="divide-y">
                            {trending?.length > 0 ? (
                                trending.slice(0, 3).map((item, index) => (
                                    <div key={item.id} className="flex gap-4 py-4">
                                        <div className="text-2xl font-black text-gray-200 w-6">
                                            0{index + 1}
                                        </div>

                                        <div className="flex-1">
                                            <Link
                                                href={`/articles/${item.slug}`}
                                                className="text-sm font-extrabold hover:text-red-600 line-clamp-2"
                                            >
                                                {item.title}
                                            </Link>

                                            <div className="text-[11px] text-gray-400 mt-1">
                                                {item.category?.name || t("general")} • 👁 {item.views}
                                            </div>
                                        </div>
                                    </div>
                                ))
                            ) : (
                                <p className="text-sm text-gray-400 py-4">
                                    {t("no_trending")}
                                </p>
                            )}
                        </div>
                    </div>

                    <Link className="block text-center mt-6 py-2.5 bg-gray-50 hover:bg-red-50 text-xs font-bold uppercase rounded-xl">
                        {t("view_analytics")}
                    </Link>
                </aside>
            </section>

            {/* LATEST ARTICLES */}
            <section className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-14 pb-20">

                <div className="flex justify-between items-end border-b pb-4 mb-8">
                    <div>
                        <h2 className="text-2xl font-black">
                            {t("latest_dispatches")}
                        </h2>
                        <p className="text-xs text-gray-500 mt-1">
                            {t("real_time_coverage")}
                        </p>
                    </div>

                    <Link className="text-sm font-bold text-red-600 hover:underline">
                        {t("view_all_archives")}
                    </Link>
                </div>

                <div className="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">

                    {latestArticles?.length > 0 ? (
                        latestArticles.map((article) => (
                            <article
                                key={article.id}
                                className="group bg-white rounded-2xl overflow-hidden border border-gray-100 hover:shadow-lg transition-all duration-300"
                            >
                                {/* FULL CLICKABLE CARD */}
                                <Link href={`/articles/${article.slug}`} className="block">

                                    <div className="overflow-hidden">
                                        <img
                                            src={articleImage(article.featured_image)}
                                            className="w-full h-40 object-cover group-hover:scale-105 transition-transform duration-300"
                                        />
                                    </div>

                                    <div className="p-4">
                                        <h3 className="font-bold line-clamp-2 group-hover:text-red-600">
                                            {article.title}
                                        </h3>

                                        <p className="text-xs text-gray-500 mt-2 line-clamp-2">
                                            {article.excerpt}
                                        </p>

                                        {/* READ MORE BUTTON */}
                                        <div className="mt-4 flex justify-between items-center">
                                            <span className="text-[11px] text-gray-400">
                                                {article.author?.name || t("staff_writer")}
                                            </span>

                                            <span className="text-xs font-bold text-red-600 group-hover:underline">
                                                {t("read_more")} →
                                            </span>
                                        </div>
                                    </div>
                                </Link>
                            </article>
                        ))
                    ) : (
                        <div className="col-span-full text-center py-16">
                            <h2>{t("no_articles")}</h2>
                        </div>
                    )}
                </div>
            </section>

            {/* MARQUEE ANIMATION */}
            <style>{`
                @keyframes marquee {
                    0% { transform: translate3d(0, 0, 0); }
                    100% { transform: translate3d(-50%, 0, 0); }
                }
            `}</style>
        </div>
    );
}