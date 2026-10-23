# Release notes — v3.0.0

Fecha: 2026-10-22

## Resumen

Esta versión mayor actualiza la SDK a PHP moderno. **Requiere PHP 8.3 o superior** y es compatible con PHP 8.4, 8.5 y 8.6. No hay cambios en la API pública de pagos, tokens, links ni cierres de lote.

## Breaking changes

- PHP mínimo: `>=8.3` (antes `>=5.3`). Las versiones anteriores de PHP deben seguir usando la rama 2.x.
- Nuevos requisitos: extensiones `ext-curl` y `ext-json`.
- `Decidir\Exception\SdkException`:
  - `$data` pasa a ser opcional.
  - `$previous` acepta `?\Throwable`.
  - Se eliminan las propiedades redeclaradas `$message`, `$code` y `$previous`.
- `AllowValue` y `EmptyValue` ahora informan el código `0` en lugar de `null`.
- `vendor/` deja de estar versionado en el repositorio: instalar con `composer require payway-ar/php-sdk-venta-online` o ejecutar `composer install`.

## Correcciones

- Se eliminan las deprecaciones de PHP 8.1 a 8.5: propiedades dinámicas, tipos nullable implícitos, `null` como código de excepción y `curl_close`.
- `Data\Response` lanzaba una clase `Exception` inexistente en su namespace; ahora lanza `\Exception`.
- Se elimina código inalcanzable en `Payment::deleteRefund`.
- `DECIDIR_VERSION` estaba desactualizada (1.5.0) y ahora refleja la versión de la SDK.

## Desarrollo

- Suite de tests con PHPUnit 11 (`composer test`).
- CI en GitHub Actions para PHP 8.3, 8.4 y 8.5 (8.6 experimental).

## Cómo actualizar

1. Verificar que el entorno use PHP 8.3 o superior con `curl` y `json`.
2. Ejecutar `composer update payway-ar/php-sdk-venta-online`.
3. Si se capturan `SdkException`, revisar que no dependan de las propiedades protegidas eliminadas.
