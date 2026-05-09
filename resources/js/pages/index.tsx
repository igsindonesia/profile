import BlogController from "@/actions/App/Http/Controllers/BlogController";
import CategoryController from "@/actions/App/Http/Controllers/CategoryController";
import PageController from "@/actions/App/Http/Controllers/PageController";
import { BlogPostCard } from "@/components/blog/blog-post-card";
import { CategoryCard } from "@/components/profile/category-card";
import { CategoryNavMenu } from "@/components/profile/category-nav-menu";
import { CategorySidebar } from "@/components/profile/category-sidebar";
import { ContentCard } from "@/components/profile/content-card";
import { ContentDetailView } from "@/components/profile/content-detail-view";
import { ProfileCard } from "@/components/profile/profile-card";
import { StatsCard } from "@/components/profile/stats-card";
import { Button } from "@/components/ui/button";
import { Input } from "@/components/ui/input";
import {
    Sheet,
    SheetContent,
    SheetHeader,
    SheetTitle,
    SheetTrigger,
} from "@/components/ui/sheet";
import { useLanguage } from "@/contexts/language-context";
import { Head, Link, router } from "@inertiajs/react";
import {
    Award,
    BookOpen,
    Briefcase,
    Building,
    ChevronRight,
    FileEdit,
    FileText,
    FlaskConical,
    GraduationCap,
    Lightbulb,
    LucideIcon,
    Menu,
    Newspaper,
    Presentation,
    School,
    Search as SearchIcon,
    Users,
} from "lucide-react";
import { useEffect, useState } from "react";

interface ModelCategory {
    name: string;
    name_en: string;
    name_id: string;
    description_en: string;
    description_id: string;
    icon: LucideIcon;
    count: number;
    route: string;
}

interface PersonalInfo {
    name: string;
    picture: string | null;
    short_description: {
        en: string;
        id: string;
    };
    institution: string;
    academic_position: string;
    scopus_id: string;
    sinta_id: string;
    google_scholar_id: string;
}

interface ContentItem {
    id: number;
    title: string;
    description: string;
    date: string;
    [key: string]: unknown;
}

interface BlogPost {
    id: number;
    slug: string;
    title: string;
    excerpt: string;
    published_at: string;
    featured_image: string;
}

interface Props {
    personal_info: PersonalInfo | null;
    awards_count: number;
    book_writings_count: number;
    community_services_count: number;
    conferences_count: number;
    educations_count: number;
    institution_positions_count: number;
    intellectual_properties_count: number;
    links_count: number;
    organizations_count: number;
    policy_experiences_count: number;
    publications_count: number;
    researches_count: number;
    teaching_experiences_count: number;
    teaching_materials_count: number;
    trainings_count: number;
    selected_category?: string;
    category_items?: ContentItem[];
    latest_blog_posts?: BlogPost[];
}

