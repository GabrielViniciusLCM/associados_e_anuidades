# Gerenciamento de Associados e Anuidades - Devs do RN

Este projeto é um sistema de gerenciamento de associados e anuidades para a associação "Devs do RN". O software permite que o gerente cadastre associados, registre anuidades com valores anuais variáveis, cobre anuidades devidas, marque pagamentos e identifique associados com pagamentos em dia ou em atraso.

## Funcionalidades

1. **Cadastro de Associados**: Registra informações como Nome, E-mail, CPF e Data de Filiação.
2. **Cadastro de Anuidades**: Permite definir o valor da anuidade para cada ano.
3. **Cobrança de Anuidades**: Calcula o total de anuidades devidas com base na data de filiação do associado.
4. **Pagamento de Anuidades**: Marca anuidades como pagas e permite a quitação individual de anuidades de anos específicos.
5. **Status dos Associados**: Identifica associados com pagamentos em dia e em atraso.

## Tecnologias Utilizadas

- **PHP**: Backend em PHP puro (sem frameworks).
- **PostgreSQL**: Banco de dados relacional para armazenamento de dados.
- **HTML**: Interface básica para interação com o sistema.

## Pré-requisitos

- PHP 7.4 ou superior com extensão `pdo_pgsql` habilitada.
- Servidor Apache ou Nginx configurado para rodar PHP.
- PostgreSQL instalado e configurado.
- Acesso a um terminal ou linha de comando.

## Instalação

### 1. Clone o Repositório

Clone o projeto para o seu ambiente local:
```bash
git clone https://github.com/seuusuario/gerenciamento-associados-devsdorn.git
cd gerenciamento-associados-devsdorn
```

### 2. Configure o Banco de Dados

1. Inicie o PostgreSQL e crie um banco de dados chamado `devs_do_rn`:
   ```sql
   CREATE DATABASE devs_do_rn;
   ```

2. Importe a estrutura do banco de dados a partir do arquivo `meu_database.sql`:
   ```bash
   psql -U seu_usuario -d devs_do_rn -f meu_database.sql
   ```
   Substitua `seu_usuario` pelo seu nome de usuário do PostgreSQL.

3. Verifique se o banco de dados contém as tabelas `associados`, `anuidades` e `pagamentos`.

### 3. Configure o PHP

1. Abra o arquivo `config.php` e configure as credenciais do banco de dados:
   ```php
   $host = 'localhost';
   $dbname = 'devs_do_rn';
   $user = 'seu_usuario';
   $password = 'sua_senha';
   ```
2. Certifique-se de que a extensão `pdo_pgsql` está habilitada no arquivo `php.ini`.

### 4. Inicie o Servidor Web

Se estiver usando o PHP embutido:
```bash
php -S localhost:8000
```
Ou inicie o Apache/Nginx e certifique-se de que a pasta do projeto está acessível.

### 5. Acesse a Aplicação

Abra o navegador e acesse `http://localhost:8000` (ou `http://localhost/seuprojeto` se estiver usando Apache/Nginx).

## Testando a Aplicação

### Testes de Funcionalidades

#### Cadastro de Associados

1. Navegue até `cadastro_associados.php`.
2. Preencha o formulário com dados fictícios e envie.
3. Verifique no banco de dados se o associado foi registrado corretamente na tabela `associados`.

#### Cadastro de Anuidades

1. Navegue até `cadastro_anuidades.php`.
2. Insira o ano e o valor da anuidade e envie.
3. Verifique se o registro da anuidade aparece na tabela `anuidades`.

#### Cobrança de Anuidades

1. Acesse `cobranca_anuidades.php` e selecione um associado para visualizar as anuidades devidas.
2. Verifique se as anuidades desde o ano de filiação até o ano atual aparecem corretamente, assim como o valor total devido.

#### Pagamento de Anuidade

1. Ainda em `cobranca_anuidades.php`, selecione um associado e marque uma anuidade como paga.
2. Verifique se o banco de dados atualiza o pagamento para essa anuidade com `pago = 1`.

#### Status dos Associados

1. Acesse `status_associados.php` para visualizar o status de todos os associados.
2. Verifique se os associados aparecem como **Em Dia** ou **Em Atraso** conforme o estado dos pagamentos.

## Estrutura do Projeto

- **`cadastro_associados.php`**: Formulário para cadastro de novos associados.
- **`cadastro_anuidades.php`**: Formulário para cadastro de anuidades anuais.
- **`cobranca_anuidades.php`**: Exibe anuidades devidas de cada associado e permite marcar como pagas.
- **`status_associados.php`**: Lista todos os associados com status de pagamento (Em Dia ou Em Atraso).
- **`meu_database.sql`**: Script SQL para criação das tabelas necessárias no banco de dados PostgreSQL.

## Possíveis Problemas

- **Erro "could not find driver"**: Certifique-se de que a extensão `pdo_pgsql` está habilitada no `php.ini`.
- **Conexão com o Banco de Dados**: Verifique se as credenciais em `config.php` estão corretas e se o banco de dados PostgreSQL está ativo.


