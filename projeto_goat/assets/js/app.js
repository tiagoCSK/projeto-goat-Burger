let quantidadePessoas = 5;
const minimoPessoas = 1;
const maximoPessoas = 20;

const elementoNumero = document.getElementById('numeroPessoas');
const elementoDica = document.getElementById('dicaPessoas');
const barraProgresso = document.querySelector('.barra-progresso');
const opcoesRapidas = document.querySelectorAll('.opcao');
const botaoMenos = document.getElementById('botaoMenos');
const botaoMais = document.getElementById('botaoMais');

// Inicializa os eventos e interface da etapa 1 (quantidade de pessoas)
function iniciarEtapa1() {
  opcoesRapidas.forEach(botao => {
    const valor = parseInt(botao.dataset.numero, 10);
    botao.classList.toggle('ativo', valor === quantidadePessoas);
    botao.addEventListener('click', () => definirQuantidade(valor));
  });

  botaoMenos.addEventListener('click', () => alterarQuantidade(-1));
  botaoMais.addEventListener('click', () => alterarQuantidade(1));

  atualizarInterface();
  atualizarBarraProgresso(1); 
}

function definirQuantidade(valor) {
  quantidadePessoas = limitar(valor, minimoPessoas, maximoPessoas);
  atualizarInterface();
  atualizarBarraProgresso(1); 
}

function alterarQuantidade(delta) {
  definirQuantidade(quantidadePessoas + delta);
}

function atualizarInterface() {
  elementoNumero.textContent = quantidadePessoas;
  elementoDica.textContent = quantidadePessoas === 1
    ? '1 pessoa selecionada'
    : `${quantidadePessoas} pessoas selecionadas`;

  opcoesRapidas.forEach(botao => {
    const valor = parseInt(botao.dataset.numero, 10);
    botao.classList.toggle('ativo', valor === quantidadePessoas);
  });
}

function limitar(valor, minimo, maximo) {
  return Math.max(minimo, Math.min(maximo, valor));
}

const diasCalendario = document.getElementById('diasCalendario');
const rotuloMes = document.getElementById('rotuloMes');
const dicaData = document.getElementById('dicaData');

let mesAtual = 8;
let anoAtual = 2025;
let diaSelecionado = null;

const nomesMeses = [
  "Janeiro","Fevereiro","Março","Abril","Maio","Junho",
  "Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"
];

const botaoMesAnterior = document.getElementById('mesAnterior');
const botaoMesSeguinte = document.getElementById('mesSeguinte');

botaoMesAnterior.addEventListener('click', () => {
  mesAtual = mesAtual - 1;
  if (mesAtual < 0) { mesAtual = 11; anoAtual--; }
  renderizarCalendario();
});

botaoMesSeguinte.addEventListener('click', () => {
  mesAtual = mesAtual + 1;
  if (mesAtual > 11) { mesAtual = 0; anoAtual++; }
  renderizarCalendario();
});

