import BlogController from "@/actions/App/Http/Controllers/BlogController";
import { Button } from "@/components/ui/button";
import {
    Card,
    CardContent,
    CardDescription,
    CardFooter,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import { useLanguage } from "@/contexts/language-context";
import { Link } from "@inertiajs/react";
import { Calendar, ChevronRight } from "lucide-react";

interface BlogPostCardProps {
    post: {
        id: number;
        slug: string;
        title: string;
        excerpt: string;
        published_at: string;
        featured_image: string | null;
    };
    t: (key: string) => string;
}

export function BlogPostCard({ post, t }: BlogPostCardProps) {
    const { locale } = useLanguage();
    return (
        <Link href={BlogController.show.url({ locale, slug: post.slug })}>
            <Card className="group flex h-full transform cursor-pointer flex-col overflow-hidden border-border bg-card pt-0 transition-all duration-300 hover:-translate-y-1 hover:border-primary hover:shadow-lg">
                {post.featured_image && (
                    <div className="relative aspect-video w-full overflow-hidden bg-muted">
                        <img
                            src={post.featured_image}
                            alt={post.title}
                            className="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                        />
                    </div>
                )}
                <CardHeader>
                    <CardTitle className="line-clamp-2 text-lg group-hover:text-primary">
                        {post.title}
                    </CardTitle>
                    <CardDescription className="line-clamp-3 text-sm leading-relaxed">
                        {post.excerpt}
                    </CardDescription>
                </CardHeader>
                <CardContent>
                    <div className="flex items-center gap-2 text-sm text-muted-foreground">
                        <Calendar className="h-4 w-4" />
                        <span>{post.published_at}</span>
                    </div>
                </CardContent>
                <CardFooter>
                    <Button
                        variant="outline"
                        className="w-full gap-1 transition-all hover:gap-2"
                    >
                        {t("Read More")}
                        <ChevronRight className="h-4 w-4" />
                    </Button>
                </CardFooter>
            </Card>
        </Link>
    );
}
