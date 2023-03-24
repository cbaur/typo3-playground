# Deployer Setup

Die Vorlage enthält ein vorgefertigte GitHub Action sowie ein Deployer Skript, das mit geringfügiger
Konfiguration dazu in der Lage ist, alle Website Daten auf einen Server zu laden.

## Einrichtung

1. Erstelle einen neuen SSH-Benutzer mit **keybasiertem Zugriff**.
Generiere dazu ein [neues SSH Key Pair](https://docs.github.com/de/authentication/connecting-to-github-with-ssh/generating-a-new-ssh-key-and-adding-it-to-the-ssh-agent#generating-a-new-ssh-key)
und hinterlege den Public Key im Benutzer in ISPconfig.


2. Hinterlege folgende **Action Secrets** in den Repository Einstellungen

GitHub: Repository > Settings > Secrets and Variables > Actions
```
AUTH_TOKEN -> https://cnet.creationell.com/?q=allgemeindienstleister/github-deployercomposer-token

PRIVATE_KEY -> der private Schlüssel des soeben erzeugten SSH Key Pairs

KNOWN_HOSTS -> Ausgabe des Befehls 'ssh-keyscan -H [REMOTE_SERVER_IP_OR_HOSTNAME]'

FONTAWESOME_TOKEN -> nur, wenn FontAwesoe Pro genutzt wird, siehe Token (nicht Passwort!) im [CNET](https://cnet.creationell.com/?q=allgemeindienstleister/fontawesome)
```

3. Passe die Konstanten am Anfang der Datei `_deployer/deploy.php` an

## Deployment testen

Das Deployment kann zunächst über das [GitHub Interface manuell getriggert](https://docs.github.com/en/actions/managing-workflow-runs/manually-running-a-workflow) werden.

Wähle dazu im Repository unter Actions den Workflow "deploy" aus und klicke auf "Run Workflow":

![](docs/img/run-github-action.png)

## Deployment automatisieren

Sobald die GitHub Action erfolgeich getestet wurde, kann diese automatisch
bei einer Änderung des `main` Branch getriggert werden.

Ändere dazu die Anweisung `on:` in der Datei `.github/workflows/deploy.yml`

```yaml
on:
  # in production use the following trigger to dispatch the deploy on every push to main
  push:
    branches:
      - main
```
