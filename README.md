Instruktioner:
==============

O.B.S
-----
Denna version är endast till för redovisning av kmom10 BTH 2013
En funktion är inbyggd så att man kan ta bort skapade databaser bara för att testa sidan.
Denna funktion ska man endast kunna göra en gång då man startar upp sidan.


1.-Ladda hem, clona, ladda upp
------------------------------

Antingen laddar du hem filerna manuellt eller så klonar du.  
1.- Skapa en mapp på din dator.  
2.- Med t.ex. git bash går du in i den skapade mappen  
3.- Skriv in raden under i git bash för att klona sidan till din mapp.  
>> git clone https://github.com/Tjacke/CI_kmom07.git  

4.- Ladda sedan upp filerna i mappen CI_kmom07 till roten på ditt hotell / host  

  
2.-Gör databasinställningar 
-----------------------------
Filen "database.php" hittar du här:  
application->config->database.php  

Öppna filen och leta reda på dessa rader:
Kör du lokalt ska det vara som det är såvida du inte har  
egna inställningar, då ska dessa fyllas i.   
>> $db['default']['hostname'] = 'localhost';  
>> $db['default']['username'] = 'root';  
>> $db['default']['password'] = '';  
>> $db['default']['database'] = 'site';  
  
Byt:  
>> 'localhost' 		till din host eller webhotell  
>> 'root' 			till ditt användarnamn   
>> ''			    till ett lösenord  
>> 'site'			till databasens namn    
  
O.B.S. innan du spara filen.  
  
Se till att den här raden har rätt prefix:  
  
>> $db['default']['dbdriver'] = "mysql";  

Databas typerna är t.ex. mysql, postgres, odbc, etc. >> Måsta vara små bokstäver.
Olika plattformar kräver olika prefix. BTH har prefix "mysql".
Det är viktigt för att sidan ska kunna skicka mail från servern när medlemmar söker
medlemsskap.  



3.-Ändra i .htaccess filen
--------------------------
Du hittar filen i rooten. Du ska se application mappen:  

Öppna filen .htaccess  
på rad 3 ändrar du "RewriteBase":  
Ändra sökvägen till den mapp där .htaccess filen och index.php filen är  
Du kanske måste kolla med din host som har webbhotellet vilken som är rätt sökväg.  

Exempel:   
>> RewriteBase /vision/  
>> RewriteBase /~username/phpmvc/kmom05/  

4.-Favicon
----------
Vill du ha en favicon så lägger du den i rootmappen och döper den till "favicon.png"   
och sparar över den som följer med.  
Vill du byta namn på favicon kan du göra det i filen: "header.php"  
Sökvägen till filen: application->views->includes->header.php  

5.-Klart att testa
------------------
När alla inställningar är gjorda så gå till första sidan och initiera databaserna.  
Följ sedan instruktionerna på sidan.  

De 4 databaser som initieras är:  
>> users  
>> temp-users - Skapas när man skapar users  
>> pagedata  
>> blogs  
 
En temporär användare skapas.  
Alla lösenord är md5 skyddade.  

//Lycka till!  

Vid frågor kontakta   
tjacke@hotmail.com  






