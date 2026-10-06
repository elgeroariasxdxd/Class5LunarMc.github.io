# Class5LunarMc.github.io

# 🌙 LunarMC - Clase 5

## Procesamiento del lado del servidor con PHP

En esta actividad se implementó el procesamiento de datos del lado del servidor utilizando **PHP**, aplicando los métodos HTTP **GET** y **POST** dentro del proyecto LunarMC.

También se agregaron validaciones y medidas de seguridad para controlar correctamente los datos enviados por los usuarios.

---

## 📩 Método POST - Formulario de contacto

El método **POST** fue implementado en el formulario de contacto de la página **Acerca de Nosotros**.

El formulario permite ingresar:

- Nombre
- Correo electrónico
- Sexo
- Pregunta o consulta

Al presionar **Enviar Pregunta**, los datos son enviados mediante POST y procesados por PHP en el servidor.

### Validaciones realizadas

PHP verifica que:

- Los campos obligatorios estén completos.
- El correo electrónico tenga un formato válido.
- Los valores recibidos sean válidos.
- Los datos ingresados se conserven si ocurre un error.

Para validar el correo electrónico se utiliza:

filter_var($email, FILTER_VALIDATE_EMAIL);

También se utiliza:

```php
trim();
```

para eliminar espacios innecesarios al principio y al final de los datos recibidos.

Si existe algún problema, el servidor muestra un mensaje de error.

Si todos los datos son correctos, se muestra un mensaje indicando que la consulta fue procesada correctamente.

---

## 🔒 Prevención de XSS

Para mostrar datos ingresados por el usuario dentro del HTML de forma segura se utiliza:

```php
htmlspecialchars();
```

Esto evita que contenido ingresado por el usuario sea interpretado directamente como código HTML.

---

## 🔎 Método GET - Ordenamiento de rangos

El método **GET** fue utilizado en la página de **Rangos**.

Se agregó un selector que permite ordenar los productos por:

- Recomendados
- Precio: menor a mayor
- Precio: mayor a menor
- Nombre: A → Z
- Nombre: Z → A

Al seleccionar una opción, el valor se envía mediante la URL.

Ejemplo:

```text
rangos.php?orden=precio_desc
```

PHP recibe el parámetro `orden` y reorganiza los rangos según la opción seleccionada.

Para validar el valor recibido se utiliza una lista de opciones permitidas:

```php
$ordenesPermitidos = [
    'recomendados',
    'precio_asc',
    'precio_desc',
    'nombre_asc',
    'nombre_desc'
];
```

Si alguien modifica manualmente la URL utilizando un valor que no está permitido, PHP lo descarta y utiliza el orden predeterminado.

---

## 🛠️ Método GET - Soporte rápido

También se implementó una segunda interacción mediante **GET** en la página de **Preguntas Frecuentes**.

El usuario puede seleccionar entre diferentes tipos de consultas:

- Mi compra todavía no llegó
- Tengo un problema con mi rango
- Tengo una duda sobre una compra
- Tengo otro problema

Por ejemplo, al seleccionar que una compra todavía no llegó, la URL contiene:

```text
faq pagina web.php?consulta=compra_no_llego
```

PHP recibe el parámetro `consulta`, lo valida y muestra dinámicamente la sección correspondiente.

Los valores permitidos son:

```php
$consultasPermitidas = [
    'compra_no_llego',
    'problema_rango',
    'duda_compra',
    'otro'
];
```

De esta manera, solamente se procesan opciones previamente definidas por el servidor.

---

## 🛡️ Validación y seguridad

Durante la actividad se utilizaron diferentes mecanismos para validar y proteger los datos.

### `trim()`

Elimina espacios innecesarios al principio y al final de los datos recibidos.

### `filter_var()`

Permite validar datos. En este proyecto se utiliza para comprobar que el correo electrónico tenga un formato válido.

### `htmlspecialchars()`

Convierte caracteres especiales antes de mostrar datos ingresados por el usuario dentro del HTML, ayudando a prevenir ataques XSS.

### Listas de valores permitidos

Los parámetros enviados mediante GET son comparados con listas de valores permitidos.

Esto evita procesar como válidos valores modificados manualmente desde la URL.

---

## 🧪 Pruebas realizadas

### ✅ POST válido

Se completó el formulario de contacto utilizando datos correctos.

PHP procesó los datos y mostró un mensaje indicando que la consulta fue procesada correctamente.

![POST correcto](captura%20tp2/post%20correcto%20.png)

### ❌ POST inválido

Se ingresó un correo electrónico con formato incorrecto.

PHP detectó el problema, mostró el mensaje de error correspondiente y mantuvo los demás datos ingresados en el formulario.

![POST incorrecto](captura%20tp2/post%20incorrecto.png)


### ✅ GET - Rangos

Se modificó el orden de los rangos y se comprobó que el parámetro apareciera correctamente en la URL.

![GET Rangos](captura%20tp2/get%20de%20rangos%20php.png)


Ejemplo:

```text
?orden=precio_desc
```

PHP procesó el parámetro y reorganizó los productos.

### ✅ GET - Soporte rápido

Se seleccionó un problema desde la sección de soporte rápido.

![GET Soporte rápido](captura%20tp2/get%20soporte%20rapido.png)

Ejemplo:

```text
?consulta=compra_no_llego
```

PHP validó el parámetro y mostró el contenido correspondiente.

También se probaron valores no permitidos para comprobar que fueran descartados por el servidor.

---

## 💻 Tecnologías utilizadas

- HTML
- CSS
- JavaScript
- PHP
- XAMPP
- Git
- GitHub

---

## 📁 Proyecto

**LunarMC Network**

Trabajo correspondiente a **Clase 5 - Procesamiento del lado del servidor**.
