import { Badge } from "@/components/ui/badge";
import { Button } from "@/components/ui/button";
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";
import { Separator } from "@/components/ui/separator";
import { useLanguage } from "@/contexts/language-context";
import { Head, Link } from "@inertiajs/react";
import { ArrowLeft, Calendar, Download, FileText } from "lucide-react";

interface PersonalInfo {
    name: string;
    picture: string | null;
}

interface Attachment {
    name: string;
    url: string;
    size: number;
    mime_type: string;
}

interface BlogPost {
    id: number;
    slug: string;
    title: string;
    excerpt: string;
    content: string;
    published_at: string;
    featured_image: string;
    gallery: string[];
    attachments: Attachment[];
}

interface Props {
    personal_info: PersonalInfo | null;
    post: BlogPost;
}

export default function BlogShow({ post }: Props) {
    const { t, locale } = useLanguage();
    const localePath = (path: string) => `/${locale}${path}`;

    const formatFileSize = (bytes: number): string => {
        if (bytes === 0) {
            return "0 Bytes";
        }
        const k = 1024;
        const sizes = ["Bytes", "KB", "MB", "GB"];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return (
            Math.round((bytes / Math.pow(k, i)) * 100) / 100 + " " + sizes[i]
        );
    };

    return (
        <>
            <Head title={`${post.title} - ${t("Blog")} - IGS Indonesia`} />

            <div className="min-h-screen bg-background">
                {/* Header Navigation */}
                <div className="border-b-1 bg-muted/30">
                    <div className="mx-auto max-w-screen-lg px-4 py-4">
                        <Button variant="ghost" asChild className="gap-2">
                            <Link href={localePath("/blog")}>
                                <ArrowLeft className="h-4 w-4" />
                                {t("Back to Blog")}
                            </Link>
                        </Button>
                    </div>
                </div>

                {/* Article Content */}
                <article className="mx-auto max-w-screen-lg px-4 py-8 lg:py-12">
                    {/* Featured Image */}
                    {post.featured_image && (
                        <div className="mb-8 overflow-hidden rounded-xl">
                            <img
                                src={post.featured_image}
                                alt={post.title}
                                className="w-full"
                            />
                        </div>
                    )}

                    {/* Title and Meta */}
                    <div className="mb-8">
                        <h1 className="mb-4 text-3xl font-bold text-foreground lg:text-4xl">
                            {post.title}
                        </h1>
                        <div className="flex items-center gap-4 text-muted-foreground">
                            <Badge variant="outline" className="gap-1.5">
                                <Calendar className="h-3 w-3" />
                                <span>
                                    {t("Published on")} {post.published_at}
                                </span>
                            </Badge>
                        </div>
                    </div>

                    {/* Excerpt */}
                    {post.excerpt && (
                        <div className="mb-8">
                            <p className="text-lg text-muted-foreground italic">
                                {post.excerpt}
                            </p>
                        </div>
                    )}

                    <Separator className="my-8" />

                    {/* Content */}
                    <div
                        className="prose prose-slate dark:prose-invert max-w-none"
                        dangerouslySetInnerHTML={{ __html: post.content }}
                    />

                    {/* Gallery */}
                    {post.gallery && post.gallery.length > 0 && (
                        <>
                            <Separator className="my-8" />
                            <div className="my-8">
                                <h2 className="mb-4 text-2xl font-bold text-foreground">
                                    {t("Gallery")}
                                </h2>
                                <div className="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                                    {post.gallery.map((image, index) => (
                                        <div
                                            key={index}
                                            className="overflow-hidden rounded-lg"
                                        >
                                            <img
                                                src={image}
                                                alt={`Gallery image ${index + 1}`}
                                                className="h-full w-full object-cover transition-transform hover:scale-105"
                                            />
                                        </div>
                                    ))}
                                </div>
                            </div>
                        </>
                    )}

                    {/* Attachments */}
                    {post.attachments && post.attachments.length > 0 && (
                        <>
                            <Separator className="my-8" />
                            <div className="my-8">
                                <h2 className="mb-4 text-2xl font-bold text-foreground">
                                    {t("Attachments")}
                                </h2>
                                <div className="grid grid-cols-1 gap-4 md:grid-cols-2">
                                    {post.attachments.map(
                                        (attachment, index) => (
                                            <Card key={index}>
                                                <CardHeader>
                                                    <CardTitle className="flex items-center gap-2 text-base">
                                                        <FileText className="h-4 w-4" />
                                                        {attachment.name}
                                                    </CardTitle>
                                                    <CardDescription>
                                                        {formatFileSize(
                                                            attachment.size,
                                                        )}
                                                    </CardDescription>
                                                </CardHeader>
                                                <CardContent>
                                                    <Button
                                                        variant="outline"
                                                        asChild
                                                        className="w-full gap-2"
                                                    >
                                                        <a
                                                            href={
                                                                attachment.url
                                                            }
                                                            download
                                                            target="_blank"
                                                            rel="noopener noreferrer"
                                                        >
                                                            <Download className="h-4 w-4" />
                                                            {t("Download")}
                                                        </a>
                                                    </Button>
                                                </CardContent>
                                            </Card>
                                        ),
                                    )}
                                </div>
                            </div>
                        </>
                    )}

                    {/* Back to Blog */}
                    <div className="mt-12 text-center">
                        <Button
                            asChild
                            variant="outline"
                            size="lg"
                            className="gap-2"
                        >
                            <Link href={localePath("/blog")}>
                                <ArrowLeft className="h-4 w-4" />
                                {t("Back to Blog")}
                            </Link>
                        </Button>
                    </div>
                </article>
            </div>
        </>
    );
}
