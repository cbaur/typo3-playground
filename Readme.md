# TYPO3 mit Composer installieren

## 1. Vorbereitung

### 1.1 Lokal
Lege den Kunden sowie das Abonnement (inkl. Datenbank) auf dem STRATO-Server an und lösche alle Dateien aus dem httpdocs/ Verzeichnis.
Erstelle außerdem ein neues Gitlab-Repository und checke es in PhpStorm aus (oder umgekehrt).

Konfiguriere nun wie gewohnt den SFTP-Zugang und das Mapping in PhpStorm. Du benötigst Shell-Zugriff auf den Server. 

Als nächstes solltest du eine Kommandozeile im Projektverzeichnis öffnen und folgenden Befehl ausführen:

<code>git pull git@gitlab.com:creationell_intern/typo3-installer.git</code>

Die Dateien aus diesem Repository werden heruntergeladen und in das Projekt-Repository integriert. Die Datei Readme.md kann an dieser Stelle geleert, gelöscht oder geändert werden.

Lade nun die Datei *composer.json* in das Webverzeichnis hoch.

### 1.2 Remote & GitLab
Verbinde dich nun per SSH auf den Server (PhpStorm: Tools > Start SSH session...) und führe folgenden Befehl aus:

<code>ssh-keygen -t rsa -b 4096 -C "creationell_guest@creationell.com"</code>

#### 1.2.1 Strato
 Behalte den Standard-Pfad für den Key bei und erstelle kein Passwort für das Key-File (drei mal Enter drücken). Es wird ein SSH Key für den User *creationell_guest* auf GitLab generiert, der dazu benötigt wird um die creationell TYPO3 Themes per Composer zu laden.
 
#### 1.2.2 Lokaler Server
Setze den Standard-Pfad für den Key auf <code>/var/www/clients/client1/[webXY]/home/[KUNED]/.ssh/id_rsa</code> und erstelle kein Passwort für das Key-File (drei mal Enter drücken). Es wird ein SSH Key für den User *creationell_guest* auf GitLab generiert, der dazu benötigt wird um die creationell TYPO3 Themes per Composer zu laden.

Mit <code>cat ~/.ssh/id_rsa.pub</code> kannst du dir den generierten Key anzeigen lassen. Kopiere dir die Zeichenkette nun in die Zwischenablage und logge dich mit dem Benutzer *creationell_guest* auf gitlab.com ein.
 Die Zugangsdaten sind auf dem Agenturserver abgelegt.
 
Füge den Key nun dem User hinzu. Klicke dazu oben rechts auf das Profilbild und wähle *Settings*. Wechsle anschließend auf
 den Reiter *SSH Keys* und füge den kopierten Key in das obere Textfeld ein. Vergib außerdem einen Titel für den Key, der am besten dem Projektnamen entsprechen sollte.
 
## 2. Composer-Installation
Wechsle in der SSH-Konsole auf das Web-Root-Verzeichnis, in dem die Datei *composer.json* liegt (z.B. <code>cd ~/httpdocs</code>).
 
Führe nun den Installationsbefehl für Composer aus:

<code>composer install</code>

Sobald der Befehl durchgelaufen ist (kann einige Zeit dauern, u.U. musst du bestätigen, dass gitlab.com als Quelle erlaubt ist), ist TYPO3 sowie alle von uns in jedem Projekt genutzten Extensions vorhanden.

### 2.1 Lokaler Entwicklungsserver
 Schlägt die Installation via Composer fehl, wird ggf. die falsche id_rsa Datei zum Aufbauen der Verbindung genommen.  
 Damit die korrekte Datei verwendet wird, mit <code>touch ~/.ssh/config</code> die Konfiguration für SSH anlegen.
 
 In der Datei folgenden Inhalt einfügen:
 
<code>HOST=gitlab
HOSTNAME=gitlab.com
USER=git
IdentityFile=~/.ssh/id_rsa</code>

Anschließend in der composer.json die <code>.com</code> bei den beiden Repositories crea_theme_bs3 und crea_theme_bs3_child entfernen.

## 3 TYPO3 Installationsroutine
Zuletzt muss noch die TYPO3 Installationsroutine durchlaufen werden. Erstelle dazu eine Datei *FIRST_INSTALL* auf Root-Ebene und rufe die Domain des Webs im Browser auf.

Falls eine Entwicklungsdomain verwendet wird, gibt TYPO3 im ersten Screen eine rote Warnmeldung bzgl. Trusted Host Patterns aus, die aber ignoriert werden kann.

Bei der Verknüpfung mit der Datenbank kann/sollte die Option "Socket" ausgewählt werden. Auch hier gibt TYPO3 u.U. eine Warnmeldung aus ("Socket konnte nicht gefunden werden."). Auch diese kann ignoriert werden.

Stelle nach der erfolgreichen Installation sicher, dass die Datei *FIRST_INSTALL* gelöscht wurde.

Nun können die via Composer installierten Extensions im Extension Manager aktiviert werden.