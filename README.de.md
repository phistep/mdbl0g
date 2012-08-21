# mdbl0g
A simple, file-based, markdown-driven blog engine *with* web interface.


## Features
* schlank
* hübsches, minimalistisches HTML5 Standard Responsive Layout
* dateibasiert, es wird keine Datenbank benötigt
* erstelle, bearbeite und lösche Beiträge direkt im Webinterface oder lade selbst Dateien hoch
* Webinterface mit live Preview
* keine Kommentare, keine Kategorien, keine Tags - nur Text*
* [Markdown](http://daringfireball.net/projects/markdown/)-Formatierung
* Volltextsuche
* RSS-Feed
* (abschaltbare) hübsche URLs
* Englische und Deutsche Lokalisation
* einfacher und schneller Installer


## *Mit Plugins anpassbar
Du kannst einfach Features zu deinem *mdbl0g* hinzufügen, indem du Plugins installierst. Lade einfach eines herunter und stecke es in den `plugins/` Ordner. Es gibt Plugins im [mdbl0g Plugin Directory](https://github.com/Ps0ke/mdbl0g-plugins).

Wenn du selbst Plugins entwickeln willst, sieh dir die [Plugin API](https://github.com/Ps0ke/mdbl0g/blob/master/plugins/README.md) an.


## Installation

### Vorraussetzungen
Du brauchst mindestens PHP Version `5.1.0`, Apache `mod_auth_basic` für HTTP Basic Auth (Admin Interface) und optional Apache `mod_rewrite` für hübsche URLs. Oder irgend einen anderen Webserver der Apache Konfigurationsdateien verwendet und `mod_auth_basic` und `mod_rewrite` unterstützt. Du brauchst keine Datenbank, weil *mdbl0g* dateibasiert ist.

Falls du keine Ahnung hast, was das alles bedeuten soll -- es wird höchstwahrscheinlich einfach funktionieren ;) Probiers einfach mal aus!

### Die Installation
[Download](https://github.com/Ps0ke/mdbl0g/zipball/master) die *mdbl0g* Dateien von GitHub und lade sie auf deinen Server. Du kannst auch das Repository mit `git` auschecken, das vereinfacht Updates:

    git clone git://github.com/Ps0ke/mdbl0g.git

Jetzt besuche `http://DEINEDOMAIN.de/mdbl0g/install/` mit deinem Browser, oder wo auch immer du die Dateien hochgeladen hast. Der Installer wird dich durch den einfachen Installtionsprozess begleiten. Wenn dir gesagt wird, du sollst den `install/` Ordner löschen, dann mach das und danach bist du fertig.

### Import
Da das Dateiformat sehr einfach ist, kannst du einfach deine Posts von deinem bisherigen Blog exportieren und mit *mdbl0g* weiter zu machen. Hier gibt es ein kleines Skript um [aus Wordpress zu importieren](https://gist.github.com/2553348/).


## Häufig gestellte Fragen
**F:** Ist ein dateibasiertes Blog nicht furchtbar langsam?

**A:** Nein. Netzwerklatenz ist ein viel größeres Problem für Performance als Lese/Schreibzugriffe. Zumindes wenn du vertretbaren Mengen Daten hantieren. Ich hab sogar selbst mal die Limits von *mdbl0g* getestet, du kannst das hier in meinem eigenen (*mdbl0g*-basierten) [Blog](http://blog.ps0ke.de/2012/08/15/20/27/mdbl0g-benchmark) nachlesen.



## Lizenz
[Die MIT Lizenz](http://opensource.org/licenses/MIT):

> Copyright (c) 2012 Philipp Stephan
>
> Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
>
> The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
>
> THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.



## Powered by
* Die wunderschöne ['Average' Schriftart](http://www.google.com/webfonts/specimen/Average) von Eduardo Tunni (Lizenz: SIL Open Font License, 1.1) mit Googles wunderbaren [Web Fonts API](http://www.google.com/webfonts/)
* [PHP Markdown 1.0.1o](https://github.com/michelf/php-markdown/) (Lizenz: BSD-style / GPL 2)
* [showdown.js](https://github.com/coreyti/showdown) (Lizenz: BSD)
* [PHP-like Javascript Date.format](http://jacwright.com/projects/javascript/date_format/) (Lizenz: MIT)
