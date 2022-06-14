<!DOCTYPE html>
<html lang="pr-br">

<head>
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
            text-align: center;
            clear: both;
            padding: 5px;
            font-weight: bold;
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
            <p style="font-size: 8pt">CNPJ: 10.830.301/0003-68 – Telefone: 87 2101-4300</p><br>
        </div>
    </div>

    <div id="titulo">
        <p style="margin-top: 40px !important;">DECLARAÇÃO</p>
    </div>

    <div id="declaracao">
        <p>Declaramos que o(a) professor(a) <strong>{{ $tcc->professor->name }}
                ({{ $tcc->professor->cpf }})</strong>
            participou como <strong>Orientador(a)</strong> do Trabalho de Conclusão de Curso do aluno
            <strong>{{ $tcc->student->name }} ({{ $tcc->student->registration }})</strong>, intitulado:
        </p>
        <p style="text-align: center">{{ $tcc->title }}</p>
        <p style="text-align: justify">no curso <strong>LICENCIATURA EM COMPUTAÇÃO</strong> da DIRETORIA DE ENSINO do
            Campus PETROLINA do Instituto Federal de Educação, Ciência e Tecnologia do Sertão Pernambucano, em sessão
            pública realizada em <strong>{{ date('d-m-Y H:i', strtotime($tcc->intended_date)) }}</strong>.
        </p>
        <p style="text-align: center"><strong>Membros da banca</strong></p>
        <ul style="margin-left: 40px;">
            <li>{{ $tcc->professor->name }} (orientador(a))</li>
            @foreach ($members as $member)
                <li>{{ $member->name }}</li>
            @endforeach
        </ul>
    </div>
    <p style="text-align: center; margin-top: 320px">
      Petrolina, {{ date('d-m-Y') }}
    </p>
    <p style="text-align: center; margin-top: 70px">
        _____________________________________________
      </p>
      <p style="text-align: center">Professor da disciplina de TCC</p>

</body>

</html>
