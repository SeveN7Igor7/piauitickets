<?php
// Função para obter os detalhes do evento do Firebase
function getEventDetails($eventId, $eventName) {
    $url = 'https://piauiticketsdb-default-rtdb.firebaseio.com/eventos/'.$eventId.'.json';
    
    // Faz uma requisição para a API do Firebase
    $response = file_get_contents($url);
    if ($response === FALSE) {
        die('Erro ao obter dados do Firebase');
    }

    $eventDetails = json_decode($response, true);
    return $eventDetails;
}

// Pega os parâmetros da URL
$eventId = basename(dirname($_SERVER['REQUEST_URI']));
$eventName = basename($_SERVER['REQUEST_URI']);

// Obtenha os detalhes do evento
$eventDetails = getEventDetails($eventId, $eventName);

if (!$eventDetails) {
    die('Evento não encontrado');
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($eventDetails['nomeevento']); ?></title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: 'Arial', sans-serif;
            min-height: 100%;
            position: relative;
        }
        header {
            width: 100%;
            background-color: black;
            color: white;
            padding: 5px 0; /* Reduzido para diminuir a altura */
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 1000;
        }
        .logo {
            max-width: 100px; /* Reduzido para diminuir o tamanho da logo */
            margin-left: 10px;
        }
        .header-links {
            margin-right: 10px;
        }
        .header-links a {
            color: white;
            text-decoration: none;
            margin-left: 10px;
            font-size: 14px; /* Reduzido para diminuir o tamanho da fonte */
        }
        .header-links a:hover {
            text-decoration: underline;
        }
        .event-details {
            padding: 20px;
            text-align: center;
            margin-top: 60px; /* Adicionado para compensar a altura do cabeçalho */
        }
        .event-details img {
            max-width: 300px;
            border-radius: 5px;
        }
        .event-details h1 {
            margin-top: 20px;
            font-size: 24px;
        }
        .event-details p {
            font-size: 18px;
            color: #555;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <img src="/images/Logo.png" alt="Logo da Empresa" class="logo">
        <div class="header-links">
            <a href="/cadastro">Cadastro</a>
            <a href="/login">Login</a>
            <a href="/area-do-organizador">Área do Organizador</a>
        </div>
    </header>

    <main>
        <div class="event-details">
            <img src="<?php echo htmlspecialchars($eventDetails['imageurl']); ?>" alt="<?php echo htmlspecialchars($eventDetails['nomeevento']); ?>">
            <h1><?php echo htmlspecialchars($eventDetails['nomeevento']); ?></h1>
            <p><strong>Local:</strong> <?php echo htmlspecialchars($eventDetails['local']); ?></p>
            <p><strong>Data:</strong> <?php echo htmlspecialchars($eventDetails['datainicio']); ?></p>
            <p><strong>Hora:</strong> <?php echo htmlspecialchars($eventDetails['aberturaportas']); ?></p>
            <p><strong>Informações Adicionais:</strong> <?php echo htmlspecialchars($eventDetails['informaçõesadicionais']); ?></p>
        </div>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @PITICKETS</p>
    </footer>
</body>
</html>
