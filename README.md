# Agenda de Contactos (POO + MVC)

¡Bienvenido a tu **Agenda de Contactos**!
Esta aplicación está desarrollada en **PHP**, siguiendo el patrón **MVC**, utilizando **Programación Orientada a Objetos (POO)** y gestionando dependencias con **Composer**.

La aplicación permite **gestionar contactos**, **crear usuarios**, iniciar sesión y mantener tu información organizada de manera segura y eficiente.

---

## Requisitos

Antes de empezar, asegúrate de tener instalado:

* **PHP 8+**
* **MySQL o MariaDB**
* **Composer**
* Un servidor local como **XAMPP**, **Laragon** o **MAMP**

---

## Instalación

1. **Descargar o clonar el proyecto**
   Coloca la carpeta del proyecto en la carpeta `htdocs` (XAMPP) o la carpeta equivalente de tu servidor local.
   ⚠️ **Importante:** La carpeta raíz **debe llamarse** `agenda_contactos_mvc`.

   ```bash
   git clone <tu-repositorio> agenda_contactos_mvc
   ```

2. **Instalar dependencias con Composer**
   Abre la terminal en la carpeta raíz del proyecto y ejecuta:

   ```bash
   composer install
   ```

3. **Configurar la base de datos**

   * Importa el archivo `base_datos/agenda_contactos.sql` en tu **phpMyAdmin** o en tu gestor de MySQL.
   * Crea la base de datos con el mismo nombre o ajusta el `.env` si quieres cambiarlo.

4. **Configurar el archivo `.env`**
   Copia el archivo `.env.example` como `.env` y ajusta los datos de tu base de datos:

   ```env
   DB_HOST=127.0.0.1
   DB_NAME=agenda_contactos
   DB_USER=root
   DB_PASS=
   APP_URL=http://localhost/agenda_contactos_mvc/public
   ```

5. **Iniciar la aplicación**
   Abre tu navegador y entra a:

   ```
   http://localhost/agenda_contactos_mvc/public
   ```

---

## Estructura del proyecto

```
agenda_contactos_mvc/
│
├─ aplicacion/
│  ├─ Controladores/      # Contiene los controladores MVC
│  ├─ Modelos/            # Contiene las clases de POO para la base de datos
│  └─ Nucleo/             # Clases base como Ruteador, Controlador, etc.
│
├─ base_datos/            # Archivo SQL de la base de datos
├─ publico/                # Carpeta pública, donde se encuentra index.php
├─ vistas/                # Plantillas HTML/PHP
├─ vendor/                # Dependencias de Composer
├─ .env                   # Configuración del proyecto
└─ composer.json          # Configuración de Composer
```

---

## Uso

1. **Registro e inicio de sesión**

   * Crea un usuario para poder acceder a la agenda.
   * Solo los usuarios registrados pueden ver, crear, editar o eliminar contactos.

2. **Gestión de contactos**

   * Crear nuevos contactos
   * Editar contactos existentes
   * Eliminar contactos
   * Listar todos los contactos de manera organizada

---

## Notas

* El proyecto está basado en **MVC**, así que **nunca accedas directamente a archivos que no estén en `public`**.
* Se utiliza **POO**, así que todas las operaciones con la base de datos y la lógica de negocio están encapsuladas en clases.
* Si quieres añadir nuevas dependencias de PHP, ejecuta `composer require <paquete>` dentro de la carpeta raíz.

---

## Autor

**Luis Guerra** – Desarrollador de la Agenda de Contactos
