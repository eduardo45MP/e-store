# e-Store

O **e-Store** é um sistema de gestão de lojas voltado para micro, pequenas e médias empresas, desenvolvido como um MVP (Produto Viável Mínimo). Ele facilita o gerenciamento de produtos, vendas e atendimento ao cliente, oferecendo ferramentas essenciais como controle de estoque, carrinho de compras e cadastro de usuários, proporcionando uma experiência de uso intuitiva.

## Funcionalidades

- **Cadastro de Usuários**: Permite que os usuários se registrem e gerenciem seus perfis.
- **Gerenciamento de Produtos**: Criação, atualização e administração de produtos da loja.
- **Controle de Estoque**: Monitoramento em tempo real do inventário.
- **Gestão de Vendas**: Acompanhamento e gerenciamento de vendas da loja.
- **Carrinho de Compras**: Clientes podem adicionar produtos ao carrinho e realizar a compra.

## Tecnologias Utilizadas

- **Frontend**: Desenvolvido com [React](https://reactjs.org/), garantindo uma interface de usuário dinâmica e responsiva.
- **Backend**: Utiliza [Laravel](https://laravel.com/) como estrutura backend, proporcionando um ambiente seguro e robusto.
- **Banco de Dados**: Utiliza MySQL para gerenciamento e persistência de dados.

## Instalação

Para configurar o projeto localmente, siga os passos abaixo:

1. **Clone o repositório**:
   ```bash
   git clone https://github.com/eduardo45MP/e-store.git
   ```

2. **Instale as dependências**:
   ```bash
   cd e-store
   composer install
   npm install
   ```

3. **Configure as variáveis de ambiente**:
   Copie o arquivo `.env.example` para `.env` e atualize as configurações (banco de dados, chaves de API, etc.).

4. **Execute as migrações**:
   ```bash
   php artisan migrate
   ```

5. **Inicie o servidor de desenvolvimento**:
   ```bash
   php artisan serve
   npm run dev
   ```

## Contribuindo

Se você é membro da equipe, siga estas etapas:

1. Faça um fork do repositório.
2. Crie uma nova branch (`git checkout -b minha-nova-feature`).
3. Faça commit das suas alterações (`git commit -am 'Adiciona nova funcionalidade'`).
4. Envie para a branch (`git push origin minha-nova-feature`).
5. Abra um **Pull Request**.

## Licença

Este projeto está licenciado sob a [Licença Creative Commons BY-NC 4.0](./LICENSE).
