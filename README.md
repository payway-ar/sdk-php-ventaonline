Decidir SDK PHP
===============

Modulo para conexión con gateway de pago DECIDIR2

  + [Instalación](#instalación)
  + [Manual de Integración](#manualintegracion)
  + [Diagrama de secuencia](#diagrama-secuencia)
  + [Uso](#uso)
    + [Inicializar la clase correspondiente al conector](#initconector)
    + [Operatoria del Gateway](#operatoria)
      + [Health Check](#healthcheck)
      + [Ejecución del Pago](#payment)
      + [Listado de Pagos](#getallpayments)
      + [Información de un Pago](#getpaymentinfo)
      + [Anulación / Devolución Total de Pago](#refund)
      + [Anulación de Devolución Total](#deleterefund)
      + [Devolución Parcial de un Pago](#partialrefund)
      + [Anulación de Devolución Parcial](#deletepartialrefund)
    + [Tokenizacion de tarjetas de crédito](#tokenizaciontarjeta)
      + [Listado de tarjetas tokenizadas](#listadotarjetastokenizadas)	
      + [Solicitud de token de pago](#solicitudpagotokenizado)
      + [Ejecucion de pago tokenizado](#pagotokenizado)
      + [Eliminacion de tarjeta tokenizada](#eliminartarjetatokenizada)
    + [Integración con Cybersource](#cybersource)
      + [Parámetros Comunes](#parámetros-comunes)
      + [Retail](#retail)
      + [Ticketing](#ticketing)
      + [Digital Goods](#digital-goods)  	
  + [Tablas de referencia](#tablasreferencia)
    + [Códigos de Medios de Pago](#códigos-de-medios-de-pago)
	  + [Divisas Aceptadas](#divisasa)
    + [Provincias](#provincias)


## Instalación
Descargar la última versión del SDK desde el botón Download ZIP en (poner link).		
Se debe incluirse la carpeta del SDK dentro del proyecto.		
<br />		

**Observación**: Descomentar **extension=php_curl.dll** en el php.ini, ya que para la conexión al gateway se utiliza la clase curl del API de PHP.

[Volver al inicio](#decidir-sdk-php)

<a name="manualintegracion"></a>
## Manual de Integración

Se encuentra disponible en Gitbook el **[Manual de Integración Decidir2](https://decidir.api-docs.io/1.0/guia-de-inicio/)** para su consulta online, en este detalla el proceso de integración. En el mismo se explican los servicios y operaciones disponibles, con ejemplos de requerimientos y respuestas, aquí sólo se ejemplificará la forma de llamar a los distintos servicios usando la presente SDK.


<a name="diagrama-secuencia"></a>
## Diagrama de secuencia
![imagen de configuracion](https://www.planttext.com/plantuml/img/NP7DJiCm48JlUOfLkAI7149HIN90gaWE4H9K_5shnTuWqyIkrWvIUNhiYhQX5zixdfM_MQDmXk7D4iC5aupsf_GEX1c8XJ8LC66lVX16ZK7TCaQ7os3i30zZZnoimqZMCKuqa0HR_3JHHF9DDGab5LTWJQ-4SgCCHcSsf26Hw8pTryXVv70M_TdFdrEoYhjEYB8iYhJiFcxJ6vddQIclV5ai5cKf5uMydiUGl3uzD8-pCufJniFzDDYHyNABku6qix1YzOsEOBbgOKCxiChHsWVM5eLJHgy3qNlxieIwyKkMGNmEcMNnDCu9mVlo-JnfwyF8mbutzstTFly72rzK-KxTAHxGY_euvIZw1G00)</br>

[Volver al inicio](#decidir-sdk-php)

<a name="uso"></a>
## Uso

<a name="initconector"></a>
### Inicializar la clase correspondiente al conector.

El SDK-PHP permite trabajar con los ambientes de desarrollo y de producción de Decidir.
El ambiente se debe instanciar como se indica a continuación.
Instanciación de la clase `Decidir\Connector`
La misma recibe como parámetros la public key o private key provisto por Decidir para el comercio y el ambiente en que se trabajara.
```php

$keys_data = array('public_key' => 'e9cdb99fff374b5f91da4480c8dca741',
           'private_key' => '92b71cf711ca41f78362a7134f87ff65');

$ambient = "test";
//el segundo parametro es "test" o "prod"

$connector = new \Decidir\Connector($keys_data, $ambient);

```
*Nota:* La sdk incluye un completo al cual se debe acceder desde el navegador y allí te permitirá configurar las distintas opciones.

[<sub>Volver a inicio</sub>](#decidir-sdk-php)
<a name="operatoria"></a>

## Operatoria del Gateway
<a name="healthcheck"></a>
### Health Check
Este recurso permite conocer el estado actual de la API RESTful de DECIDIR.

```php
$connector = new \Decidir\Connector($header_http_data, $ambient);

$data = array();
$response = $connector->healthcheck()->getStatus($data);
$response->getName();
$response->getVersion();
$response->getBuildTime();
```
[<sub>Volver a inicio</sub>](#decidir-sdk-php)


<a name="payment"></a>

### Ejecución del Pago
Una vez generado y almacenado el token de pago, se deberá ejecutar la solicitud de pago más el token previamente generado.
Además del token de pago y los parámetros propios de la transacción, el comercio deberá identificar la compra con el site_transaction_id.

*Aclaracion* : amount es un campo double el cual debería tener solo dos dígitos.

```php
$connector = new \Decidir\Connector($header_http_data, $ambient);

$data = array(
      "site_transaction_id" => "12042017_20",
      "token" => "be211413-757b-487e-bb0c-283d21c0fb6f",
      "user_id" => "usuario",
      "payment_method_id" => 1,
      "bin" => "450799",
      "amount" => 5.00,
      "currency" => "ARS",
      "installments" => 1,
      "description" => "",
      "payment_type" => "single",
      "sub_payments" => array()
    );

$response = $connector->payment()->ExecutePayment($data);
$response->getId();
$response->getToken();
$response->getUserId();
$response->getpaymentMethodId();
$response->getBin();
$response->getAmount();
$response->getCurrency();
$response->getInstallments();
$response->getDescription();
$response->getPaymentType();
$response->getDateDue();
$response->getSubPayments();
$response->getStatus();
$response->getStatusDetails();
$response->getStatusDetails();
$response->getDate();
$response->getMerchantId();
$response->getEstablishmentName();
$response->getFraudDetection();
$response->getAggregateData();
```

[<sub>Volver a inicio</sub>](#decidir-sdk-php)


<a name="getallpayments"></a>

### Listado de Pagos

Mediante este recurso, se genera una solicitud de listado de pagos.
Este recurso admite la posibilidad de agregar los filtros adicionales:

- (opcional) offset: desplazamiento en los resultados devueltos. Valor por defecto = 0.
- (opcional) pageSize: cantidad máxima de resultados retornados. Valor por defecto = 50.
- (opcional) siteOperationId: ID único de la transacción a nivel comercio (equivalente al site_transaction_id).
- (opcional) merchantId: ID Site del comercio.

```php
$connector = new \Decidir\Connector($header_http_data, $ambient);

$data = array();
$response = $connector->payment()->PaymentList($data);
$response->getLimit();
$response->getOffset();
$response->getResults();
$response->getHasMOre();
```

[<sub>Volver a inicio</sub>](#decidir-sdk-php)

<a name="getpaymentinfo"></a>

### Información de un Pago

Mediante este recurso, se genera una solicitud de información de un pago previamente realizado, pasando como parámetro el id del pago.

```php
$connector = new \Decidir\Connector($header_http_data, $ambient);

$data = array();

$response = $connector->payment()->PaymentInfo($data, '574421');
$response->getId();
$response->getSiteTransactionId();
$response->getToken();
$response->getUserId();
$response->getPaymentMethodId();
$response->getCardBrand();
$response->getBin();
$response->getAmount();
$response->getCurrency();
$response->getInstallments();
$response->getPaymentType();
$response->getSubPayments();
$response->getStatus();
$response->getStatusDetails();
$response->getDate();
$response->getMerchantId();
$response->getEstablishmentName();
$response->getFraudDetection();
$response->getAggregateData();
```

[<sub>Volver a inicio</sub>](#decidir-sdk-php)

<a name="refund"></a>

### Anulación / Devolución Total de Pago

Mediante este recurso, se genera una solicitud de anulación / devolución total de un pago puntual, pasando como parámetro el id del pago.

```php

$data = array();
$response = $connector->payment()->Refund($data, '574671'); //574671 es el id de la operacion de compra
$response->getId();
$response->getAmount();
$response->getSubPayments();
$response->getStatus();

```

[<sub>Volver a inicio</sub>](#decidir-sdk-php)


<a name="deleterefund"></a>

### Anulación de Devolución Total

Mediante este recurso, se genera una solicitud de anulación de devolución total de un pago puntual, pasando como parámetro el id del pago y el id de la devolución.

```php

$data = array();
$response = $connector->payment()->deleteRefund($data, '574671', '164'); //574671 id de la operacion de compra, 164 id de la devolucion
$response->getResponse();
$response->getstatus();

```

[<sub>Volver a inicio</sub>](#decidir-sdk-php)

<a name="partialrefund"></a>

### Devolución Parcial de un Pago

Mediante este recurso, se genera una solicitud de devolución parcial de un pago puntual, pasando como parámetro el id del pago y el monto de la devolución.

```php

$data = array(
	"amount" => 1.00
	);
$response = $connector->payment()->partialRefund($data,'574673'); //574671 id de la operacion de compra
$response->getId();
$response->getAmount();
$response->getSubPayments();
$response->getStatus();


```

[<sub>Volver a inicio</sub>](#decidir-sdk-php)


<a name="deletepartialrefund"></a>

### Anulación de Devolución Parcial

Mediante este recurso, se genera una solicitud de anulación de devolución parcial de un pago puntual, pasando como parámetro el id del pago y el id de la devolución.

```php

$data = array();
$response = $connector->payment()->deleteRefund($data, '574671', '164'); //574671 id de la operacion de compra, 164 id de la devolucion parcial
$response->getResponse());
$response->getstatus());


```


<a name="Tokenizacion de tarjetas de crédito"></a>

## Tokenizacion de tarjetas de crédito

Esta funcionalidad permite que luego de realizar una compra con una tarjeta, se genere un token alfanumerico unico en el backend de Decidir, esto permite que a la hora de comprar nuevamente con esta tarjeta solo requerira el codigo de seguridad.
Como primer paso se debe realizar una un pago normal, el token generado estara en el campo "token" de la respuesta.

<a name="listadotarjetastokenizadas"></a>

### Listado de tarjetas tokenizadas

Este metodo permite conocer el listado de tarjetas tokenizadas que posee un usuario determinado. Para esto es necesario el nombre de usuario a la instancia de token

```php

$response = $connector->token()->tokensList($data, 'prueba'); //prueba, es el usuario dueño de la tarjeta de credito
var_dump($response);
var_dump($response->getTokens());

```

[<sub>Volver a inicio</sub>](#listadotarjetastokenizadas)


<a name="solicitudpagotokenizado"></a>

### Solicitud de token de pago

Al cargar el formulario de pago este mostrara las tarjetas tokenizadas que posee el usuario.

[<sub>Volver a inicio</sub>](#solicitudpagotokenizado)


<a name="pagotokenizado"></a>

### Ejecucion de pago tokenizado

Una vez que se obtiene el token a partir de la tarjeta tokenizada, se deberá ejecutar la solicitud de pago. Además del token de pago y los parámetros propios de la transacción, el comercio deberá identificar la compra con el "site_transaction_id" y "user_id".

```php

$connector = new \Decidir\Connector($header_http_data, $ambient);

$data = array(
      "site_transaction_id" => "12042017_20",
      "token" => "be211413-757b-487e-bb0c-283d21c0fb6f",
      "user_id" => "pepe",
      "payment_method_id" => 1,
      "bin" => "450799",
      "amount" => 10.00,
      "currency" => "ARS",
      "installments" => 1,
      "description" => "",
      "payment_type" => "single",
      "sub_payments" => array()
    );

$response = $connector->payment()->ExecutePayment($data);
$response->getId();
$response->getToken();
$response->getUserId();
$response->getpaymentMethodId();
$response->getBin();
$response->getAmount();
$response->getCurrency();
$response->getInstallments();
$response->getDescription();
$response->getPaymentType();
$response->getDateDue();
$response->getSubPayments();
$response->getStatus();
$response->getStatusDetails();
$response->getStatusDetails();
$response->getDate();
$response->getMerchantId();
$response->getEstablishmentName();
$response->getFraudDetection();
$response->getAggregateData();

```

[<sub>Volver a inicio</sub>](#pagotokenizado)


<a name="eliminartarjetatokenizada"></a>

### Eliminacion de tarjeta tokenizada

El servicio da la posibilidad de eliminar un token de tarjeta generadas, esto se logra instanciando token y utilizando el metodo tokenDelete(). Funciona enviando el token de la tarjeta tokenizada.

```php

$data = array();
$response = $connector->token()->tokenDelete($data, 'af49025a-f1b7-4363-a1cb-1ed38c3d4d75');

$response->getErrorType();
$response->getEntityName();
$response->getId();

```

[<sub>Volver a inicio</sub>](#eliminartarjetatokenizada)


<a name="cybersource"></a>

### Integración con Cybersource

Para utilizar el Servicio de Control de Fraude Cybersource, en la operación SendAuthorizeRequest, deben enviarse datos adicionales sobre la operación de compra que se quiere realizar.
Se han definido cinco verticales de negocio que requieren parámetros específicos, así como también parámetros comunes a todas las verticales.

[Volver al inicio](#cybersource)


#### Parámetros Comunes

Los parámetros comunes a todas las verticales deben enviarse junto con los datos específicos de cada uno. A continuación, describiremos los párametros comúnes que se deberan agregar a los datos de cada vertical al momento de instanciar la clase correspondiente.


```php
  $datos_cs = array(
    'send_to_cs' => 'true', 
    'channel' => 'Web/Mobile/Telefonica' //una de las tres opciones son validas
    'city'=>'Villa General Belgrano', //Ciudad de facturación, MANDATORIO.
    'country'=>'AR', //País de facturación. MANDATORIO. Código ISO. (http://apps.cybersource.com/library/documentation/sbc/quickref/countries_alpha_list.pdf)
    'customerid'=>'453458', //Identificador del usuario al que se le emite la factura. MANDATORIO. No puede contener un correo electrónico.
    'email'=>'decidir@hotmail.com', //Mail del usuario al que se le emite la factura. MANDATORIO.
    'firstname'=>'Juan' ,//Nombre del usuario al que se le emite la factura. MANDATORIO.
    'lastname'=>'Perez', //Apellido del usuario al que se le emite la factura. MANDATORIO.
    'phone_number'=>'541160913988', //Teléfono del usuario al que se le emite la factura. No utilizar guiones, puntos o espacios. Incluir código de país. MANDATORIO.
    'postalcode'=>' C1010AAP', //Código Postal de la dirección de facturación. MANDATORIO.
    'state'=>'B', //Provincia de la dirección de facturación. MANDATORIO. Ver tabla anexa de provincias.
    'street1'=>'Cerrito 740', //Domicilio de facturación (calle y nro). MANDATORIO.
    'street2'=>'Piso 8', //Complemento del domicilio. (piso, departamento). NO MANDATORIO.
    'currency'=>'ARS', //Moneda. MANDATORIO.
    'amount'=>'5.00', //Con decimales opcional usando el puntos como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. MANDATORIO. (Ejemplos:$125,38-> 125.38 $12-> 12 o 12.00)
  );
```

[Volver al inicio](#parámetros-comunes)


#### Retail

Los siguientes parámetros se deben enviar específicamente para la vertical Retail. Además se deben enviar datos específicos de cada producto involucrado en la transacción.


```php
  $datos_cs = array(
    'device_unique_id' => "devicefingerprintid",
    "days_to_delivery": "55",
    "dispatch_method": "storepickup",
    "tax_voucher_required": true,
    "customer_loyality_number": "123232",
    "coupon_code": "cupon22",

  );

  //Datos de productos, un array con los diferentes productos involucrados.
  $cs_productos = array(
    array(  // Producto 1
      'productcode'=>'electronic_good', //Código de producto. MANDATORIO. Valores posibles(adult_content;coupon;default;electronic_good;electronic_software;gift_certificate;handling_only;service;shipping_and_handling;shipping_only;subscription)
      'productdescription'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Descripción del producto. MANDATORIO.
      'productname'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Nombre del producto. MANDATORIO.
      'productsku'=>'LEVJNSL36GN', //Código identificador del producto. MANDATORIO.
      'totalamount'=>'1254.40', //CSITTOTALAMOUNT=CSITUNITPRICE*CSITQUANTITY "999999[.CC]" Con decimales opcional usando el puntos como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. MANDATORIO.
      'quantity'=>'1', //Cantidad del producto. MANDATORIO.
      'unitprice'=>'1254.40', //Formato Idem CSITTOTALAMOUNT. MANDATORIO    
    ),
    array(  // Producto 2
      'productcode'=>'default', //Código de producto. MANDATORIO. Valores posibles(adult_content;coupon;default;electronic_good;electronic_software;gift_certificate;handling_only;service;shipping_and_handling;shipping_only;subscription)
      'productdescription'=>'PENDRIVE 2GB KINGSTON', //Descripción del producto. MANDATORIO.
      'productname'=>'PENDRIVE 2GB', //Nombre del producto. MANDATORIO.
      'productsku'=>'KSPDRV2g', //Código identificador del producto. MANDATORIO.
      'totalamount'=>'248.40', //CSITTOTALAMOUNT=CSITUNITPRICE*CSITQUANTITY "999999[.CC]" Con decimales opcional usando el puntos como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. MANDATORIO.
      'quantity'=>'1', //Cantidad del producto. MANDATORIO.
      'unitprice'=>'248.40', //Formato Idem CSITTOTALAMOUNT. MANDATORIO     
    ),
    ......... // Otros productos
  );

```

Para incorporar estos datos en el requerimiento inicial, se debe instanciar un objeto de la clase Decidir\Data\Cybersource\Retail de la siguiente manera.

```php

$cybersource = new Decidir\Data\Cybersource\Retail(
                    $datos_cs,  // Datos de la operación
                    $cs_productos, // Datos de los productos
  );

$connector->payment()->setCybersource($cybersource->getData());

$data = array(
      "site_transaction_id" => "12042017_20",
      "token" => "be211413-757b-487e-bb0c-283d21c0fb6f",
      "user_id" => "usuario",
      "payment_method_id" => 1,
      "bin" => "450799",
      "amount" => 5.00,
      "currency" => "ARS",
      "installments" => 1,
      "description" => "",
      "payment_type" => "single",
      "sub_payments" => array()
    );

$response = $connector->payment()->ExecutePayment($data);

```

[Volver al inicio](#decidir-sdk-php)


#### Ticketing

Los siguientes parámetros se deben enviar específicamente para la vertical Ticketing. Además se deben enviar datos específicos de cada producto involucrado en la transacción.

```php
  $datos_cs = array(
    'days_to_event'=> 55, //Número de días en los que se desarrollara el evento. MANDATORIO
    'delivery_type'=>'Pick up', //Tipo de envío. MANDATORIO. Valores posibles: Pick up, Email, Smartphone, Other
  );

  //Datos de productos, un array con los diferentes productos involucrados.
  $cs_productos = array(
    array(  // Producto 1
      'productcode'=>'electronic_good', //Código de producto. MANDATORIO. Valores posibles(adult_content;coupon;default;electronic_good;electronic_software;gift_certificate;handling_only;service;shipping_and_handling;shipping_only;subscription)
      'productdescription'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Descripción del producto. MANDATORIO.
      'productname'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Nombre del producto. MANDATORIO.
      'productsku'=>'LEVJNSL36GN', //Código identificador del producto. MANDATORIO.
      'totalamount'=>'1254.40', //CSITTOTALAMOUNT=CSITUNITPRICE*CSITQUANTITY "999999[.CC]" Con decimales opcional usando el puntos como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. MANDATORIO.
      'quantity'=>'1', //Cantidad del producto. MANDATORIO.
      'unitprice'=>'1254.40', //Formato Idem CSITTOTALAMOUNT. MANDATORIO    
    ),
    array(  // Producto 2
      'productcode'=>'default', //Código de producto. MANDATORIO. Valores posibles(adult_content;coupon;default;electronic_good;electronic_software;gift_certificate;handling_only;service;shipping_and_handling;shipping_only;subscription)
      'productdescription'=>'PENDRIVE 2GB KINGSTON', //Descripción del producto. MANDATORIO.
      'productname'=>'PENDRIVE 2GB', //Nombre del producto. MANDATORIO.
      'productsku'=>'KSPDRV2g', //Código identificador del producto. MANDATORIO.
      'totalamount'=>'248.40', //CSITTOTALAMOUNT=CSITUNITPRICE*CSITQUANTITY "999999[.CC]" Con decimales opcional usando el puntos como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. MANDATORIO.
      'quantity'=>'1', //Cantidad del producto. MANDATORIO.
      'unitprice'=>'248.40', //Formato Idem CSITTOTALAMOUNT. MANDATORIO     
    ),
    ......... // Otros productos
  );

```

Para incorporar estos datos en el requerimiento inicial, se debe instanciar un objeto de la clase Decidir\Data\Cybersource\Ticketing de la siguiente manera.

```php
$cybersource = new Decidir\Data\Cybersource\Ticketing(
                    $datos_cs,  // Datos de la operación
                    $cs_productos, // Datos de los productos
  );

$connector->payment()->setCybersource($cybersource->getData());

$data = array(
      "site_transaction_id" => "12042017_20",
      "token" => "be211413-757b-487e-bb0c-283d21c0fb6f",
      "user_id" => "usuario",
      "payment_method_id" => 1,
      "bin" => "450799",
      "amount" => 5.00,
      "currency" => "ARS",
      "installments" => 1,
      "description" => "",
      "payment_type" => "single",
      "sub_payments" => array()
    );

$response = $connector->payment()->ExecutePayment($data);

```

[Volver al inicio](#decidir-sdk-php)


#### Digital Goods

Los siguientes parámetros se deben enviar específicamente para la vertical Digital Goods. Además se deben enviar datos específicos de cada producto involucrado en la transacción.


```php

$datos_digitalgoods = array(
  'device_unique_id': 'devicefingerprintid',
  'digital_goods_transaction_data': {
  'delivery_type': 'Pick up',
);

//Datos de productos, un array con los diferentes productos involucrados.
$cs_productos = array(
  array(  // Producto 1
    'productcode'=>'electronic_good', //Código de producto. MANDATORIO. Valores posibles(adult_content;coupon;default;electronic_good;electronic_software;gift_certificate;handling_only;service;shipping_and_handling;shipping_only;subscription)
    'productdescription'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Descripción del producto. MANDATORIO.
    'productname'=>'NOTEBOOK L845 SP4304LA DF TOSHIBA', //Nombre del producto. MANDATORIO.
    'productsku'=>'LEVJNSL36GN', //Código identificador del producto. MANDATORIO.
    'totalamount'=>'1254.40', //CSITTOTALAMOUNT=CSITUNITPRICE*CSITQUANTITY "999999[.CC]" Con decimales opcional usando el puntos como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. MANDATORIO.
    'quantity'=>'1', //Cantidad del producto. MANDATORIO.
    'unitprice'=>'1254.40', //Formato Idem CSITTOTALAMOUNT. MANDATORIO    
  ),
  array(  // Producto 2
    'productcode'=>'default', //Código de producto. MANDATORIO. Valores posibles(adult_content;coupon;default;electronic_good;electronic_software;gift_certificate;handling_only;service;shipping_and_handling;shipping_only;subscription)
    'productdescription'=>'PENDRIVE 2GB KINGSTON', //Descripción del producto. MANDATORIO.
    'productname'=>'PENDRIVE 2GB', //Nombre del producto. MANDATORIO.
    'productsku'=>'KSPDRV2g', //Código identificador del producto. MANDATORIO.
    'totalamount'=>'248.40', //CSITTOTALAMOUNT=CSITUNITPRICE*CSITQUANTITY "999999[.CC]" Con decimales opcional usando el puntos como separador de decimales. No se permiten comas, ni como separador de miles ni como separador de decimales. MANDATORIO.
    'quantity'=>'1', //Cantidad del producto. MANDATORIO.
    'unitprice'=>'248.40', //Formato Idem CSITTOTALAMOUNT. MANDATORIO     
  ),
  ......... // Otros productos
);  
  

```


Para incorporar estos datos en el requerimiento inicial, se debe instanciar un objeto de la clase Decidir\Data\Cybersource\Ticketing de la siguiente manera.

```php

$cybersource = new Decidir\Data\Cybersource\DigitalGoods(
                    $datos_cs,  // Datos de la operación
                    $cs_productos, // Datos de los productos
  );

$connector->payment()->setCybersource($cybersource->getData());
$response = $connector->payment()->ExecutePayment($data);

```

[Volver al inicio](#decidir-sdk-php)


<a name="tablasreferencia"></a>

## Tablas de Referencia

### Códigos de Medios de pago

| MEDIO DE PAGO | NOMBRE |
----------------|--------
| 1 | VISA |
| 6 | AMEX<sup>2</sup> |
| 8 | DINERS |
| 15 | MASTERCARD |
| 20 | MASTERCARD TEST |
| 23 | TARJETA SHOPPING |
| 24 | TARJETA NARANJA |
| 25 | PAGO FACIL |
| 26 | RAPIPAGO |
| 27 | CABAL |
| 29 | ITALCRED |
| 30 | ARGENCARD |
| 31 | VISA DEBITO<sup>1</sup> |
| 34 | COOPEPLUS |
| 36 | ARCASH |
| 37 | NEXO |
| 38 | CREDIMAS |
| 39 | TARJETA NEVADA |
| 41 | PAGOMISCUENTAS |
| 42 | NATIVA |
| 43 | TARJETA MAS |
| 44 | TARJETA CARREFOUR |
| 45 | TARJETA PYMENACION |
| 46 | PAYSAFECARD |
| 47 | MONEDERO ONLINE |
| 48 | CAJA DE PAGOS |
| 50 | BBPS |
| 51 | COBRO EXPRESS |
| 52 | QIDA |
| 53 | LAPOS WEB TRAVEL |
| 54 | GRUPAR |
| 55 | PATAGONIA 365 |
| 56 | TARJETA CLUD DIA |
| 59 | TARJETA TUYA |
| 60 | DISTRIBUTION |
| 61 | LA ANONIMA |
| 62 | CREDIGUIA |
| 63 | CABAL PRISMA |
| 64 | TARJETA SOL |
| 65 | AMEX MT<sup>2</sup> |
| 66 | MC DEBIT |
| 67 | CABAL DEBITO (Cabal24) |
| 99 | MAESTRO |

1. Visa Debito no acepta devoluciones parciales en ecommerce.
2. En el caso de AMEX se debe seleccionar solo una de las dos opciones. El uso del IdMediodePago = 65, en lugar del IdMediodePago=6, le permite al comercio operar en su Idsite con Multiples terminales provistas por  American Express, favoreciendo la alta disponibilidad de terminales cuando el volumen de transacciones del medio de pago es importante.ndo el volumen de transacciones del medio de pago es importante.


*Para la marca American Express, se deberá optar únicamente por uno de los dos IDs. El uso del ID = 65 le permite al comercio operar con múltiples terminales, favoreciendo la alta disponibilidad cuando el volumen de transacciones del medio de pago es importante. DECIDIR recomienda la utilización del ID = 65.

[Volver al inicio](#decidir-sdk-php)


### Divisas Aceptadas

| Divisa | Descripción | Código API
---------|-------------|--------
| AR$ | Pesos Argentinos | ARS |
| U$S | Dólares Americanos | USD | 

**NOTA** Si bien la API RESTful de DECIDIR admite compras en Dólares Americanos, la legislación argentina sólo permite transacciones en Pesos Argentinos. Es por esto que DECIDIR recomienda que todas las transacciones se cursen en dicha moneda.

[Volver al inicio](#decidir-sdk-php)


### Provincias

| Provincia | Código |
|----------|-------------|
| CABA | C |
| Buenos Aires | B |
| Catamarca | K |
| Chaco | H |
| Chubut | U |
| Córdoba | X |
| Corrientes | W |
| Entre Ríos | R |
| Formosa | P |
| Jujuy | Y |
| La Pampa | L |
| La Rioja | F |
| Mendoza | M |
| Misiones | N |
| Neuquén | Q |
| Río Negro | R |
| Salta | A |
| San Juan | J |
| San Luis | D |
| Santa Cruz | Z |
| Santa Fe | S |
| Santiago del Estero | G |
| Tierra del Fuego | V |
| Tucumán | T | 	

[Volver al inicio](#decidir-sdk-php)
