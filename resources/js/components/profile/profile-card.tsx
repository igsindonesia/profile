import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from "@/components/ui/card";

import { Button } from "@/components/ui/button";
import { FileDown } from "lucide-react";

interface PersonalInfo {
    name: string;
    picture: string | null;
    cv_en: string | null;
    cv_id: string | null;
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

interface ProfileCardProps {
    personalInfo: PersonalInfo;
    locale: string;
}

export function ProfileCard({ personalInfo, locale }: ProfileCardProps) {
    return (
        <Card className="overflow-hidden bg-gradient-to-br from-card to-muted/30 py-0">
            <div className="flex flex-col items-center gap-6 lg:flex-row lg:items-start lg:gap-0">
                {/* Profile Picture */}
                {personalInfo.picture && (
                    <div className="aspect-square px-6 pt-6 lg:aspect-auto lg:self-stretch lg:px-0 lg:pt-0">
                        <img
                            src={`/storage/${personalInfo.picture}`}
                            alt={personalInfo.name}
                            className="aspect-square h-full rounded-lg border-2 object-cover lg:aspect-auto lg:rounded-none lg:border-0 lg:border-r-2"
                        />
                    </div>
                )}

                {/* Profile Info */}
                <div className="flex-1 py-6 text-center lg:text-justify">
                    <CardHeader>
                        <CardTitle className="text-3xl">
                            {personalInfo.name}
                        </CardTitle>
                        <CardDescription className="text-lg font-medium text-primary">
                            {personalInfo.academic_position}
                        </CardDescription>
                        <CardDescription>
                            {personalInfo.institution}
                        </CardDescription>
                    </CardHeader>

                    <CardContent className="space-y-6">
                        <p className="text-base leading-relaxed text-foreground">
                            {locale === "en"
                                ? personalInfo.short_description.en
                                : personalInfo.short_description.id}
                        </p>

                        {/* Academic Profile Links */}
                        <div className="flex flex-wrap justify-center gap-8">
                            {personalInfo.scopus_id && (
                                <a
                                    href={`https://www.scopus.com/authid/detail.uri?authorId=${personalInfo.scopus_id}`}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="transition-opacity hover:opacity-80"
                                >
                                    <img
                                        src="/img/scopus.png"
                                        alt="SCOPUS"
                                        className="h-12 w-auto object-contain"
                                    />
                                </a>
                            )}
                            {personalInfo.sinta_id && (
                                <a
                                    href={`https://sinta.kemdiktisaintek.go.id/authors/profile/${personalInfo.sinta_id}`}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="transition-opacity hover:opacity-80"
                                >
                                    <img
                                        src="/img/sinta.jpg"
                                        alt="SINTA"
                                        className="h-12 w-auto object-contain"
                                    />
                                </a>
                            )}
                            {personalInfo.google_scholar_id && (
                                <a
                                    href={`https://scholar.google.com/citations?user=${personalInfo.google_scholar_id}`}
                                    target="_blank"
                                    rel="noopener noreferrer"
                                    className="transition-opacity hover:opacity-80"
                                >
                                    <img
                                        src="/img/scholar.jpg"
                                        alt="Google Scholar"
                                        className="h-12 w-auto object-contain"
                                    />
                                </a>
                            )}
                        </div>

                        <div className="flex flex-wrap justify-center gap-4 pt-2">
                            {personalInfo.cv_en && (
                                <Button
                                    asChild
                                    variant="outline"
                                    className="gap-2"
                                >
                                    <a
                                        href={`/storage/${personalInfo.cv_en}`}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <FileDown className="h-4 w-4" />
                                        CV (English)
                                    </a>
                                </Button>
                            )}
                            {personalInfo.cv_id && (
                                <Button
                                    asChild
                                    variant="outline"
                                    className="gap-2"
                                >
                                    <a
                                        href={`/storage/${personalInfo.cv_id}`}
                                        target="_blank"
                                        rel="noopener noreferrer"
                                    >
                                        <FileDown className="h-4 w-4" />
                                        CV (Indonesian)
                                    </a>
                                </Button>
                            )}
                        </div>
                    </CardContent>
                </div>
            </div>
        </Card>
    );
}
