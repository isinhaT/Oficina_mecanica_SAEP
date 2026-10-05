<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Editar Veículo</title>
    </head>
    <body>
        <h1>Editar Veículo</h1>

        <form action="<?= base_url('veiculos/atualizar/'.$veiculos['VEI_ID']) ?>" method="POST">
            <label>Marca:</label><br>
            <input type="text" id="marca" name="marca" value="<?= $veiculos['VEI_MARCA'] ?>" required>
            <br><br>
            <label>Placa:</label><br>
            <input type="text" id="placa" name="placa" value="<?= $veiculos['VEI_PLACA'] ?>" required>
            <br><br>
            <label>Modelo:</label><br>
            <input type="text" id="modelo" name="modelo" value="<?= $veiculos['VEI_MODELO'] ?>" required>
            <br><br>
            <label>Ano:</label><br>
            <input type="text" id="ano" name="ano" value="<?= $veiculos['VEI_ANO'] ?>" required>
            <br><br>
            <label>Cliente:</label><br>
            <select id="clientes" name="clientes" required>
                <?php foreach($clientes as $cli): ?>
                    <option value="<?= $cli['CLI_ID'] ?>"
                        <?= $cli['CLI_ID'] == $veiculos['FK_CLI_ID'] ? 'selected' : '' ?>>
                        <?= $cli['CLI_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <br><br>
            <input type="submit" id="editar_veiculo" name="editar_veiculo" value="Salvar Alterações">
        </form>

        <br>
        <a href="<?= base_url('veiculos') ?>"><button>Voltar</button></a>
    </body>
</html>