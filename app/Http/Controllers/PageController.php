<?php

namespace App\Http\Controllers;

use App\Facades\Meta;
use App\Models\BlogPost;
use App\Models\BookWriting;
use App\Models\CommunityService;
use App\Models\Conference;
use App\Models\Education;
use App\Models\InstitutionPosition;
use App\Models\IntellectualProperty;
use App\Models\Organization;
use App\Models\PersonalInfo;
use App\Models\PolicyExperience;
use App\Models\Publication;
use App\Models\Research;
use App\Models\TeachingExperience;
use App\Models\TeachingMaterial;
use App\Models\Training;
use Inertia\Inertia;

class PageController extends Controller
{
    public function index(string $locale)
    {
        $personalInfo = PersonalInfo::first();

        // Get latest 3 published blog posts
        $latestBlogPosts = BlogPost::query()
            ->published()
            ->orderBy('published_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function ($post) {
                $featuredImage = $post->getFirstMedia('featured_image');

                return [
                    'id' => $post->id,
                    'slug' => $post->slug,
                    'title' => $post->title,
                    'excerpt' => $post->excerpt,
                    'published_at' => $post->published_at?->format('F d, Y'),
                    'featured_image' => $featuredImage ? $featuredImage->getUrl() : null,
                ];
            });

        $description = $personalInfo
            ? strip_tags($personalInfo->short_description[$locale] ?? '')
            : null;

        Meta::title($personalInfo->name ?? config('app.name'))
            ->description($description)
            ->type('website')
            ->card('summary');

        return Inertia::render('index', [
            'personal_info' => $personalInfo ? [
                'name' => $personalInfo->name,
                'picture' => $personalInfo->picture,
                'cv_en' => $personalInfo->cv_en,
                'cv_id' => $personalInfo->cv_id,
                'short_description' => $personalInfo->short_description,
                'institution' => $personalInfo->institution,
                'academic_position' => $personalInfo->academic_position,
                'scopus_id' => $personalInfo->scopus_id,
                'sinta_id' => $personalInfo->sinta_id,
                'google_scholar_id' => $personalInfo->google_scholar_id,
            ] : null,
            'book_writings_count' => BookWriting::count(),
            'community_services_count' => CommunityService::count(),
            'conferences_count' => Conference::count(),
            'educations_count' => Education::count(),
            'institution_positions_count' => InstitutionPosition::count(),
            'intellectual_properties_count' => IntellectualProperty::count(),
            'organizations_count' => Organization::count(),
            'policy_experiences_count' => PolicyExperience::count(),
            'publications_count' => Publication::count(),
            'researches_count' => Research::count(),
            'teaching_experiences_count' => TeachingExperience::count(),
            'teaching_materials_count' => TeachingMaterial::count(),
            'trainings_count' => Training::count(),
            'latest_blog_posts' => $latestBlogPosts,
        ]);
    }
}
