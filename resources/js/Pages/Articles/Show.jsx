import React from "react";
import { Link, useForm, usePage } from "@inertiajs/react";
import Header from "@/Components/Header";
import AdSlider from "@/Components/AdSlider";

export default function Show() {
    const {
        article,
        related = [],
        comments = [],
        trending = [],
    } = usePage().props;

    const { data, setData, post, reset } = useForm({
        content: "",
    });

    const submitComment = (e) => {
        e.preventDefault();

        if (!data.content?.trim()) return;

        post(`/articles/${article?.id}/comments`, {
            onSuccess: () => reset(),
        });
    };

    const imageUrl = (img) =>
        img ? `/articles/${img}` : "https://via.placeholder.com/600x400?text=News";

    if (!article) {
        return (
            <div className="min-h-screen flex items-center justify-center text-gray-500">
                Article not found
            </div>
        );
    }

    return (
        <div className="bg-gray-100 min-h-screen">
            <Header />

            <div className="max-w-7xl mx-auto px-4 py-10 grid lg:grid-cols-12 gap-6">

                {/* ================= MAIN ================= */}
                <div className="lg:col-span-8 space-y-6">

                    <article className="bg-white rounded-xl shadow overflow-hidden">

                        {article.featured_image && (
                            <img
                                src={imageUrl(article.featured_image)}
                                className="w-full h-96 object-cover"
                                alt={article.title}
                            />
                        )}

                        <div className="p-6">

                            <span className="text-red-600 text-xs font-bold uppercase">
                                {article.category?.name || "General"}
                            </span>

                            <h1 className="text-3xl font-bold mt-2">
                                {article.title}
                            </h1>

                            <div className="text-sm text-gray-500 mt-3">
                                By <b>{article.author?.name || "Unknown"}</b> • 👁{" "}
                                {article.views || 0}
                            </div>

                            <div className="mt-6 text-gray-700 leading-relaxed whitespace-pre-line">
                                {article.content || ""}
                            </div>
                        </div>
                    </article>

                    {/* ================= COMMENTS ================= */}
                    <section className="bg-white rounded-xl p-6 shadow">

                        <h2 className="text-xl font-bold mb-4">
                            Comments ({comments?.length || 0})
                        </h2>

                        {/* FORM */}
                        <form onSubmit={submitComment} className="mb-6">

                            <textarea
                                value={data.content}
                                onChange={(e) => setData("content", e.target.value)}
                                placeholder="Write your comment..."
                                className="w-full border rounded-lg p-3 focus:ring focus:outline-none"
                            />

                            <button
                                type="submit"
                                className="mt-3 bg-red-600 text-white px-5 py-2 rounded-lg hover:bg-red-700"
                            >
                                Post Comment
                            </button>
                        </form>

                        {/* LIST */}
                        <div className="space-y-4">

                            {comments?.length > 0 ? (
                                comments.map((c) => (
                                    <div key={c.id} className="border-b pb-3">

                                        <p className="text-sm font-semibold">
                                            {c.user?.name || "Anonymous"}
                                        </p>

                                        <p className="text-gray-600 text-sm mt-1">
                                            {c.content}
                                        </p>
                                    </div>
                                ))
                            ) : (
                                <p className="text-gray-500">No comments yet</p>
                            )}
                        </div>
                    </section>

                    {/* ================= RELATED ================= */}
                    <section className="bg-white rounded-xl p-6 shadow">

                        <h2 className="text-xl font-bold mb-4">
                            Related Articles
                        </h2>

                        <div className="grid md:grid-cols-3 gap-4">

                            {related?.length > 0 ? (
                                related.map((item) => (
                                    <Link
                                        key={item.id}
                                        href={`/articles/${item.slug}`}
                                        className="border rounded-lg overflow-hidden hover:shadow-md transition block"
                                    >
                                        <img
                                            src={imageUrl(item.featured_image)}
                                            className="w-full h-32 object-cover"
                                            alt={item.title}
                                        />

                                        <div className="p-3">

                                            <h3 className="text-sm font-semibold line-clamp-2">
                                                {item.title}
                                            </h3>

                                            <p className="text-xs text-gray-500 mt-2">
                                                👁 {item.views || 0}
                                            </p>

                                        </div>
                                    </Link>
                                ))
                            ) : (
                                <p className="text-gray-500">
                                    No related articles
                                </p>
                            )}

                        </div>
                    </section>
                </div>

                {/* ================= SIDEBAR ================= */}
                <aside className="lg:col-span-4 space-y-6">

                    {/* TRENDING */}
                    <div className="bg-white rounded-xl p-5 shadow">

                        <h2 className="font-bold mb-4 border-b pb-2">
                            Trending News
                        </h2>

                        {trending?.length > 0 ? (
                            trending.map((item) => (
                                <Link
                                    key={item.id}
                                    href={`/articles/${item.slug}`}
                                    className="flex gap-3 mb-4 last:mb-0"
                                >

                                    <img
                                        src={imageUrl(item.featured_image)}
                                        className="w-16 h-16 object-cover rounded"
                                        alt={item.title}
                                    />

                                    <div>
                                        <p className="text-sm font-semibold hover:text-red-600">
                                            {item.title}
                                        </p>

                                        <p className="text-xs text-gray-500">
                                            👁 {item.views || 0}
                                        </p>
                                    </div>
                                </Link>
                            ))
                        ) : (
                            <p className="text-gray-500 text-sm">
                                No trending news
                            </p>
                        )}
                    </div>

                    {/* AD */}
                    <p className="text-gray-400 text-sm">Advertisement</p>

                    <div className="bg-white rounded-xl p-6 shadow text-center">
                        <div className="h-80 bg-gray-100 mt-3 rounded flex items-center justify-center text-gray-400">
                            <AdSlider />
                        </div>
                    </div>

                    {/* LATEST */}
                    <div className="bg-white rounded-xl p-5 shadow">

                        <h2 className="font-bold mb-3">Latest Updates</h2>

                        <p className="text-sm text-gray-500">
                            More features like live updates can go here.
                        </p>
                    </div>

                </aside>
            </div>
        </div>
    );
}