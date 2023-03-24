# TYPO3 mit Composer installieren

## System Requirements
Zur Nutzung wird Composer und NodeJS mit NPM oder YARN benötigt: https://nodejs.org/en/

## 1. Vorbereitung

- Erstelle ein neues GitHub-Repository auf Basis der Vorlage "creationell-dev/typo3-installer" (dieses Repository)
- Stelle sicher, dass du die aktuellste Version der JPKCLI nutzt (TYPO3 11 wird ab JPKCLI-Version 1.2.2 unterstützt)
- Lege ein leeres Projektverzeichnis in einem WSL2-Verzeichnis an und navigiere hinein: `mkdir <my-project> && cd <my-project>`
- initialisiere JPKCLI (Achtung: Typ ist **typo311**):
```
j init project
```
- Initialisiere Docker-Container:
```
j init docker && j up
```
- Navigiere in den Ordner `project/web` und leere diesen:
```
cd project/web
rm * .*
```
- Klone das Repository und öffne es in VS Code (Achtung: der Punkt am Ende gehört zum Befehl!)
```
git clone git@github.com/creationell-dev/<REPOSITORY-KEY> .
j c
```
- Starte Docker
```
j up
```

## 2. Composer-Installation

- Wechsle in den PHP Container:
```
j dc sh php
```
- wechsle in das web-Verzeichnis:
```
cd web
```
- Installiere TYPO3:
```
composer install
```
- Folgende Daten sind bei einer Standard-Installation mit Docker/JPKCLI einzugeben
   - GitHub Token: [hier kann dieser verwendet werden](https://cnet.creationell.com/?q=allgemeindienstleister/github-deployercomposer-token)
   - Database connection type: mysqli oder Enter drücken
   - User name for database server: `db_1`
   - User password for database server: `db_1`
   - Host name of database serve: `db`
   - TCP Port of database server: Enter drücken
   - Unix Socekt to connect to: Enter drücken
   - Use already existing database: `yes`
   - Name of the database: `db_1`
   - Name of the TYPO3 site
   - Specify the site base url: `http://127.0.0.1:<your-port>180` <-- the nginx_port in jpkcli.ini
   - Specify the web server you want to write configuration for: none oder Enter drücken
   - NPM auth Token für FontAwesome: zu finden [hier im CNET](https://cnet.creationell.com/?q=allgemeindienstleister/fontawesome) (Token ist unten im Beschreibungsfeld hinterlegt)

## 3. Cleanup

- Die Pakete `creationell/crea_distribution` und `creationell/creationell-typo3-setup` werden nicht mehr benötigt, deinstalliere diese mit composer:
```
composer remove creationell/crea_distribution
composer remove --dev creationell/creationell-typo3-setup
```
- Lösche diese beiden Pakete auch aus dem Verzeichnis `packages`
- Logge dich in das TYPO3 Backend ein (BN: creationell, PW: password)
- Ändere das Admin Passwort (ins CNET speichern)
- Ändere das Install Tool Passwort (ins CNET speichern)

## 4. Optional
- Wenn du den Docker Proxy verwenden möchtest (empfohlen), dann inkludiere die Datei `proxy.ymal` in der
  Datei `config/dev.settings.yaml` und starte den Proxy (`j proxy`)

## 5. NPM-Setup

- Wechsle in den Node Container `j dc sh nodejs`
- wechsle in das web-Verzeichnis: `cd html/web`
- Installiere die npm-Dependencies und kompiliere JS/SCSS: `npm install && npm run dev`

## 6. Deployment einrichten

siehe [Deployer-Setup](docs/Deployment.md)

# Features

- Unterstützung von `.env` Dateien zum Setzen von Environment Variablen
- TYPO3 & Extension Konfiguration mittels YAML-Dateien im Verzeichnis `config`
- Automatisierte Installation von TYPO3 und [ausgewählten Extensions](docs/Extensions.md)
- Automatisiertes Erstellen eines Basis-Seitenbaums mit Systemordnern für News, Suche etc.
- Integriertes Setup von Typoscript-Template und Site-Config
- Extension-Programmierung im Ordner `/packages`, Verwaltung der Extensions mit Composer
- [Vorlage für automatisertes Deployment auf einen Server](docs/Deployment.md)

## Enthaltene Extension

[Alle in der Vorlage enthaltenen Extensions sind hier gelistet](docs/Extensions.md)




