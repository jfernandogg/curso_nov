# Integración de Botón de Pago Bold en Formulario JotForm

Este documento describe cómo agregar un botón de "Pagar con Bold" a un formulario JotForm que se integra con la API de Bold.

## Requisitos Previos

1. Un formulario JotForm existente
2. Un campo de tipo "calculation" que contenga el total a pagar
3. Un campo de tipo "number" que contenga la identificación del usuario
4. Un archivo `linkredir.php` configurado con la API de Bold

## Pasos de Implementación

### 1. Localizar el Campo Total

Buscar en el código el elemento `li` que contiene el campo de cálculo del total. Normalmente se ve así:

```html
<li class="form-line" data-type="control_calculation" id="id_22">
  <div id="cid_22" class="form-input-wide" data-layout="half"> 
    <input aria-labelledby="label_22" data-component="calculation" type="text" id="input_22" name="q22_total22" value="0" />
  </div>
</li>
```

### 2. Agregar el Enlace de Pago

Agregar el enlace de pago justo después del input del total, dentro del mismo div:

```html
<div id="cid_22" class="form-input-wide" data-layout="half"> 
  <input aria-labelledby="label_22" data-component="calculation" type="text" id="input_22" name="q22_total22" value="0" />
  <a href="#" id="boldPayLink" target="_blank" style="text-decoration:none; margin-left:10px;">Pagar con Bold</a>
</div>
```

### 3. Agregar el JavaScript

Agregar el siguiente script justo después del elemento `li` del total:

```html
<script>
  document.getElementById('boldPayLink').addEventListener('click', function(e) {
    e.preventDefault();
    var total = document.getElementById('input_22').value;
    var identificacion = document.getElementById('input_7').value;
    
    // Generar el enlace con los parámetros en la URL
    var link = 'linkredir.php?monto=' + encodeURIComponent(total) + '&descripcion=' + encodeURIComponent('Curso Noviembre-' + identificacion);
    
    // Redirigir al usuario al enlace generado
    window.open(link, '_blank');
  });
</script>
```

## Configuración del Archivo .env

Para proteger la información sensible como la API key de Bold, es necesario configurar un archivo `.env`:

1. Crear un archivo `.env` en la raíz del proyecto
2. Agregar la siguiente línea al archivo:
```
BOLD_API_KEY=TU_API_KEY_DE_BOLD
```
3. Asegurarse de que el archivo `.env` esté incluido en `.gitignore` para no compartir información sensible
4. El archivo `linkredir.php` ya está configurado para leer este valor

Nota: Reemplaza `TU_API_KEY_DE_BOLD` con tu API key real de Bold.

## Seguridad

- Nunca subas el archivo .env a un repositorio de control de versiones
- Mantén una copia de respaldo segura de tus claves API
- Si sospechas que tu API key ha sido comprometida, genera una nueva inmediatamente

## Notas Importantes

1. Asegúrate de ajustar los IDs de los campos según tu formulario:
   - `input_22`: ID del campo total
   - `input_7`: ID del campo identificación

2. El enlace se abre en una nueva pestaña gracias al atributo `target="_blank"` y se evita la validación del formulario con el siguiente script:

```html
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var enlace = document.querySelector('#boldPayLink');
    enlace.addEventListener('click', function(event) {
      event.preventDefault(); // Evita que el enlace siga su comportamiento predeterminado
      window.open(enlace.href, '_blank'); // Abre el enlace en una nueva pestaña
    });
  });
</script>
```

3. La descripción del pago se forma concatenando "Curso Noviembre-" con el número de identificación

4. El script genera dinámicamente un enlace con los parámetros en la URL para enviar los datos a `linkredir.php`

## Personalización

- Puedes modificar el texto "Pagar con Bold" cambiando el contenido del enlace
- Puedes ajustar el estilo del enlace modificando las propiedades CSS inline o agregando nuevas clases
- Puedes modificar el formato de la descripción del pago editando la línea `link = 'linkredir.php?monto=' + encodeURIComponent(total) + '&descripcion=' + encodeURIComponent('Curso Noviembre-' + identificacion);`