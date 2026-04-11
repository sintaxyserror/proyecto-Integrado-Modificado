# 🎮 Proyecto Integrado - Juego de Batallas en Tiempo Real

Sistema completo de juego de batallas por turnos con autenticación, gestión de personajes y persistencia de datos.

## 📋 Requisitos

- PHP 8.1+
- MySQL 8.3+
- Docker & Docker Compose (para desarrollo)
- Node.js (opcional, para CI/CD)

## 🚀 Despliegue Rápido

### Local (Desarrollo)

1. **Clonar el repositorio**
   ```bash
   git clone <tu-repo>
   cd proyectoIntegrado
   ```

2. **Iniciar con Docker**
   ```bash
   cd codigo/inflaestructura
   docker-compose up -d
   ```

3. **Acceder a la aplicación**
   - Juego: http://localhost:8080
   - PHPMyAdmin: http://localhost:8081
   - Base de datos ya estará poblada con datos de prueba

### En Railway (Producción)

1. **Empujar a GitHub**
   ```bash
   git add .
   git commit -m "Preparar para despliegue en Railway"
   git push origin main
   ```

2. **Crear cuenta en Railway.app**
   - Ir a https://railway.app
   - Conectar con GitHub
   - Nuevo proyecto → Import from GitHub

3. **Seleccionar repositorio**
   - Buscar `proyectoIntegrado`
   - Autorizar acceso

4. **Configurar Railway**
   - Railway detectará `docker-compose.yml` automáticamente
   - Las variables de entorno se tomarán de `.env.example`
   - El sitio estará disponible en `https://tu-proyecto-production.railway.app`

5. **Obtener dominio personalizado (opcional)**
   - En Railway Dashboard → Custom Domain
   - Añadir dominio propio

## 🎯 Características

✅ **Autenticación**: Login/Registro con BCrypt  
✅ **Personajes**: Crear y modificar con atributos (vida, daño, energía)  
✅ **Poderes**: 8 tipos diferentes de ataques con mecánicas únicas  
✅ **Batallas**: Sistema por turnos con daño escalable basado en stats  
✅ **Base de datos**: Registro completo de todas las batallas y acciones  
✅ **Interfaz web**: Responsive y funcional  

## 📊 Stack Tecnológico

- **Backend**: PHP 8.1 + OOP
- **Base de datos**: MySQL 8.3
- **Frontend**: HTML5 + CSS3 + JavaScript vanilla
- **Infraestructura**: Docker, Docker Compose
- **Autenticación**: BCrypt password hashing
- **API**: RESTful con sesiones PHP

## 📁 Estructura

```
codigo/
├── inflaestructura/
│   ├── docker-compose.yml       # Configuración Docker
│   ├── Dockerfile               # Imagen PHP-Apache
│   └── dump/myDb.sql            # Schema y datos iniciales
├── www/
│   ├── index.php                # Probador de API
│   ├── login.php                # Inicio de sesión
│   ├── batalla.php              # Motor de batallas
│   ├── personajes.php           # Gestión de personajes
│   ├── clases/                  # Clases PHP (Security, Connection, etc)
│   └── css/                     # Estilos
└── personal/                    # Subcarpetas por integrante
```

## 🔧 Cuentas de Prueba

```
Email: jonathan@gmail.com     | Contraseña: test
Email: test@test.com          | Contraseña: test
Email: pau@prueba.com         | Contraseña: test
```

## 📝 Variables de Entorno

Ver `.env.example` para la lista completa.

En **Railway**, configurar en:
Settings → Variables → Raw Editor

## 🐛 Troubleshooting

**"No puedo acceder a la base de datos"**
- Verificar que el nombre del host es `db` (no localhost en Docker)

**"Errores de charset en SQL"**
- La base de datos y tablas usan UTF-8mb4 para soportar caracteres especiales

**"Las sesiones no persisten entre páginas"**
- Asegurar que `session_start()` está al inicio del archivo PHP

## 🤝 Contribuciones

Este es un proyecto académico de 2º DAW. Los cambios se hacen a través de pull requests.

## 📜 Licencia

Proyecto educativo - Uso libre

---

**Última actualización**: Abril 2026  
**Estado**: Producción ✅
