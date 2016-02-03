# Terminplaner

## Requirements

Erstellen Sie die Geschäftslogik für einen einfachen Terminplaner. Dabei gelten folgende Regeln:

 - ein Benutzer ist durch einen Nicknamen und eine Mail-Adresse gekennzeichnet
 - ein Benutzer kann in verschiedene Terminplaner Termine eintragen
 - Ein Termin hat ein Anfangs und Enddatum sowie Namen, Raum und Teilnehmer
 - Jeder Terminplaner hat verschiedene Räume die gebucht werden können
 - Zu jedem Zeitpunkt darf ein Raum eines Terminplaners nur von einem Termin belegt sein
 - Teilnehmer können einem Termin auch nachträglich hinzugefügt werden
 - es soll möglich sein alle Termine eines Terminplaners auf der Konsole auszugeben
 - es soll möglich sein Terminüberschneidungen eines Benutzers auf der Konsole auszugeben

## Getting started

Forked euch am besten das Repo, dann ist es einfacher zum reviewen.

Ich benutze ein `Makefile`, weils angenehmer zu schreiben und v.a. lesen ist als ein Ant `build.xml`, aber ihr dürft ja machen wie oder was ihr wollt. Ihr könnt aber einfach die Befehle aus dem `Makefile` kopieren.

```
make 			# macht alles
make phpab		# oder make a macht autoload files
make test		# oder make t macht phpunit
make cov    	# oder make c macht phpunit coverage
make testdox	# oder make d macht phpunit mit testdox Ausgabe 
```
