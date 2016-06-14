# parkplatz
PM Projekt für Parkplatzsuche

Datenbankkonfiguration muss vor der Nutzung lokal erstellt werden!

Dazu folgende Erklärung (Abschnitt: Configuring the Database ist relevant):

http://symfony.com/doc/current/book/doctrine.html

parameters.yml wird bewusst von git ignoriert! Es existiert allerdings eine Vorlage (parkplatz/app/config/parameters.yml.dist).
Eigentlich müsste es ausreichen das Passwort des root users einzufügen und die Datei als parameters.yml zu speichern.
Eventuell müsst ihr erst das Passwort eures MySQL Servers setzen.

Der Rest der Konfiguartion übernehmen die Services selbst!



