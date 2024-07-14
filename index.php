<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seu Site</title>
    <style>
        /* Estilos CSS */
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
            padding: 5px 0;
            text-align: center;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: fixed;
            top: 0;
            z-index: 1000;
        }
        .logo {
            max-width: 100px;
            margin-left: 10px;
        }
        .header-links {
            margin-right: 20px;
        }
        .header-links a {
            color: white;
            text-decoration: none;
            margin-left: 20px;
            font-size: 16px;
        }
        .header-links a:hover {
            text-decoration: underline;
        }
        main {
            padding-top: 80px; /* Ajuste para o cabeçalho não sobrepor o conteúdo */
        }
        .event-cards {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }
        .event-card {
            width: calc(22% - 20px); /* Aproximadamente 22% para 4 eventos por linha com espaço entre */
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }
        .event-card img {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-top-left-radius: 5px;
            border-top-right-radius: 5px;
        }
        .event-card h2 {
            margin-top: 10px;
            font-size: 18px;
        }
        .event-card p {
            font-size: 14px;
            color: #555;
            flex-grow: 1;
        }
        footer {
            text-align: center;
            padding: 10px;
            background-color: #f0f0f0;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .cart-button {
            margin-top: 10px;
            padding: 8px 16px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <header>
        <img src="images/logo.jpg" alt="Logo da Empresa" class="logo">
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
