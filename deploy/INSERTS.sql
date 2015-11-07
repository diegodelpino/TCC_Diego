INSERT INTO `condominio`.`usuario`
(`cpf`,`nome`,`telefone`,`unidade`,`login`,`senha`)
VALUES ("00448786052","DIEGO DEL PINO",84030251,204,"diegodelpino","xdokbca");

INSERT INTO `condominio`.`usuario`
(`cpf`,`nome`,`telefone`,`unidade`,`login`,`senha`)
VALUES ("00557832902","SUELEN GEHLEN",94321229,201,"suelengehlen","xdokbca");

INSERT INTO `condominio`.`usuario`
(`cpf`,`nome`,`telefone`,`unidade`,`login`,`senha`)
VALUES ("00100200304","MANOEL GONZAGA",81112222,303,"manoelgonzaga","xdokbca");

INSERT INTO `condominio`.`seguranca`(`id_permissao`,`cpf`) VALUES (1,3);

INSERT INTO `condominio`.`seguranca` (`id_permissao`,`cpf`) VALUES (1,2);

INSERT INTO `condominio`.`seguranca`(`id_permissao`,`cpf`) VALUES (2,1);

INSERT INTO `condominio`.`fornecedor`
(`id_fornecedor`,`nome`,`endereço`,`cpf`,`cnpj`,`telefone`,`detalhes`)
VALUES
(1,"ABC CONSTRUÇÕES","RUA DA AMIZADE,123",null,"03817438000111",11111111,"EMPRESA INDICADA PELO MORADOR DO 301");

INSERT INTO `condominio`.`fornecedor`
(`id_fornecedor`,`nome`,`endereço`,`cpf`,`cnpj`,`telefone`,`detalhes`)
VALUES
(2,"TETO TELHADOS","ALAMEDA DOS ANJOS,456",null,"03817438000222",22222222,"ÓTIMO FORNECEDOR");

INSERT INTO `condominio`.`fornecedor`
(`id_fornecedor`,`nome`,`endereço`,`cpf`,`cnpj`,`telefone`,`detalhes`)
VALUES
(3,"DESENTUPIDORA JAJA","RUA DA HARMONIA,123",null,"03817438000333",33333333,"");

INSERT INTO `condominio`.`fornecedor`
(`id_fornecedor`,`nome`,`endereço`,`cpf`,`cnpj`,`telefone`,`detalhes`)
VALUES
(4,"JOÃO FERNANDES","AVENIDA PROGRESSO,123","0044444444",NULL,44444444,"JOÃO FAZ TUDO");

INSERT INTO `condominio`.`requisicao`
(`id_requisicao`,`titulo`,`prioridade`,`descricao`)
VALUES
(1,"Conserto de cano quebrado",1,"Conserto de cano quebrado na entrada do condomínio");

INSERT INTO `condominio`.`requisicao`
(`id_requisicao`,`titulo`,`prioridade`,`descricao`)
VALUES
(2,"Pintar o portão interno de outra cor",3,"A cor do portão não está em harmonia com o resto.");

INSERT INTO `condominio`.`requisicao`
(`id_requisicao`,`titulo`,`prioridade`,`descricao`)
VALUES
(3,"Consertar o telhado",1,"Está chovendo dentro da unidade 303");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (1,"HIDRÁULICA");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (2,"ELÉTRICA");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (3,"GÁS");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (4,"GRADIL");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (5,"ESTRUTURAL");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (6,"TELHADO");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (7,"SEGURANÇA");

INSERT INTO `condominio`.`categoria`
(`id_cat`,`nome`) VALUES (8,"SERVIÇOS GERAIS");

INSERT INTO `condominio`.`status`
(`id_status`,`status`) VALUES (1,"INICIAL");

INSERT INTO `condominio`.`status`
(`id_status`,`status`) VALUES (2,"ANDAMENTO");

INSERT INTO `condominio`.`status`
(`id_status`,`status`) VALUES (3,"CONCLUÍDA");

INSERT INTO `condominio`.`status`
(`id_status`,`status`) VALUES (4,"INATIVA");

INSERT INTO `condominio`.`status`
(`id_status`,`status`) VALUES (5,"EXCLUÍDA");

INSERT INTO `condominio`.`historico`
(`id_hist`,`id_requisicao`,`cpf`,`data_atualizacao`,`id_status`,`detalhes`)
VALUES
(1,1,1,"2015-10-31",1,"Requisição iniciada");

INSERT INTO `condominio`.`historico`
(`id_hist`,`id_requisicao`,`cpf`,`data_atualizacao`,`id_status`,`detalhes`)
VALUES
(2,1,1,"2015-11-1",2,"Solicitação em andamento");

INSERT INTO `condominio`.`historico`
(`id_hist`,`id_requisicao`,`cpf`,`data_atualizacao`,`id_status`,`detalhes`)
VALUES
(3,3,3,"2015-10-31",1,"Requisição iniciada");

INSERT INTO `condominio`.`solicitacao`
(`id_cat`,`id_requisicao`)
VALUES (1,1);

INSERT INTO `condominio`.`solicitacao`
(`id_cat`,`id_requisicao`)
VALUES (4,2);

INSERT INTO `condominio`.`atendimento`
(`id_atend`,`id_cat`,`id_fornecedor`)
VALUES (1,1,1);

INSERT INTO `condominio`.`atendimento`
(`id_atend`,`id_cat`,`id_fornecedor`)
VALUES (2,6,2);

INSERT INTO `condominio`.`servico`
(`id_servico`,`id_fornecedor`,`id_requisicao`,`detalhes`)
VALUES
(1,1,1,"Serviço prestado no dia 10/10");
