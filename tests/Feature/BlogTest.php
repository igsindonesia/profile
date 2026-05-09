<?php

use App\Models\BlogPost;
use App\Models\PersonalInfo;

use function Pest\Laravel\get;

it('displays blog index page', function () {
    PersonalInfo::factory()->create();

    $response = get('/en/blog');

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page
        ->component('blog/index')
        ->has('posts')
    );
});

it('displays published blog posts on index page', function () {
    PersonalInfo::factory()->create();

    $publishedPost = BlogPost::factory()->create([
        'status' => 'published',
        'published_at' => now()->subDay(),
    ]);

    $draftPost = BlogPost::factory()->create([
        'status' => 'draft',
    ]);

    $response = get('/en/blog');

    $response->assertInertia(fn ($page) => $page
        ->component('blog/index')
        ->has('posts', 1)
        ->where('posts.0.slug', $publishedPost->slug)
    );
});

it('searches blog posts by title and content', function () {
    PersonalInfo::factory()->create();

    $post1 = BlogPost::factory()->create([
        'title' => ['en' => 'Laravel Tutorial', 'id' => 'Tutorial Laravel'],
        'status' => 'published',
        'published_at' => now(),
    ]);

    $post2 = BlogPost::factory()->create([
        'title' => ['en' => 'React Guide', 'id' => 'Panduan React'],
        'status' => 'published',
        'published_at' => now(),
    ]);

    $response = get('/en/blog?search=Laravel');

    $response->assertInertia(fn ($page) => $page
        ->component('blog/index')
        ->has('posts', 1)
        ->where('posts.0.slug', $post1->slug)
    );
});

it('displays individual blog post', function () {
    PersonalInfo::factory()->create();

    $post = BlogPost::factory()->create([
        'slug' => 'test-post',
        'status' => 'published',
        'published_at' => now(),
    ]);

    $response = get("/en/blog/{$post->slug}");

    $response->assertSuccessful();
    $response->assertInertia(fn ($page) => $page
        ->component('blog/show')
        ->has('post')
        ->where('post.slug', $post->slug)
    );
});

it('returns 404 for unpublished blog post', function () {
    PersonalInfo::factory()->create();

    $post = BlogPost::factory()->create([
        'slug' => 'draft-post',
        'status' => 'draft',
    ]);

    $response = get("/en/blog/{$post->slug}");

    $response->assertNotFound();
});

it('shows latest blog posts on home page', function () {
    PersonalInfo::factory()->create();

    BlogPost::factory()->count(5)->create([
        'status' => 'published',
        'published_at' => now(),
    ]);

    $response = get('/en');

    $response->assertInertia(fn ($page) => $page
        ->component('index')
        ->has('latest_blog_posts', 3)
    );
});
