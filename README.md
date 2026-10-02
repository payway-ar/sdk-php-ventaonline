# Decidir SDK PHP

![banner](./docs/img/payway-banner.png)

Módulo de conexión con el gateway de pago **DECIDIR2**.

> [!IMPORTANT]
> ### 📘 La documentación completa está en el portal de Payway
> Este README es solo una introducción. Ahí vas a encontrar guías de integración, ejemplos y la referencia completa de la API.
>
> ### 👉 [Ir a la documentación del SDK PHP](https://documentacion-ventasonline.payway.com.ar/docs/sdk-s/branches/main/8eucdoynmh3ox-alcance)

---

## ⚙️ Cómo funciona

El **SDK PHP** se integra en el backend del comercio y cubre todo el ciclo de pago:

- Generación de tokens de pago
- Procesamiento de pagos en todas las verticales disponibles
- Creación y consulta de links de pago
- Devoluciones y anulaciones
- Consulta del historial de transacciones

> También hay SDKs de backend para **Java**, **.NET** y **Node.js**, con las mismas funcionalidades.

### 🧩 Opcional: SDK JavaScript

Si el comercio quiere capturar los datos de la tarjeta desde su frontend, puede sumar la **SDK JavaScript**. Esta SDK muestra un formulario de pago, toma los datos de la tarjeta y genera el token. Después, el backend usa ese token para procesar el pago con el SDK PHP.

| Modalidad | Generación del token | Procesamiento del pago |
|---|---|---|
| **Solo backend** | SDK PHP | SDK PHP |
| **Con formulario en el frontend** *(opcional)* | SDK JavaScript | SDK PHP |

---

## 🛟 Soporte

| Horario | Alcance |
|---|---|
| Lunes a viernes, de 9 a 18 h | Soporte técnico, atención comercial y soporte transaccional |
| Fuera de horario | Control de red |

- 📞 **Teléfono:** +54 11 4379 3460
- ✉️ **Implementaciones:** integraciones-ventasonline@payway.com.ar
- 🚨 **Control de red** (si hay una disrupción transaccional): controldered@payway.com.ar

---

<p align="center">
  <a href="https://documentacion-ventasonline.payway.com.ar/docs/sdk-s/ddw69qltg92u5-alcance">
    <img src="https://img.shields.io/badge/Documentaci%C3%B3n%20SDK%20PHP-Ir%20al%20portal%20%E2%86%92-00A3E0?style=for-the-badge" alt="Documentación SDK PHP">
  </a>
</p>