# TYPO3 mit Composer installieren

## 1. Vorbereitung

- Lege ein leeres JPKCLI Projekt an und konfiguriere alle relevanten Einstellungen in der
  jpkcli.ini (`j init project && j set edit`)
- Starte Docker (`j init docker && j up`)
- Erstelle einen Ordner `fileadmin` im Verzeichnis `project/web/` und entferne die beiden Dateien `index.html` sowie `index.php`

## 2. Composer-Installation

- Wechsle in den PHP Container: `j dc sh php`
- wechsle in das private-Verzeichnis: `cd private`
- Installiere
  TYPO3: `composer create-project creationell/typo3-installer:dev-typo3-10-lts --repository='{"type": "vcs", "url": "git@gitlab.com:creationell_intern/typo3-installer.git"}' --stability dev ./composer`
- Folgende Daten sind bei einer Standard-Installation mit Docker/JPKCLI einzugeben
  - Use existing database: `yes`
  - Database Host: `db`
  - Database Name: `db_1`
  - Database User: `db_1`
  - Database Password: `db_1`

## 3. Cleanup im TYPO3

- Logge dich in das TYPO3 Backend ein (BN: creationell, PW: password)
- Ändere das Admin Passwort
- Deaktiviere Extensions, die während der Entwicklungsphase nicht benötigt werden: `sourceopt`, `staticfilecache`
- Wenn du den Docker Proxy verwenden möchtest (empfohlen), dann inkludiere die Datei `proxy.ymal` in der
  Datei `config/dev.settings.yaml` und starte den Proxy (`j proxy`)

# Features

- Unterstützung von `.env` Dateien zum Setzen von Environment Variablen
- TYPO3 & Extension Konfiguration mittels YAML-Dateien im Verzeichnis `config`
- Automatisierte Installation von TYPO3 und ausgewählten Extensions
