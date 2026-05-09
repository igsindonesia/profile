<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\PersonalInfo;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class BlogController extends Controller
{
    public function index(string $locale, Request $request): Response
    {
        $personalInfo = PersonalInfo::first();

        $query = BlogPost::query()->published();

        // Search functionality - search in title, excerpt, and content
        if ($request->has('search') && $request->search) {
            $search = strtolower($request->search);
            $query->where(function ($q) use ($search) {
                $q
                    ->whereRaw('LOWER(CAST(title AS TEXT)) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(CAST(excerpt AS TEXT)) LIKE ?', ["%{$search}%"])
                    ->orWhereRaw('LOWER(CAST(content AS TEXT)) LIKE ?', ["%{$search}%"]);
            });
        }

        $posts = $query
            ->orderBy('published_at', 'desc')
            ->get()
            ->map(function ($post) {
                $featuredImage = $post->getFirstMedia('featured_image');

                return [
                    'id' => $post->id,
                    'slug' => $post->slug,
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'published_at' => $post->published_at?->format('F d, Y'),
                    'featured_image' => $featuredImage ? $featuredImage->getTemporaryUrl(now()->addHours(2)) : null,
                ];
            });

        return Inertia::render('blog/index', [
            'personal_info' => $personalInfo
                ? [
                    'name' => $personalInfo->name,
                    'picture' => $personalInfo->picture,
                ] : null,
            'posts' => $posts,
            'search' => $request->search ?? '',
        ]);
    }

    public function show(string $locale, string $slug): Response
    {
        $personalInfo = PersonalInfo::first();

        $post = BlogPost::query()->published()->where('slug', $slug)->firstOrFail();

        $featuredImage = $post->getFirstMedia('featured_image');
        $galleryMedia = $post->getMedia('gallery');
        $attachmentMedia = $post->getMedia('attachments');

        return Inertia::render('blog/show', [
            'personal_info' => $personalInfo
                ? [
                    'name' => $personalInfo->name,
                    'picture' => $personalInfo->picture,
                ] : null,
            'post' => [
                'id' => $post->id,
                'slug' => $post->slug,
                'title' => $post->title,
                'excerpt' => $post->excerpt,
                'content' => $post->content,
                'published_at' => $post->published_at?->format('F d, Y'),
                'featured_image' => $featuredImage ? $featuredImage->getTemporaryUrl(now()->addHours(2)) : null,
                'gallery' => $galleryMedia->map(fn ($media) => $media->getTemporaryUrl(now()->addHours(2))),
                'attachments' => $attachmentMedia->map(fn ($media) => [
                    'name' => $media->name,
                    'url' => $media->getTemporaryUrl(now()->addHours(2)),
                    'size' => $media->size,
                    'mime_type' => $media->mime_type,
                ]),
            ],
        ]);
    }
}
