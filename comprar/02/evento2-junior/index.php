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
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <img src="../../../images/Logo.png" alt="Logo da Empresa" class="logo">
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
