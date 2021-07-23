# teste-pulses
módulo de pesquisa pulses

### Features

- [x] Cadastro de pergunta
- [x] Cadastro de dimensão
- [x] Edição de pergunta
- [x] Edição de dimensão
- [x] Exclusão de pergunta
- [x] Exclusão de dimensão
- [x] Listagem de pergunta
- [x] Listagem de dimensão

### Pré-requisitos

Antes de começar, você vai precisar ter instalado em sua máquina as seguintes ferramentas:
[Git](https://git-scm.com), [PHP] um servidor web que ofereça suporte a PHP 7.2 ou mais recente, como:
Apache 2 (ou mais recente);
Nginx;
Microsoft IIS.
 [EXTENSÕES] 
As seguintes extensões PHP são necessárias para que o aplicativo funcione corretamente:
curl: para autenticação CAS, verificação de versão do GLPI, Telemetria, etc;
fileinfo: para obter informações extras dos arquivos;
gd: para gerar imagens;
json: para obter suporte para o formato de dados JSON;
mbstring: gerenciar caracteres multibytes;
mysqli: para conectar e consultar o banco de dados;
session: para obter suporte a sessões de usuários;
zlib: para efetuar backup e restaurar as funções da base de dados;
simplexml;
xml;
intl.
Além disto é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

### Configurações

# Clone este repositório
$ git clone https://github.com/DeividAlmeida/teste-pulses.git
# Acesse a pasta do projeto no terminal/cmd
$ cd controller
Edite o arquivo config.php colocando as credências do seu banco de dados 
# Acesse novamente a pasta do projeto no terminal/cmd
cd ..\
Importe o arquivo databese.sql no banco de dados que você acabou de configurar 

### Tecnologias

As seguintes ferramentas foram usadas na construção do projeto:

- [Vue.js](https://vuejs.org/)
- [Bootstrap](https://getbootstrap.com/)
- [sweetalert2](https://sweetalert2.github.io/)
- [fontawesome](https://fontawesome.com/)
