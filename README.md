# Taller - Aplicación MVC en PHP

1. Crear la base de datos ejecutando `/sql/schema.sql`.
2. Ajustar credenciales en `config/database.php`.
3. Colocar el contenido de `public/` como root web (o configurar virtual host) y asegurarse que `index.php` apunte a `../` correctamente.
4. Abrir en el navegador: `index.php?controller=auth&action=login`.

Notas de seguridad:
- Este es un esqueleto inicial. Para producción revise CSRF, validación extra, protección de ficheros, y uso de HTTPS.
