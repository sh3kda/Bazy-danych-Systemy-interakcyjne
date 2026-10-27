# Kompendium PHP: Od Podstaw do Laravela

---

## Konkatenacja i praca z tekstem (Stringi)

W wielu językach (np. JavaScript, Python, C#) do łączenia tekstu używa się plusa (`+`). **W PHP jest inaczej!**

* `+` w PHP to **zawsze** operacja matematyczna.
* `.` (kropka) to operator łączenia ciągów tekstowych **(konkatenacji)**.

* `.` – łączy dwa kawałki tekstu.
* `.=` – dokleja tekst do istniejącej zmiennej (skrót od `$tekst = $tekst . 'nowy kawałek'`).

```php
<?php

$imie = "Marek";
echo "Cześć, " . $imie . "! Witaj w kursie."; 
// Wynik: Cześć, Marek! Witaj w kursie.

// Budowanie dłuższego tekstu krok po kroku:
$koszyk = "Twoje zamówienie:\n";
$koszyk .= "- Pizza Capricciosa\n";
$koszyk .= "- Sos czosnkowy\n";

echo $koszyk;
```

### Cudzysłowy pojedyncze (`'`) vs podwójne (`"`)
To jedno z najważniejszych ułatwień w PHP:

* **Pojedynczy apostrof (`'...'`)** – traktuje wszystko dosłownie. Jest minimalnie szybszy, ale nie odczytuje zmiennych.
* **Podwójny cudzysłów (`"..."`)** – włącza **interpolację zmiennych**. Zamiast łączyć tekst kropkami, można po prostu wstawić zmienną do środka.

```php
<?php

$gra = "Wiedźmin 3";
$cena = 99;

// Trudniej się czyta:
echo 'Kupiłem grę ' . $gra . ' za ' . $cena . ' zł.';

// Dużo prościej i czyściej (interpolacja):
echo "Kupiłem grę $gra za $cena zł.";

// Złożone wyrażenia wstawiać w wąsy {}:
$uzytkownik = ['login' => 'coder123'];
echo "Twój login to: {$uzytkownik['login']}";
```

> **Jak podejrzeć, co siedzi w zmiennej?**  
> `var_dump($zmienna);` – wyświetli wartość oraz jej dokładny typ.

---

## Deklarowanie typów i `declare(strict_types= 1)`

Domyślnie PHP jest językiem **słabo typowanym** (lubi zgadywać i konwertować typy w locie). 

Jeśli funkcja oczekuje liczby całkowitej (`int`), a podasz jej string `"10"`, domyślny PHP przymknie oko i zamieni to na liczbę. To bywa wygodne, ale prowadzi do ukrytych, trudnych do wykrycia błędów.

### Dlaczego warto włączać `strict_types`?
Wymusza bezwzględną dyscyplinę: jeśli funkcja chce `int`, a dostanie `'10'`, PHP natychmiast wyrzuci błąd `TypeError`. Dzięki temu błędy wyłapujesz od razu podczas pisania, a nie na produkcji u klienta.

```php
<?php
// WAŻNE: To musi być pierwsza linijka kodu w pliku!
declare(strict_types=1);

function policzCene(int $kwota, int $rabat): int {
    return $kwota - $rabat;
}

echo policzCene(100, 20); // Działa: 80

// echo policzCene("100", 20); 
// BŁĄD! TypeError: Argument #1 must be of type int, string given
```

---

## Typowanie parametrów i wartości zwracanych w funkcjach

Określanie typów sprawia, że Twój kod jest czytelny jak dokumentacja: od razu widać, co funkcja przyjmuje i co oddaje.

### Składnia ogólna:
```php
<?php
declare(strict_types=1);

function nazwaFunkcji(TypArg $parametr1, TypArg $parametr2): TypZwracany {
    // kod funkcji
    return $wynik;
}
```

### Specjalne typy zwracane: `void`
Jeśli funkcja tylko coś robi (np. loguje informację lub wyświetla tekst) i **nic nie zwraca przez `return`**, oznaczamy jej typ jako `void`:

```php
<?php
declare(strict_types=1);

function zapiszLog(string $wiadomosc): void {
    echo "[LOG]: $wiadomosc\n";
    // brak instrukcji return z wartością
}
```

### Nullable types (Typy opcjonalne / puste)
Czasami parametr lub wynik może być wartością danego typu **albo** niczym (`null`). Stawiamy wtedy znak zapytania `?` przed nazwą typu:

```php
<?php
declare(strict_types=1);

// ?string oznacza: przekazujesz tekst ALBO null
function wyslijEmail(string $odbiorca, ?string $temat): void {
    // Operator ?? (null coalescing) - jeśli $temat to null, użyj wartości domyślnej
    $ostatecznyTemat = $temat ?? "(Brak tematu)";
    echo "Wysyłanie do: $odbiorca, temat: $ostatecznyTemat\n";
}

wyslijEmail("jan@example.com", null); 
wyslijEmail("jan@example.com", "Oferta handlowa");
```

### Union Types (Typy alternatywne – PHP 8.0+)
Gdy funkcja może przyjąć np. liczbę całkowitą LUB zmiennoprzecinkową, łączymy je pionową kreską `|`:

```php
<?php
declare(strict_types=1);

function obliczPodatek(int|float $kwota): float {
    return $kwota * 0.23;
}
```

---

## Typowanie w Programowaniu Obiektowym (OOP)

Klasa to forma/szablon, a obiekt to gotowy wypiek. Dzięki typowaniu pól klasy upewniasz się, że nikt nie włoży do obiektu śmieciowych danych.

### Klasyczny zapis z typowaniem pól (PHP 7.4+):
```php
<?php
declare(strict_types=1);

class TemperatureConverter {
    // Pole klasy z typem float i wartością domyślną
    public float $lastResult = 0.0;

    public function toFahrenheit(float $celsius): float {
        $this->lastResult = ($celsius * 9 / 5) + 32;
        return $this->lastResult;
    }
}

$kalkulator = new TemperatureConverter();
echo $kalkulator->toFahrenheit(20.5);
```

### Nowoczesny zapis (PHP 8.0+): Promocja Właściwości Konstruktora
Zamiast ręcznie definiować pola i przepisywać je w konstruktorze, PHP 8 pozwala zrobić wszystko w jednym miejscu:

```php
<?php
declare(strict_types=1);

class Produkt {
    // Deklaracja pól, ich typów i przypisanie odbywa się w nawiasie konstruktora!
    public function __construct(
        public readonly int $id,     // readonly: nie można zmienić po utworzeniu obiektu
        public string $nazwa,
        public float $cena,
        public int $stanMagazynowy = 0 // wartość domyślna
    ) {}
}

$ksiazka = new Produkt(1, "Władca Pierścieni", 49.99, 10);
echo $ksiazka->nazwa; // "Władca Pierścieni"
```

---

## Szybkie pułapki dla początkujących

1. **`==` vs `===`**
   * Zawsze używaj `===` (porównuje wartość **oraz typ**).
   * `0 == "kot"` w starszych wersjach potrafiło zwrócić `true`. 
   * `0 === "kot"` da bezpieczne `false`.

2. **Dzielenie przez zero**
   * Od nowszych wersji PHP rzuca wyjątkiem `DivisionByZeroError` zamiast cichego ostrzeżenia.

3. **Operator `??` (Null Coalescing Operator)**
   * Pozwala elegancko ustalić wartość domyślną, gdy zmienna nie istnieje lub wynosi `null`:
   ```php
   $nazwaUzytkownika = $_GET['user'] ?? 'Gość';
   ```

---

## Dlaczego Laravel jest taki spoko? (I dlaczego warto się go uczyć)

Skoro umiem już czysty PHP, po co mi jakiś framework?
7 głównych powodów, dla których programiści kochają Laravela:

### 1. Eloquent ORM (Koniec z ręcznym SQL-em)
Zamiast pisać długie i podatne na błędy zapytania SQL, rozmawiasz z bazą danych jak z obiektami w PHP:

```php
// W czystym PHP (PDO):
// $stmt = $pdo->prepare('SELECT * FROM users WHERE active = 1 AND age > 18 ORDER BY created_at DESC');
// $stmt->execute();
// $users = $stmt->fetchAll();

// W Laravelu (Eloquent):
$users = User::where('active', 1)
             ->where('age', '>', 18)
             ->latest()
             ->get();

// Dodanie nowego rekordu:
$user = User::create([
    'name' => 'Kasia',
    'email' => 'kasia@example.com',
    'password' => bcrypt('sekret123')
]);
```

### 2. Czytelny i intuicyjny Routing
Definiowanie adresów URL w aplikacji jest proste i znajduje się w jednym pliku `routes/web.php`:

```php
Route::get('/artykuly', [ArticleController::class, 'index']);
Route::get('/artykuly/{id}', [ArticleController::class, 'show']);
Route::post('/artykuly', [ArticleController::class, 'store']);
```

### 3. Silnik szablonów Blade (Czyste widoki HTML)
Zamiast mieszać znaczniki `<?php echo $zmienna; ?>` z HTML-em, używamy prostego silnika Blade:

```html
<!-- Czysty PHP w widoku: brzydki i podatny na ataki XSS -->
<h1><?php echo htmlspecialchars($tytul); ?></h1>

<!-- Laravel Blade: automatycznie zabezpiecza przed atakami XSS! -->
<h1>{{ $tytul }}</h1>

@if($punkty > 100)
    <p>Jesteś graczem PRO!</p>
@endif

<ul>
@foreach($produkty as $produkt)
    <li>{{ $produkt->nazwa }} - {{ $produkt->cena }} zł</li>
@endforeach
</ul>
```

### 4. Artisan CLI – osobisty asystent w terminalu
Laravel posiada konsolowe narzędzie o nazwie Artisan. Zamiast ręcznie tworzyć pliki, foldery i klasy, wpisujesz komendę:

```bash
# Wygeneruje gotowy model, kontroler i plik migracji bazy danych:
php artisan make:model Product -mc

# Uruchomi lokalny serwer developerski:
php artisan serve
```

### 5. Migracje bazy danych (Wersjonowanie bazy jak w Git)
Koniec z ręcznym tworzeniem tabel w phpMyAdmin i wysyłaniem plików `.sql` koledze z zespołu. W Laravelu strukturę tabeli opisujesz w PHP:

```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('nazwa');
    $table->decimal('cena', 8, 2);
    $table->timestamps(); // automatycznie tworzy kolumny created_at i updated_at
});
```
Kiedy uruchamiam `php artisan migrate`, Laravel sam stworzy tabele w MySQL/PostgreSQL/SQLite.

### 6. Bezpieczeństwo od pierwszego dnia
Pisząc czysty kod, łatwo zapomnieć o zabezpieczeniach. Laravel zabezpiecza domyślnie przed:
* **SQL Injection** (dzięki mechanizmom PDO wbudowanym w Eloquent),
* **XSS** (Blade automatycznie filtruje niebezpieczny kod JavaScript wprowadzony przez użytkownika),
* **CSRF** (każdy formularz wymaga bezpiecznego tokenu `@csrf`, chroniącego przed podszywaniem się pod użytkownika).

### 7. Wszystko w jednym ekosystemie („Batteries Included”)
W czystym PHP trzeba samemu kminić:
* Jak zrobić logowanie, rejestrację i reset hasła (Laravel Breeze generuje to w 30 sekund).
* Jak wysyłać maile i powiadomienia (Slack, SMS, E-mail).
* Jak obsługiwać zadania w tle (tzw. Queues – np. generowanie PDF-ów bez zawieszania strony użytkownikowi).

Uczenie się czystego PHP daje zrozumienie fundamentów (zmienne, typy, pętle, klasy). Przejście na Laravela sprawia z kolei, że zaczynam budować pełnoprawne, nowoczesne aplikacje internetowe w ułamku czasu, jaki zająłby w surowym kodzie.
