# appSalon_MVC_JB
Mi Nombre es Jesus Baptista, soy de Venezuela. He subido este proyecto a GitHub como parte del curso de Desarrollo Web del Profesor Juan de la Torre y su equipo de trabajo como Julio Cesar.

A lo largo del curso he obtenido de ellos valiosos conocimientos y he desarrollado otros por mi cuenta investigando, por lo que este proyecto a pesar de ser autoria del profesor Juan de la Torre, tiene varios cambios y muchas cosas adicionales que yo mismo integre.

Como mencione antes, lo subo por ser parte del curso y para mostrar tambien las habilidades adquiridas. Bajo ningun concepto, este proyecto lo considero con fines comerciales y es codigo abierto.

Algunas de las cosas que yo agregue adicional o diferente al Profesor:
1) API Recaptcha V2 de Google para que en el inicio de sesion se valique que no es un robot.
2) En vez de usar PHP/Mailer use la API de Resend la cual en su version gratuita me deja elegir a que buzon de correo electronico deseo enviar el mensaje con el token.
3) En el registro de cliente, agregue datos adicionales que para una proxima ampliacion del sistema nos ayudan con el tema de facturacion ya que son datos necesarios.
4) El token que yo genero es un numero entero de 10 digitos (El Profesor usa alfanumerico).
5) Yo no borro los usuarios, les agrego un campo adicional llamado estatus el cual al ponerlo en un estado significa que esta suspendido el usuario y no puede iniciar sesion.
6) En el registro de citas, agregue tiempo a cada servicio para que se pueda elegir los servicios, en sistema suma los minutos, luego el usuario elige fecha y hora de la cita, el sistema calcula a que hora termina la cita y ademas te enlista a los Barberos que estan disponibles en esa fecha y en ese bloque de hora.
7) Muestro el sub total, el Impuesto del 16% (Venezuela), el total en dolares y con una API de cambios de moneda calculo cuanto es el monto en la moneda local de Venezuela, ya que esta API me da el valor del dolar en tiempo real.
8) En el resumen de cita no enlisto los servicios, los muestro en una tabla.
9) Basado en lo que aprendi en el proyecto de Bienes Raices, uso el simbolo de hamburguesa para el panel de admin.
10) En los CRUD hago que todas las operaciones sean posibles en una misma pagina.
11) Hice que varios registros en una tabla puedan ser seleccionados para luego ser suspendidos o aprobados.

Lo que mas espero de todo esto por ahora es que el profesor Juan de la Torre vea este proyecto y me de su opinion.
