<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8" />
    <title>AlfabetizaJunto</title>
    <base href="/" />
    <meta name="viewport"
        content="viewport-fit=cover, width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="format-detection" content="telephone=no" />
    <meta name="msapplication-tap-highlight" content="no" />
    <link href="https://fonts.googleapis.com/css?family=Mansalva&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body class="h-100">
    <nav class="navbar navbar-expand-lg navbar-black bg-dark text-white">
        <div class="container">
            <div class=" w-100 d-flex justify-content-between align-items-center">
                <h4 class="m-0">Alfabetiza Junto</h4>
            </div>
        </div>
    </nav>
    <div class="d-flex align-items-center h-100" id="quadro">
        <div class="container align-center" id="container"></div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <script>
        let options = { method: 'GET' }; //opções pra função fetch, nesse caso só tem o método que é GET
        fetch('https://spreadsheets.google.com/feeds/list/1wlq5rZEfXLtSDsAEvPAur9Oos0zBK3MVm3fODGppQUA/od6/public/values?alt=json', options) // usa a função fetch para ler os dados da url do json da planilha
            .then(response => { //apos concluir o fetch então (then) ele executa o código que ta entre {} passando o valor retornado da função fetch pra variavel response
                return response.json() //essa função só retorna a resposta como json
            })
            .then(data => { //apos concluir a função do then anterior ele passa o resultado do response.json() pra variavel data, ou seja, o valor retornado da função anterior
                const dadosDia = data.feed.entry[Math.floor((Date.now() / 86400) % data.feed.entry.length)];
                let frase = dadosDia.gsx$post.$t;
                let post = document.createElement('h4');
                post.setAttribute("class", "white-text");
                post.textContent = frase;
                // SAIBA MAIS
                let saibamais = document.createElement('a');
                saibamais.setAttribute("id", 'linksaibamais');
                saibamais.setAttribute("class", 'btn btn-primary mt-5');
                saibamais.append('Saiba Mais');
                // adiciona fonte
                saibamais.setAttribute("href", dadosDia.gsx$fonte.$t);
                let quadro = document.getElementById('container');
                quadro.append(post);
                quadro.append(saibamais);
            });


    </script>

    <script>
        function notificarFrase() {
            new Notification('AlfabetizaJunto tem uma nova informação para você')
        }

        if (Notification.permission !== "granted") {
            Notification.requestPermission().then(() => notificarFrase());
        } else {
            notificarFrase();
        }
    </script>
    <style type="text/css">
        body {
            font-family: 'Mansalva', cursive;
        }

        html {
            height: 100%;
            overflow-y: hidden;
        }

        #quadro {
            background-image: url(https://i.stack.imgur.com/pMAiU.jpg);
        }

        .align-center {
            text-align: center;
        }
        .white-text {
            color: white;
        }
    </style>
</body>

</html>
