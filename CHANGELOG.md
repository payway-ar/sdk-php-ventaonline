# Changelog

Todos los cambios relevantes de la SDK PHP se documentan en este archivo.

El formato se basa en [Keep a Changelog](https://keepachangelog.com/es-ES/1.1.0/).
Para versiones anteriores a la 2.0.9 consultar el historial de tags y commits del repositorio.

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
