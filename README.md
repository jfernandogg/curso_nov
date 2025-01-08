# Integración JotForm con Bold Payments

Este proyecto implementa una integración entre formularios JotForm y el sistema de pagos Bold para procesar donaciones o pagos en Colombia.

## Características

- Integración con formularios JotForm existentes
- Botón de pago con Bold
- Manejo seguro de API keys a través de variables de entorno
- Soporte para pagos en COP (Pesos Colombianos)
- Descripción personalizada del pago usando ID del usuario

## Estructura del Proyecto

```
curso_nov/
├── .env                    # Variables de entorno (API keys)
├── index.html              # Formulario JotForm modificado
├── linkredir.php           # Manejador de redirección a Bold
├── instruccionesbold.md    # Guía de implementación
└── README.md               # Este archivo
```

## Requisitos

- Servidor web con PHP 7.0+
- Cuenta en Bold Payments
- Formulario JotForm existente
- API Key de Bold

## Configuración

1. Clonar el repositorio
2. Crear archivo .env con la API key de Bold:
```
BOLD_API_KEY=tu_api_key_aqui
```
3. Ajustar los IDs de los campos en index.html según tu formulario JotForm

## Uso

El proyecto añade un enlace "Pagar con Bold" junto al campo total en el formulario. Cuando el usuario hace clic:

1. Se captura el monto total del formulario
2. Se obtiene el ID del usuario
3. Se genera un link de pago usando la API de Bold
4. Se redirige al usuario a la pasarela de pago

## Seguridad

- Las API keys se manejan mediante variables de entorno
- Las transacciones se procesan en el servidor de Bold
- El formulario usa HTTPS para la transmisión de datos

## Documentación Adicional

- Ver instruccionesbold.md para detalles de implementación
- [Documentación de Bold](https://bold.co/developers)
- [Documentación de JotForm](https://www.jotform.com/developers/)

## Contribución

1. Fork el repositorio
2. Crea una rama para tu característica (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## Licencia

Distribuido bajo la Licencia MIT. Ver `LICENSE` para más información.

## Contacto

Juan Fernando Gallego Gomez - [@jfernandogg](https://twitter.com/jfernandogg) - juan.gallego@gmail.com

Link del Proyecto: [https://github.com/jfernandogg/curso_nov](https://github.com/jfernandogg/curso_nov)
