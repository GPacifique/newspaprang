import i18n from "i18next";
import { initReactI18next } from "react-i18next";

const resources = {
    en: {
        translation: {
            // ================= GENERAL =================
            welcome: "Welcome",
            loading: "Loading...",
            search: "Search",
            submit: "Submit",
            cancel: "Cancel",
            save: "Save",
            update: "Update",
            delete: "Delete",
            edit: "Edit",
            create: "Create",
            read_more: "Read More",
            view_all: "View All",
            back: "Back",
            next: "Next",
 title: "News",
    feed: "Category Feed",
    news: "News",
    newsFeed: "News Feed",
    thisTopic: "this topic",
    description: "Discover curated perspectives, deep-dives, and real-time updates regarding {{category}}.",

    featuredStory: "Featured Story",
    views: "Views:",
    recent: "Recent",

    loadMore: "Load Additional Articles",

    emptyTitle: "Quiet Studio",
    emptyDescription: "No articles are currently posted under this category. Check back shortly for updates.",

    returnHome: "Return to full newsroom feed →",
    featured: "Featured",
    breaking: "Breaking",
    trending: "Trending",
    latest: "Latest",
    author: "Author",
    reporter: "Reporter",
    staffWriter: "Staff Writer",
    general: "General",
    featuredHighlight: "Featured Highlight",
    noData: "No data available",
    loading: "Loading...",
    categories: "Categories",
    latest: "Latest News",
    trending: "Trending",
    contact: "Contact",

            // ================= NAVIGATION =================
            home: "Home",
            politics: "Politics",
            education: "Education",
            sport: "Sport",
            world_news: "World News",
            technology: "Technology",
            economy: "Economy",
            health: "Health",
            entertainment: "Entertainment",

            // ================= SEARCH =================
            search_news: "Search news...",

            // ================= DASHBOARD =================
            trending_feed: "Trending Feed",
            view_analytics: "View Analytics Dashboard →",
            latest_dispatches: "Latest Dispatches",
            real_time_coverage: "Real-time dynamic coverage across all monitored beats",
            view_all_archives: "View All Archives",

            // ================= CATEGORIES =================
            world: "World",

            // ================= ARTICLES TITLES =================
            peace_from_prayer: "PEACE COMES FROM PRAYER",
            international_youth_forum:
                "AN INTERNATIONAL YOUTH FORUM HAS BEEN PREPARED IN RWANDA",
            africa_article:
                "🌍 Africa: The Cradle of Humanity and a Land of Diversity",
            forest_article:
                "🌳 Forests: The Lungs of Our Planet",

            // ================= AUTHORS =================
            journalist_user: "Journalist User",

            // ================= ARTICLE CONTENT =================
            peace_story:
                "Peace that comes from prayer. In the village of Kabeza lived Eric, a young man who was always anxious and without peace.",
            rwanda_forum_story:
                "An international youth forum has been organized in Rwanda, bringing together youth from all over the world.",
            africa_story:
                "Africa is the second largest continent in the world in both size and population.",
            forest_story:
                "Forests are important because they produce oxygen.",

            // ================= COMMON UI SENTENCES =================
            welcome_message: "Welcome to our newspaper website",
            latest_updates: "Stay updated with the latest news",
            no_articles_found: "No articles found",
            thank_you: "Thank you for visiting our website",
        },
    },

    fr: {
        translation: {
            home: "Accueil",
            politics: "Politique",
            education: "Éducation",
            sport: "Sport",
            world_news: "Actualités Mondiales",
            technology: "Technologie",
            economy: "Économie",
            health: "Santé",
            entertainment: "Divertissement",

            search_news: "Rechercher des nouvelles...",

            trending_feed: "Tendances",
            view_analytics: "Voir le tableau analytique →",
            latest_dispatches: "Dernières publications",
            real_time_coverage:
                "Couverture dynamique en temps réel",
            view_all_archives: "Voir toutes les archives",

            world: "Monde",

            peace_from_prayer: "LA PAIX VIENT DE LA PRIÈRE",
            international_youth_forum:
                "UN FORUM INTERNATIONAL DE LA JEUNESSE AU RWANDA",
            africa_article:
                "🌍 Afrique : Le berceau de l’humanité",
            forest_article:
                "🌳 Les forêts : Les poumons de la planète",

            journalist_user: "Utilisateur Journaliste",

            peace_story:
                "La paix vient de la prière. Eric vivait dans l’inquiétude sans paix intérieure.",
            rwanda_forum_story:
                "Un forum international de la jeunesse a été organisé au Rwanda.",
            africa_story:
                "L’Afrique est le deuxième plus grand continent du monde.",
            forest_story:
                "Les forêts produisent de l’oxygène.",

            welcome_message: "Bienvenue sur notre site de journal",
            latest_updates: "Restez informé des dernières nouvelles",
            no_articles_found: "Aucun article trouvé",
            thank_you: "Merci de visiter notre site",
        },
    },

    rw: {
        translation: {
            home: "Ahabanza",
            politics: "Politiki",
            education: "Uburezi",
            sport: "Siporo",
            world_news: "Amakuru Mpuzamahanga",
            technology: "Ikoranabuhanga",
            economy: "Ubukungu",
            health: "Ubuzima",
            entertainment: "Imyidagaduro",

            search_news: "Shakisha amakuru...",

            trending_feed: "Amakuru Akunzwe",
            view_analytics: "Reba imibare →",
            latest_dispatches: "Amakuru mashya",
            real_time_coverage: "Amakuru agezweho",
            view_all_archives: "Reba ububiko bwose",

            world: "Isi",

            peace_from_prayer: "UMUTUZO UVA MU GUSENGA",
            international_youth_forum:
                "HATEGUWE UMUHURO MPUZAMAHANGA MU RWANDA",
            africa_article:
                "🌍 Afurika: Inkomoko y'Ikiremwamuntu",
            forest_article:
                "🌳 Amashyamba: Ibihaha by'Isi",

            journalist_user: "Umunyamakuru",

            peace_story:
                "Umutuzo uturuka mu gusenga. Eric yari umuntu wahangayitse nta mahoro afite.",
            rwanda_forum_story:
                "Mu Rwanda hateguwe umuhuro mpuzamahanga w'urubyiruko.",
            africa_story:
                "Afurika ni umugabane wa kabiri munini ku isi.",
            forest_story:
                "Amashyamba atanga umwuka mwiza wa oxygen.",

            welcome_message: "Murakaza neza ku rubuga rwacu",
            latest_updates: "Komeza umenye amakuru mashya",
            no_articles_found: "Nta nkuru zabonetse",
            thank_you: "Murakoze gusura urubuga rwacu",
        },
    },
};

i18n.use(initReactI18next).init({
    resources,
    lng: localStorage.getItem("language") || "en",
    fallbackLng: "en",
    interpolation: {
        escapeValue: false,
    },
});

export default i18n;