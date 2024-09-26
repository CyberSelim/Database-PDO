Netland Admin Panel
Het Netland Admin Panel is een webapplicatie waarmee beheerders films en series kunnen beheren. De applicatie maakt gebruik van een MySQL database en biedt functies zoals inloggen, bekijken, bewerken en toevoegen van media-informatie.

Installatie
Database Importeren
Importeer de bijgeleverde MySQL database door het SQL-bestand uit te voeren in je MySQL-omgeving. Dit bestand bevat de vereiste tabellen en voorbeeldgegevens zoals gebruikersinformatie en media-items (films en series).

Configuratie
Zorg ervoor dat je config.php bestand correct is ingesteld met je database-inloggegevens, zodat de applicatie verbinding kan maken met je MySQL database.

Functies
Login Functionaliteit
De applicatie maakt gebruik van een loginpagina. Om toegang te krijgen tot de admin-pagina, dien je in te loggen met de inloggegevens die in de database zijn opgeslagen. De gebruikerssessie zorgt ervoor dat alleen geautoriseerde gebruikers toegang hebben.

Admin Dashboard
Na het inloggen word je doorgestuurd naar de admin-pagina. Hier kun je films en series beheren. Dit omvat de volgende mogelijkheden:

Details bekijken: Je kunt de details van verschillende films en series bekijken, inclusief titel, beschrijving, releasedatum, duur, en meer.

Media bewerken: Films en series kunnen eenvoudig worden bewerkt. Je kunt specifieke velden aanpassen, zoals titel, duur, releasedatum, land van herkomst, en een YouTube-trailer ID.

Media toevoegen: Het is mogelijk om nieuwe films en series toe te voegen aan de database. De applicatie ondersteunt het toevoegen van alle benodigde details zoals titel, lengte, en releasedatum.

Gebruik
Login
Open de applicatie in je browser en je wordt automatisch doorgestuurd naar de loginpagina (login.php). Voer je inloggegevens in om toegang te krijgen tot het admin-dashboard.

logout
je kan vervolgens uitloggen, waardoor je wordt doorverstuurd naar (login.php) om opnieuw te inloggen

Beheer Films en Series
Vanuit het dashboard kun je media beheren. Selecteer een film of serie om de details te bekijken, te bewerken of een nieuw item toe te voegen via de beschikbare formulieren.

Technische Specificaties
Backend: PHP met PDO voor database-interacties.
Frontend: HTML, CSS voor de styling.
Database: MySQL
Versiebeheer: Git
