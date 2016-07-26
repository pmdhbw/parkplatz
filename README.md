#Aufsetzen der Parkplatz-Website:
===============================
Die Webseite ist unter http://www.parkplaetze.wo-zu-finden.de zu erreichen!

###Voraussetzungen:

Zum Ausführen muss der gewählte Webserver PHP unterstützen. Zusätzlich dazu muss eine MySql Datenbank vorhanden sein (MariaDB funktioniert auch) und ein User mit dessen Passwort muss zur Verfügung stehen. Internet Explorer bzw. Microsoft Edge werden nicht unterstützt!

###Durchführung einer lokalen Installation:

1.	Als Webserver Bundle ist am besten XAMPP zu verwenden, dieses kann <a href="https://www.apachefriends.org/de/index.html"  target="_blank">hier</a> heruntergeladen werden. Die Standardkonfiguration der Installation ist ausreichend.
2.	Nun XAMPP starten und den Webserver Apache & MySQL starten, danach unter localhost:80 testen.(1)
3.	(2) Jetzt muss das MySql root Passwort gesetzt werden, dazu über XAMPP die XAMPP Shell öffnen und folgenden Befehl ausführen: <code>mysqladmin.exe -u root password secret</code> (secret ist dabei das neue Passwor)
4.	Als nächstes können die Quelldateien von Github heruntergeladen werden (wahlweiße als zip oder eben natürlich über git clone), diese werden dann im Webroot entpackt (standardmäßig unter xampp_installationsordner/htdocs).
5.	Im nun entpackten Verzeichnis die Datei <code>parkplatz/app/config/parameters.yml.dist</code> öffnen und dort unter <code>database_user</code> und  <code>database_password</code> die eigenen Logindaten der MySql Installation eintragen und die Datei im gleichen Verzeichnis unter  parameters.yml speichern. (Bspl: <code>database_user: root datbase_password: secret</code>)
6.	Nun kann die Website über <code>http://localhost:80/parkplatz-master/parkplatz-master</code> aufgerufen werden. Bis die volle Funktionaltität vorhanden ist muss beim ersten Aufruf die Seite evtl. öfters neu geladen werden!

(1) Falls es nicht geht, versuchen den Webserverport umzulegen. Dazu über XAMPP Apache Config httpd.conf öffnen und die Option Listen ändern.

(2) Es kann auch ein bereits bekanntes Passwort oder ein eigener User verwendet werden
