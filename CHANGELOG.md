# Changelog

Todos los cambios relevantes de la SDK PHP se documentan en este archivo.

El formato se basa en [Keep a Changelog](https://keepachangelog.com/es-ES/1.1.0/).
Para versiones anteriores a la 2.0.9 consultar el historial de tags y commits del repositorio.

## [3.0.0] - 2026-10-22

### Cambiado

- **Breaking:** la SDK ahora requiere PHP 8.3 o superior (compatible con PHP 8.4, 8.5 y 8.6). Se agregan `ext-curl` y `ext-json` como requisitos en `composer.json`.
- `SdkException`: el parámetro `$data` pasa a ser opcional y `$previous` acepta `?\Throwable`; se eliminan las propiedades redeclaradas.

### Corregido

- Se eliminan deprecaciones de PHP 8.1 a 8.5: propiedades dinámicas, tipos nullable implícitos, `null` como código de excepción y `curl_close`.
- `Data\Response` lanzaba una clase `Exception` inexistente en su namespace.
- Se elimina código inalcanzable en `Payment::deleteRefund`.

### Agregado

- Tests con PHPUnit (`tests/`, `phpunit.xml.dist`) y workflow de CI para PHP 8.3 a 8.6.

## [2.0.10]

Versión de mantenimiento: no agrega funcionalidades. El único cambio de comportamiento es el de `origin_platform` en `GenerateLink` (ver "Corregido").

### Eliminado

- Se elimina el campo `notifications_url` de los campos declarados para la generación de links de pago (GenerateLink), ya que este campo nunca tuvo uso.

Ante la necesidad de contar con un webhook, actualmente se está trabajando en una solución para los comercios que requieran esta funcionalidad. Para más información o consultas, pueden comunicarse a través de los canales disponibles.

### Corregido

- `GenerateLink` ahora envía siempre `origin_platform` con el valor fijo `SDK-PHP`.

### Documentación

- Corrección de ejemplos de código PHP del README con errores de sintaxis.
- Se agrega este archivo (`CHANGELOG.md`) y se lo enlaza desde el README.

## [2.0.9] - 2026-09-24

### Agregado

- Historial de links de pago: `GetCheckoutHistory($data)` (FONLP02-5816).
- Historial de una transacción de checkout-payment-button: `GetCheckoutTransactionHistory($chargeId)` (FONLP02-5996).

### Documentación-

- README: nuevas secciones "Historial de Links de Pago" e "Historial de una Transacción".
- README: el ejemplo del historial usa `platform` `SDK-PHP` y `site_id`.
