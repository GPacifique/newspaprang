import React, { useState } from "react";
import { Link, usePage, Head } from "@inertiajs/react";
import Header from "@/Components/Header";

export default function Show() {
    const { category, articles, recent } = usePage().props;
    const [visible, setVisible] = useState(7);

    const list = articles?.data || [];
    const featured = list.length > 0 ? list[0] : null;
    const rest = list.slice(1, visible);

    const imageUrl = (img) =>
        img ? `/articles/${img}` : "https://via.placeholder.com/1200x700?text=News";

    return (
        <div className="bg-gray-50 min-h-screen text-gray-900 font-sans">
            <Head title={`${category?.name || "Category"} - News`} />

            <Header />

            {/* HERO */}
            <div className="bg-white border-b border-gray-200">
                <div className="max-w-4xl mx-auto px-2 py-6">
                    <h1 className="text-5xl font-green">
                        {category?.name || "News"}
                    </h1>
                    <p className="text-gray-600 mt-2">
                        Latest updates in {category?.name || "this category"}
                    </p>
                </div>
            </div>

            {/* MAIN + SIDEBAR */}
            <main className="max-w-7xl mx-auto px-6 py-10 grid lg:grid-cols-4 gap-8">

                {/* MAIN CONTENT */}
                <div className="lg:col-span-3">

                    {/* FEATURED */}
                    {featured && (
                        <Link
                            href={route("articles.show", featured.slug)}
                            className="block bg-white rounded-2xl overflow-hidden shadow hover:shadow-xl transition"
                        >
                            <div className="grid lg:grid-cols-2">
                                <div className="h-80 lg:h-full">
                                    <img
                                        src={imageUrl(featured.featured_image)}
                                        className="w-full h-full object-cover"
                                    />
                                </div>
                                <div className="p-8 flex flex-col justify-center">
                                    <span className="text-xs font-bold text-red-600 uppercase">
                                        Featured
                                    </span>
                                    <h2 className="text-3xl font-black mt-2">
                                        {featured.title}
                                    </h2>
                                    <p className="text-gray-600 mt-4 line-clamp-3">
                                        {featured.excerpt}
                                    </p>
                                    <div className="mt-6">
                                        <span className="inline-flex items-center gap-2 text-red-600 font-bold">
                                            Read More →
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </Link>
                    )}

                    {/* GRID */}
                    <div className="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 mt-10">
                        {rest.map((article) => (
                            <div
                                key={article.id}
                                className="bg-white rounded-xl overflow-hidden shadow hover:shadow-lg transition"
                            >
                                <Link
                                    href={route("articles.show", article.slug)}
                                    className="block"
                                >
                                    <img
                                        src={imageUrl(article.featured_image)}
                                        className="w-full h-48 object-cover"
                                    />
                                </Link>
                                <div className="p-4 flex flex-col">
                                    <Link
                                        href={route("articles.show", article.slug)}
                                        className="font-bold text-lg hover:text-red-600"
                                    >
                                        {article.title}
                                    </Link>
                                    <p className="text-sm text-gray-600 mt-2 line-clamp-2">
                                        {article.excerpt}
                                    </p>
                                    <Link
                                        href={route("articles.show", article.slug)}
                                        className="mt-4 text-sm font-semibold text-red-600"
                                    >
                                        Read more →
                                    </Link>
                                    <div className="text-xs text-gray-400 mt-3">
                                        {article.author?.name || "Reporter"}
                                    </div>
                                </div>
                            </div>
                        ))}
                    </div>

                    {/* LOAD MORE */}
                    {visible < list.length && (
                        <div className="text-center mt-10">
                            <button
                                onClick={() => setVisible(visible + 6)}
                                className="px-6 py-3 bg-black text-white rounded-lg hover:bg-red-600"
                            >
                                Load More
                            </button>
                        </div>
                    )}
                </div>

                {/* SIDEBAR */}
                <aside className="lg:col-span-1 space-y-8">
                    {/* Recent Articles */}
                    <div className="bg-white rounded-xl shadow p-4">
                        <h3 className="text-lg font-bold mb-4">Recent Articles</h3>
                        <ul className="space-y-3">
                            {recent?.map((item) => (
                                <li key={item.id}>
                                    <Link
                                        href={route("articles.show", item.slug)}
                                        className="text-sm text-gray-700 hover:text-red-600 line-clamp-2"
                                    >
                                        {item.title}
                                    </Link>
                                </li>
                            ))}
                        </ul>
                    </div>

                    {/* Ads */}
                    <div className="bg-white rounded-xl shadow p-4">
                        <h3 className="text-lg font-bold mb-4">Sponsored</h3>
                        <div className="space-y-4">
                            <a href="#" className="block">
                                <img
                                    src="https://via.placeholder.com/300x250?text=Ad+Banner"
                                    className="w-full rounded-lg"
                                />
                            </a>
                            <a href="#" className="block">
                                <img
                                    src="https://via.placeholder.com/300x250?text=Ad+Banner"
                                    className="w-full rounded-lg"
                                />
                            </a>
                        </div>
                    </div>
                </aside>
            </main>
        </div>
    );
}
