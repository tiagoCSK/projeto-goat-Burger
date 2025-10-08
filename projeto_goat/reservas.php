<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "src/Reserva.php";
require_once "src/ReservaDAO.php";

$dao = new ReservaDAO();

if (isset($_GET['excluir'])) {
    $id = (int) $_GET['excluir'];
    $dao->apagar($id);
    header("Location: reservas.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['editar_id'])) {
    $id = (int) $_POST['editar_id'];
    $data = $_POST['data_reserva'];
    $horario = $_POST['horario'];
    $qtd = $_POST['quantidade_pessoas'];
    $pref = $_POST['preferencia'];
    $restr = $_POST['restricao'];
    $coment = $_POST['comentario'];

    $reserva = new Reserva($data, $horario, $qtd, $pref, $restr, $coment);
    $reserva->setIdReserva($id);
    $dao->atualizar($reserva);
    header("Location: reservas.php");
    exit;
}

$reservas = $dao->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Painel de Reservas</title>
  <link rel="stylesheet" href="assets/css/reservas.css">
<style>
    body { background: #fff8f0; font-family: 'Segoe UI', Arial, sans-serif; margin: 0; padding: 0; color: #333; }
    .barra-topo { background: #b63d15; color: #fff; padding: 15px 20px; display: flex; justify-content: space-between; align-items: center; }
    .marca-topo { font-weight: bold; font-size: 20px; }
    .idioma select { background: #fff; border: none; border-radius: 5px; padding: 5px; }
    h1 { text-align: center; margin-top: 20px; color: #b63d15; font-size: 26px; }
    .resumo { display: flex; justify-content: center; gap: 20px; margin: 20px 0; }
    .card { background: #fff; padding: 15px 20px; border-radius: 12px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); text-align: center; width: 180px; }
    .card h2 { margin: 0; color: #b63d15; }
    .filtros { display: flex; justify-content: center; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
    .filtros input, .filtros select, .filtros button { padding: 7px; border-radius: 6px; border: 1px solid #ccc; }
    table { width: 95%; margin: 0 auto 30px auto; border-collapse: collapse; }
    th, td { padding: 10px; border-bottom: 1px solid #ccc; text-align: center; }
    th { background: #b63d15; color: #fff; }
    .acoes button, .acoes a { padding: 5px 10px; border: none; border-radius: 6px; cursor: pointer; color: #fff; font-weight: bold; margin: 0 2px; text-decoration: none; }
    .editar { background: #ffc107; color: #222; }
    .excluir { background: #dc3545; }
    .btn:hover, .acoes button:hover, .acoes a:hover { opacity: 0.9; }
    .modal { display: none; position: fixed; top:0; left:0; width: 100%; height: 100%; background: rgba(0,0,0,0.6); justify-content: center; align-items: center; }
    .modal-content { background: #fff; padding: 25px; border-radius: 10px; width: 400px; }
    .modal-content h2 { margin-top: 0; color: #b63d15; }
    .modal-content input, .modal-content select { width: 100%; padding: 8px; margin: 5px 0 10px 0; border-radius: 5px; border: 1px solid #ccc; }
    .modal-content .btn { width: 100%; margin-top: 10px; }

    /* ==================== Botão + Nova Reserva ==================== */
    .nova-reserva {
        display: inline-block;
        margin: 20px auto;
        padding: 14px 30px;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
        color: #fff;
        background: linear-gradient(135deg, #b63d15, #e0491e);
        border-radius: 12px;
        text-decoration: none;
        box-shadow: 0 6px 15px rgba(0,0,0,0.2);
        transition: 0.3s ease;
    }

    .nova-reserva:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 18px rgba(0,0,0,0.3);
        background: linear-gradient(135deg, #e0491e, #b63d15);
    }
</style>

</head>
<body>
  <div class="barra-topo">
    <div class="idioma">
      <select>
        <option value="pt" selected>PT</option>
        <option value="en">EN</option>
        <option value="es">ES</option>
      </select>
    </div>
    <div class="marca-topo">GOAT BURGUER</div>
    <button class="perfil">👤</button>
  </div>

  <h1>Painel de Reservas</h1>

  <div class="resumo">
    <div class="card">
      <h2><?= count($reservas) ?></h2>
      <p>Reservas cadastradas</p>
    </div>
    <div class="card">
      <h2><?= array_sum(array_column($reservas, 'quantidade_pessoas')) ?></h2>
      <p>Pessoas esperadas</p>
    </div>
  </div>

  <div class="filtros">
    <input type="date">
    <select>
      <option>Status</option>
      <option>Confirmada</option>
      <option>Aguardando</option>
      <option>Cancelada</option>
      <option>Concluída</option>
    </select>
    <input type="text" placeholder="Buscar cliente...">
    <button>Filtrar</button>
  </div>

  <table>
    <thead>
      <tr>
        <th>Data</th>
        <th>Hora</th>
        <th>Pessoas</th>
        <th>Preferência</th>
        <th>Restrição</th>
        <th>Comentário</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($reservas as $r): ?>
        <tr>
          <td><?= htmlspecialchars($r['data_reserva']) ?></td>
          <td><?= htmlspecialchars($r['horario']) ?></td>
          <td><?= htmlspecialchars($r['quantidade_pessoas']) ?></td>
          <td><?= htmlspecialchars($r['preferencia']) ?></td>
          <td><?= htmlspecialchars($r['restricao']) ?></td>
          <td><?= htmlspecialchars($r['comentario']) ?></td>
          <td class="acoes">
            <button class="editar" onclick="abrirEdicao(<?= $r['id_reserva'] ?>,'<?= $r['data_reserva'] ?>','<?= $r['horario'] ?>','<?= $r['quantidade_pessoas'] ?>','<?= $r['preferencia'] ?>','<?= $r['restricao'] ?>','<?= htmlspecialchars($r['comentario'], ENT_QUOTES) ?>')">Editar</button>
            <a href="?excluir=<?= $r['id_reserva'] ?>" onclick="return confirm('Deseja realmente excluir esta reserva?')" class="excluir">Excluir</a>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  <a href="reservar.php" class="btn" style="display:block; width:200px; margin:20px auto; text-align:center; background:#b63d15;">+ Nova Reserva</a>

  <div class="modal" id="modalEdicao">
    <div class="modal-content">
      <h2>Editar Reserva</h2>
      <form method="POST">
        <input type="hidden" name="editar_id" id="editar_id">
        <label>Data:</label>
        <input type="date" name="data_reserva" id="editar_data">
        <label>Horário:</label>
        <input type="time" name="horario" id="editar_horario">
        <label>Pessoas:</label>
        <input type="number" name="quantidade_pessoas" id="editar_qtd" min="1">
        <label>Preferência:</label>
        <select name="preferencia" id="editar_pref">
          <option value="almoco">Almoço</option>
          <option value="jantar">Jantar</option>
        </select>
        <label>Restrição:</label>
        <select name="restricao" id="editar_restr">
          <option value="sim">Sim</option>
          <option value="nao">Não</option>
        </select>
        <label>Comentário:</label>
        <input type="text" name="comentario" id="editar_coment">
        <button type="submit" class="btn confirmar">Salvar Alterações</button>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById('modalEdicao');
    function abrirEdicao(id, data, hora, qtd, pref, restr, coment) {
      modal.style.display = 'flex';
      document.getElementById('editar_id').value = id;
      document.getElementById('editar_data').value = data;
      document.getElementById('editar_horario').value = hora;
      document.getElementById('editar_qtd').value = qtd;
      document.getElementById('editar_pref').value = pref;
      document.getElementById('editar_restr').value = restr;
      document.getElementById('editar_coment').value = coment;
    }
    modal.addEventListener('click', (e) => { if(e.target===modal) modal.style.display='none'; });
  </script>

</body>
</html>
