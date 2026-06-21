import React from "react";
import { Link, usePage, Head } from "@inertiajs/react";
import Header from "@/Components/Header";

export default function Index() {
    const { articles, query } = usePage().props;

    // ✅ only results when query exists
    const results = query ? (articles?.data || []) : [];

    // ✅ safe image handler (prevents duplicates + broken paths)
    const articleImage = (image) => {
        if (!image) {
            return "https://via.placeholder.com/800x400?text=News";
        }

        // prevent duplicate /articles/articles/ issue
        return image.startsWith("http")
            ? image
            : `/articles/${image}`;
    };

    return (
        <div className="bg-gray-50 min-h-screen text-gray-900 antialiased font-sans">
            {query ? (
    <>
        <p className="text-xs font-bold text-red-600 uppercase tracking-widest mb-1">
            Search Query
        </p>

        <h1 className="text-3xl font-black tracking-tight text-gray-900">
            Showing results for{" "}
            <span className="text-red-600">"{query}"</span>
        </h1>

        <p className="text-xs text-gray-400 mt-2">
            Found {results.length} matching {results.length === 1 ? "article" : "articles"}
        </p>
    </>
) : (
    <>
        <p className="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">
            Search
        </p>

        <h1 className="text-3xl font-black tracking-tight text-gray-900">
            Search Articles
        </h1>

        <p className="text-xs text-gray-400 mt-2">
            Enter keywords to search news articles
        </p>
    </>
)}

            <Header />

            {/* HEADER */}
            <div className="bg-white border-b border-gray-200/80 py-10">
                <div className="max-w-4xl mx-auto px-4 sm:px-6">

                    {query ? (
                        <>
                            <p className="text-xs font-bold text-red-600 uppercase tracking-widest mb-1">
                                Search Query
                            </p>

                            <h1 className="text-3xl font-black tracking-tight text-gray-900">
                                Showing results for{" "}
                                <span className="text-red-600">"{query}"</span>
                            </h1>

                            <p className="text-xs text-gray-400 mt-2">
                                Found {results.length} matching{" "}
                                {results.length === 1 ? "article" : "articles"}
                            </p>
                        </>
                    ) : (
                        <>
                            <p className="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">
                                Search
                            </p>

                            <h1 className="text-3xl font-black tracking-tight text-gray-900">
                                Search Articles
                            </h1>

                            <p className="text-xs text-gray-400 mt-2">
                                Enter keywords to find news articles
                            </p>
                        </>
                    )}

                </div>
            </div>

            {/* RESULTS */}
            <main className="max-w-4xl mx-auto px-4 sm:px-6 py-10">

                {/* NO QUERY */}
                {!query && (
                    <div className="text-center text-gray-400">
                        Start typing to search articles...
                    </div>
                )}

                {/* RESULTS LIST */}
                {query && results.length > 0 && (
                    <div className="space-y-5">
                        {results.map((article, index) => (
                            <Link
                                key={article.id ?? index}
                                href={route("articles.show", article.slug)}
                                className="group block bg-white p-5 rounded-xl border shadow-sm hover:shadow-md transition"
                            >
                                <div className="flex flex-col sm:flex-row gap-4">

                                    <div className="flex-1">
                                        <h2 className="text-xl font-bold group-hover:text-red-600">
                                            {article.title}
                                        </h2>

                                        <p className="text-sm text-gray-600 line-clamp-2 mt-2">
                                            {article.excerpt}
                                        </p>
                                    </div>

                                    {/* IMAGE FIX (prevents duplication bugs visually) */}
                                    {article.featured_image ? (
                                        <img
                                            src={articleImage(article.featured_image)}
                                            alt={article.title}
                                            className="w-28 h-20 object-cover rounded"
                                            loading="lazy"
                                        />
                                    ) : (
                                        <img
                                            src="https://via.placeholder.com/120x80?text=News"
                                            className="w-28 h-20 object-cover rounded"
                                            alt="placeholder"
                                        />
                                    )}

                                </div>
                            </Link>
                        ))}
                    </div>
                )}

                {/* NO RESULTS */}
                {query && results.length === 0 && (
                    <div className="text-center text-gray-500">
                        No results found for "{query}"
                    </div>
                )}

            </main>
        </div>
    );
}