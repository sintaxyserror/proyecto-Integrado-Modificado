# 📋 Notas sobre el Despliegue en Railway

## Cómo funciona

1. Railway detecta automáticamente `docker-compose.yml` en la raíz del proyecto
2. Construye la imagen desde el `Dockerfile`
3. Inicia los servicios especificados

## Variables de Entorno en Railway

Railway inyectará automáticamente:
- **Para el servicio `db` (MySQL)**:
  - `MYSQL_ROOT_PASSWORD`: Generada automáticamente por Railway
  - `MYSQL_DATABASE`: "Proyecto" (tal como está en docker-compose.yml)
  
- **Para el servicio `www` (PHP-Apache)**:
  - El HOST de la BD se resuelve como `db` dentro de la red Docker
  - Los puertos internos se mapean automáticamente

## Configuración Manual Necesaria en Railway

Después de crear el proyecto en Railway:

1. **Ir a Variables** (Critical)
   - DEBE agregar estas variables en Railway Dashboard → Project → Settings → Variables:
   ```
   DB_HOST=db
   DB_USER=root
   DB_PASSWORD=test
   DB_NAME=Proyecto
   MYSQL_ROOT_PASSWORD=test
   MYSQL_DATABASE=Proyecto
   MYSQL_PASSWORD=test
   ```
   
   **⚠️ IMPORTANTE:** Sin estas variables, la conexión a la base de datos fallará con "Name or service not known"

2. **Conectar como Services**
   - El MySQL se detectará como base de datos
   - El PHP-Apache como servicio web

3. **Agregar Dominio** (opcional)
   - Railway proporciona automáticamente: https://proyecto-production.railway.app
   - Puedes agregar un dominio personalizado en Settings

## Puertos en Producción

- Railway expone el puerto 80 del contenedor `www` como HTTPS automáticamente
- No necesitas especificar puertos - Railway lo maneja
- PHPMyAdmin (8000) no será accesible desde internet por seguridad (Railway bloquea puertos internos)

## Health Checks

Para mejorar la confiabilidad, Railroad puede revisar el estado del servicio.
Esto ya está configurado implícitamente por Docker.

## Redeploy Automático

Cada vez que hagas `git push` al repositorio conectado:
1. Railway detecta el cambio
2. Construye una nueva imagen
3. Detiene la versión anterior
4. Inicia la nueva versión con cero downtime

## Variables Sensibles

Nunca commitear al repositorio:
- `.env` (local) ← está en .gitignore
- Contraseñas en código
- Claves API

Railway proporciona un editor seguro de variables en Settings → Variables.

## Logs en Producción

Ver logs en tiempo real:
- Dashboard de Railway → Deployments → Click en el deployment
- Los logs del HTTP aparecen en tiempo real
- Los errores de PHP aparecen en el log de servicios

## Rolled Back Automático

Si el nuevo deployment falla, Railway automáticamente revierte a la versión anterior.

---

**Todas estas configuraciones son automáticas - Railway maneja casi todo por ti.**
