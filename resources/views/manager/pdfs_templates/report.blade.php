<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Relatório</title>
    <style>
        #cabecalho>p,
        #titulo>p,
        #resultado>p {
            padding: 0;
            margin: 0;
        }

        #cabecalho {
            font-family: Arial, Helvetica, sans-serif;
            margin-left: 40px;
            float: right;
        }

        #titulo {
            border: 1px solid black;
            text-align: center;
            clear: both;
            padding: 5px;
            background-color: #cccc;
        }

        th,
        td {
            padding: 5px;
            text-align: left;
        }
    </style>
</head>

<body>
    <div>
        <img src="{{ storage_path('app/public/if.png') }}" style="float: left">
        <div id="cabecalho">
            <p style="font-size: 10pt">INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO PERNAMBUCANO</p>
            <p style="font-size: 8pt">Campus Petrolina – Código INEP: 26036096</p>
            <p style="font-size: 8pt">Rua Maria Luiza de Araújo Gomes Cabral, S/N, CEP 56316-686, Petrolina (PE)</p>
            <p style="font-size: 8pt; margin-bottom: 40px;">CNPJ: 10.830.301/0003-68 – Telefone: 87 2101-4300</p><br>
        </div>
    </div>

    <section id="titulo">
        <p>Relatório de Trabalho de Conclusão de Curso da turma <strong>{{ $subject }}</strong>
            @if (!$select_stage)
                por <strong>todas as etapas</strong>,
            @else
                pela <strong>{{ strtolower($select_stage) }}</strong>,
            @endif
            @if (!$select_situation)
                por <strong>todas as situações</strong> e
            @else
                pela situação <strong>{{ strtolower($select_situation) }}</strong> e
            @endif
            @if (!$select_situation)
                por <strong>todos os orientadores</strong>.
            @else
                pelo orientador <strong>{{ strtolower($select_professor) }}</strong>.
            @endif
        </p>
    </section>

    @foreach ($tccs->data as $key => $tcc)
        <section style="margin-top: 30px;" width="100%">
            <table border="1" cellpadding="0" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th colspan="1" width="10%"># {{ $key + 1 }}</th>
                        <th colspan="9" width="90">Nome: {{ $tcc->student->name }}</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td style="padding-top: 30px; padding-bottom: 10px; font-size: 18px;" colspan="10">Dados do(a) aluno(a)</td>
                    </tr>
                    <tr>
                        <th colspan="1" width="10%">Matrícula</th>
                        <th colspan="4" width="40%">E-mail</th>
                        <th colspan="2" width="20%">Telefone</th>
                        <th colspan="1" width="10%">Etapa</th>
                        <th colspan="2" width="20%">Situação</th>
                    </tr>
                    <tr>
                        <td colspan="1">{{ $tcc->student->registration }}</td>
                        <td colspan="4">{{ $tcc->student->email }}</td>
                        <td colspan="2">{{ $tcc->student->phone }}</td>
                        <td colspan="1">{{ $tcc->stage }}</td>
                        <td colspan="2">{{ $tcc->situation }}</td>
                    </tr>
                    <tr>
                        <td style="padding-top: 30px; padding-bottom: 10px; font-size: 18px;" colspan="10">Dados do TCC</td>
                    </tr>
                    <tr>
                        <th colspan="1">Tema</th>
                        <td colspan="4" style="font-size: 14px; text-align: justify">{{ $tcc->theme ?? "-" }}</td>
                        <th colspan="1">Título</th>
                        <td colspan="4" style="font-size: 14px; text-align: justify">{{ $tcc->title ?? "-" }}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Data pretendida 1</th>
                        <td colspan="2">{{ $tcc->date_claim ? date('d/m/Y', strtotime($tcc->date_claim)) : "-" }}</td>
                        <th colspan="3">Comitê de ética</th>
                        <td colspan="2">{{ $tcc->ethics_committee ? "sim" : ($tcc->date_claim ? "não" : "-") }}</td>
                    </tr>
                    <tr>
                        <th colspan="3">Data pretendida 2</th>
                        <td colspan="2">{{ $tcc->intended_date ? date('d/m/Y', strtotime($tcc->intended_date)) : "-" }}</td>
                        <th colspan="3">Tipo de TCC</th>
                        <td colspan="2">@switch($tcc->type_tcc)
                                @case('artigo') Artigo @break
                                @case('cap_livro') Capítulo de livro @break
                                @case('monografia') Monografia @break
                                @case('outro') Outro @break
                                @default - @endswitch
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-top: 30px; padding-bottom: 10px; font-size: 18px;" colspan="10">Dados do(a) orientador(a)</td>
                    </tr>
                    <tr>
                        <th colspan="4" width="10%">Nome</th>
                        <th colspan="4" width="40%">E-mail</th>
                        <th colspan="2" width="20%">Telefone</th>
                    </tr>
                    <tr>
                        @php $aux_professor = false; @endphp
                        @foreach ($professors as $professor)
                            @if ($professor->id == $tcc->professor_id)
                                <td colspan="4">{{ $professor->name }}</td>
                                <td colspan="4">{{ $professor->email }}</td>
                                <td colspan="2">{{ $professor->phone }}</td>
                                @php $aux_professor = true; @endphp
                            @endif
                        @endforeach
                        @if (!$aux_professor)
                            <td colspan="4">-</td>
                            <td colspan="4">-</td>
                            <td colspan="2">-</td>
                        @endif
                    </tr>
                    <tr>
                        <td style="padding-top: 30px; padding-bottom: 10px; font-size: 18px;" colspan="10">Dados do(a) co-orientador(a)</td>
                    </tr>
                    <tr>
                        <th colspan="4" width="10%">Nome</th>
                        <th colspan="4" width="40%">E-mail</th>
                        <th colspan="2" width="20%">Telefone</th>
                    </tr>
                    <tr>
                        @php $aux_coprofessor = false; @endphp
                        @foreach ($professors as $professor)
                            @if ($professor->id == $tcc->coprofessor_id)
                                <td colspan="4">{{ $professor->name }}</td>
                                <td colspan="4">{{ $professor->email }}</td>
                                <td colspan="2">{{ $professor->phone }}</td>
                                @php $aux_coprofessor = true; @endphp
                            @endif
                        @endforeach
                        @if (!$aux_coprofessor)
                            <td colspan="4">-</td>
                            <td colspan="4">-</td>
                            <td colspan="2">-</td>
                        @endif
                    </tr>
                </tbody>
            </table>
        </section>
        @if (!$loop->last)
            <div style="page-break-after: always !important;"></div>
        @endif
    @endforeach
</body>

</html>
