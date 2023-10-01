<?php

namespace App\Enum;

enum SupportEnum: string
{
    case A = 'Aguardando Aluno';
    case C = 'Finalizado';
    case P = 'Pendente';
}