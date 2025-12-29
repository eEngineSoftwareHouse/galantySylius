# Wytyczne dla agentów/AI – projekt galantySylius

## Kontekst
- Bazujemy na Sylius-Standard (upstream: `https://github.com/Sylius/Sylius-Standard.git`), nasze repo: `eEngineSoftwareHouse/galantySylius`.
- Pracujemy na gałęzi `main` (lokalnie wcześniej `2.2`), bez CI/CD; środowisko de facto produkcyjno-dev w jednym.

## Zasady zmian w kodzie
- Nie modyfikuj nic w `vendor/` ani `node_modules/`; wszystkie zmiany rób w warstwie aplikacji (`src`, `config`, `templates`/`themes`, `migrations`, `assets`).
- Szablony nadpisuj w `templates/...` (lub motywie), nie w vendorze.
- Nowe pola/feature’y: form type extensions, własne walidatory (np. NIP), migracje w `migrations/`.
- Konfiguracja/routing w plikach YAML/PHP w `config/`; nie hardcoduj w kodzie.
- Locki (`composer.lock`, `symfony.lock`, `yarn.lock`) muszą być wersjonowane; `vendor/`, `node_modules/`, `var/`, `public/media/`, `.env*` nie mogą trafić do repo (są w `.gitignore`).
- Sekrety (.env, klucze, tokeny) nigdy nie są commitowane.

## Git / remoty
- `origin` – nasze repo (`git@github.com:eEngineSoftwareHouse/galantySylius.git`), `upstream` – Sylius-Standard.
- Commituj na `main`; krótkie, opisowe komunikaty (np. `Add NIP validation`, `Fix checkout regex`).

## Testowanie / weryfikacja
- Brak CI – po istotnych zmianach przynajmniej manualny smoke na checkout.
- Gdy modyfikujesz kod/konfigurację PHP lub Twig, uruchom szybkie lintery:
  - `docker compose exec php php bin/console lint:twig templates`
  - (jeśli to logika PHP) `docker compose exec php ./vendor/bin/phpstan analyse` – nawet krótką ścieżkę lub pojedynczy plik, by złapać regresje.
- Jeśli dodajesz walidator/logikę, mile widziane testy (PHPUnit/Behat), ale nie blokują merge.

## Cache po zmianach frontu/szablonów
- Po każdej zmianie w plikach Twig/CSS/JS (assets/templates) czyść i dogrzej cache prod:
  - `docker compose exec php php bin/console cache:clear --env=prod --no-warmup`
  - `docker compose exec php php bin/console cache:warmup --env=prod --no-optional-warmers`
- Pamiętaj o przebudowie assetów, gdy zmieniasz CSS/JS: `docker compose exec nodejs yarn build` (w razie OOM zwiększ `NODE_OPTIONS=--max_old_space_size=3072`).

## Jak korzystać z pliku
- Agent powinien przeczytać i stosować te wytyczne przed edycją. Jeśli nie wczyta ich automatycznie, wskaż ten plik w poleceniu.
