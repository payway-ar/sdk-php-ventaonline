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

Una transacción tiene **dos etapas**: primero se **genera un token de pago** y después se **procesa el pago**.

```
Cliente → Checkout → SDK JavaScript → Token → Backend (SDK PHP) → Pago
```

| Capa | SDK | Qué hace |
|---|---|---|
| **Frontend** | JavaScript | Captura los datos de pago en el checkout y genera el token |
| **Backend** | Java · **PHP** · .NET · Node.js | Tokens, pagos, links de pago, devoluciones, anulaciones y consultas de historial |

### Escenarios de integración

- **Checkout propio:** la SDK JavaScript genera el token y la SDK de backend procesa el pago.
- **Solo backend:** la SDK de backend hace todo, incluida la generación del token.

> [!NOTE]
> La SDK JavaScript **complementa** a las SDKs de backend, no las reemplaza.

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
  <a href="https://documentacion-ventasonline.payway.com.ar/docs/sdk-s/branches/main/8eucdoynmh3ox-alcance">
    <img src="https://img.shields.io/badge/Documentaci%C3%B3n%20SDK%20PHP-Ir%20al%20portal%20%E2%86%92-00A3E0?style=for-the-badge" alt="Documentación SDK PHP">
  </a>
</p>