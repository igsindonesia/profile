import {
    Accordion,
    AccordionContent,
    AccordionItem,
    AccordionTrigger,
} from "@/components/ui/accordion";
import { Card } from "@/components/ui/card";
import { Input } from "@/components/ui/input";
import { Head, Link, usePage } from "@inertiajs/react";
import { ChevronRight, HelpCircle, Home, Search } from "lucide-react";
import { useState } from "react";

interface Faq {
    id: number;
    question: string;
    question_en: string;
    question_id: string;
    answer: string;
    answer_en: string;
    answer_id: string;
}

interface FaqCategory {
    id: number;
    name: string;
    name_en: string;
    name_id: string;
    description: string;
    description_en: string;
    description_id: string;
    icon: string;
    activeFaqs: Faq[];
}

interface Props {
    category: FaqCategory & {
        activeFaqs: Faq[];
    };
}

export default function FaqCategory({ category }: Props) {
    const { locale } = usePage<{ locale: string }>().props;
    const [searchTerm, setSearchTerm] = useState("");

    const getLocalizedName = () => {
        return locale === "en" ? category.name_en : category.name_id;
    };

    const getLocalizedDescription = () => {
        return locale === "en"
            ? category.description_en
            : category.description_id;
    };

    const getLocalizedQuestion = (faq: Faq) => {
        return locale === "en" ? faq.question_en : faq.question_id;
    };

    const getLocalizedAnswer = (faq: Faq) => {
        return locale === "en" ? faq.answer_en : faq.answer_id;
    };

    const filteredFaqs = category.activeFaqs.filter((faq) => {
        const question = getLocalizedQuestion(faq).toLowerCase();
        const answer = getLocalizedAnswer(faq).toLowerCase();
        const search = searchTerm.toLowerCase();
        return question.includes(search) || answer.includes(search);
    });

    return (
        <>
            <Head title={`${getLocalizedName()} - FAQ ASIIN`} />

            <div className="min-h-screen bg-background">
                <div className="container mx-auto px-4 py-8">
                    <div className="space-y-8">
                        {/* Breadcrumb */}
                        <nav className="flex" aria-label="Breadcrumb">
                            <ol className="flex items-center space-x-3">
                                <li>
                                    <Link
                                        href={category.url({ locale })}
                                        className="group text-muted-foreground transition-colors hover:text-primary"
                                    >
                                        <Home className="h-5 w-5 transition-colors group-hover:text-primary" />
                                        <span className="sr-only">
                                            {locale === "en"
                                                ? "Home"
                                                : "Beranda"}
                                        </span>
                                    </Link>
                                </li>
                                <li>
                                    <div className="flex items-center">
                                        <ChevronRight className="h-4 w-4 text-muted-foreground" />
                                        <Link
                                            href={category.url({ locale })}
                                            className="ml-3 text-sm font-medium text-muted-foreground transition-colors hover:text-primary"
                                        >
                                            FAQ
                                        </Link>
                                    </div>
                                </li>
                                <li>
                                    <div className="flex items-center">
                                        <ChevronRight className="h-4 w-4 text-muted-foreground" />
                                        <span className="ml-3 text-sm font-medium text-primary">
                                            {getLocalizedName()}
                                        </span>
                                    </div>
                                </li>
                            </ol>
                        </nav>

                        {/* Category Header */}
                        <Card className="border-0 bg-gradient-to-r from-primary to-primary/80 text-primary-foreground">
                            <div className="p-8">
                                <div className="flex items-center space-x-4">
                                    <div className="flex h-16 w-16 items-center justify-center rounded-xl bg-primary-foreground/20">
                                        <span className="text-3xl">
                                            {category.icon || "📄"}
                                        </span>
                                    </div>
                                    <div>
                                        <h1 className="mb-2 text-3xl font-bold">
                                            {getLocalizedName()}
                                        </h1>
                                        <p className="text-lg text-primary-foreground/80">
                                            {getLocalizedDescription()}
                                        </p>
                                        <div className="mt-3 flex items-center text-primary-foreground/70">
                                            <HelpCircle className="mr-2 h-4 w-4" />
                                            <span>
                                                {category.activeFaqs.length}{" "}
                                                {locale === "en"
                                                    ? "questions available"
                                                    : "pertanyaan tersedia"}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </Card>

                        {category.activeFaqs.length > 0 ? (
                            <>
                                {/* Search FAQ */}
                                <div className="mx-auto max-w-md">
                                    <div className="group relative">
                                        <Search className="absolute top-1/2 left-3 h-5 w-5 -translate-y-1/2 text-muted-foreground transition-colors group-focus-within:text-primary" />
                                        <Input
                                            type="text"
                                            className="pl-10"
                                            placeholder={
                                                locale === "en"
                                                    ? "Search questions in this category..."
                                                    : "Cari pertanyaan dalam kategori ini..."
                                            }
                                            value={searchTerm}
                                            onChange={(e) =>
                                                setSearchTerm(e.target.value)
                                            }
                                        />
                                    </div>
                                </div>

                                {/* FAQ Accordion */}
                                {filteredFaqs.length > 0 ? (
                                    <div className="mx-auto max-w-7xl">
                                        <Accordion
                                            type="single"
                                            collapsible
                                            className="space-y-4"
                                        >
                                            {filteredFaqs.map((faq) => (
                                                <AccordionItem
                                                    key={faq.id}
                                                    value={`faq-${faq.id}`}
                                                    className="overflow-hidden rounded-xl border border-border bg-card transition-all duration-300 hover:shadow-lg"
                                                >
                                                    <AccordionTrigger className="group px-6 py-5 text-left hover:no-underline">
                                                        <h3 className="pr-4 text-lg font-semibold text-foreground transition-colors duration-200 group-hover:text-primary">
                                                            {getLocalizedQuestion(
                                                                faq,
                                                            )}
                                                        </h3>
                                                    </AccordionTrigger>
                                                    <AccordionContent className="px-6 pb-6">
                                                        <div className="border-t border-border pt-4">
                                                            <div
                                                                className="prose prose-blue max-w-none leading-relaxed text-muted-foreground"
                                                                dangerouslySetInnerHTML={{
                                                                    __html: getLocalizedAnswer(
                                                                        faq,
                                                                    ),
                                                                }}
                                                            />
                                                        </div>
                                                    </AccordionContent>
                                                </AccordionItem>
                                            ))}
                                        </Accordion>
                                    </div>
                                ) : (
                                    /* No Results Message */
                                    <div className="py-16 text-center">
                                        <div className="mb-6 animate-bounce">
                                            <Search className="mx-auto h-16 w-16 text-primary/40" />
                                        </div>
                                        <h3 className="mb-2 text-xl font-semibold text-foreground">
                                            {locale === "en"
                                                ? "No results found"
                                                : "Tidak ada hasil ditemukan"}
                                        </h3>
                                        <p className="mx-auto max-w-md text-lg text-muted-foreground">
                                            {locale === "en"
                                                ? "Try searching with different keywords or browse all questions below."
                                                : "Coba cari dengan kata kunci yang berbeda atau lihat semua pertanyaan di bawah."}
                                        </p>
                                    </div>
                                )}
                            </>
                        ) : (
                            /* Empty State */
                            <div className="py-20 text-center">
                                <div className="mb-6 animate-pulse">
                                    <HelpCircle className="mx-auto h-20 w-20 text-primary/30" />
                                </div>
                                <h3 className="mb-3 text-2xl font-bold text-foreground">
                                    {locale === "en"
                                        ? "No FAQ Available Yet"
                                        : "Belum Ada FAQ"}
                                </h3>
                                <p className="mx-auto mb-8 max-w-md text-lg text-muted-foreground">
                                    {locale === "en"
                                        ? "This category doesn't have any questions and answers yet. Check back later!"
                                        : "Kategori ini belum memiliki pertanyaan dan jawaban. Coba lagi nanti!"}
                                </p>
                                <Link
                                    href={category.url({ locale })}
                                    className="inline-flex transform items-center rounded-xl bg-primary px-6 py-3 font-semibold text-primary-foreground shadow-lg transition-all duration-300 hover:scale-105 hover:bg-primary/90"
                                >
                                    {locale === "en"
                                        ? "Browse Other Categories"
                                        : "Lihat Kategori Lain"}
                                </Link>
                            </div>
                        )}
                    </div>
                </div>
            </div>
        </>
    );
}
