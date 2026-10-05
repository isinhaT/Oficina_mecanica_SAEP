<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ClientesModel;
use App\Models\VeiculosModel;

class VeiculosController extends BaseController
{
    public function index()
    {
        $model = new VeiculosModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado pelo usuário
            $pesquisar = $this->request->getPost('pesquisar');

            $dados['veiculos'] = $model
                ->select('VEICULOS.*, CLIENTES.CLI_NOME')

                ->join(
                    'CLIENTES',
                    'CLIENTES.CLI_ID = VEICULOS.FK_CLI_ID'
                )

                // Agrupa as condições da pesquisa
                ->groupStart()

                    ->like('VEI_MARCA', $pesquisar)

                    ->orLike('VEI_PLACA', $pesquisar)

                    ->orLike('VEI_MODELO', $pesquisar)

                    ->orLike('VEI_ANO', $pesquisar)

                    ->orLike('CLIENTES.CLI_NOME', $pesquisar)

                ->groupEnd()

                // Executa a consulta
                ->findAll();
        }
        else {

            $dados['veiculos'] = $model
                ->select('VEICULOS.*, CLIENTES.CLI_NOME')
                ->join(
                    'CLIENTES',
                    'CLIENTES.CLI_ID = VEICULOS.FK_CLI_ID'
                )
                ->findAll();
        }

        return view('sistema/veiculos/index', $dados);
    }


    public function novo()
    {
        $clientesModel = new ClientesModel();

        $dados['clientes'] = $clientesModel->findAll();

        // Carrega o formulário de cadastro do veículo
        return view('sistema/veiculos/novo_veiculo', $dados);
    }

    public function inserir()
    {

        $model = new VeiculosModel();

        // Recupera os dados enviados pelo formulário
        $dados = [
            'VEI_MARCA' => $this->request->getPost('marca'),
            'VEI_PLACA' => $this->request->getPost('placa'),
            'VEI_MODELO' => $this->request->getPost('modelo'),
            'VEI_ANO' => $this->request->getPost('ano'),

            'FK_CLI_ID' => $this->request->getPost('clientes')
        ];

        $model->insert($dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('veiculos'))
            ->with('success', 'Veículo cadastrado com sucesso!');
    }


    // Exibe o formulário de edição
    public function editar($id)
    {

        $veiculosModel = new VeiculosModel();

        $clientesModel = new ClientesModel();

        $dados['veiculos'] = $veiculosModel->find($id);

        $dados['clientes'] = $clientesModel->findAll();

        // Carrega a View de edição
        return view('sistema/veiculos/editar_veiculo', $dados);
    }

    public function atualizar($id)
    {
        // Instancia o Model
        $model = new VeiculosModel();

        // Recupera os novos dados do formulário
        $dados = [
            'VEI_MARCA' => $this->request->getPost('marca'),
            'VEI_PLACA' => $this->request->getPost('placa'),
            'VEI_MODELO' => $this->request->getPost('modelo'),
            'VEI_ANO' => $this->request->getPost('ano'),
            
            'FK_CLI_ID' => $this->request->getPost('clientes')
        ];

        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('veiculos'))
            ->with('success', 'Veículo atualizado com sucesso!');
    }


    public function excluir($id)
    {
        // Instancia o Model
        $model = new VeiculosModel();

        // Exclui o veículo pelo ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('veiculos'))
            ->with('success', 'Veículo excluído com sucesso!');
    }
}