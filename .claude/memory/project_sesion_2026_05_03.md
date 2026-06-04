---
name: Sesión 2026-05-03 - Rediseño de formularios y mejoras en vista principal
description: Resumen de los cambios realizados en la sesión del 3 de mayo de 2026
type: project
---

## Cambios realizados en esta sesión

### Formulario de Registro (`resources/views/actualizacion_docente/layouts/registro.blade.php`)
- Rediseñado completamente: de un cuadro pequeño a una tarjeta amplia (720px) con fondo semitransparente y borde dorado superior
- Nuevas clases CSS: `.registro-wrapper`, `.registro-card`, `.registro-header`, `.registro-divider`, `.registro-grid`, `.registro-field`
- Se agregaron 4 campos nuevos: `# de Escuela` (num_escuela), `Subsistema`, `Dirección`, `Localidad`
- Layout en cuadrícula de 2 columnas con este orden visual:

  | Columna izquierda     | Columna derecha     |
  |-----------------------|---------------------|
  | Nombre Completo       | Dirección           |
  | Número de teléfono    | Localidad           |
  | Escuela de procedencia| Correo electrónico  |
  | Subsistema            | Contraseña          |
  | # de Escuela          | Confirmar contraseña|

- `tabindex` configurado para bajar por columna izquierda (1-5) luego derecha (6-10), botón Registrarme en tabindex="11"

### Formulario de Editar (`resources/views/actualizacion_docente/layouts/editar.blade.php`)
- Mismo diseño que el formulario de registro (mismas clases CSS)
- Se agregaron los 4 campos nuevos con valores pre-llenados desde `$currentUser` usando `?? ''` por si la API aún no los devuelve
- Layout de 2 columnas (8 campos, sin contraseña):

  | Columna izquierda     | Columna derecha     |
  |-----------------------|---------------------|
  | Nombre Completo       | # de Escuela        |
  | Número de teléfono    | Dirección           |
  | Escuela de procedencia| Localidad           |
  | Subsistema            | Correo electrónico  |

- `tabindex` 1-8 bajando por columna izquierda, luego derecha; botón Guardar cambios en tabindex="9"

### Controlador (`app/Http/Controllers/FastApiController.php`)
- Método `createUser`: se agregaron los 4 campos nuevos al array `$data` que se envía a FastAPI:
  - `num_escuela`, `subsistema`, `direccion`, `localidad`
- URL del servidor actualizada a `http://192.168.254.12:4001`

### CSS (`public/css/registro-editar.css`)
- Se agregaron los estilos para el nuevo diseño de los formularios al final del archivo
- Los estilos antiguos (`.contenedor-formulario`) se mantuvieron para no romper otros usos

### Vista principal (`resources/views/actualizacion_docente/home/home.blade.php`)
- Botones de cada curso invertidos: ahora aparece primero **Temario** y luego **Inscribirse**
- Enlace "Editar información" movido desde el bloque `.editar_baja` al bloque `.bienvenido`

## Arquitectura del proyecto
- Laravel como frontend, FastAPI en `http://192.168.254.12:4001` como backend
- Autenticación por token JWT guardado en sesión (`api_token`)
- Datos del usuario en sesión: `current_user_data`
- Middleware `ensure.api.data` protege rutas privadas

**Why:** El usuario quería modernizar los formularios y agregar campos que la API de FastAPI necesita.
**How to apply:** Si se trabaja en los formularios, respetar el diseño con `.registro-card` y el orden de campos acordado. Si se agregan más campos, actualizar también el método `createUser` y `updateUser` en `FastApiController`.
