<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <title>Novo Veículo</title>
    </head>
    <body>
        <h1>Novo Veículo</h1>
        <form action="<?= base_url('veiculos/inserir') ?>" method="POST">

            <label>Marca:</label><br>
            <input type="text" id="marca" name="marca" required>
            <br><br>
            <label>Placa:</label><br>
            <input type="text" id="placa" name="placa" required>
            <br><br>
            <label>Modelo:</label><br>
            <input type="text" id="modelo" name="modelo" required>
            <br><br>
            <label>Ano:</label><br>
            <input type="text" id="ano" name="ano" required>
            <br><br>

            <label>Cliente:</label><br>
            <select id="clientes" name="clientes" required>
                <option value="">Selecione um cliente</option>
                <?php foreach($clientes as $cli): ?>
                    <option value="<?= $cli['CLI_ID'] ?>">
                        <?= $cli['CLI_NOME'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <br><br>

            <input type="submit" id="cadastrar_veiculo" name="cadastrar_veiculo" value="Cadastrar">
        </form>
        <br>
        <a href="<?= base_url('veiculos') ?>"><button>Voltar</button></a>
    </body>
</html>