export default function ProfileIndex({
    personal_info,
    book_writings_count,
    community_services_count,
    conferences_count,
    educations_count,
    institution_positions_count,
    intellectual_properties_count,
    organizations_count,
    policy_experiences_count,
    publications_count,
    researches_count,
    teaching_experiences_count,
    teaching_materials_count,
    trainings_count,
    selected_category,
    category_items = [],
    latest_blog_posts = [],
}: Props) {
    const { locale, t } = useLanguage();
    const [searchTerm, setSearchTerm] = useState("");
    const [selectedCategory] = useState<ModelCategory | null>(null);
    const [isContentView] = useState(false);
    const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
    const [selectedItem, setSelectedItem] = useState<ContentItem | null>(null);

    // Debounced search using Inertia reload
    useEffect(() => {
        if (!selected_category) return;

        const timer = setTimeout(() => {
            router.reload({
                data: { search: searchTerm },
                only: ["category_items"],
            });
        }, 300);

        return () => clearTimeout(timer);
    }, [searchTerm, selected_category]);

    const categories: ModelCategory[] = [
        {
            name: "Book Writings",
            name_en: t("Book Writings"),
            name_id: t("Book Writings"),
            description_en: t("Published books and written works"),
            description_id: t("Published books and written works"),
            icon: BookOpen,
            count: book_writings_count,
            route: CategoryController.bookWritings.url({ locale }),
        },
        {
            name: "Community Services",
            name_en: t("Community Services"),
            name_id: t("Community Services"),
            description_en: t("Contributions and services to the community"),
            description_id: t("Contributions and services to the community"),
            icon: Users,
            count: community_services_count,
            route: CategoryController.communityServices.url({ locale }),
        },
        {
            name: "Conferences",
            name_en: t("Conferences"),
            name_id: t("Conferences"),
            description_en: t(
                "Academic conferences and presentations attended",
            ),
            description_id: t(
                "Academic conferences and presentations attended",
            ),
            icon: Presentation,
            count: conferences_count,
            route: CategoryController.conferences.url({ locale }),
        },
        {
            name: "Education",
            name_en: t("Education"),
            name_id: t("Education"),
            description_en: t(
                "Educational background and academic qualifications",
            ),
            description_id: t(
                "Educational background and academic qualifications",
            ),
            icon: GraduationCap,
            count: educations_count,
            route: CategoryController.education.url({ locale }),
        },
        {
            name: "Institution Positions",
            name_en: t("Institution Positions"),
            name_id: t("Institution Positions"),
            description_en: t("Positions held within various institutions"),
            description_id: t("Positions held within various institutions"),
            icon: Briefcase,
            count: institution_positions_count,
            route: CategoryController.institutionPositions.url({ locale }),
        },
        {
            name: "Intellectual Properties",
            name_en: t("Intellectual Properties"),
            name_id: t("Intellectual Properties"),
            description_en: t(
                "Patents, copyrights, and other intellectual property rights",
            ),
            description_id: t(
                "Patents, copyrights, and other intellectual property rights",
            ),
            icon: Lightbulb,
            count: intellectual_properties_count,
            route: CategoryController.intellectualProperties.url({ locale }),
        },
        {
            name: "Organizations",
            name_en: t("Organizations"),
            name_id: t("Organizations"),
            description_en: t(
                "Professional and academic organizations memberships",
            ),
            description_id: t(
                "Professional and academic organizations memberships",
            ),
            icon: Building,
            count: organizations_count,
            route: CategoryController.organizations.url({ locale }),
        },
        {
            name: "Policy Experiences",
            name_en: t("Policy Experiences"),
            name_id: t("Policy Experiences"),
            description_en: t("Experience in policy-making and advisory roles"),
            description_id: t("Experience in policy-making and advisory roles"),
            icon: FileText,
            count: policy_experiences_count,
            route: CategoryController.policyExperiences.url({ locale }),
        },
        {
            name: "Publications",
            name_en: t("Publications"),
            name_id: t("Publications"),
            description_en: t("Academic publications and research papers"),
            description_id: t("Academic publications and research papers"),
            icon: Newspaper,
            count: publications_count,
            route: CategoryController.publications.url({ locale }),
        },
        {
            name: "Research",
            name_en: t("Research"),
            name_id: t("Research"),
            description_en: t("Research projects and funded studies"),
            description_id: t("Research projects and funded studies"),
            icon: FlaskConical,
            count: researches_count,
            route: CategoryController.research.url({ locale }),
        },
        {
            name: "Teaching Experiences",
            name_en: t("Teaching Experiences"),
            name_id: t("Teaching Experiences"),
            description_en: t(
                "Teaching positions and academic instruction experience",
            ),
            description_id: t(
                "Teaching positions and academic instruction experience",
            ),
            icon: School,
            count: teaching_experiences_count,
            route: CategoryController.teachingExperiences.url({ locale }),
        },
        {
            name: "Teaching Materials",
            name_en: t("Teaching Materials"),
            name_id: t("Teaching Materials"),
            description_en: t(
                "Educational materials and course content developed",
            ),
            description_id: t(
                "Educational materials and course content developed",
            ),
            icon: FileEdit,
            count: teaching_materials_count,
            route: CategoryController.teachingMaterials.url({ locale }),
        },
        {
            name: "Trainings",
            name_en: t("Trainings"),
            name_id: t("Trainings"),
            description_en: t(
                "Professional development and training programs attended",
            ),
            description_id: t(
                "Professional development and training programs attended",
            ),
            icon: Award,
            count: trainings_count,
            route: CategoryController.trainings.url({ locale }),
        },
    ];

    const getLocalizedName = (category: ModelCategory) => {
        return locale === "en" ? category.name_en : category.name_id;
    };

    const getLocalizedDescription = (category: ModelCategory) => {
        return locale === "en"
            ? category.description_en
            : category.description_id;
    };

    // Find the selected category from the categories list based on the prop
    const selectedCategoryObj =
        categories.find((cat) => cat.name === selected_category) || null;

    // Use prop data if available, otherwise fall back to client-side state
    const activeCategory = selectedCategoryObj || selectedCategory;
    const activeIsContentView = !!selected_category || isContentView;

    const filteredCategories = categories.filter((category) => {
        const name = getLocalizedName(category).toLowerCase();
        const description = getLocalizedDescription(category).toLowerCase();
        const search = searchTerm.toLowerCase();
        return name.includes(search) || description.includes(search);
    });

    const handleCategoryClick = (category: ModelCategory) => {
        setIsMobileMenuOpen(false);
        setSearchTerm("");
        router.get(
            category.route,
            {},
            {
                preserveScroll: true,
                preserveState: true,
                onSuccess: () => {
                    // Scroll to content view section after navigation
                    setTimeout(() => {
                        const contentSection =
                            document.getElementById("content-view");
                        if (contentSection) {
                            const navbarHeight = 80;
                            const elementPosition =
                                contentSection.getBoundingClientRect().top;
                            const offsetPosition =
                                elementPosition +
                                window.pageYOffset -
                                navbarHeight;

                            window.scrollTo({
                                top: offsetPosition,
                                behavior: "smooth",
                            });
                        }
                    }, 100);
                },
            },
        );
    };

    const handleBackToHome = () => {
        setIsMobileMenuOpen(false);
        setSearchTerm("");
        router.get(
            PageController.index.url({ locale }),
            {},
            {
                preserveScroll: false,
            },
        );
    };

    // Get content items from props (passed from backend)
    const getContentItems = () => {
        return category_items;
    };

    return (
        <>
            <Head title="Academic Profile - IGS Indonesia" />

            <div className="min-h-screen bg-background">
                {/* Personal Info Section - Always Visible */}
                <div className="mx-auto max-w-screen-lg px-4 py-4 lg:py-16">
                    {personal_info && (
                        <ProfileCard
                            personalInfo={personal_info}
                            locale={locale}
                        />
                    )}
                </div>

                {/* Blog Posts Section - Only on Home View */}
                {!activeIsContentView && latest_blog_posts.length > 0 && (
                    <div className="border-y-1 bg-muted/30 py-8 lg:py-16">
                        <div className="mx-auto max-w-screen-lg px-4">
                            <div className="mb-8 text-center">
                                <div className="mx-auto mb-4 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-br from-primary/10 to-primary/20">
                                    <Newspaper className="h-6 w-6 text-primary" />
                                </div>
                                <h2 className="mb-2 text-3xl font-bold text-foreground">
                                    {t("Latest Posts")}
                                </h2>
                                <p className="mx-auto max-w-2xl text-muted-foreground">
                                    {t("Read our latest articles and insights")}
                                </p>
                            </div>
                            <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                                {latest_blog_posts.map((post) => (
                                    <BlogPostCard
                                        key={post.id}
                                        post={post}
                                        t={t}
                                    />
                                ))}
                            </div>
                            <div className="mt-8 text-center">
                                <Button
                                    asChild
                                    variant="outline"
                                    size="lg"
                                    className="gap-2"
                                >
                                    <Link
                                        href={BlogController.index.url({
                                            locale,
                                        })}
                                    >
                                        {t("See More Blog Posts")}
                                        <ChevronRight className="h-5 w-5" />
                                    </Link>
                                </Button>
                            </div>
                        </div>
                    </div>
                )}

                {!activeIsContentView ? (
                    /* Home View - Categories Grid */
                    <div>
                        {/* Search and Categories Section */}
                        <div className="border-y-1 py-8 lg:py-16">
                            <div className="mx-auto max-w-screen-lg px-4">
                                <div className="space-y-8">
                                    <div className="text-center">
                                        <h1 className="mb-4 text-4xl font-bold text-foreground">
                                            {t("Academic Profile")}
                                        </h1>
                                        <p className="mx-auto max-w-3xl text-lg text-muted-foreground">
                                            {t(
                                                "Explore comprehensive academic achievements, research contributions, and professional experience. Select a category below to view detailed information.",
                                            )}
                                        </p>
                                    </div>
                                    <div className="mx-auto max-w-md">
                                        <div className="group relative">
                                            <SearchIcon className="absolute top-1/2 left-3 h-5 w-5 -translate-y-1/2 text-muted-foreground transition-colors group-focus-within:text-primary" />
                                            <Input
                                                type="text"
                                                className="pl-10"
                                                placeholder={t(
                                                    "Search categories...",
                                                )}
                                                value={searchTerm}
                                                onChange={(e) =>
                                                    setSearchTerm(
                                                        e.target.value,
                                                    )
                                                }
                                            />
                                        </div>
                                    </div>

                                    {/* Categories Grid */}
                                    {filteredCategories.length > 0 ? (
                                        <div className="flex flex-wrap justify-center gap-4 md:gap-6">
                                            {filteredCategories.map(
                                                (category, index) => (
                                                    <CategoryCard
                                                        key={index}
                                                        name={getLocalizedName(
                                                            category,
                                                        )}
                                                        description={getLocalizedDescription(
                                                            category,
                                                        )}
                                                        icon={category.icon}
                                                        count={category.count}
                                                        onClick={() =>
                                                            handleCategoryClick(
                                                                category,
                                                            )
                                                        }
                                                    />
                                                ),
                                            )}
                                        </div>
                                    ) : (
                                        /* No Results Message */
                                        <div className="py-12 text-center">
                                            <SearchIcon className="mx-auto mb-4 h-12 w-12 text-muted-foreground" />
                                            <p className="text-lg text-muted-foreground">
                                                {t(
                                                    "No categories found matching your search.",
                                                )}
                                            </p>
                                        </div>
                                    )}
                                </div>
                            </div>
                        </div>
                    </div>
                ) : (
                    /* Content View - Sidebar + Content */
                    <div
                        id="content-view"
                        className="flex min-h-screen border-y-1"
                    >
                        {/* Desktop Sidebar */}
                        <CategorySidebar
                            categories={categories}
                            selectedCategory={activeCategory?.name || null}
                            onCategorySelect={handleCategoryClick}
                            onBackToHome={handleBackToHome}
                            getLocalizedName={getLocalizedName}
                            t={t}
                        />

                        {/* Main Content Area */}
                        <main className="flex-1 bg-muted/30 p-4 lg:p-8">
                            {activeCategory && (
                                <div className="mx-auto max-w-screen-xl">
                                    {/* Header */}
                                    <div className="mb-8">
                                        <div className="mb-4 flex items-start justify-between gap-4">
                                            <div className="flex items-center gap-4">
                                                {/* Mobile Menu Button */}
                                                <Sheet
                                                    open={isMobileMenuOpen}
                                                    onOpenChange={
                                                        setIsMobileMenuOpen
                                                    }
                                                >
                                                    <SheetTrigger asChild>
                                                        <Button
                                                            variant="outline"
                                                            size="icon"
                                                            className="lg:hidden"
                                                        >
                                                            <Menu className="h-5 w-5" />
                                                            <span className="sr-only">
                                                                {t("Open menu")}
                                                            </span>
                                                        </Button>
                                                    </SheetTrigger>
                                                    <SheetContent
                                                        side="left"
                                                        className="w-80 overflow-y-auto"
                                                    >
                                                        <SheetHeader>
                                                            <SheetTitle>
                                                                {t(
                                                                    "Categories",
                                                                )}
                                                            </SheetTitle>
                                                        </SheetHeader>
                                                        <div className="mt-6">
                                                            <CategoryNavMenu
                                                                categories={
                                                                    categories
                                                                }
                                                                selectedCategory={
                                                                    activeCategory?.name ||
                                                                    null
                                                                }
                                                                onCategorySelect={
                                                                    handleCategoryClick
                                                                }
                                                                onBackToHome={
                                                                    handleBackToHome
                                                                }
                                                                getLocalizedName={
                                                                    getLocalizedName
                                                                }
                                                                t={t}
                                                            />
                                                        </div>
                                                    </SheetContent>
                                                </Sheet>

                                                {(() => {
                                                    const IconComponent =
                                                        activeCategory.icon;
                                                    return (
                                                        <div className="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl bg-gradient-to-br from-primary/10 to-primary/20 lg:h-16 lg:w-16">
                                                            <IconComponent className="h-6 w-6 text-primary lg:h-8 lg:w-8" />
                                                        </div>
                                                    );
                                                })()}
                                                <div>
                                                    <h1 className="text-2xl font-bold text-foreground lg:text-3xl">
                                                        {getLocalizedName(
                                                            activeCategory,
                                                        )}
                                                    </h1>
                                                    <p className="mt-1 text-sm text-muted-foreground lg:text-base">
                                                        {getLocalizedDescription(
                                                            activeCategory,
                                                        )}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>

                                        {/* Search Bar */}
                                        <div className="relative max-w-md">
                                            <SearchIcon className="absolute top-1/2 left-3 h-5 w-5 -translate-y-1/2 text-muted-foreground" />
                                            <Input
                                                type="text"
                                                className="pl-10"
                                                placeholder={t(
                                                    "Search items...",
                                                )}
                                                value={searchTerm}
                                                onChange={(e) =>
                                                    setSearchTerm(
                                                        e.target.value,
                                                    )
                                                }
                                            />
                                        </div>
                                    </div>

                                    {/* Content Grid */}
                                    <div className="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
                                        {getContentItems().map((item) => (
                                            <ContentCard
                                                key={item.id}
                                                title={item.title}
                                                description={item.description}
                                                date={item.date}
                                                url={
                                                    item.url as
                                                        | string
                                                        | undefined
                                                }
                                                onViewDetails={() =>
                                                    setSelectedItem(item)
                                                }
                                                t={t}
                                            />
                                        ))}
                                    </div>

                                    {/* Empty State */}
                                    {category_items.length === 0 && (
                                        <div className="py-16 text-center">
                                            <FileText className="mx-auto mb-4 h-16 w-16 text-muted-foreground" />
                                            <h3 className="mb-2 text-xl font-semibold text-foreground">
                                                {t("No items found")}
                                            </h3>
                                            <p className="text-muted-foreground">
                                                {searchTerm
                                                    ? t(
                                                          "No items match your search. Try different keywords.",
                                                      )
                                                    : t(
                                                          "There are currently no items in this category.",
                                                      )}
                                            </p>
                                        </div>
                                    )}
                                </div>
                            )}
                        </main>

                        {/* Detail View Sheet */}
                        <Sheet
                            open={!!selectedItem}
                            onOpenChange={(open) =>
                                !open && setSelectedItem(null)
                            }
                        >
                            <SheetContent
                                side="right"
                                className="w-full overflow-y-auto sm:max-w-2xl"
                            >
                                <SheetHeader>
                                    <SheetTitle>{t("Details")}</SheetTitle>
                                </SheetHeader>
                                <div className="mt-6">
                                    {selectedItem && activeCategory && (
                                        <ContentDetailView
                                            item={selectedItem}
                                            category={activeCategory.name}
                                            t={t}
                                        />
                                    )}
                                </div>
                            </SheetContent>
                        </Sheet>
                    </div>
                )}

                {/* Stats Section - Always Visible */}
                <div className="mx-auto max-w-screen-lg p-4 lg:py-16">
                    <StatsCard
                        stats={[
                            {
                                label: t("Categories"),
                                value: categories.length,
                            },
                            {
                                label: t("Total Items"),
                                value: categories.reduce(
                                    (sum, cat) => sum + cat.count,
                                    0,
                                ),
                            },
                            {
                                label: t("Updated"),
                                value: new Date().getFullYear(),
                            },
                        ]}
                    />
                </div>
            </div>
        </>
    );
}