// Renderiza os dias no calendário
function renderizarCalendario() {
  diasCalendario.innerHTML = "";
  const primeiroDia = new Date(anoAtual, mesAtual, 1).getDay();
  const diasNoMes = new Date(anoAtual, mesAtual + 1, 0).getDate();
  const deslocamento = (primeiroDia === 0 ? 6 : primeiroDia - 1);

  for (let i = 0; i < deslocamento; i++) {
    const vazio = document.createElement('div');
    vazio.classList.add('dia','vazio');
    diasCalendario.appendChild(vazio);
  }

  for (let d = 1; d <= diasNoMes; d++) {
    const botaoDia = document.createElement('button');
    botaoDia.classList.add('dia');
    botaoDia.textContent = d;

    const dataAtual = `${anoAtual}-${String(mesAtual + 1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
    botaoDia.dataset.data = dataAtual;

    if (dataAtual === diaSelecionado) botaoDia.classList.add('ativo');

    botaoDia.addEventListener('click', () => {
      selecionarDia(d, dataAtual, botaoDia);
    });

    diasCalendario.appendChild(botaoDia);
  }

  rotuloMes.textContent = `${nomesMeses[mesAtual]} ${anoAtual}`;
}

// Define a data selecionada
function selecionarDia(dia, dataAtual, botao) {
  diaSelecionado = dataAtual;
  document.getElementById('inputDataReservaForm').value = diaSelecionado;

  document.querySelectorAll('.dia').forEach(b => b.classList.remove('ativo'));
  botao.classList.add('ativo');

  dicaData.textContent = `Data selecionada: ${dia} de ${nomesMeses[mesAtual]} de ${anoAtual}`;
  atualizarBarraProgresso(2);
}

const objServico = { valor: null };
const objHorario = { valor: null };
const objRestricao = { valor: null };
const objOcasiao = { valor: null };

const botoesServico = document.querySelectorAll(".botao-servico");
const dicaServico = document.getElementById("dicaServico");

const horariosAlmoco = ["12:00","12:30","13:00","13:30","14:00"];
const horariosJanta = ["18:00","18:30","19:00","19:30","20:00"];

// Seleção do tipo de serviço
botoesServico.forEach(botao => {
  botao.addEventListener("click", () => {
    botoesServico.forEach(b => b.classList.remove("ativo"));
    botao.classList.add("ativo");

    objServico.valor = botao.dataset.servico;
    document.getElementById('inputPreferencia').value = objServico.valor;

    dicaServico.textContent = `${objServico.valor} selecionado`;
    atualizarBarraProgresso(3);
    atualizarHorarios(objServico.valor);
  });
});

// Atualiza os horários com base no serviço
function atualizarHorarios(servico) {
  const botoesHorario = document.querySelectorAll(".botao-horario");
  botoesHorario.forEach((btn, index) => {
    if(servico === "Almoço") {
      btn.textContent = horariosAlmoco[index] || "";
      btn.style.display = horariosAlmoco[index] ? "inline-block" : "none";
    } else if(servico === "Jantar") {
      btn.textContent = horariosJanta[index] || "";
      btn.style.display = horariosJanta[index] ? "inline-block" : "none";
    }
    btn.classList.remove("ativo");
  });

  objHorario.valor = null;
  document.getElementById("dicaHorario").textContent = "Nenhum horário selecionado";
}

const dicaHorario = document.getElementById("dicaHorario");
const botoesHorario = document.querySelectorAll(".botao-horario");

botoesHorario.forEach(btn => {
  btn.addEventListener("click", () => {
    botoesHorario.forEach(b => b.classList.remove("ativo"));
    btn.classList.add("ativo");
    objHorario.valor = btn.textContent;
    dicaHorario.textContent = btn.textContent;
    atualizarBarraProgresso(4);
  });
});

configurarGrupoBotoes('.botao-restricao', 'valor', document.getElementById('dicaRestricao'), objRestricao, 5);
configurarGrupoBotoes('.botao-ocasiao', 'valor', document.getElementById('dicaOcasião'), objOcasiao, 6);

function configurarGrupoBotoes(seletor, atributo, dicaElemento, obj, etapa) {
  const botoes = document.querySelectorAll(seletor);
  botoes.forEach(botao => {
    botao.addEventListener('click', () => {
      botoes.forEach(b => b.classList.remove('ativo'));
      botao.classList.add('ativo');
      obj.valor = atributo ? botao.dataset[atributo] : botao.textContent;
      if(dicaElemento) dicaElemento.textContent = `${obj.valor} selecionado`;
      atualizarBarraProgresso(etapa);
    });
  });
}

// Atualiza visualmente a barra de progresso
function atualizarBarraProgresso(etapa) {
  if (!barraProgresso) return;
  const unidades = (etapa === 7) ? 8 : etapa;
  const percentual = unidades * 12.5;
  barraProgresso.style.width = `${Math.min(percentual, 100)}%`;
}

// Controla a navegação entre etapas
function irParaEtapa(numero) {
  if (numero === 2 && quantidadePessoas < 1) { alert("Selecione a quantidade de pessoas!"); return; }
  if (numero === 3 && !diaSelecionado) { alert("Selecione uma data!"); return; }
  if (numero === 4 && !objServico.valor) { alert("Selecione um serviço!"); return; }
  if (numero === 5 && !objHorario.valor) { alert("Selecione um horário!"); return; }
  if (numero === 6 && !objRestricao.valor) { alert("Selecione se possui restrição alimentar!"); return; }
  if (numero === 4) {
    renderizarHorariosComDias(diaSelecionado);
  }

  const etapas = document.querySelectorAll('.etapa');
  etapas.forEach((etapa, idx) => {
    etapa.style.display = idx === numero - 1 ? 'block' : 'none';
  });

  atualizarBarraProgresso(numero === 7 ? 7 : numero - 1);
}

// Submete o formulário com os dados selecionados
function submeterFormulario() {
  document.getElementById('inputPessoas').value = quantidadePessoas;
  document.getElementById('inputDataReservaForm').value = diaSelecionado || '';
  document.getElementById('inputHorario').value = objHorario.valor || '';
  document.getElementById('inputPreferencia').value = objServico.valor;
  document.getElementById('inputRestricao').value = objRestricao.valor || '';
  document.getElementById('inputComentario').value = document.getElementById('campoNotas').value || '';
  document.getElementById('inputOcasião').value = objOcasiao.valor || '';
  document.getElementById('formReserva').submit();
}

function toggleMenuPerfil() {
  const menu = document.getElementById('menuPerfil');
  menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

window.addEventListener('click', (e) => {
  const menu = document.getElementById('menuPerfil');
  const perfil = document.querySelector('.perfil');
  if (!perfil.contains(e.target)) menu.style.display = 'none';
});

function logout() {
  window.location.href = 'index.php';
}

// Inicializa a página
document.addEventListener('DOMContentLoaded', () => {
  renderizarCalendario();
  iniciarEtapa1();
});

// Renderiza horários dinâmicos para o dia selecionado e dias adjacentes
function renderizarHorariosComDias(dataSelecionadaStr) {
  const dias = gerarDiasContexto(dataSelecionadaStr);
  const container = document.querySelector('.colunas-horario');
  container.innerHTML = '';

  dias.forEach((data) => {
    const diaSemana = ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb'][data.getDay()];
    const dia = data.getDate();
    const mes = ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'][data.getMonth()];
    const dataISO = data.toISOString().split('T')[0];

    const rotulo =
      dataISO === dataSelecionadaStr
        ? 'Selecionado'
        : dataISO < dataSelecionadaStr
        ? 'Dia anterior'
        : 'Próximo dia';

    const coluna = document.createElement('div');
    coluna.innerHTML = `
      <div class="rotulo-horario destaque" data-data="${dataISO}">
        ${rotulo}<br><small>${diaSemana} ${dia}, ${mes}</small>
      </div>
    `;

    const horarios = objServico.valor === "Jantar" ? horariosJanta : horariosAlmoco;
    horarios.forEach(horario => {
      const btn = document.createElement('button');
      btn.classList.add('botao-horario');
      btn.textContent = horario;

      if (dataISO === diaSelecionado && horario === objHorario.valor) {
        btn.classList.add('ativo');
      }

      btn.addEventListener('click', () => {
        objHorario.valor = horario;
        diaSelecionado = dataISO;
        document.getElementById('inputHorario').value = horario;
        document.getElementById('inputDataReservaForm').value = diaSelecionado;
        dicaHorario.textContent = `Horário selecionado: ${horario}`;
        atualizarBarraProgresso(4);

        document.querySelectorAll('.botao-horario').forEach(b => b.classList.remove('ativo'));
        btn.classList.add('ativo');
      });

      coluna.appendChild(btn);
    });

    container.appendChild(coluna);
  });

  document.querySelectorAll('.rotulo-horario').forEach(rotulo => {
    rotulo.addEventListener('click', () => {
      const novaData = rotulo.dataset.data;
      renderizarHorariosComDias(novaData);
      diaSelecionado = novaData;
      document.getElementById('inputDataReservaForm').value = novaData;
    });
  });
}

// Gera dia anterior, atual e seguinte a partir de uma data base
function gerarDiasContexto(dataBaseStr) {
  const [ano, mes, dia] = dataBaseStr.split('-').map(Number);
  const base = new Date(ano, mes - 1, dia);

  const diaAnterior = new Date(base);
  diaAnterior.setDate(base.getDate() - 1);

  const diaSeguinte = new Date(base);
  diaSeguinte.setDate(base.getDate() + 1);

  return [diaAnterior, base, diaSeguinte];
}
