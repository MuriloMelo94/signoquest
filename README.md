
# SignoQuest

Este projeto é o resultado do desafio para a vaga de estagiário Dev na SignoTechnology, utilizando Laravel para construir um CRUD de enquetes e um sistema de votação com contabilização de votos.

## Tecnologias Utilizadas

**Front-end:** Blade, Breeze, TailwindCSS

**Back-end:** Laravel 9.0, PHP

## Execução Local

Clone o projeto

```bash
git clone git@github.com:MuriloMelo94/signoquest.git
```

Mude para o diretório do projeto

```bash
cd signoquest
```

Para as dependências PHP, execute

```bash
composer install
```

Para as dependências JavaScript, execute

```bash
npm install
```

Para a configuração do banco de dados, altere o arquivo `.ENV` e indique a variável `DB_DATABASE=signoquest` ou coloque algum outro banco de dados que deseje.

```bash
php artisan migrate
```

Inicie o servidor com

```bash
php artisan serve
```

E, finalmente, em outro terminal, execute

```bash
npm run dev
```

Voilá, você está pronto para criar suas enquetes e perguntar algo para o mundo. Seja bem-vindo :)

**Nota: se uma mensagem de erro de geração de chave aparecer quando você iniciar sua aplicação, basta clicar em 'Generate Key' no canto superior direito.

## Autor

- [@murilomelodev](https://www.linkedin.com/in/murilomelodev/)
