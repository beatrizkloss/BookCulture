<?php
require_once 'verifica_admin.php';
require_once '../services/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $is_novidade = isset($_POST['is_novidade']) ? 1 : 0;

    $sql = "INSERT INTO produtos (nome, descricao, preco, imagem, is_novidade) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssdsi", $nome, $descricao, $preco, $imagem, $is_novidade);

    if ($stmt->execute()) {
        header("Location: produtos.php?status=sucesso");
        exit();
    } else {
        $erro = "Erro ao adicionar o produto: " . $stmt->error;
    }
}

if (isset($_GET['excluir_id'])) {
    $id_para_excluir = $_GET['excluir_id'];
    
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id_para_excluir);

    if ($stmt->execute()) {
        header("Location: produtos.php?status=excluido");
        exit();
    } else {
        $erro = "Erro ao excluir o produto: " . $stmt->error;
    }
}

require_once 'includes/header.php';
$resultado = $conexao->query("SELECT * FROM produtos ORDER BY id DESC");
?>

<h2 class="my-4">Gerenciamento de Produtos</h2>

<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

<div class="card mb-4 shadow-sm">
  <div class="card-header bg-dark text-white">Adicionar novo livro</div>
  <div class="card-body">
    <form method="POST">
      <div class="row mb-2">
        <div class="col-md-6">
          <input type="text" name="nome" class="form-control" placeholder="Nome do Livro" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="preco" class="form-control" placeholder="Preço (ex: 29.90)" required>
        </div>
        <div class="col-md-3">
          <input type="text" name="imagem" class="form-control" placeholder="Nome do arquivo (ex: livro1.jpg)" required>
        </div>
      </div>
      <div class="mb-3">
        <textarea name="descricao" class="form-control" rows="3" placeholder="Descrição do livro" required></textarea>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_novidade" id="is_novidade" value="1">
        <label class="form-check-label" for="is_novidade">
          Marcar como Novidade
        </label>
      </div>
      
      <button type="submit" name="adicionar" class="btn btn-success">Salvar Livro</button>
    </form>
  </div>
</div>

<div class="table-responsive">
  <table class="table table-bordered table-striped align-middle text-center">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Imagem</th>
        <th>Nome</th>
        <th>Descrição</th>
        <th>Preço</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody>
      <?php while($produto = $resultado->fetch_assoc()): ?>
        <tr>
          <td><?php echo $produto['id']; ?></td>
          <td><img src="../img/<?php echo htmlspecialchars($produto['imagem']); ?>" width="70"></td>
          <td><?php echo htmlspecialchars($produto['nome']); ?></td>
          <td><?php echo htmlspecialchars($produto['descricao']); ?></td>
          <td>R$ <?php echo number_format($produto['preco'], 2, ',', '.'); ?></td>
          <td>
            <a href="produto_form.php?id=<?php echo $produto['id']; ?>" class="btn btn-primary btn-sm">Editar</a>
            <button type="button" class="btn btn-danger btn-sm" 
                    data-bs-toggle="modal" 
                    data-bs-target="#confirmDeleteModal"
                    data-bs-id="<?php echo $produto['id']; ?>">
              Excluir
            </button>
          </td>
        </tr>
      <?php endwhile; ?>
    </tbody>
  </table>
</div>


<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Confirmar Exclusão</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este produto? Esta ação não pode ser desfeita.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
        <a href="#" id="confirmDeleteLink" class="btn btn-secondary">Confirmar Exclusão</a>
      </div>
    </div>
  </div>
</div>


<?php require_once 'includes/footer.php'; ?>

<script>
const confirmDeleteModal = document.getElementById('confirmDeleteModal');
confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;
  const productId = button.getAttribute('data-bs-id');
  const confirmDeleteLink = document.getElementById('confirmDeleteLink');
  confirmDeleteLink.href = `produtos.php?excluir_id=${productId}`;
});
</script>