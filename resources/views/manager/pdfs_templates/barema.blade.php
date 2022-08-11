<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Barema de avaliação - {{ $tcc->student->name }}</title>
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
            padding: 5px;
            background-color: #cccc;
        }

        #informacoes>p {
            margin-top: 10px;
        }

        table,
        th,
        td {
            border: 1px solid black;
            border-collapse: collapse;
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

    <div id="titulo">
        <p>Barema de Avaliação do Trabalho de Conclusão de Curso</p>
    </div>

    <div id="infomacoes" style="margin-top: 40px">
        <p><strong>Curso:</strong> Licenciatura em Computação</p>
        <p><strong>Aluno:</strong> {{$tcc->student->name}}</p>
        <p><strong>Titulo TCC:</strong> {{$tcc->title}}</p>
        <p><strong>Data defesa: </strong>{{ @datebr($tcc->intended_date)}} <strong>Hora:</strong> {{date('H:i',
            strtotime($tcc->intended_date))}}</p>
    </div>

    <div id="barema">
        <table width="100%">
            <thead style="background-color: #cccc">
                <tr>
                    <th>Item</th>
                    <th>Valor Máximo</th>
                    <th>Pontos</th>
                </tr>
                <tr>
                    <th colspan="3">Apresentação do Trabalho Escrito</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Relevância e Contemporaneidade do tema</td>
                    <td>5</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Abrangência e profundidade da literatura utilizada</td>
                    <td>5</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Análise dos resultados e sua discussão a partir do suporte da literatura utilizada</td>
                    <td>10</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Organização lógica e equilíbrio entre as partes (introdução, desenvolvimento e conclusão)</td>
                    <td>10</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Clareza, objetividade e capacidade de síntese</td>
                    <td>10</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Observação das normas ABNT e das especificações técnicas para apresentação</td>
                    <td>10</td>
                    <td></td>
                </tr>
                <tr style="background-color: #cccc">
                    <th colspan="3">Apresentação Oral</th>
                </tr>
                <tr>
                    <td>Definição dos objetivos</td>
                    <td>5</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Lógica da apresentação (demonstrar, explicar, inferir e concluir)</td>
                    <td>15</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Recursos de apresentação</td>
                    <td>5</td>
                    <td></td>
                </tr>
                <tr>
                    <td>Conhecimento do assunto</td>
                    <td>15</td>
                    <td></td>
                </tr>

                <tr>
                    <td>Capacidade de síntese</td>
                    <td>10</td>
                    <td></td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align: right; margin-right: 4px"><strong>Conceito</strong> (total de
                        pontos) </td>
                    <td></td>
                </tr>
            </tbody>
        </table>
        <div id="data" style="width: 100%; text-align: center;  margin-top: 40px">Petrolina, {{@datebr(now())}}</div>

        <div id="orientador" style="margin-top: 20px; {{count((array) $members) == 3 ? 'float: left;' : null}}">
            <p style="text-align: center">__________________________________________</p>
            <p style="text-align: center"><strong>{{$tcc->professor->name}}</strong></p>
            <p style="text-align: center">Avaliador 1 (orietador)</p>
        </div>
        @foreach ($members as $member)
            @if($loop->first)
            <div id="avaliador_dois" style="margin-top: 20px;{{count((array) $members) == 3 ? 'float: right;' : 'float: left;'}}">
                <p style="text-align: center">__________________________________________</p>
                <p style="text-align: center"><strong>{{$member->name}}</strong></p>
                <p style="text-align: center">Avaliador 2</p>
            </div>
            @endif
            <div style="clear: both"></div>
            @if($loop->index == 1)
            <div style="clear: both"></div>
            <div id="avaliador_dois" style="margin-top: 20px; {{count((array) $members) == 3 ? 'float: left;' : 'float: right;'}}">
                <p style="text-align: center">__________________________________________</p>
                <p style="text-align: center"><strong>{{$member->name}}</strong></p>
                <p style="text-align: center">Avaliador 3</p>
            </div>
            @endif
            @if($loop->index == 2)
            <div id="avaliador_tres" style="margin-top: 20px; {{count((array) $members) == 3 ? 'float: right;' : 'float: left;'}}">
                <p style="text-align: center">__________________________________________</p>
                <p style="text-align: center"><strong>{{$member->name}}</strong></p>
                <p style="text-align: center">Avaliador 4</p>
            </div>
          
            @endif
        @endforeach
    </div>
</body>

</html>
