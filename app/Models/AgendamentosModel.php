<?php
namespace App\Models;
use CodeIgniter\Model;

// Model = representa a tabela no banco
class AgendamentosModel extends Model
{
    protected $table = 'AGENDAMENTOS'; // nome da tabela
    protected $primaryKey = 'AGE_ID'; // chave primária

    // Campos permitidos para INSERT/UPDATE
    protected $allowedFields = [
        // colunas na tabela AGENDAMENTOS do banco
        'AGE_DATA_HORA',
        'AGE_MOTIVO',
        'AGE_STATUS',
        'FK_VEI_ID',
        'FK_CLI_ID'
    ];
}