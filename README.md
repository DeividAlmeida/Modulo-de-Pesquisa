# teste-pulses
módulo de pesquisa pulses

# Tabela de conteúdos
=================
<!--ts-->
   * [Status](###Status)
   * [Features](###Features)
   * [Pré-requisitos](#Pré-requisitos)
   * [Configurações](#Configurações)
   * [Tecnologias](#Tecnologias)
   * [Autor](#Autor)
   * [Licença](#Licença)
<!--te-->

# Status
<h4 align="center"> 
	🚧  Modulo de Perguntas 🚀 Em construção...  🚧
</h4>

# Features

- [x] Cadastro de pergunta
- [x] Cadastro de dimensão
- [x] Edição de pergunta
- [x] Edição de dimensão
- [x] Exclusão de pergunta
- [x] Exclusão de dimensão
- [x] Listagem de pergunta
- [x] Listagem de dimensão

# Pré-requisitos
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
Além disso é bom ter um editor para trabalhar com o código como [VSCode](https://code.visualstudio.com/)

# Configurações
Clone este repositório
$ git clone https://github.com/DeividAlmeida/teste-pulses.git
# Acesse a pasta do projeto no terminal/cmd
$ cd controller
Edite o arquivo config.php colocando as credênciais do seu banco de dados 
# Acesse novamente a pasta do projeto no terminal/cmd
$cd ..\
Importe o arquivo database.sql no banco de dados que você acabou de configurar 

# Tecnologias
As seguintes ferramentas foram usadas na construção do projeto:
- [Vue.js](https://vuejs.org/)
- [Bootstrap](https://getbootstrap.com/)
- [sweetalert2](https://sweetalert2.github.io/)
- [fontawesome](https://fontawesome.com/)


# Autor
Deivid dos Santos Lima Almeida

# Licença
MIT License

Copyright (c) <2020> <Seu Nome>

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
