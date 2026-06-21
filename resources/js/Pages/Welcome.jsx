import React from "react";
import { Link, usePage } from "@inertiajs/react";

export default function Home() {
    const { articles } = usePage().props;

    return (
        <div className="max-w-7xl mx-auto px-6 py-8">

            {/* HEADER */}
            <h1 className="text-4xl font-bold mb-6">
                Latest News
            </h1>

            {/* GRID */}
            <div className="grid md:grid-cols-3 gap-6">

                {articles.data.map((article) => (
                    <div
                        key={article.id}
                        className="bg-white shadow rounded-xl overflow-hidden"
                    >

                        {/* IMAGE */}
                        {article.featured_image && (
                            <img
                                src={`/storage/${article.featured_image}`}
                                className="w-full h-48 object-cover"
                            />
                        )}

                        <div className="p-4">

                            {/* CATEGORY + BREAKING */}
                            <div className="flex justify-between items-center mb-2">

                                <span className="text-xs bg-gray-200 px-2 py-1 rounded">
                                    {article.category?.name}
                                </span>

                                {article.is_breaking && (
                                    <span className="text-xs bg-red-600 text-white px-2 py-1 rounded">
                                        Breaking
                                    </span>
                                )}
                            </div>

                            {/* TITLE */}
                            <h2 className="text-xl font-bold mb-2">
                                {article.title}
                            </h2>

                            {/* EXCERPT */}
                            <p className="text-gray-600 text-sm mb-3">
                                {article.excerpt}
                            </p>

                            {/* META INFO */}
                            <div className="text-xs text-gray-500 mb-3">
                                By{" "}
                                <span className="font-semibold">
                                    {article.author?.name}
                                </span>
                                {" • "}
                                {article.views} views
                            </div>

                            {/* READ MORE */}
                            <Link
                                href={`/articles/${article.slug}`}
                                className="text-red-600 font-semibold text-sm"
                            >
                                Read More →
                            </Link>

                        </div>
                    </div>
                ))}

            </div>
        </div>
    );
}