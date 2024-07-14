<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Site</title>
    <style>
        /* Reset de margens e paddings */
        body, html {
            margin: 0;
            padding: 0;
        }

        /* Estilo do cabeçalho */
        header {
            width: 100%;
            background-color: black;
            color: white;
            padding: 10px 0; /* Reduzi o padding superior e inferior */
            text-align: center;
            display: flex;
            justify-content: space-between; /* Alinha os itens à esquerda e à direita */
            align-items: center; /* Centraliza verticalmente os itens */
            font-family: 'Arial', sans-serif; /* Fonte para o cabeçalho */
        }

        /* Estilo do logo */
        .logo {
            max-width: 150px; /* Aumentei o tamanho máximo do logo */
            margin-left: 20px; /* Espaçamento à esquerda do logo */
        }

        /* Estilo dos links */
        .header-links {
            margin-right: 20px; /* Espaçamento à direita dos links */
        }

        .header-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px; /* Espaçamento entre os links */
            font-size: 16px; /* Tamanho da fonte dos links */
        }

        .header-links a:hover {
            text-decoration: underline; /* Sublinhado ao passar o mouse */
        }

        /* Estilo do rodapé */
        footer {
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0; /* Cor de fundo do rodapé */
        }
    </style>
</head>
<body>
    <header>
        <img src="../images/logo.jpg" alt="Logo da Empresa" class="logo">
        <div class="header-links">
            <a href="..//cadastro">Cadastro</a>
            <a href="/login">Login</a>
            <a href="/area-do-organizador">Área do Organizador</a>
        </div>
    </header>

    <main>
        <?php
            // Insira seu código PHP aqui
        ?>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?>@PITICKETS</p>
    </footer>
</body>
</html>
