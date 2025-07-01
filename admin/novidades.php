<?php
require_once 'verifica_admin.php';
require_once '../services/conexao.php';

if (isset($_GET['remover_id'])) {
    $id_para_remover = $_GET['remover_id'];
    
    $sql = "UPDATE produtos SET is_novidade = 0 WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_para_remover);

    if ($stmt->execute()) {
        header("Location: novidades.php?status=removido");
        exit();
    } else {
        $erro = "Erro ao remover da lista de novidades: " . $stmt->error;
    }
}

require_once 'includes/header.php';

$resultado = $conexao->query("SELECT * FROM produtos WHERE is_novidade = 1 ORDER BY id DESC");
?>

<h2 class="my-4">Gerenciamento de Novidades</h2>

<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Preço</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php if($resultado && $resultado->num_rows > 0): ?>
        <?php while($produto = $resultado->fetch_assoc()): ?>
          <tr>
            <td><?php echo $produto['id']; ?></td>
            <td><img src="../img/<?php echo htmlspecialchars($produto['imagem']); ?>" width="70"></td>
            <td><?php echo htmlspecialchars($produto['nome']); ?></td>
            <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
            <td>
              <button type="button" class="btn btn-warning btn-sm"
                      data-bs-toggle="modal"
                      data-bs-target="#confirmRemoveModal"
                      data-bs-id="<?php echo $produto['id']; ?>">
                Remover de Novidades
              </button>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">Nenhum produto marcado como novidade no momento.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<div class="modal fade" id="confirmRemoveModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Confirmar Remoção</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja remover este item da lista de novidades?
        <br><small class="text-muted">(O produto não será excluído do site, apenas da seção de novidades).</small>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancelar</button>
        <a href="#" id="confirmRemoveLink" class="btn btn-secondary">Sim, Remover</a>
      </div>
    </div>
  </div>
</div>


<?php require_once 'includes/footer.php'; ?>

<script>
const confirmRemoveModal = document.getElementById('confirmRemoveModal');
confirmRemoveModal.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;
  const productId = button.getAttribute('data-bs-id');
  const confirmRemoveLink = document.getElementById('confirmRemoveLink');
  
  confirmRemoveLink.href = `novidades.php?remover_id=${productId}`;
});
</script>