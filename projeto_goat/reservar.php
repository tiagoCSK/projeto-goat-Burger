<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "src/Reserva.php";
require_once "src/ReservaDAO.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dados = $_POST;
    $dataBr = $dados['data_reserva'] ?? null;
    $dataFormatada = null;

    if ($dataBr) {
        $dataObj = DateTime::createFromFormat('Y-m-d', $dataBr);
        if ($dataObj) {
            $dataFormatada = $dataObj->format('Y-m-d');
        } else {
            echo "<script>alert('Data inválida.');</script>";
            exit;
        }
    }

    $reserva = new Reserva(
        $dataFormatada,
        $dados['horario'] ?? null,
        $dados['quantidade_pessoas'] ?? 1,
        $dados['preferencia'] ?? 'almoco',
        $dados['restricao'] ?? 'nao',
        $dados['comentario'] ?? ''
    );

    $dao = new ReservaDAO();
    $sucesso = $dao->salvar($reserva);

    if ($sucesso) {
        header("Location: pageUsuario.php"); 
        exit;
    } else {
        $con = new mysqli('localhost', 'root', '1234', 'projetogoat');
        echo "<script>alert('Erro ao salvar reserva: " . $con->error . "');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8" />
    <title>GOAT Burguer - Reserva</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="assets/css/reservar.css" />
</head>
<body>
<div class="barra-topo">
    <div class="idioma">
        <select aria-label="Idioma" id="seletorIdioma">
            <option value="pt" selected>PT</option>
            <option value="en">EN</option>
            <option value="es">ES</option>
        </select>
    </div>
    <div class="marca-topo">GOAT BURGUER</div>
    <div class="perfil" onclick="toggleMenuPerfil()">
        👤 <span id="nomeUsuario">
            <?php 
                session_start();
                echo htmlspecialchars($_SESSION['usuario'] ?? 'Usuário');
            ?>
        </span>
        <div id="menuPerfil" class="menu-perfil" style="display:none">
            <button onclick="logout()">Sair</button>
        </div>
    </div>
</div>

<main class="conteudo">

    <section class="cartao etapa" id="etapa1">
        <header class="cabecalho-cartao">
            <div class="logo"><img src="assets/img/logo-goatburger.png" alt="Logo" /></div>
            <hr class="divisor" />
        </header>
        <h2 class="titulo">Selecione a quantidade de <b>pessoas</b></h2>
        <div class="opcoes" id="opcoesRapidas">
            <button class="opcao" data-numero="1">1</button>
            <button class="opcao" data-numero="2">2</button>
            <button class="opcao" data-numero="3">3</button>
            <button class="opcao" data-numero="4">4</button>
            <button class="opcao" data-numero="5">5</button>
        </div>
        <div class="contador">
            <button class="controle" id="botaoMenos">−</button>
            <div class="numero" id="numeroPessoas">5</div>
            <button class="controle" id="botaoMais">+</button>
        </div>
        <div class="dica" id="dicaPessoas">5 pessoas selecionadas</div>
        <div class="progresso"><div class="barra-progresso" style="width: 12.5%"></div></div>
        <button class="botao-voltar" disabled>← Voltar</button>
        <button class="botao-avancar" onclick="irParaEtapa(2)">Próximo</button>
    </section>

    <section class="cartao etapa" id="etapa2" style="display:none;">
        <header class="cabecalho-cartao">
            <div class="logo"><img src="assets/img/logo-goatburger.png" alt="Logo" /></div>
            <hr class="divisor" />
        </header>
        <h2 class="titulo">Selecione a <b>data</b> da reserva</h2>
        <div class="calendario">
            <div class="cabecalho-calendario">
                <button id="mesAnterior">←</button>
                <div id="rotuloMes">Setembro 2025</div>
                <button id="mesSeguinte">→</button>
            </div>
            <div class="dias-semana">
                <span>SEG</span><span>TER</span><span>QUA</span><span>QUI</span>
                <span>SEX</span><span>SÁB</span><span>DOM</span>
            </div>
            <div class="dias-calendario" id="diasCalendario"></div>
        </div>
        <div class="dica" id="dicaData">Nenhuma data selecionada</div>
        <div class="progresso"><div class="barra-progresso" style="width: 25%"></div></div>
        <button class="botao-voltar" onclick="irParaEtapa(1)">← Voltar</button>
        <button class="botao-avancar" onclick="irParaEtapa(3)">Próximo</button> 
    </section>

    <section class="cartao etapa" id="etapa3" style="display:none;">
        <header class="cabecalho-cartao">
            <div class="logo"><img src="assets/img/logo-goatburger.png" alt="Logo" /></div>
            <hr class="divisor" />
        </header>
        <h2 class="titulo">Preferência de <b>serviço</b></h2>
        <div class="opcoes-servico">
            <button class="botao-servico" data-servico="Almoço">Almoço</button>
            <button class="botao-servico" data-servico="Jantar">Jantar</button>
        </div>
        <div class="dica" id="dicaServico">Nenhuma preferência selecionada</div>
        <div class="progresso"><div class="barra-progresso" style="width: 37.5%"></div></div>
        <button class="botao-voltar" onclick="irParaEtapa(2)">← Voltar</button>
        <button class="botao-avancar" onclick="irParaEtapa(4)">Próximo</button>
    </section>

    <section class="cartao etapa" id="etapa4" style="display:none;">
        <header class="cabecalho-cartao">
            <div class="logo"><img src="assets/img/logo-goatburger.png" alt="Logo" /></div>
            <hr class="divisor" />
        </header>
        <h2 class="titulo">Selecione o <b>horário</b> disponível</h2>
        <div class="colunas-horario">
            <div>
                <div class="rotulo-horario">Dia anterior<br><small>Qua 17, Set</small></div>
                <button class="botao-horario">12:00</button>
                <button class="botao-horario">12:30</button>
                <button class="botao-horario">13:00</button>
                <button class="botao-horario">13:30</button>
                <button class="botao-horario">14:00</button>
            </div>
            <div>
                <div class="rotulo-horario destaque">Reservas disponíveis<br><small>Qui 18, Set</small></div>
                <button class="botao-horario">12:00</button>
                <button class="botao-horario">12:30</button>
                <button class="botao-horario">13:00</button>
                <button class="botao-horario">13:30</button>
                <button class="botao-horario">14:00</button>
            </div>
            <div>
                <div class="rotulo-horario">Próximo dia<br><small>Sex 19, Set</small></div>
                <button class="botao-horario">12:00</button>
                <button class="botao-horario">12:30</button>
                <button class="botao-horario">13:00</button>
                <button class="botao-horario">13:30</button>
                <button class="botao-horario">14:00</button>
            </div>
        </div>
        <div class="dica" id="dicaHorario">Nenhum horário selecionado</div>
        <div class="progresso"><div class="barra-progresso" style="width: 50%"></div></div>
        <button class="botao-voltar" onclick="irParaEtapa(3)">← Voltar</button>
        <button class="botao-avancar" onclick="irParaEtapa(5)">Próximo</button>
    </section>

    <section class="cartao etapa" id="etapa5" style="display:none;">
        <header class="cabecalho-cartao">
            <div class="logo"><img src="assets/img/logo-goatburger.png" alt="Logo" /></div>
            <hr class="divisor" />
        </header>
        <div class="pergunta">Possui restrições alimentares?</div>
        <div class="opcoes-restricao">
            <button class="botao-restricao" data-valor="não">NÃO</button>
            <button class="botao-restricao" data-valor="sim">SIM</button>
        </div>
        <div class="dica" id="dicaRestricao">Nenhuma preferência selecionada</div>
        <div class="progresso"><div class="barra-progresso" style="width: 62.5%"></div></div>
        <button class="botao-voltar" onclick="irParaEtapa(4)">← Voltar</button>
        <button class="botao-avancar" onclick="irParaEtapa(6)">Próximo</button>
    </section>

    <section class="cartao etapa" id="etapa6" style="display:none;">
        <header class="cabecalho-cartao">
            <div class="logo"><img src="assets/img/logo-goatburger.png" alt="Logo" /></div>
            <hr class="divisor" />
        </header>
        <h2 class="titulo">Notas para esta <b>reserva</b></h2>
        <textarea id="campoNotas" placeholder="Escreva aqui alguma observação ou restrição..."></textarea>
        <p class="nota">Faremos o possível para atender suas solicitações, mas não podemos garantir.</p>
        <div class="pergunta">Ocasião especial? Escolha o motivo:</div>
        <div class="opcoes-ocasiao">
            <button class="botao-ocasiao" data-valor="Aniversário">🎉 Aniversário</button>
            <button class="botao-ocasiao" data-valor="Casamento">💍 Aniversário de casamento</button>
            <button class="botao-ocasiao" data-valor="Romântico">❤️ Encontro romântico</button>
            <button class="botao-ocasiao" data-valor="Negócios">💼 Reunião de negócios</button>
            <button class="botao-ocasiao" data-valor="Outro">✨ Outra ocasião especial</button>
        </div>
        <div class="dica" id="dicaOcasião">Nenhuma ocasião selecionada</div>
        <div class="progresso"><div class="barra-progresso" style="width: 75%"></div></div>
        <button class="botao-voltar" onclick="irParaEtapa(5)">← Voltar</button>
        <button class="botao-avancar" onclick="submeterFormulario()">Terminar</button>
    </section>

    <section class="cartao etapa" id="etapa7" style="display:none;">
        <header class="cabecalho-cartao">
            <div class="logo"><img src="assets/img/logo.png" alt="Logo" /></div>
            <hr class="divisor" />
        </header>
        <div class="progresso"><div class="barra-progresso" style="width: 100%"></div></div>
        <button class="botao-avancar" onclick="irParaEtapa(1)">Minhas reservas</button>
    </section>

</main>

<form id="formReserva" action="" method="POST" style="display:none;">
    <input type="hidden" name="quantidade_pessoas" id="inputPessoas">
    <input type="hidden" name="data_reserva" id="inputDataReservaForm">
    <input type="hidden" name="horario" id="inputHorario">
    <input type="hidden" name="preferencia" id="inputPreferencia">
    <input type="hidden" name="restricao" id="inputRestricao">
    <input type="hidden" name="comentario" id="inputComentario">
    <input type="hidden" name="ocasiao" id="inputOcasião">
</form>

<script src="assets/js/app.js"></script>
</body>
</html>
