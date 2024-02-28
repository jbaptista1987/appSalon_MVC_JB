<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prueba de Posible Layout</title>

    <style>
        .layout{
            display: grid;
            gap: 10px;
            grid-template-rows: 80px 40px auto 60px 60px 80px;
            grid-template-columns: 1fr;
            grid-template-areas: 'Cabecera' 'Opciones' 'Principal' 'Widget1' 'Widget2' 'Pies';
            height: 100vh;
        }

        @media (min-width: 480px){
            .layout{
                display: grid;
                grid-template-rows: 80px auto 120px 80px;
                grid-template-columns: 160px auto auto;
                grid-template-areas: 
                    'Cabecera Cabecera Cabecera'
                    'Opciones Principal Principal'
                    'Opciones Widget1 Widget2'
                    'Pies Pies Pies';
            }
        }

        header{
            grid-area: Cabecera;
            background: #c08bfd;
        }
        footer{
            grid-area: Pies;
            background: #c08bfd;
        }
        nav{
            grid-area: Opciones;
            background: #f6c365;
        }
        main{
            grid-area: Principal;
            background: #b2ee94;
        }
        .widget{
            grid-area: Widget1;
            background-color: #ff8983;
            width: 100%;
        }
        .statistics{
            grid-area: Widget2;
            background-color: #99c2fe;
            width: 100%;
        }
    </style>

    <?php
    require __DIR__ . '/../vendor/autoload.php';
    /*echo '/appsalon/vendor/autoload.php';
    exit();*/
    require_once __DIR__ . '/../includes/funciones.php';

    
    if($_SERVER['REQUEST_METHOD'] === 'POST' ) {
   
    }
    
    
    
    ?>
</head>
<body>
    <form action="" method="post">
    <div class="layout">
        <header>Cabecera
            </br> cabecera
            </br> cabecera
            </br> cabecera
        </header>
        <nav>Opciones
            <input type="submit" value="Enviar">
        </nav>
        <main>Principal

            <p>Sera Redigiridigo en: </p>
            <div id="countdown">10</div>

        </main>
        <article class="widget">Widget1</article>
        <article class="statistics">Widget2</article>
        <footer>Pies</footer>
    </div>
    </form>
</body>

<!-- //<script src="https://unpkg.com/axios/dist/axios.min.js"></script> -->
<script>

    fetch('https://api.exchangerate-api.com/v4/latest/USD')
  .then(response => response.json())
  .then(data => {
    console.log(data.rates.VES);
  })
  .catch(error => console.error('Error:', error));


        function escapeText(str) {
            const escapeHtmlRegExp = /[&<>"']/g;
            const escapeHtmlMap = {
              '&': '&',
              '<': '<',
              '>': '>',
              '"': '"',
              "'": "'"
            };
            const escapeStringRegExp = /[-\/\\^$*+?.()|[\]{}]/g;
            const escapeStringMap = {
              '\\': '\\\\',
              '^': '\\^',
              '$': '\\$',
              '*': '\\*',
              '+': '\\+',
              '?': '\\?',
              '.': '\\.',
              '(': '\\(',
              ')': '\\)',
              '{': '\\{',
              '}': '\\}',
              '[': '\\[',
              ']': '\\]'
            };
        
            return str.replace(escapeHtmlRegExp, (match) => escapeHtmlMap[match])
              .replace(escapeStringRegExp, (match) => escapeStringMap[match]);
        }


        const texto = 'Este es un texto con caracteres especiales: & \´ < > <script src="https://unpkg.com/axios/dist/axios.min.js">';
        const textoEscapado = escapeText(texto);
        console.log(textoEscapado);
</script>
</html>