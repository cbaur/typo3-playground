# Frontend-Assets mit Laravel Mix / Webpack

Mit diesem Paket können ebenfalls Frontend-Assets wie *CSS*, *JS* und *Fonts* kompiliert werden.

Grundlage dessen ist die Bibliothek Laravel Mix (https://laravel-mix.com/docs/):

> ## What is Mix?
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

Im Standard wird der Inhalt des Verzeichnisses `frontend/static` in den Ordner `web/assets` kopiert.

## Vorteile
- JavaScript kann mit ES6 geschrieben werden, beim Kompilieren wird die in der Datei `.browserslistrc` festgelegte Browserkompatibilität automatisch berücksichtigt
- Das lokale Kompilieren des SCSS Codes bietet verschiedene Vorteile ggü. der Kompilierung mit PHP: es wird Autoprefixer für eine bessere Browserkompatibilität genutzt, Bootstrap kann in der neuesten Version verwendet werden, ...
- Webpack bietet ein enormes Potenzial zur Code-Optimierung
- durch Laravel Mix wird die Komplexität der Webpack_konfiguration stark vermindert

## Bitte beachten:
- `.env` bzw. `.env.*` Dateien sowie die Datei `.npmrc` sollen niemals ins GIT committed werden!
- es steht ein leerer Ordner '/web' zur Verfügung, der als Mapping-Pfad zum Web-Root auf dem Server genutzt werden kann.
Alle Theme und Extension Dateien sollten also hier landen.

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
