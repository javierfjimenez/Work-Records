# 📂 Work Records Manager

Sistema de registro de horas de trabajo para freelancers, desarrollado en Laravel 11. Permite gestionar registros de trabajo, exportar reportes en CSV y ofrece autenticación con Laravel Breeze y API con Sanctum.

## 🚀 Características

✅ Registro y gestión de horas de trabajo  
✅ Exportación de registros en CSV  
✅ Autenticación con Laravel Breeze  
✅ API REST con Laravel Sanctum  
✅ UI moderna con Tailwind CSS  
✅ Pruebas automatizadas con Pest  

---

## 📌 Tecnologías Utilizadas

- Laravel 11
- Tailwind CSS
- SQLite (para facilidad en la evaluación)
- Laravel Breeze (para autenticación)
- Laravel Sanctum (para API)
- Pest PHP (para pruebas)
- Laravel Queues y Jobs (para exportación en segundo plano)

---

### 🛠️ Instalación

## 1️⃣ Clonar el repositorio
bash

git clone https://github.com/javierfjimenez/Work-Records
cd Work-Records

## 2️⃣ Instalar dependencias
bash

composer install
npm install && npm run build

## 3️⃣ Configurar variables de entorno
bash

cp .env.example .env
php artisan key:generate

Configura .env con tu base de datos SQLite:

DB_CONNECTION=sqlite
DB_DATABASE=/absolute/path/to/database.sqlite

## 4️⃣ Ejecutar migraciones

php artisan migrate --seed

## 5️⃣ Iniciar el servidor

php artisan serve

Ahora puedes iniciar sesión con:
	•	Email: admin@admin.com
	•	Password: password

## Instrucciones de uso

1️⃣ Regístrate o inicia sesión
2️⃣ Crea un nuevo registro de trabajo
3️⃣ Edita o elimina tus registros
4️⃣ Exporta un reporte en CSV


## Instrucciones para el manejo del API en Postman


## Configuración Inicial en Postman

	1.	Abre Postman en tu PC o usa la versión web.
	2.	Crea una nueva colección llamada Work Records API para organizar las solicitudes.
	3.	Establece la URL base:
        •	Local: http://127.0.0.1:8000/api/
        •	Producción: https://tudominio.com/api/
	4.	Configura el Header (Para autenticación después de iniciar sesión):
        •	Clave: Authorization
        •	Valor: Bearer {tu_token_aquí}


## Registro de Usuario
Método: POST
Endpoint: /register
Cuerpo (Body) - JSON:
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password",
    "password_confirmation": "password"
}

## Inicio de Sesión

Método: POST
Endpoint: /login
Cuerpo (Body) - JSON:
{
    "email": "john@example.com",
    "password": "password"
}
Respuesta esperada: 
    {
    "token": "tu_token_generado"
}
Modo de uso:

1. Copiar el token y usarlo en todas las siguientes solicitudes.
2.  Ir a Headers y agregar el Token: Authorization: Bearer tu_token_generado

## Cerrar Sesión (requiere token)

Método: POST
Endpoint: /logout
Headers: Authorization: Bearer tu_token_generado

Respuesta esperada: {
    "message": "Sesión cerrada correctamente."
}

## Obtener todos los Registros de Trabajo (requiere token)

Método: GET
Endpoint: /work_records
Headers: Authorization: Bearer tu_token_generado

Respuesta esperada:
[
    {
        "id": 1,
        "title": "Desarrollo de API",
        "description": "Crear endpoints en Laravel",
        "priority": "alta",
        "start_time": "2025-02-23 10:00:00",
        "end_time": "2025-02-23 12:00:00"
    }
]

## Crear un Nuevo Registro de Trabajo (requiere token)

Método: POST
Endpoint: /work_records
Headers: 
Authorization: Bearer tu_token_generado
Content-Type: application/json

Cuerpo (Body - JSON):
{
    "title": "Revisión de código",
    "description": "Optimización de consultas en Laravel",
    "priority": "media",
    "start_time": "2025-02-23 15:00:00",
    "end_time": "2025-02-23 17:00:00"
}

Respuesta esperada: 
{
    "message": "Registro creado con éxito."
}

## Obtener un Registro Específico (requiere token)

Método: GET
Endpoint: /work_records/{id}
Ejemplo: /work_records/1
Headers: Authorization: Bearer tu_token_generado

Respuesta esperada:
{
    "id": 1,
    "title": "Desarrollo de API",
    "description": "Crear endpoints en Laravel",
    "priority": "alta",
    "start_time": "2025-02-23 10:00:00",
    "end_time": "2025-02-23 12:00:00"
}

## Actualizar un Registro (requiere token)

Método: PUT
Endpoint: /work_records/{id}
Ejemplo: /work_records/1
Headers:
Authorization: Bearer tu_token_generado
Content-Type: application/json

Cuerpo (Body - JSON):
{
    "title": "Revisión de API",
    "description": "Mejorando la seguridad con Sanctum",
    "priority": "alta",
    "start_time": "2025-02-23 16:00:00",
    "end_time": "2025-02-23 18:00:00"
}

Respuesta esperada:
{
    "message": "Registro actualizado correctamente."
}

## Eliminar un Registro (requiere token)

Método: DELETE
Endpoint: /work_records/{id}
Ejemplo: /work_records/1
Headers: Authorization: Bearer tu_token_generado

Respuesta esperada:
{
    "message": "Registro eliminado correctamente."
}

## Exportar Registros a CSV (requiere token)

Método: POST
Endpoint: /work_records/export
Headers: Authorization: Bearer tu_token_generado

Respuesta esperada:
{
    "message": "La exportación está en proceso. Recibirás un correo con el archivo CSV."
}