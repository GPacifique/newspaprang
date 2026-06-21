import React from "react";
import { Link, usePage } from "@inertiajs/react";
import AuthenticatedNav from "@/Components/AuthenticatedNav";

export default function Dashboard() {
    const { stats = {}, latestArticles = [] } = usePage().props;

    return (
        <div className="max-w-7xl mx-auto p-6">
<AuthenticatedNav/>
            {/* HEADER */}
            <div className="mb-6">
                <h1 className="text-3xl font-bold">
                    Newsroom Dashboard
                </h1>
                <p className="text-gray-500">
                    Manage articles, monitor performance & newsroom activity
                </p>
            </div>

            {/* STATS CARDS */}
            <div className="grid md:grid-cols-4 gap-4 mb-8">

                <Card title="Total Articles" value={stats.total_articles ?? 0} color="text-black" />
                <Card title="Published" value={stats.published_articles ?? 0} color="text-green-600" />
                <Card title="Drafts" value={stats.drafts ?? 0} color="text-yellow-600" />
                <Card title="Total Views" value={stats.total_views ?? 0} color="text-blue-600" />

            </div>

            {/* ACTIONS */}
            <div className="flex gap-3 mb-8">

                <Link
                    href="/manage/articles/create"
                    className="bg-red-600 text-white px-4 py-2 rounded"
                >
                    + Create Article
                </Link>

                <Link
                    href="/articles"
                    className="bg-gray-800 text-white px-4 py-2 rounded"
                >
                    View Site
                </Link>

                <Link
                    href="/manage/categories"
                    className="bg-blue-600 text-white px-4 py-2 rounded"
                >
                    Categories
                </Link>

            </div>

            {/* LATEST ARTICLES TABLE */}
            <div className="bg-white shadow rounded-xl p-4">

                <h2 className="text-xl font-bold mb-4">
                    Latest Articles
                </h2>

                <table className="w-full text-left">

                    <thead>
                        <tr className="border-b text-gray-600">
                            <th className="py-2">Title</th>
                            <th>Author</th>
                            <th>Status</th>
                            <th>Views</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        {latestArticles.length > 0 ? (
                            latestArticles.map((article) => (
                                <tr key={article.id} className="border-b">

                                    <td className="py-2 font-medium">
                                        {article.title}
                                    </td>

                                    <td>
                                        {article.author?.name ?? "Unknown"}
                                    </td>

                                    <td>
                                        <span className={`px-2 py-1 text-xs rounded ${
                                            article.status === "published"
                                                ? "bg-green-100 text-green-700"
                                                : "bg-yellow-100 text-yellow-700"
                                        }`}>
                                            {article.status}
                                        </span>
                                    </td>

                                    <td>{article.views}</td>

                                    <td className="space-x-2">

                                        <Link
                                            href={`/articles/${article.slug}`}
                                            className="text-green-600"
                                        >
                                            View
                                        </Link>

                                    </td>

                                </tr>
                            ))
                        ) : (
                            <tr>
                                <td colSpan="5" className="py-4 text-center text-gray-500">
                                    No articles found
                                </td>
                            </tr>
                        )}
                    </tbody>

                </table>

            </div>

        </div>
    );
}

/*
Reusable Stat Card
*/
function Card({ title, value, color }) {
    return (
        <div className="bg-white shadow rounded-xl p-4">
            <h2 className="text-sm text-gray-500">{title}</h2>
            <p className={`text-2xl font-bold ${color}`}>
                {value}
            </p>
        </div>
    );
}