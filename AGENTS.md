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
- Jeśli dodajesz walidator/logikę, mile widziane testy (PHPUnit/Behat), ale nie blokują merge.

## Jak korzystać z pliku
- Agent powinien przeczytać i stosować te wytyczne przed edycją. Jeśli nie wczyta ich automatycznie, wskaż ten plik w poleceniu.
