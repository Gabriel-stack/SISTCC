#SISTEMA DE TRABALHO DE CONCLUSÃO DE CURSO



$Estudante = [
	% // '4.5' => 'Anexar comprovante de artigo se o tcc for do tipo artigo na página de requerimento',
	% // '8' => 'Exibir mensagem de devolução das etapas',
	% // '2' => 'Sobrescrever arquivos na edição de etapa',
	'' => '',
];

$Professor = [
	% // '1' => 'Sistema de reprovar aluno', 
	'7' => 'Adicionar outro professor a turma',
	'10' => 'Gerar relatório com base em filtros',
	'' => '',
];

$Restrições = [
	% // '5' => 'Sistema de reprovar aluno','Middleware para verificação de acesso a rotas das etapas',
	% // '3' => 'Não permitir modificar dados das etapas após avançar para a próxima etapa',
	% // '4' => 'Não permitir modificar dados das etapas após a turma ser finalizada',
	'6' => 'Request de validação das etapas',
	'' => '',
];

$Extras = [
	% // '9' => 'Tradução de mensagens de validação',
	'0' => 'Exibição de arquivos',
	'11' => 'Exibição de dados na devolução de etapas',
	'12' => 'Aplicar máscaras nos formulários',
	'13' => 'Gerar declaração de participação de membros da banca',
    '' => '',
];



Estilizar páginas de acompanhamento aluno e professor.

Adicionar campo de orientador na tela do aluno.

Adicionar sistema de preenchimento de campos nas páginas que são devolvidas.

Validar os campos de membro opcional.
