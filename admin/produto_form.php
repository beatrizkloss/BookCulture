<?php
require_once 'verifica_admin.php';
require_once '../services/conexao.php';

//formulário para editar produtos
$page_title = 'Adicionar Produto';
$produto = [
    'id' => '',
    'nome' => '',
    'descricao' => '',
    'preco' => '',
    'imagem' => '',
    'is_novidade' => 0 
];
if (isset($_GET['id'])) {
    $page_title = 'Editar Produto';
    $id = $_GET['id'];

    $sql = "SELECT * FROM produtos WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    
    if ($resultado->num_rows === 1) {
        $produto = $resultado->fetch_assoc();
    } else {
        header("Location: produtos.php?status=erro_nao_encontrado");
        exit();
    }
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];
    $imagem = $_POST['imagem'];
    $is_novidade = isset($_POST['is_novidade']) ? 1 : 0;

    if (empty($id)) { 
        $sql = "INSERT INTO produtos (nome, descricao, preco, imagem, is_novidade) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssdsi", $nome, $descricao, $preco, $imagem, $is_novidade);
    } else { 
        $sql = "UPDATE produtos SET nome = ?, descricao = ?, preco = ?, imagem = ?, is_novidade = ? WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("ssdsii", $nome, $descricao, $preco, $imagem, $is_novidade, $id);
    }

    if ($stmt->execute()) {
        header("Location: produtos.php?status=sucesso");
        exit();
    } else {
        $erro = "Erro ao salvar o produto: " . $stmt->error;
    }
}

require_once 'includes/header.php';
?>

<h2 class="my-4"><?php echo $page_title; ?></h2>

<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>

<div class="card shadow-sm">
  <div class="card-body">
    <form action="produto_form.php<?php if (!empty($produto['id'])) echo '?id=' . $produto['id']; ?>" method="POST">
      <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">

      <div class="mb-3">
        <label for="nome" class="form-label">Nome do Livro</label>
        <input type="text" name="nome" id="nome" class="form-control" value="<?php echo htmlspecialchars($produto['nome']); ?>" required>
      </div>
      <div class="mb-3">
        <label for="descricao" class="form-label">Descrição</label>
        <textarea name="descricao" id="descricao" class="form-control" rows="4" required><?php echo htmlspecialchars($produto['descricao']); ?></textarea>
      </div>
      <div class="row">
        <div class="col-md-6 mb-3">
          <label for="preco" class="form-label">Preço (ex: 49.90)</label>
          <input type="text" name="preco" id="preco" class="form-control" value="<?php echo htmlspecialchars($produto['preco']); ?>" required>
        </div>
        <div class="col-md-6 mb-3">
          <label for="imagem" class="form-label">Nome do Arquivo de Imagem (ex: livro1.jpg)</label>
          <input type="text" name="imagem" id="imagem" class="form-control" value="<?php echo htmlspecialchars($produto['imagem']); ?>" required>
        </div>
      </div>
      
      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" name="is_novidade" id="is_novidade" value="1" <?php if (!empty($produto['is_novidade']) && $produto['is_novidade'] == 1) echo 'checked'; ?>>
        <label class="form-check-label" for="is_novidade">
          Marcar como Novidade 
        </label>
      </div>
      
      <button type="submit" class="btn btn-success">Salvar</button>
      <a href="produtos.php" class="btn btn-secondary">Cancelar</a>
    </form>
  </div>
</div>

<?php 
require_once 'includes/footer.php'; 
?>