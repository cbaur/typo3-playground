# Enthaltene Extensions (aka: creationell TYPO3 Vorlage)

## creationell Theme

- crea_theme
- crea_theme_child: wird individuell pro Website angepasst (aka. site_package)

## Privacy/DSGVO

- [amazing/media2click](https://docs.typo3.org/p/amazing/media2click/master/en-us/): 2-Klick Lösung für YouTube-/Vimeo-Embeds
- [dirkpersky/typo3-dp_cookieconsent](https://docs.typo3.org/p/dirkpersky/typo3-dp_cookieconsent/main/en-us/): Cookie-Consent Tool

## Bildoptimierung

- [b13/picture](https://github.com/b13/picture): ViewHelper für `<picture>` Elemente (Responsive Images)
- [christophlehmann/imageoptimizer](https://github.com/christophlehmann/imageoptimizer): Automatisierte Optimierung beim Upload/Verarbeiten von Bildern
- [plan2net/webp](https://github.com/plan2net/webp): Erstellt automatisch eine Kopie jedes hochgeladenen JPG/PNG/GIF im WebP Format

## TYPO3 Form Framework (EXT:form)

- [brotkrueml/form-country-select](https://docs.typo3.org/p/brotkrueml/form-country-select/master/en-us/): Formularelement zur Auswahl eines Landes

## SEO

- [brotkrueml/schema](https://docs.typo3.org/p/brotkrueml/schema/master/en-us/): API and view helpers for schema.org markup
- [clickstorm/cs-seo](https://docs.typo3.org/p/clickstorm/cs_seo/master/en-us/): Erweiterte OnPage-SEO Features
- [t3brightside/advancedtitle](https://github.com/t3brightside/advancedtitle): Präfix/Suffix für Seitentitel

## Performance

- [lochmueller/sourceopt](https://docs.typo3.org/typo3cms/extensions/sourceopt/): HTML minifier
- [lochmueller/staticfilecache](https://github.com/lochmueller/staticfilecache): Statischer Dateicache

## Backend Erweiterungen

- [fixpunkt/backendtools](https://docs.typo3.org/p/fixpunkt/backendtools/4.0/en-us): 6 admin tools
- [undefined/translate-locallang](https://docs.typo3.org/p/undefined/translate-locallang/2.8/en-us/): Visueller Editor für XLIFF Sprachdateien im Backend

## Inhalte

- [b13/container](https://github.com/b13/container/blob/master/README.md)
- [georgringer/news](https://docs.typo3.org/p/georgringer/news/main/en-us/)
- [mask/mask](https://docs.typo3.org/p/mask/mask/master/en-us/): Erstellen von Content Elementen
- [sitegeist/fluid-components](https://github.com/sitegeist/fluid-components): Framework zum Erstellen von Frontend Komponenten auf Basis von Fluid
- [sitegeist/fluid-styleguide](https://github.com/sitegeist/fluid-styleguide): Interaktive Dokumenatation der mit fluid-components erstellten Komponenten
- [tpwd/ke_search](https://docs.typo3.org/p/tpwd/ke_search/4.2/en-us/): Facettierte Suche

## CLI/Scheduler

- [tomasnorre/crawler](https://docs.typo3.org/p/tomasnorre/crawler/master/en-us/): Crawler für den Seitenbaum (Indexierung/Cache Warmup etc.)
- [zwo3/mask_kesearch_indexer](): ke_search Indexer für mask Elemente

## Weitere enthaltene Pakete

Diese Composer packages sind keine regulären TYPO3-Extension, beeinflussen aber den Umgang mit der TYPO3 Instanz:

- [helhum/dotenv-connector](https://github.com/helhum/dotenv-connector): Ermöglicht Auslesen von Variablen aus `.env`
- [helhum/typo3-config-handling](https://github.com/helhum/typo3-config-handling): Verwaltung der TYPO3 Konfiguration in YAML-Dateien (statt `LocalConfiguration.php`)
- [helhum/typo3-console](https://github.com/TYPO3-Console/TYPO3-Console): Erweiterte CLI-Tools für TYPO3

## Suggested extensions

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
  "t3g/querybuilder": "Filter records in the list module."
}
```

Bitte beachte, dass einzelne dieser Extensions noch nicht in einer (stabilen) Version für TYPO3 11 bereitstehen könnten.
