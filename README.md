# Laboratoria: Bazy Danych i Systemy Interakcyjne
### Elektroniczne Przetwarzanie Informacji (EPI) – Uniwersytet Jagielloński

Repozytorium gromadzi zadania, kwerendy oraz projekty realizowane w ramach cotygodniowych laboratoriów

---

### Bazy danych (SQL & MySQL)
* **Techniki kwerendowania:**
  * Złączenia tabel (`INNER JOIN`, `LEFT/RIGHT JOIN`, `CROSS JOIN`, `SELF JOIN`).
  * Podzapytania (skorelowane i nieskorelowane, w klauzulach `WHERE`, `FROM`, `HAVING`).
  * Agregacja danych, kalkulacje oraz filtrowanie grup (`GROUP BY`, `HAVING`).
* **Rozszerzenia proceduralne i logika po stronie bazy:**
  * Procedury składowane (`STORED PROCEDURES`) i funkcje zdefiniowane przez użytkownika.
  * Wyzwalacze (`TRIGGERS`) do automatyzacji logiki biznesowej i audytu zmian.
  * Definiowanie więzów integralności (`CONSTRAINTS`, `FOREIGN KEY` z kaskadami).
* **Transakcyjność i spójność:**
  * Sterowanie transakcjami (`START TRANSACTION`, `COMMIT`, `ROLLBACK`).
  * Zasady ACID oraz analiza poziomów izolacji transakcji.
* **Administracja i optymalizacja:**
  * Tworzenie i analiza planu wykonania zapytań (`EXPLAIN`).
  * Indeksowanie (`B-Tree`, indeksy unikalne, kompozytowe) i przyspieszanie wąskich gardeł.
  * Zarządzanie użytkownikami, uprawnieniami (`GRANT`, `REVOKE`) oraz konfiguracja instancji MySQL.

### Projektowanie i modelowanie relacyjne
* **Analiza wymagań:** Identyfikacja reguł biznesowych oraz bytów w systemie.
* **Modelowanie strukturalne (ERD):** Sporządzanie konceptualnych i logicznych diagramów związków encji (kardynalności 1:1, 1:N, N:M).
* **Normalizacja:** Przekształcanie modeli do postaci normalnych (1NF, 2NF, 3NF / BCNF) w celu eliminacji redundancji i anomalii (wstawiania, modyfikacji, usuwania).
* **Implementacja fizyczna:** Skrypty DDL tworzące strukturę tabel, klucze główne/obce oraz typowanie kolumn.

### Aplikacje webowe i backend (PHP & Architektura)
* **Fundamenty i czysty kod:**
  * Standardy formatowania i dokumentacji kodu (**phpDoc**, PSR).
  * Narzędzia statycznej analizy kodu (np. PHPStan).
* **Programowanie zorientowane obiektowo (OOP):**
  * Klasy, obiekty, hermetyzacja, dziedziczenie, polimorfizm oraz interfejsy.
  * Zarządzanie zależnościami przy użyciu **Composera** oraz bibliotek zewnętrznych.
* **Architektura aplikacji internetowej:**
  * Warstwowy podział odpowiedzialności (model, widok, kontroler – MVC).
  * Routing żądań HTTP (mapowanie ścieżek URL na logikę kontrolerów).
  * Silniki szablonów i separacja logiki prezentacji od backendu.
  * Lokalizacja i umiędzynarodowienie aplikacji (i18n).
* **Komunikacja z bazą danych i bezpieczeństwo:**
  * Bezpieczna komunikacja PHP z MySQL za pomocą **PDO** (Prepared Statements).
  * Obsługa formularzy oraz walidacja i sanityzacja danych wejściowych.
  * Ochrona przed atakami: **SQL Injection**, **XSS** oraz **CSRF**.
  * Uwierzytelnianie i autoryzacja: bezpieczne haszowanie haseł (`password_hash`), mechanizmy sesji i kontrola dostępu użytkowników.

---
