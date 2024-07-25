<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Seu Site</title>
</head>
<body>
    <header>
        <img src="../images/Logo.png" alt="Logo da Empresa" class="logo">
        <div class="header-links">
            <a href="/cadastro">Cadastro</a>
            <a href="/login">Login</a>
            <a href="/area-do-organizador">Área do Organizador</a>
        </div>
    </header>

    <main>
        <h1 style="margin-top: 100px;">Eventos em destaque:</h1>

        <!-- Seção de Eventos em Destaque -->
        <section class="event-cards" id="eventos-em-destaque">
            <!-- Aqui serão inseridos os eventos dinamicamente -->
        </section>
    </main>

    <footer>
        <p>&copy; <?php echo date('Y'); ?> @PITICKETS</p>
    </footer>

    <!-- Incluir o SDK do Firebase -->
    <!-- Scripts do Firebase -->
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.10.0/firebase-database.js"></script>

    <!-- Script JavaScript -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Realiza uma requisição AJAX para obter as credenciais seguras do Firebase
            $.ajax({
                url: 'api/apifirebase.php',
                type: 'GET',
                dataType: 'json',
                success: function(credentials) {
                    if (credentials.apiKey && credentials.authDomain && credentials.databaseURL) {
                        // Inicializa o Firebase com as credenciais obtidas
                        const firebaseConfig = {
                            apiKey: credentials.apiKey,
                            authDomain: credentials.authDomain,
                            databaseURL: credentials.databaseURL,
                            projectId: credentials.projectId,
                            storageBucket: credentials.storageBucket,
                            messagingSenderId: credentials.messagingSenderId,
                            appId: credentials.appId,
                            measurementId: credentials.measurementId
                        };

                        // Verifique se o Firebase já está inicializado para evitar erros
                        if (!firebase.apps.length) {
                            firebase.initializeApp(firebaseConfig);
                        }

                        // Referência para os eventos no banco de dados
                        const eventosRef = firebase.database().ref('eventos');

                        // Escuta eventos no Firebase
                        eventosRef.on('value', function(snapshot) {
                            $('#eventos-em-destaque').empty(); // Limpa a seção de eventos antes de adicionar novos

                            snapshot.forEach(function(childSnapshot) {
                                var evento = childSnapshot.val();
                                var eventId = childSnapshot.key; // Pega a chave do evento (número do evento)
                                var eventoHtml = `
                                    <div class="event-card">
                                        <img src="${evento.imageurl}" alt="${evento.nomeevento}">
                                        <h2>${evento.nomeevento}</h2>
                                        <p>${evento.informaçõesadicionais}</p>
                                        <button class="cart-button" onclick="comprarIngresso('${eventId}', '${evento.nomeurl}')">Comprar Ingresso</button>
                                    </div>
                                `;
                                $('#eventos-em-destaque').append(eventoHtml);
                            });
                        });
                    } else {
                        console.error('Não foi possível obter as credenciais do Firebase.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Erro na requisição AJAX:', error);
                }
            });
        });

        // Função para comprar ingresso
        function comprarIngresso(eventId, nomeUrl) {
            window.location.href = `/comprar/${eventId}/${nomeUrl}`;
        }
    </script>
</body>
</html>
