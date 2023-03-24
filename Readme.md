# TYPO3 mit Composer installieren

## System Requirements
Zur Nutzung wird Composer und NodeJS mit NPM oder YARN benötigt: https://nodejs.org/en/

## 1. Vorbereitung

- Lege ein leeres JPKCLI Projekt an und konfiguriere alle relevanten Einstellungen in der
  jpkcli.ini (`j init project && j set edit`)
- Starte Docker (`j init docker && j up`)

## 2. Composer-Installation

- Wechsle in den PHP Container: `j dc sh php`
- wechsle in das web-Verzeichnis: `cd web`
- Installiere
  TYPO3: `composer create-project creationell/typo3-installer:dev-typo3-11-lts --repository='{"type": "vcs", "url": "git@gitlab.com:creationell_intern/typo3-installer.git"}' --stability dev .`
- Folgende Daten sind bei einer Standard-Installation mit Docker/JPKCLI einzugeben
   - Use existing database: `yes`
   - Database Host: `db`
   - Database Name: `db_1`
   - Database User: `db_1`
   - Database Password: `db_1`
   - NPM auth Token für FontAwesome: zu finden [hier im CNET](https://cnet.creationell.com/?q=allgemeindienstleister/fontawesome) (Token ist unten im Beschreibungsfeld hinterlegt)

## 3. Cleanup im TYPO3

- Logge dich in das TYPO3 Backend ein (BN: creationell, PW: password)
- Ändere das Admin Passwort
- Wenn du den Docker Proxy verwenden möchtest (empfohlen), dann inkludiere die Datei `proxy.ymal` in der
  Datei `config/dev.settings.yaml` und starte den Proxy (`j proxy`)

<<<<<<< Readme.md
## 4. NPM-Setup

- Wechsle in den Node Container `j dc sh nodejs`
- wechsle in das web-Verzeichnis: `cd html/web`
- Installiere die npm-Dependencies und kompiliere JS/SCSS: `npm install && npm run dev`

# Features

- Unterstützung von `.env` Dateien zum Setzen von Environment Variablen
- TYPO3 & Extension Konfiguration mittels YAML-Dateien im Verzeichnis `config`
- Automatisierte Installation von TYPO3 und ausgewählten Extensions
- Extension-Programmierung im Ordner `/packages`, Verwaltung der Extension mit Composer

### Enthaltene Extensions (aka: creationell TYPO3 Vorlage)

#### creationell Theme

- crea_theme_bs4
- crea_theme_bs4_child: wird individuell pro Website angepasst

#### Privacy/DSGVO

- [amazing/media2click](https://docs.typo3.org/p/amazing/media2click/master/en-us/): 2-Klick Lösung für YouTube-/Vimeo-Embeds
- [dirkpersky/typo3-dp_cookieconsent](https://docs.typo3.org/p/dirkpersky/typo3-dp_cookieconsent/main/en-us/): Cookie-Consent Tool

#### Bildoptimierung

- [b13/picture](https://github.com/b13/picture): ViewHelper für `<picture>` Elemente (Responsive Images)
- [christophlehmann/imageoptimizer](https://github.com/christophlehmann/imageoptimizer): Automatisierte Optimierung beim Upload/Verarbeiten von Bildern
- [plan2net/webp](https://github.com/plan2net/webp): Erstellt automatisch eine Kopie jedes hochgeladenen JPG/PNG/GIF im WebP Format

#### TYPO3 Form Framework (EXT:form)

- [brotkrueml/form-country-select](https://docs.typo3.org/p/brotkrueml/form-country-select/master/en-us/): Formularelement zur Auswahl eines Landes

#### SEO

- [brotkrueml/schema](https://docs.typo3.org/p/brotkrueml/schema/master/en-us/): API and view helpers for schema.org markup
- [clickstorm/cs-seo](https://docs.typo3.org/p/clickstorm/cs_seo/master/en-us/): Erweiterte OnPage-SEO Features
- [t3brightside/advancedtitle](https://github.com/t3brightside/advancedtitle): Präfix/Suffix für Seitentitel

#### Performance

- [dirkpersky/typo3-dp_http2](https://github.com/DirkPersky/typo3-dp_http2): HTTP2 Push für Assets
- [lochmueller/sourceopt](https://docs.typo3.org/typo3cms/extensions/sourceopt/): HTML minifier
- [lochmueller/staticfilecache](https://github.com/lochmueller/staticfilecache): Statischer Dateicache

#### Backend Erweiterungen

- [fixpunkt/backendtools](https://docs.typo3.org/p/fixpunkt/backendtools/4.0/en-us): 6 admin tools
- [friendsoftypo3/frontend-editing](https://docs.typo3.org/p/friendsoftypo3/frontend-editing/main/en-us/): Bearbeitung von TYPO3 Content Elementen in einer FE-Vorschau
- [undefined/translate-locallang](https://docs.typo3.org/p/undefined/translate-locallang/2.8/en-us/): Visueller Editor für XLIFF Sprachdateien im Backend

#### Inhalte

- [georgringer/news](https://docs.typo3.org/p/georgringer/news/main/en-us/)
- [gridelementsteam/gridelements](https://docs.typo3.org/typo3cms/extensions/gridelements/)
- [mask/mask](https://docs.typo3.org/p/mask/mask/master/en-us/): Erstellen von Content Elementen
- [sitegeist/fluid-components](https://github.com/sitegeist/fluid-components): Framework zum Erstellen von Frontend Komponenten auf Basis von Fluid
- [sitegeist/fluid-styleguide](https://github.com/sitegeist/fluid-styleguide): Interaktive Dokumenatation der mit fluid-components erstellten Komponenten
- [tpwd/ke_search](https://docs.typo3.org/p/tpwd/ke_search/4.2/en-us/): Facettierte Suche

#### CLI/Scheduler

- [tomasnorre/crawler](https://docs.typo3.org/p/tomasnorre/crawler/master/en-us/): Crawler für den Seitenbaum (Indexierung/Cache Warmup etc.)
- [zwo3/mask_kesearch_indexer](): ke_search Indexer für mask Elemente

### Weitere enthaltene Pakete

Diese Composer packages sind keine regulären TYPO3-Extension, beeinflussen aber den Umgang mit der TYPO3 Instanz:

- [helhum/dotenv-connector](https://github.com/helhum/dotenv-connector): Ermöglicht Auslesen von Variablen aus `.env`
- [helhum/typo3-config-handling](https://github.com/helhum/typo3-config-handling): Verwaltung der TYPO3 Konfiguration in YAML-Dateien (statt `LocalConfiguration.php`)
- [helhum/typo3-console](https://github.com/TYPO3-Console/TYPO3-Console): Erweiterte CLI-Tools für TYPO3

### Suggested extensions

In der `composer.json` werden weitere Extensions gelistet, die für im Falle einer entsprechenden Anforderung genutzt
werden könnten:

```json
{
  "t3g/blog":  "Flexible blog system for TYPO3",
  "extcode/cart": "Simple (yet extendable) shopping cart extension",
  "ichhabrecht/content-defender":  "Disallow certain content elements in columns of your BE layouts.",
  "in2code/fetchurl": "Fetch an url and show its content in the frontend.",
  "fixpunkt/fp-masterquiz":  "Quiz, polls and tests.",
  "clickstorm/go-maps-ext": "Google maps integration.",
  "derhansen/plain-faq":  "FAQ with list and detail view",
  "in2code/powermail": "Advanced forms.",
  "evoweb/recaptcha":  "Google Recaptcha integration for EXT:form",
  "derhansen/sf_event_mgt": "Event management & booking",
  "derhansen/sf_event_mgt_indexer":  "ke_search indexer for sf_event_mgt",
  "friendsoftypo3/tt-address": "Address & contacts management.",
  "apache-solr-for-typo3/solr":  "SOLR search integration.",
  "cobweb/flush_language_cache": "Adds a button to flush the l10n cache.",
  "apen/recordsmanager":  "Export any database record.",
  "wazum/sluggi": "Improved slug management.",
  "in2code/typoscript2ce": "Render typoscript as content element.",
  "ichhabrecht/mask-export":  "Export mask elements as extension.",
  "brotkrueml/typo3-matomo-widgets": "Show statistics from Matomo on the dashboard.",
  "kitzberger/form-mailtext":  "Customize email texts sent by EXT:form",
  "zotornit/webfonts": "Easy way to use selfhosted Google webfonts",
  "dirkpersky/typo3-dp_http2":  "Add HTTP2 Push header or preloads",
  "t3g/querybuilder": "Filter records in the list module."
}
```

Bitte beachte, dass einzelne dieser Extensions noch nicht in einer (stabilen) Version für TYPO3 11 bereitstehen könnten.

# Frontend-Boilerplate mit Laravel Mix / Webpack

Mit diesem Paket können ebenfalls Frontend-Assets wie *CSS*, *JS* und *Fonts* kompiliert werden.

Grundlage dessen ist die Bibliothek Laravel Mix (https://laravel-mix.com/docs/):

> ##What is Mix?
> Webpack is an incredibly powerful module bundler that prepares your JavaScript and assets for the browser. The only understandable downside is that it requires a bit of a learning curve.
>
> In an effort to flatten that curve, Mix is a thin layer on top of webpack for the rest of us. It exposes a simple, fluent API for dynamically constructing your webpack configuration.
>
> Mix targets the 80% usecase. If, for example, you only care about compiling modern JavaScript and triggering a CSS preprocessor, Mix should be right up your alley. Don't worry about researching the necessary webpack loaders and plugins. Instead, install Mix...

## Arbeiten mit SCSS und JS

Im Ordner '/frontend' befinden sich bereits vorbereitete SCSS und JS-Dateien, die nach Belieben erweitert werden können. Standardmäßig sind Bootstrap 4, FontAwesome 5 Pro, jQuery und Popper.js im Paket enthalten. Diese können entrsprechend erweitert werden.

Weitere Assets (Fonts/Icons/Images) können im entsprechenden Ordner in `public/assets` abgelegt werden.

## Kompilieren

1. Mit `npm run dev` bzw. `yarn run dev` wird Webpack im Development-Modus gestartet. Das Programm kompiliert die SCSS- und JS-Dateien in den in der `.env` festgelegten Ordner (i.d.R. 'web/assets').
2. Mit `npm run watch` bzw. `yarn run watch` wird Webpack im Development-Modus mit Filewatcher gestartet. Das Programm erkennt dann Änderungen im Ordner '/src' und kompiliert die SCSS- und JS-Dateien in den in der `.env` festgelegten Ordner (i.d.R. 'web/assets').
3. Mit `npm run prod` bzw. `yarn run prod` wird wird Webpack im Production-Modus gestartet.

Die kompilierten Dateien werden in `public/assets` abgelegt.

### Kompilierte JS-Dateien

Standardmäßig erzeugt unsere Konfiguration folgende Dateien im Ordner `web/assets/`:

- `js/manifest.js`: Webpack-Runtime, muss vor den anderen JS-Dateien eingebunden werden
- `js/vendor.js`: Bibliotheken wie jQuery, FontAwesome etc.
- `js/vendor.js.LICENSE.txt`: Übersicht und Lizenzinformationen der eingesetzten Bibliotheken
- `js/index.js`: Custom JavaScript

Die drei JS-Dateien müssen in der Reihenfloge wie oben gezeigt in den HTMl-Code eingebunden werden.

Die Quelle dieser drei Dateien ist `webpack/src/scripts/index.js`, d.h. alles was hier importiert oder geschrieben wird,
ist im kompilierten JS-Code enthalten.

#### Weitere JS-Dateien kompilieren

Manchmal möchte man einzelne Funktionsbestandteile ausgliedern, dann kann in der Datei `webpack.mix.js` der entsprechende Befehl ergänzt werden, z.B.:

```js
mix.js('frontend/scripts/custom.js', 'js');
```

Für die JS-Kompilierung stehen noch zahlreiche weitere Befehle zur Verfügung, z.B. zur Kompilierung von Vue (`mix.vue(...)`), TypeScript (`mix.ts(...)`)

Doku: https://laravel-mix.com/docs/6.0/mixjs

### Kompiliertes CSS

Im Standard wird die Datei `webpack/src/styles/index.scss` zur Datei `web/assets/css/index.css` kompiliert. Um weitere CSS-Dateien zu erzeugen, kann der folgende Befehl genutzt werden (in `webpack.mix.js`):

```js
mix.sass('frontend/styles/other.scss', 'css');
```

Auch hier werden andere Präprozessoren wie Less oder PostCSS unterstützt.

Doku: https://laravel-mix.com/docs/6.0/css

### Weitere Tasks

Laravel Mix kann vor, nach oder im Kompilierungsprozess weitere Tasks durchführen.

Im Standard wird der Inhalt des Verzeichnisses `webpack/public` in den Ordner `web/assets` kopiert.

## Vorteile
- JavaScript kann mit ES6 geschrieben werden, beim Kompilieren wird die in der Datei `.browserslistrc` festgelegte Browserkompatibilität automatisch berücksichtigt
- Das lokale Kompilieren des SCSS Codes bietet verschiedene Vorteile ggü. der Kompilierung mit PHP: es wird Autoprefixer für eine bessere Browserkompatibilität genutzt, Bootstrap kann in der neuesten Version verwendet werden, ...
- Webpack bietet ein enormes Potenzial zur Code-Optimierung
- durch Laravel Mix wird die Komplexität der Webpack_konfiguration stark vermindert

## Bitte beachten:
- `.env` bzw. `.env.*` Dateien sowie die Datei `.npmrc` sollen niemals ins GIT committed werden!
- es steht ein leerer Ordner '/web' zur Verfügung, der als Mapping-Pfad zum Web-Root auf dem Server genutzt werden kann. Alle Theme und Extension Dateien sollten also hier landen.

## FontAwesome 5 (Pro)

FontAwesome 5 wird standardmäßig in der Pro Version via `npm install` installiert.

Voraussetzung dafür ist ein gültiger FontAwesome Auth-Token in der Datei `.npmrc`. Über Environment Variablen (Einträge
in der Datei `.env`) kann zudem gesteuert werden, ob FontAwesome genutzt werden soll (Stanbdard: ja) und ob statt der
Pro-Version FA free verwendet werden soll (Standard: nein).

```dotenv
ENABLE_FONTAWESOME=1
ENABLE_FONTAWESOME_FREE=0
```

Sofern aktiviert werden im Rahmen des mitgelieferten Build Prozesses mit Laravel Mix die SVG Dateien aus dem FontAwesome
Paket in den Ordner `public/icons` kopiert, sodass diese zur weiteren Verwendung/Einbindung (z.B. mit dem IconViewHelper
des https://gitlab.com/creationell_t3extensions/crea_theme_bs4) zur Verfügung stehen. Dieses Verhalten kann in der Datei
`webpack.mix.js` natürlich angepasst werden (z.B. könnten stattdessen die Font Dateien kopiert werden, um FA als Font zu
verwenden).
