<?php

//   ANOMAIL DESKTOP - SKRYPT DO WYPISYWANIA POPRZEZ STRONE WWW
//   ==========================================================
//
//    WYMAGA PHP w wersji >=5.2.0
//
//    To jest skrypt do programu AnoMail Desktop,
//    ktory sluzy do wypisywania z listy mailingowej
//    poprzez strone internetowa firmy.
//
//    TEN SKRYPT UDOSTEPNIANY JEST BEZPLATNIE W TAKIEJ FORMIE W JAKIEJ JEST
//    NIE OFERUJEMY POMOCY TECHNICZNEJ W JEGO WDROZENIU ORAZ MODYFIKACJI
//    W KWESTII INSTALACJI SKRYPTU NA PANSTWA SERWERZE NALEZY KONTAKTOWAC SIE
//    Z PANSTWA INFORMATYKIEM LUB POMOCA TECHNICZNA W PANSTWA FIRMIE HOSTINGOWEJ
//
//    Skrypt moze byc wykorzystany takze do obslugi zgod na mailing
//    w takim przypadku nalezy umiescic na witrynie osobna kopie skryptu w innym katalogu
//    i zmienic nazwe z wypisz.php na zapisz.php a nastepnie ustawic w linii 76
//    temat na jaki ma reagowac program Anomail np. "Zgoda" zamiast "Rezygnacja"
//
//    JEZELI POTRZEBUJECIE PANSTWO BARDZIEJ FUNKCJONALNE ROZWIAZANIE DOPASOWANE
//    DO SPECYFIKI PANSTWA FIRMY TO ZAPRASZAMY DO KONTAKTU Z ZESPOLEM ANOMAIL
//    E-mail: pomoc@anomail.pl, Infolinia: (22) 203 56 66, (32) 441 60 14
//    http://www.anomail.pl/subskrypcja_online.html
//
//
//		JAK DZIALA TEN SKRYPT - ZAPOZNAJ SIE DOKLADNIE Z OPISEM
//		=======================================================
//
//		1. W liscie AnoMail wstawiasz link rezygnacji np. www.anomail.pl/wypisz.php?email={ODBIORCA#ADRES}
//		   AnoMail zamieni ten link na taka postac: www.anomail.pl/wypisz.php?email=adres@anomail.pl
//
//		2. Po kliknieciu w powyzszy link wyswietli sie strona internetowa z informacja "Zostales wypisany"
//
//		3. Skrypt wysle wiadomosc email na podany przez Ciebie adres e-mail z tematem "Rezygnacja"
//       Skrypt w polu FROM umieszcza adres osoby rezygnujacej. Mozesz zmodyfikowac skrypt aby
//       w polu FROM znajdowal sie Twoj adres a w tresci listu adres osoby rezygnujacej (patrz pkt. 5)
//
//		4. Lokalny modul subskrypcji AnoMail, odbiera poczte i jezel w temacie wykryje slowo "Rezygnacja"
//		   to pokaze, ze ktos wypisuje sie z Panstwa listy mailingowej
//
//		5. W AnoMail klikasz ikone "Zastrzezone" a nastepnie "Adresy -> Importuj z rezygnacji"
//			 Dzieki temu dodajesz osoby z rezygnacji, na liste zastrzezona i juz nic do nich nie wyslesz
//       (ta funkcja pobiera adresy z rezygnacji rownoczesnie z pol FROM, BODY, SUBJECT)
//
//		6. Ewentualnie w AnoMail klikasz ikone Subskrypcja i wybierasz "Podglad listy subskrybentow"
//			 a potem prawy klawisz myszki i "Dodaj rezygnacje do Zastrzezonych"
//       (ta funkcja pobiera adresy z rezygnacji tylko z pola FROM)
//
//
//		W TEJ SEKCJI ZMIEN PARAMETRY KONFIGURACJI SKRYPTU
//		=================================================

//		Tu wpisz adres e-mail na jaki skrypt ma przesylac wiadomosc e-mail ze strony WWW
//		Skonfiguruj lokalny modul subskrypcji AnoMail aby odbieral poczte z tego adresu 
//
//    $mail_do_subskrypcji = 'adres@anomail.pl';	// to jest przyklad
//

$mail_do_subskrypcji = 'WPISZ_SWOJ_EMAIL';	// UZUPELNIJ ZACHOWUJAC APOSTROFY I SREDNIK NA KONCU

//    Tu wpisz linki do strony z potwierdzeniem wypisania np. "ok.html"
//    W przypadku podania blednego maila do wypisania wyswietli sie strona "no.html"
//    Gdy wystapi problem techniczny to wyswietli sie strona "problem.html"
//    Wczesniej powyzsze trzy pliki dostosuj do swoich potrzeb i umiesc na swoim serwerze

$url_wypisany = 'ok.html';	// UWAGA! jesli strony sa poza biezacym katalogiem...
$url_problem = 'no.html';    // ... wpisz pelny url, np.: 'http://www.anomail.pl/wypisz/problem.html';
$email_problem = 'problem.html';  // PAMIETAJ O ZACHOWANIU APOSTROFOW I SREDNIKA NA KONCU


//		OD TEGO MIEJSCA W DOL NIC NIE ZMIENIAJ!!!!!!!!!!!
//		=================================================

error_reporting(0);

$email = trim($_GET['email']);
if (filter_var($email, FILTER_VALIDATE_EMAIL)){
	if(mail($mail_do_subskrypcji,'Rezygnacja','Zablokuj: '.$email,'From: '.$email)){
		header("Location: $url_wypisany");
	}else{
		header("Location: $email_problem");
	}
} else {
	header("Location: $url_problem");
}
?>