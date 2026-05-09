import { usePage } from "@inertiajs/react";
import React, { createContext, useContext, useEffect, useState } from "react";

export type Locale = "id" | "en";

interface TranslationMap {
    [key: string]: string;
}

interface LanguageContextType {
    locale: Locale;
    setLocale: (locale: Locale) => void;
    t: (key: string, replacements?: Record<string, string | number>) => string;
    trans: (translations: Record<Locale, string>) => string;
}

interface PageProps {
    translations?: {
        id: TranslationMap;
        en: TranslationMap;
    };
    locale?: Locale;
    // eslint-disable-next-line @typescript-eslint/no-explicit-any
    [key: string]: any;
}

const LanguageContext = createContext<LanguageContextType | undefined>(
    undefined,
);

export function LanguageProvider({ children }: { children: React.ReactNode }) {
    const page = usePage<PageProps>();
    const serverLocale = page.props.locale || "id";
    const translations = page.props.translations;

    // Always use server locale as the source of truth
    const [locale, setLocaleState] = useState<Locale>(serverLocale);

    // Sync with server locale when it changes (e.g., after page navigation)
    useEffect(() => {
        if (serverLocale && serverLocale !== locale) {
            setLocaleState(serverLocale);
        }
    }, [serverLocale, locale]);

    const setLocale = (newLocale: Locale) => {
        // Rewrite the URL locale prefix in-place
        const currentPath = window.location.pathname;
        const pathWithoutLocale = currentPath.replace(/^\/(en|id)(\/|$)/, "/");
        window.location.href = `/${newLocale}${pathWithoutLocale}`;
    };

    /**
     * Laravel translation function - uses translations from Laravel
     * @param key - Translation key from Laravel language files
     * @param replacements - Key-value pairs for :placeholder replacement
     */
    const t = (
        key: string,
        replacements?: Record<string, string | number>,
    ): string => {
        const translationMap = translations?.[locale] || {};
        let translation = translationMap[key] || key;

        // Handle :placeholder replacements (Laravel style)
        if (replacements) {
            Object.entries(replacements).forEach(([placeholder, value]) => {
                translation = translation.replace(
                    new RegExp(`:${placeholder}`, "g"),
                    String(value),
                );
            });
        }

        return translation;
    };

    /**
     * Inline translation helper - for quick translations without Laravel keys
     * @param translations - Object with id and en keys
     */
    const trans = (translations: Record<Locale, string>): string => {
        return translations[locale] || translations.id;
    };

    useEffect(() => {
        // Update HTML lang attribute
        if (typeof document !== "undefined") {
            document.documentElement.lang = locale;
        }
    }, [locale]);

    return (
        <LanguageContext.Provider value={{ locale, setLocale, t, trans }}>
            {children}
        </LanguageContext.Provider>
    );
}

export function useLanguage() {
    const context = useContext(LanguageContext);
    if (context === undefined) {
        throw new Error("useLanguage must be used within a LanguageProvider");
    }
    return context;
}
