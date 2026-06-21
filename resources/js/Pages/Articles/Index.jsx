import React from "react";
import { Link, usePage } from "@inertiajs/react";

export default function Index() {
    const { articles } = usePage().props;

    return (
        <div className="max-w-7xl mx-auto px-6 py-8">

            {/* HEADER */}
            <div className="flex justify-between items-center mb-6">
                <h1 className="text-3xl font-bold">
                    Latest Articles
                </h1>

                <Link
                    href="/manage/articles/create"
                    className="bg-red-600 text-white px-4 py-2 rounded"
                >
                    + Create Article
                </Link>
            </div>

            {/* GRID */}
            <div className="grid md:grid-cols-3 gap-6">

                {articles?.data?.length > 0 ? (
                    articles.data.map((article) => (
                        <div
                            key={article.id}
                            className="bg-white shadow rounded-xl overflow-hidden"
                        >

                            {/* IMAGE (FIXED PATH) */}
                            {article.featured_image && (
                                <img
                                    src={`/articles/${article.featured_image}`}
                                    alt={article.title}
                                    className="w-full h-48 object-cover"
                                />
                            )}

                            <div className="p-4">

                                {/* CATEGORY */}
                                <span className="text-xs bg-gray-200 px-2 py-1 rounded">
                                    {article.category?.name}
                                </span>

                                {/* TITLE */}
                                <h2 className="text-xl font-bold mt-2">
                                    {article.title}
                                </h2>

                                {/* META */}
                                <p className="text-sm text-gray-500 mt-1">
                                    By {article.author?.name} • {article.views} views
                                </p>

                                {/* EXCERPT */}
                                <p className="text-gray-600 text-sm mt-2">
                                    {article.excerpt}
                                </p>

                                {/* ACTIONS */}
                                <div className="flex justify-between mt-4">

                                    <Link
                                        href={`/articles/${article.slug}`}
                                        className="text-green-600 font-medium"
                                    >
                                        Read
                                    </Link>

                                    <Link
                                        href={`/manage/articles/${article.id}/edit`}
                                        className="text-blue-600 font-medium"
                                    >
                                        Edit
                                    </Link>

                                </div>

                            </div>
                        </div>
                    ))
                ) : (
                    <p className="text-gray-500">
                        No articles found.
                    </p>
                )}

            </div>

            {/* PAGINATION (SAFE VERSION) */}
            <div className="mt-8 flex gap-2 flex-wrap">

                {articles?.links?.map((link, i) =>
                    link.url ? (
                        <Link
                            key={i}
                            href={link.url}
                            className={`px-3 py-1 border rounded ${
                                link.active ? "bg-red-600 text-white" : ""
                            }`}
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        />
                    ) : (
                        <span
                            key={i}
                            className="px-3 py-1 text-gray-400 border rounded"
                            dangerouslySetInnerHTML={{ __html: link.label }}
                        />
                    )
                )}

            </div>

        </div>
    );
}