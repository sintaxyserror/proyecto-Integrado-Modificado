# 📋 Notas sobre el Despliegue

## Opción 1: Render + Supabase (Recomendado) ⭐

### Paso 1: Crear proyecto en Supabase (gratis)

1. Ve a https://supabase.com
2. Sign up con GitHub o email
3. Click **"New Project"**
4. Configura:
   - Project name: `proyecto-game`
   - Password: (anota esta contraseña)
   - Region: Europe (más cercano)
5. **Espera 1-2 minutos** a que se cree
6. Una vez listo, ve a **Settings** → **Database** → **Connection Pooling**
7. Copia la URL (formato: `postgresql://user:pass@host:port/database`)

### Paso 2: Agregar datos iniciales

1. En Supabase, ve a **SQL Editor** → **New Query**
2. Copia el contenido de `codigo/inflaestructura/dump/myDb.sql`
3. Pega y ejecuta (Run)
4. Verifica que las tablas se crearon en **Table Editor**

### Paso 3: Configurar Render

1. Sube tu código a GitHub (si aún no está)
2. Ve a https://render.com
3. Sign up / Login
4. Click **"New"** → **"Web Service"**
5. Conecta tu repositorio GitHub
6. Configura:
   - Name: `proyecto-integrado`
   - Build Command: (dejar vacío o `echo "Building..."`)
   - Start Command: (dejar vacío, usa docker-compose)
7. Click **"Advanced"**
8. En **Environment Variables**, agrega:
   ```
   DATABASE_URL=postgresql://user:password@host:port/database
   ```
   (Reemplaza con la URL de Supabase del paso 1)
9. Click **"Deploy"**

### Paso 4: Espera el deploy

- Render construirá la imagen Docker
- Desplegará en unos 5 minutos
- ¡Accede a tu URL cuando esté listo!

---

## Opción 2: Railway (No gratuito, pero más fácil)

1. Ve a https://railway.app
2. Conecta tu GitHub
3. Railway detecta automáticamente `docker-compose.yml`
4. Agrega PostgreSQL desde el dashboard
5. Railway inyecta `DATABASE_URL` automáticamente
6. Deploy automático

**Costo:** ~$5/mes

---

## Desarrollo Local

```bash
cd codigo/inflaestructura
docker-compose up -d
```

- Accede: http://localhost:8080
- pgAdmin: http://localhost:5050 (email: admin@example.com, pass: admin)

