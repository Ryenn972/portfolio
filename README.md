# Ryenn MITH--CATAN — Portfolio

Portfolio personnel de Ryenn MITH--CATAN, étudiant en Bachelor Développeur Fullstack à 3W Academy, à la recherche d'une alternance dès que possible.

Site statique en HTML/CSS/JS pur, sans dépendance ni framework, hébergé sur GitHub Pages.

**Voir le site en ligne : [ryenn972.github.io/portfolio](https://ryenn972.github.io/portfolio/)**

## Aperçu

- **`index.html`** — le portfolio : profil, compétences, formation, expérience, projets, contact
- **`cv.html`** — une version HTML du CV, mise en page classique, avec export PDF via le navigateur (impression)

## Structure du projet

    portfolio-main/
    ├── index.html                  # Page d'accueil du portfolio
    ├── cv.html                     # CV en ligne
    ├── assets/
    │   ├── css/
    │   │   ├── style.css           # Styles du portfolio (thème sombre + accent jaune "solaire")
    │   │   └── cv.css              # Styles dédiés au CV (mise en page claire, deux colonnes)
    │   ├── js/
    │   │   └── script.js           # Nav active au scroll + activation en bas de page
    │   ├── cv/
    │   │   └── CV_alternance_Ryenn_MITH--CATAN.pdf   # CV en PDF
    │   └── img/
    │       ├── profile.jpg         # Photo de profil (portfolio)
    │       ├── cv_profile.jpg      # Photo de profil (CV)
    │       └── icon.png            # Favicon
    └── .github/
        └── workflows/
            └── static.yml          # Déploiement automatique sur GitHub Pages


## Design

- **Palette** : fond sombre (`#0B0D10`) avec accent doré/jaune "solaire" (`#F4C430`)
- **Polices** : Space Grotesk pour les titres, Inter pour le texte courant, JetBrains Mono pour les labels façon terminal
- **`cv.html`** utilise une palette et une mise en page volontairement différentes (claire, classique, deux colonnes) pour rester fidèle au CV utilisé sur LinkedIn/Indeed, tout en réutilisant les composants communs (`.topbar`, `.btn`) du portfolio

## Fonctionnalités

- Navigation sticky en bas d'écran (`.dock`), qui met en surbrillance la section actuellement visible au scroll (`IntersectionObserver`), avec une détection supplémentaire pour activer "Contact" une fois arrivé en bas de page
- Site entièrement responsive, construit **mobile first** (styles de base pensés pour mobile, enrichis par des `@media (min-width: ...)` pour les écrans plus larges)
- Balisage HTML sémantique (`<article>`, `<time>`, `<address>`, `aria-labelledby` sur chaque section) pour l'accessibilité et le référencement naturel (SEO)

## Déploiement

Le site est déployé automatiquement sur GitHub Pages via GitHub Actions (`.github/workflows/static.yml`) à chaque push sur la branche `main`. Aucune étape de build n'est nécessaire : les fichiers sont servis tels quels.

Pour prévisualiser en local, il suffit d'ouvrir `index.html` dans un navigateur, ou de lancer un petit serveur local (par exemple `python3 -m http.server`) depuis la racine du projet.

## Personnalisation

- **Contenu** : les informations (formations, expériences, projets) sont directement dans `index.html` et `cv.html`, à modifier au fil des mises à jour du CV
- **Photo** : remplacer `assets/img/profile.jpg` en conservant le même nom de fichier, ou en adaptant le `src` correspondant
- **Couleurs** : modifiables via les variables CSS en tête de `assets/css/style.css` et `assets/css/cv.css` (`:root { ... }`)

## Contact

- Email : ryenn.mith--catan@3wacademy.fr
- LinkedIn : linkedin.com/in/ryenn-mith-catan
- GitHub : github.com/Ryenn972
