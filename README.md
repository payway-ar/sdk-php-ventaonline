<a name="inicio"></a>
Payway SDK PHP
===============
![banner](./docs/img/payway_banner.png)</br>

### Aclaración
### ¡IMPORTANTE! El parámetro amount no debe contener ni puntos ni comas, ya que los últimos dos dígitos siempre serán utilizados para la parte decimal del importe. Ejemplo: 1200 ARS ≈ AR$ 12,00

|Monto| Ejemplo SDK |
| ------------ | ------------ |
| $1250,45 | 125045 |
| $1.500.250,50 | 150025050  |
| $3000,00 | 300000 |
   
## Introducción
El flujo de una transacción a través de las **sdks** consta de dos pasos, la **generaci&oacute;n de un token de pago** por parte del cliente y el **procesamiento de pago** por parte del comercio. Existen sdks espec&iacute;ficas para realizar estas funciones en distintos lenguajes que se detallan a continuaci&oacute;n:

+ **Generaci&oacute;n de un token de pago.**  Se utiliza alguna de las siguentes **sdks front-end** :
  + [sdk Javascript](https://github.compayway-ar/sdk-javascript-ventaonline)
+ **Procesamiento de pago.**  Se utiliza alguna de las siguentes **sdks back-end** :
  + [sdk Java](https://github.com/payway-ar/sdk-java-ventaonline)
  + [sdk PHP](https://github.com/payway-ar/sdk-php-ventaonline)
  + [sdk .Net](https://github.com/payway-ar/sdk-net-ventaonline)
  + [sdk Node](https://github.com/payway-ar/sdk-node-ventaonline)

## Consult&aacute;n la documentaci&oacute;n
PHP - API Doc ->  [sdk PHP API Doc](https://documentacion-ventasonline.payway.com.ar/docs/sdk-s/branches/main/ddw69qltg92u5-alcance)
