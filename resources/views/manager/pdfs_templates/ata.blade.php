<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ATA - {{$tcc->student->name}} </title>
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
    </style>
</head>

<body>
    <div>
        <img src="{{storage_path('app/public/if.png')}}" style="float: left">
        <div id="cabecalho">
            <p style="font-size: 10pt">INSTITUTO FEDERAL DE EDUCAÇÃO, CIÊNCIA E TECNOLOGIA DO SERTÃO PERNAMBUCANO</p>
            <p style="font-size: 8pt">Campus Petrolina – Código INEP: 26036096</p>
            <p style="font-size: 8pt">Rua Maria Luiza de Araújo Gomes Cabral, S/N, CEP 56316-686, Petrolina (PE)</p>
            <p style="font-size: 8pt">CNPJ: 10.830.301/0003-68 – Telefone: 87 2101-4300</p><br>
        </div>
    </div>

    <div id="titulo" style="margin-top: 30px">
        <p>Ata de Defesa de Trabalho de Conclusão de Curso</p>
    </div>
    <div id="descricao" style="margin-top: 30px;text-align: justify">
        <p>Na presente data realizou-se a sessão pública de defesa do Trabalho de Conclusão de
            Curso intitulado <strong>{{ $tcc->title }}</strong> apresentada pelo aluno <strong>{{ $tcc->student->name }}
                (201925030103)</strong> do Curso <strong>LICENCIATURA EM COMPUTAÇÃO</strong>. Os trabalhos foram
            iniciados às {{date('H:i',strtotime($tcc->intended_date))}} pelo(a) Professor(a) presidente da banca
            examinadora, constituída pelos seguintes membros:</p>
    </div>
    <div id="banca">
        <ul style="margin-left: 20px; font-weight: bold">
            <li>{{$tcc->professor->name}}</li>
            @foreach($members as $member)
            <li>{{$member->name}}</li>
            @endforeach
        </ul>
    </div>
    <div id="descricao_dois" style="margin-top: 5px;text-align: justify">
        <p>A banca examinadora, tendo terminado a apresentação do conteúdo do Trabalho de Conclusão de Curso, passou à
            arguição do(a) candidato(a). Em seguida, os examinadores reuniram-se para avaliação e deram o parecer final
            sobre o trabalho apresentado pelo(a) aluno(a), tendo sido atribuído o seguinte resultado:</p>
    </div>
    <div id="resultado">
        <p style="margin-left: 30px">
            [ ] Reprovado<br>
            [ ] Aprovado sem Restrições<br>
            [ ] Aprovado com Restrições<br>
        </p>
        <p style="margin-top: 5px"> O aluno deverá entregar as alterações necessárias até o dia ___/___/______</p>
        <p>Nota:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Valor inteiro de ZERO a CEM)</p>
    </div>
    <div id="observacao">
        <p><strong>Observação / Apreciações:</strong></p>
    </div>


    <div id="texto-final" style="margin-top: 20px">
        <p style="text-align: justify">Proclamados os resultados pelo presidente da banca examinadora, foram encerrados
            os trabalhos e, para constar, eu <strong>Delza Cristina Guedes Amorim</strong> lavrei a presente ata que
            assino junto aos demais membros da banca examinadora.</p>
    </div>
    <div id="data" style="width: 100%; text-align: center;  margin-top: 40px">Petrolina, {{@datebr(now())}}</div>
    <div>
        <div id="orientador" style="margin-top: 20px; float:left;">
            <p style="text-align: center">__________________________________________</p>
            <p style="text-align: center"><strong>{{$tcc->professor->name}}</strong></p>
            <p style="text-align: center">Avaliador 1 (orietador)</p>
        </div>
        @foreach ($members as $member)
        @if($loop->first)
        <div id="avaliador_dois" style="margin-top: 20px; float: right;">
            <p style="text-align: center">__________________________________________</p>
            <p style="text-align: center"><strong>{{$member->name}}</strong></p>
            <p style="text-align: center">Avaliador 2</p>
        </div>
    </div>
    @elseif($loop->index == 1)
    <div style="clear: both">
        <div id="avaliador_dois" style="margin-top: 20px; float: left;">
            <p style="text-align: center">__________________________________________</p>
            <p style="text-align: center"><strong>{{$member->name}}</strong></p>
            <p style="text-align: center">Avaliador 3</p>
        </div>
        @elseif($loop->index == 2)
        <div id="avaliador_tres" style="margin-top: 20px; float: right;">
            <p style="text-align: center">__________________________________________</p>
            <p style="text-align: center"><strong>{{$member->name}}</strong></p>
            <p style="text-align: center">Avaliador 4</p>
        </div>
    </div>
    @endif
    @endforeach
    <div style="clear: both"></div>
    <div id="aluno" style="margin-top: 20px; float: right;">
        <p style="text-align: center">__________________________________________</p>
        <p style="text-align: center"><strong>{{$tcc->student->name}}</strong></p>
        <p style="text-align: center">Aluno</p>
    </div>
    </div>
</body>

</html>
