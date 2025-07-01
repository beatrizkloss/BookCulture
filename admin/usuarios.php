<?php
require_once 'verifica_admin.php';
require_once '../services/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['adicionar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $is_admin = 1;

    $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);

    $check_sql = "SELECT id FROM usuarios WHERE email = ?";
    $check_stmt = $conexao->prepare($check_sql);
    $check_stmt->bind_param("s", $email);
    $check_stmt->execute();
    $check_result = $check_stmt->get_result();

    if ($check_result->num_rows > 0) {
        $erro = "Este email já está cadastrado. Tente outro.";
    } else {
        $sql = "INSERT INTO usuarios (nome, email, senha, is_admin) VALUES (?, ?, ?, ?)";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("sssi", $nome, $email, $senha_hashed, $is_admin);

        if ($stmt->execute()) {
            header("Location: usuarios.php?status=sucesso_admin");
            exit();
        } else {
            $erro = "Erro ao adicionar o administrador: " . $stmt->error;
        }
    }
}


// --- LÓGICA PARA EXCLUIR USUÁRIO ---
if (isset($_GET['excluir_id'])) {
    $id_para_excluir = $_GET['excluir_id'];
    if ($id_para_excluir == $_SESSION['admin_id']) {
        $erro = "Você não pode excluir sua própria conta de administrador.";
    } else {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $conexao->prepare($sql);
        $stmt->bind_param("i", $id_para_excluir);
        if ($stmt->execute()) {
            header("Location: usuarios.php?status=excluido"); exit();
        } else { $erro = "Erro ao excluir o usuário: " . $stmt->error; }
    }
}

require_once 'includes/header.php';

$admins_res = $conexao->query("SELECT id, nome, email FROM usuarios WHERE is_admin = 1 ORDER BY nome ASC");
$clientes_res = $conexao->query("SELECT id, nome, email FROM usuarios WHERE is_admin = 0 ORDER BY nome ASC");
?>

<h2 class="my-4">Gerenciamento de Usuários</h2>

<?php if(isset($erro)) echo "<div class='alert alert-danger'>$erro</div>"; ?>
<?php if(isset($_GET['status']) && in_array($_GET['status'], ['sucesso', 'excluido', 'editado_sucesso'])) echo "<div class='alert alert-success'>Ação executada com sucesso!</div>"; ?>

<div class="card mb-4 shadow-sm">
  <div class="card-header bg-dark text-white">Adicionar novo usuário</div>
    <div class="card-body">
    <form method="POST">
      <div class="row">
        <div class="col-md-4 mb-3"><input type="text" name="nome" class="form-control" placeholder="Nome completo" required></div>
        <div class="col-md-4 mb-3"><input type="email" name="email" class="form-control" placeholder="Email" required></div>
        <div class="col-md-4 mb-3"><input type="password" name="senha" class="form-control" placeholder="Senha" required></div>
      </div>
      <div class="row align-items-end">
        <div class="col-md-8 text-end"><button type="submit" name="adicionar" class="btn btn-success">Adicionar Usuário</button></div>
      </div>
    </form>
  </div>
</div>

<div class="row">
    <div class="col-md-6">
        <h4><span class="badge bg-primary">Administradores</span></h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark"><tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr></thead>
                <tbody>
                    <?php while($usuario = $admins_res->fetch_assoc()): ?>
                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td>
                                <a href="usuario_form.php?id=<?= $usuario['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                <?php if ($usuario['id'] != $_SESSION['admin_id']): ?>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-bs-id="<?= $usuario['id'] ?>">Excluir</button>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <h4><span class="badge bg-secondary">Clientes</span></h4>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark"><tr><th>ID</th><th>Nome</th><th>Email</th><th>Ações</th></tr></thead>
                <tbody>
                    <?php while($usuario = $clientes_res->fetch_assoc()): ?>
                        <tr>
                            <td><?= $usuario['id'] ?></td>
                            <td><?= htmlspecialchars($usuario['nome']) ?></td>
                            <td><?= htmlspecialchars($usuario['email']) ?></td>
                            <td>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal" data-bs-id="<?= $usuario['id'] ?>">Excluir</button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header"><h5 class="modal-title" id="modalLabel">Confirmar Exclusão</h5><button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button></div>
      <div class="modal-body">Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.</div>
      <div class="modal-footer"><button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button><a href="#" id="confirmDeleteLink" class="btn btn-secondary">Confirmar Exclusão</a></div>
    </div>btn btn-secondary
  </div>
</div>

<?php require_once 'includes/footer.php'; ?>

<script>
const confirmDeleteModal = document.getElementById('confirmDeleteModal');
confirmDeleteModal.addEventListener('show.bs.modal', function (event) {
  const button = event.relatedTarget;
  const userId = button.getAttribute('data-bs-id');
  const confirmDeleteLink = document.getElementById('confirmDeleteLink');
  confirmDeleteLink.href = `usuarios.php?excluir_id=${userId}`;
});
</script>