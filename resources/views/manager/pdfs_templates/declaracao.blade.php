<!DOCTYPE html>
<html lang="pr-br">

<head>
    @php
        setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
        date_default_timezone_set('America/Sao_Paulo');
    @endphp
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Declaração</title>
    <style>
        #cabecalho>p,
        #titulo>p {
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
            font-weight: bold;
            padding: 5px;
            background-color: #cccc;
        }
    </style>
</head>

<body>
    @foreach ($banca as $membro)
        <div>
            <img src="{{ storage_path('app/public/if.png') }}" style="float: left">
            <div id="cabecalho">
                <p style="font-size: 10pt">INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO PERNAMBUCANO</p>
                <p style="font-size: 8pt">Campus Petrolina – Código INEP: 26036096</p>
                <p style="font-size: 8pt">Rua Maria Luiza de Araújo Gomes Cabral, S/N, CEP 56316-686, Petrolina (PE)</p>
                <p style="font-size: 8pt; margin-bottom: 60px;">CNPJ: 10.830.301/0003-68 – Telefone: 87 2101-4300</p>
                <br>
            </div>
        </div>

        <div id="titulo">
            <p>DECLARAÇÃO</p>
        </div>

        <div id="declaracao">
            <p style="text-align: justify; margin-top: 50px;">Declaramos que o(a) professor(a)
                <strong>{{ $membro->name }}
                    ({{ $tcc->professor->cpf }})</strong>
                participou como <strong>{{ $loop->first ? 'Orientador(a)' : 'Examinador(a) Interno(a)' }}</strong> do
                Trabalho de Conclusão de Curso do(a) aluno(a)
                <strong>{{ $tcc->student->name }} ({{ $tcc->student->registration }})</strong>, intitulado:
            </p>
            <p style="text-align: center">{{ $tcc->title }}</p>
            <p style="text-align: justify">no curso <strong>LICENCIATURA EM COMPUTAÇÃO</strong> da DIRETORIA DE ENSINO
                do
                Campus PETROLINA do Instituto Federal de Educação, Ciência e Tecnologia do Sertão Pernambucano, em
                sessão
                pública realizada em <strong>{{ strftime('%d de %B de %Y', strtotime($tcc->intended_date)) }}</strong>
                às <strong>{{ date('H:i', strtotime($tcc->intended_date)) }}</strong>.
            </p>
            <p style="text-align: center"><strong>Membros da Banca</strong></p>
            <ul style="margin-left: 40px;">
                <li>Professor(a) <strong>{{ $tcc->professor->name }}</strong> (Orientador(a))</li>
                @foreach ($members as $member)
                    <li>Professor(a) <strong>{{ $member->name }}</strong> (Examinador interno)</li>
                @endforeach
            </ul>
        </div>
        <p style="text-align: center; margin-top: 200px">
            Petrolina-PE, {{ strftime('%d de %B de %Y', strtotime('today')) }}
        </p>
        <p style="text-align: center; margin-top: 70px">
            _____________________________________________
        </p>
        <p style="text-align: center">Professor da Disciplina de TCC</p>
        @if (!$loop->last)
            <div style="page-break-after: always !important;"></div>
        @endif
    @endforeach
</body>

</html>
