# Título Principal
## Subtítulo
### Sub-subtítulo

*Texto em itálico*
_Outro texto em itálico_

**Texto em negrito**
__Outro texto em negrito__

Listas: Use -, *, ou 1., seguido de espaço para criar listas não ordenadas ou ordenadas.
- Item 1
- Item 2
  - Item 2.1

* Item A
* Item B

1. Primeiro
2. Segundo

Links
[Google](https://www.google.com)

Imagens: Use ![texto alternativo](url_da_imagem) para inserir imagens.
![Logo](https://example.com/logo.png)

Blocos de Código: Use três crases (```) para criar blocos de código.

Citações: Use > para criar citações.

Tabelas: Use barras verticais | para delimitar células e hífens - para criar a linha de cabeçalho e separadores de células.

| Cabeçalho 1 | Cabeçalho 2 |
| ------------| ------------|
| Conteúdo 1  | Conteúdo 2  |


# Introdução - CFC Agenda
Esta documentação tem como objetivo fornecer uma visão geral da estrutura, funcionalidades e fluxos de trabalho da aplicação web CFC Agenda, desenvolvida em PHP, seguindo o padrão MVC (Model-View-Controller). O padrão MVC é amplamente adotado na comunidade de desenvolvimento web devido à sua capacidade de separar as preocupações de apresentação, lógica de negócios e manipulação de dados.

## Estrutura de Diretórios
**cfc-agenda/**
**Controllers/:** Contém os controladores responsáveis por manipular as requisições do cliente e coordenar a lógica de negócios.


**Models/:** Armazena as classes de modelo que representam a lógica de negócios e interagem com o banco de dados.
**Views/:** Contém os arquivos de interface do usuário (HTML, CSS, JavaScript) que são renderizados dinamicamente.
**config/:** Armazena arquivos de configuração da aplicação, como configurações de banco de dados, constantes globais, etc.
**public/**
**css/:** Arquivos de estilo CSS.
**js/:** Arquivos de script JavaScript.
index.php: Ponto de entrada da aplicação.
**vendor/:** Diretório para armazenar dependências de terceiros gerenciadas pelo Composer.
**.htaccess:** Arquivo de configuração do servidor Apache para regras de reescrita de URL.

## Funcionalidades
A aplicação possui as seguintes funcionalidades principais:

Autenticação de Usuário: Permitir que os usuários se registrem, façam login e gerenciem suas contas.
Gerenciamento de Conteúdo: Permitir que os usuários criem, visualizem, editem e excluam conteúdos (por exemplo, posts em um blog).
Interação com o Banco de Dados: Interagir com o banco de dados para armazenar e recuperar dados relacionados à aplicação.
Validação de Entrada: Validar os dados enviados pelos usuários para garantir a segurança e integridade dos dados.
Gerenciamento de Sessão: Manter o estado da sessão do usuário durante a interação com a aplicação.
Fluxo de Trabalho
O fluxo de trabalho típico da aplicação é o seguinte:

O cliente faz uma solicitação HTTP, que é roteada para o controlador apropriado pelo roteador da aplicação.
O controlador processa a solicitação, interage com os modelos, se necessário, e decide qual visualização deve ser exibida.
O controlador passa os dados necessários para a visualização e a renderiza dinamicamente.
A visualização é enviada de volta ao cliente para exibição no navegador.