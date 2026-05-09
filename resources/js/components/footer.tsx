import { useLanguage } from "@/contexts/language-context";
import { Link } from "@inertiajs/react";
import { Mail, MapPin, Phone } from "lucide-react";

export function Footer() {
    const { t, locale } = useLanguage();
    const localePath = (path: string) => `/${locale}${path}`;

    return (
        <footer className="w-full border-t border-border/40 bg-muted/30">
            <div className="mx-auto max-w-screen-lg px-4 py-8 md:px-6">
                <div className="grid grid-cols-1 gap-8 md:grid-cols-3">
                    {/* About Section */}
                    <div className="space-y-4">
                        <h3 className="text-lg font-semibold text-foreground">
                            IGS Indonesia
                        </h3>
                        <p className="text-sm text-muted-foreground">
                            {t(
                                "Academic profile showcasing research, publications, and professional contributions in the field of Information Technology.",
                            )}
                        </p>
                    </div>

                    {/* Quick Links */}
                    <div className="space-y-4">
                        <h3 className="text-lg font-semibold text-foreground">
                            {t("Quick Links")}
                        </h3>
                        <nav className="flex flex-col space-y-2">
                            <Link
                                href={localePath("/")}
                                className="text-sm text-muted-foreground transition-colors hover:text-primary"
                            >
                                {t("Home")}
                            </Link>
                            <Link
                                href={localePath("/contact")}
                                className="text-sm text-muted-foreground transition-colors hover:text-primary"
                            >
                                {t("Contact Us")}
                            </Link>
                        </nav>
                    </div>

                    {/* Contact Information */}
                    <div className="space-y-4">
                        <h3 className="text-lg font-semibold text-foreground">
                            {t("Contact")}
                        </h3>
                        <div className="space-y-3">
                            <div className="flex items-start space-x-3">
                                <MapPin className="mt-0.5 h-4 w-4 flex-shrink-0 text-primary" />
                                <p className="text-sm text-muted-foreground">
                                    UPN "Veteran" Jawa Timur
                                    <br />
                                    Jalan Rungkut Madya Gunung Anyar Surabaya
                                </p>
                            </div>
                            <div className="flex items-center space-x-3">
                                <Phone className="h-4 w-4 flex-shrink-0 text-primary" />
                                <a
                                    href="tel:0318796257"
                                    className="text-sm text-muted-foreground transition-colors hover:text-primary"
                                >
                                    031-8796257
                                </a>
                            </div>
                            <div className="flex items-center space-x-3">
                                <Mail className="h-4 w-4 flex-shrink-0 text-primary" />
                                <a
                                    href="mailto:igsusrama.if@upnjatim.ac.id"
                                    className="text-sm text-muted-foreground transition-colors hover:text-primary"
                                >
                                    igsusrama.if@upnjatim.ac.id
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                {/* Academic Profile Links */}
                <div className="mt-8 border-t border-border/40 pt-6">
                    <div className="flex flex-wrap items-center justify-center gap-6">
                        <a
                            href="https://www.scopus.com/authid/detail.uri?authorId=57189690019"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="transition-opacity hover:opacity-80"
                        >
                            <img
                                src="/img/scopus.png"
                                alt="SCOPUS"
                                className="h-8 w-auto object-contain"
                            />
                        </a>
                        <a
                            href="https://sinta.kemdiktisaintek.go.id/authors/profile/5977757"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="transition-opacity hover:opacity-80"
                        >
                            <img
                                src="/img/sinta.jpg"
                                alt="SINTA"
                                className="h-8 w-auto object-contain"
                            />
                        </a>
                        <a
                            href="https://scholar.google.com/citations?user=-KS9t4QAAAAJ"
                            target="_blank"
                            rel="noopener noreferrer"
                            className="transition-opacity hover:opacity-80"
                        >
                            <img
                                src="/img/scholar.jpg"
                                alt="Google Scholar"
                                className="h-8 w-auto object-contain"
                            />
                        </a>
                    </div>
                </div>

                {/* Copyright */}
                <div className="mt-8 border-t border-border/40 pt-6 text-center">
                    <p className="text-sm text-muted-foreground">
                        © {new Date().getFullYear()} Dr. Ir. I Gede Susrama Mas
                        Diyasa. {t("All rights reserved.")}
                    </p>
                </div>
            </div>
        </footer>
    );
}
