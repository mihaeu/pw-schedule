# Bookmarking Service

## Requirements

Erstellen Sie die Geschäftslogik für einen Bookmark Service (wer damit nichts anfangen kann: Delicious). Hierbei gelten folgende Regeln:

 - ein Benutzer hat einen Namen und eine E-Mail
 - das Benutzerpasswort muss mindestens acht Stellen haben und Sonderzeichen enthalten
 - Bookmarks bestehen aus einem Link, einem Kommentar und einem Zeitstempel
 - Benutzer können ihre Bookmarks in Kategorien unterteilen
 - Bookmarks anderer Benutzer können eingesehen werden
 - Wenn ein Benutzer ein Bookmark oder eine Kategorie als privat markiert, ist diese für andere Benutzer nicht mehr einsehbar
 - Bookmarks sollen erst nach Kategorie und danach anhand ihrer Aktualität sortiert werden
 - Benutzer bekommen Empfehlungen von Bookmarks anderer Benutzer, falls diese Benutzer ähnliche Kategorien haben

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