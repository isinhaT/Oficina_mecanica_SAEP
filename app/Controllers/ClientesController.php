<?php
namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\ClientesModel;

class ClientesController extends BaseController
{
    public function index()
    {
        $model = new ClientesModel();

        // Verifica se o formulário de pesquisa foi enviado
        if ($this->request->getPost('botao_pesquisar')) {

            // Recupera o texto digitado no campo de pesquisa
            $pesquisar = $this->request->getPost('pesquisar');

            $dados['clientes'] = $model
                ->like('CLI_NOME', $pesquisar)
                ->orLike('CLI_CPF', $pesquisar)
                ->orLike('CLI_TELEFONE', $pesquisar)
                ->findAll();
        }
        else {

            $dados['clientes'] = $model->findAll();
        }

        return view('sistema/clientes/index', $dados);
    }

    public function novo()
    {
        // Apenas carrega a View com o formulário
        return view('sistema/clientes/novo_cliente');
    }

    public function inserir()
    {
        // Instancia o Model
        $model = new ClientesModel();

        // Recupera os valores enviados pelo formulário
        $dados = [
            'CLI_NOME' => $this->request->getPost('nome'),
            'CLI_CPF' => $this->request->getPost('cpf'),
            'CLI_TELEFONE' => $this->request->getPost('telefone'),
        ];

        $model->insert($dados);

        return redirect()
            ->to(base_url('clientes'))
            ->with('success', 'Cliente cadastrado com sucesso!');
    }

    public function editar($id)
    {
        // Instancia o Model
        $model = new ClientesModel();

        $dados['clientes'] = $model->find($id);

        return view('sistema/clientes/editar_cliente', $dados);
    }

    public function atualizar($id)
    {
        // Instancia o Model
        $model = new ClientesModel();

        // Recupera os novos valores enviados pelo formulário
        $dados = [
            'CLI_NOME' => $this->request->getPost('nome'),
            'CLI_CPF' => $this->request->getPost('cpf'),
            'CLI_TELEFONE' => $this->request->getPost('telefone'),
        ];

        // Atualiza o registro correspondente ao ID
        $model->update($id, $dados);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('clientes'))
            ->with('success', 'Cliente atualizado com sucesso!');
    }

    public function excluir($id)
    {
        // Instancia o Model
        $model = new ClientesModel();

        // Exclui o registro correspondente ao ID
        $model->delete($id);

        // Redireciona para a listagem
        return redirect()
            ->to(base_url('clientes'))
            ->with('success', 'Cliente excluído com sucesso!');
    }
}