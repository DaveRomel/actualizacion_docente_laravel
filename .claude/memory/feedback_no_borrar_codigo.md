---
name: No borrar código existente, solo comentar
description: El usuario prefiere que el código existente se comente en lugar de eliminarse
type: feedback
---

No eliminar código existente al hacer cambios. Si se necesita reemplazar o desactivar algo, comentarlo con `//` o `/* */` y agregar el nuevo código junto a él.

**Why:** El usuario quiere mantener el historial visible en el archivo para poder revertir fácilmente sin recurrir a git.

**How to apply:** En cualquier edición de PHP, Blade o CSS donde se cambie funcionalidad existente, comentar la línea/bloque anterior y añadir el nuevo debajo. Aplica especialmente en `FastApiController.php`, `web.php` y archivos CSS. No aplica a código claramente muerto o a nuevas adiciones donde no hay nada previo.
