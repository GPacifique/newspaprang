import React, { useState } from "react";
import { useForm, usePage } from "@inertiajs/react";
import Header from "@/Components/Header";
import RichTextEditor from"@/Components/RichTextEditor";

export default function Create() {

    const { categories } = usePage().props;

    const { data, setData, post, processing, errors } = useForm({
        title: "",
        excerpt: "",
        content: "",
        category_id: "",
        status: "draft",
        is_breaking: false,
        is_featured: false,
        featured_image: null,
    });

    const submit = (e) => {
        e.preventDefault();
        post("/manage/articles");
    };

    return (
        <div className="min-h-screen bg-gray-100">

            <Header />
            <RichTextEditor
    value={data.content}
    onChange={(value) => setData("content", value)}
/>

            <div className="max-w-4xl mx-auto p-6">

                <h1 className="text-3xl font-bold mb-6">
                    Create Article
                </h1>

                <form
                    onSubmit={submit}
                    className="bg-white p-6 rounded-xl shadow space-y-5"
                >

                    {/* TITLE */}
                    <div>
                        <label className="text-sm font-semibold">
                            Title
                        </label>

                        <input
                            type="text"
                            value={data.title}
                            onChange={(e) =>
                                setData("title", e.target.value)
                            }
                            className="w-full border rounded p-2 mt-1"
                        />

                        {errors.title && (
                            <p className="text-red-500 text-sm">
                                {errors.title}
                            </p>
                        )}
                    </div>

                    {/* EXCERPT */}
                    <div>
                        <label className="text-sm font-semibold">
                            Excerpt
                        </label>

                        <textarea
                            value={data.excerpt}
                            onChange={(e) =>
                                setData("excerpt", e.target.value)
                            }
                            className="w-full border rounded p-2 mt-1"
                        />
                    </div>

                    {/* CONTENT */}
                    <div>
                        <label className="text-sm font-semibold">
                            Content
                        </label>

                        <textarea
                            rows="6"
                            value={data.content}
                            onChange={(e) =>
                                setData("content", e.target.value)
                            }
                            className="w-full border rounded p-2 mt-1"
                        />
                    </div>

                    {/* CATEGORY */}
                    <div>
                        <label className="text-sm font-semibold">
                            Category
                        </label>

                        <select
                            value={data.category_id}
                            onChange={(e) =>
                                setData("category_id", e.target.value)
                            }
                            className="w-full border rounded p-2 mt-1"
                        >
                            <option value="">Select category</option>

                            {categories.map((cat) => (
                                <option key={cat.id} value={cat.id}>
                                    {cat.name}
                                </option>
                            ))}
                        </select>
                    </div>

                    {/* IMAGE */}
                    <div>
                        <label className="text-sm font-semibold">
                            Featured Image
                        </label>

                        <input
                            type="file"
                            onChange={(e) =>
                                setData("featured_image", e.target.files[0])
                            }
                            className="w-full border rounded p-2 mt-1"
                        />
                    </div>

                    {/* CHECKBOXES */}
                    <div className="flex gap-6">

                        <label className="flex items-center gap-2">
                            <input
                                type="checkbox"
                                checked={data.is_breaking}
                                onChange={(e) =>
                                    setData("is_breaking", e.target.checked)
                                }
                            />
                            Breaking News
                        </label>

                        <label className="flex items-center gap-2">
                            <input
                                type="checkbox"
                                checked={data.is_featured}
                                onChange={(e) =>
                                    setData("is_featured", e.target.checked)
                                }
                            />
                            Featured
                        </label>

                    </div>

                    {/* STATUS */}
                    <div>
                        <label className="text-sm font-semibold">
                            Status
                        </label>

                        <select
                            value={data.status}
                            onChange={(e) =>
                                setData("status", e.target.value)
                            }
                            className="w-full border rounded p-2 mt-1"
                        >
                            <option value="draft">Draft</option>
                            <option value="published">Published</option>
                            <option value="archived">Archived</option>
                        </select>
                    </div>

                    {/* SUBMIT */}
                    <button
                        type="submit"
                        disabled={processing}
                        className="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700"
                    >
                        Publish Article
                    </button>

                </form>
            </div>
        </div>
    );
}