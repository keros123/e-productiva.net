# Resumen de Credenciales y Cadenas de Conexión

> ⚠️ Estas credenciales son de ejemplo/desarrollo local. Cámbialas antes de usar en producción.

Red compartida entre contenedores: `infra_net`

---

## 1. PostgreSQL

| Parámetro | Valor |
|---|---|
| Imagen | postgres:16 |
| Contenedor | `postgres_db` |
| Usuario | `admin` |
| Contraseña | `admin123` |
| Base de datos | `mi_base` |
| Puerto interno | 5432 |
| Puerto publicado (host) | 5432 |
| Volumen de datos | `E:\Docker\Postgres\data` |

**Conexión desde OTRO contenedor (misma red `infra_net`):**
```
host=postgres  puerto=5432
```
```
postgresql://admin:admin123@postgres:5432/mi_base
```

**Conexión desde XAMPP / host Windows (fuera de Docker):**
```
host=127.0.0.1  puerto=5432
```
```
postgresql://admin:admin123@127.0.0.1:5432/mi_base
```
PHP (PDO):
```php
$pdo = new PDO("pgsql:host=127.0.0.1;port=5432;dbname=mi_base", "admin", "admin123");
```

---

## 2. pgAdmin

| Parámetro | Valor |
|---|---|
| Imagen | dpage/pgadmin4:latest |
| Contenedor | `pgadmin` |
| URL | http://localhost:8080 |
| Email | admin@admin.com |
| Contraseña | admin123 |
| Volumen | `E:\Docker\Postgres\pgadmin` |

**Al registrar el servidor Postgres dentro de pgAdmin, usar:**
```
Host: postgres   Puerto: 5432   Usuario: admin   Contraseña: admin123
```

---

## 3. MySQL

| Parámetro | Valor |
|---|---|
| Imagen | mysql:8.0 |
| Contenedor | `mysql_db` |
| Usuario root | `root` |
| Contraseña root | `root123` |
| Usuario adicional | `admin` |
| Contraseña adicional | `admin123` |
| Base de datos | `mi_base` |
| Puerto interno | 3306 |
| Puerto publicado (host) | 3306 |
| Volumen de datos | `E:\Docker\MySQL\data` |

**Conexión desde OTRO contenedor (misma red `infra_net`):**
```
host=mysql  puerto=3306
```
```
mysql://admin:admin123@mysql:3306/mi_base
```

**Conexión desde XAMPP / host Windows (fuera de Docker):**
```
host=127.0.0.1  puerto=3306
```
> ⚠️ Si el MySQL propio de XAMPP también usa el puerto 3306, hay conflicto. Detén el MySQL de XAMPP o cambia el puerto publicado del contenedor a 3307.

```
mysql://admin:admin123@127.0.0.1:3306/mi_base
```
PHP (mysqli):
```php
$conn = new mysqli("127.0.0.1", "admin", "admin123", "mi_base", 3306);
```

---

## 4. phpMyAdmin

| Parámetro | Valor |
|---|---|
| Imagen | phpmyadmin:latest |
| Contenedor | `phpmyadmin` |
| URL | http://localhost:8081 |
| Usuario | root |
| Contraseña | root123 |
| Usuario alterno | admin |
| Contraseña alterna | admin123 |

Se conecta automáticamente al contenedor `mysql` (configurado vía `PMA_HOST=mysql`), no requiere volumen propio.

---

## 5. Apache

| Parámetro | Valor |
|---|---|
| Imagen | httpd:2.4 |
| Contenedor | `apache_server` |
| URL | http://localhost:8082 |
| Volumen sitio web | `E:\Docker\Apache\htdocs` |
| Volumen configuración | `E:\Docker\Apache\conf` |
| Volumen logs | `E:\Docker\Apache\logs` |

Sin credenciales de acceso por defecto (servidor web estático).

---

## Tabla resumen de puertos publicados

| Servicio | Puerto host | URL / Acceso |
|---|---|---|
| PostgreSQL | 5432 | `127.0.0.1:5432` |
| pgAdmin | 8080 | http://localhost:8080 |
| MySQL | 3306 | `127.0.0.1:3306` |
| phpMyAdmin | 8081 | http://localhost:8081 |
| Apache | 8082 | http://localhost:8082 |

---

## Notas de seguridad
- Todas las contraseñas mostradas son de ejemplo para entorno local de desarrollo.
- Antes de exponer cualquiera de estos servicios fuera de tu red local, cambia usuarios/contraseñas por valores fuertes y considera usar variables de entorno o un archivo `.env` en vez de credenciales hardcodeadas en el `docker-compose.yml`.
