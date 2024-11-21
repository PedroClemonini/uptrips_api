# Uptrips API

Essa API foi desenvolivida para atender a SPA do projeto desenvolvida em REACT, a autenticação da api é realizada através de um token XSRF que atende somente ao endereço da SPA.

Recursos disponíveis para acesso via API:
* [**Login**](#Recursos/Login).


## Métodos
Requisições para a API devem seguir os padrões:
| Método | Descrição |
|---|---|
| `GET` | Retorna informações de um ou mais registros. |
| `POST` | Utilizado para criar um novo registro. |
| `PUT` | Atualiza dados de um registro ou altera sua situação. |
| `DELETE` | Remove um registro do sistema. |


## Respostas

| Código | Descrição |
|---|---|
| `200` | Requisição executada com sucesso (success).|
| `400` | Erros de validação ou os campos informados não existem no sistema.|
| `401` | Dados de acesso inválidos.|
| `404` | Registro pesquisado não encontrado (Not found).|
| `405` | Método não implementado.|
| `410` | Registro pesquisado foi apagado do sistema e não esta mais disponível.|
| `422` | Dados informados estão fora do escopo definido para o campo.|
| `429` | Número máximo de requisições atingido. (*aguarde alguns segundos e tente novamente*)|

# Recursos

## Login

### Endpoint: `/login`

- **Método:** `POST`
- **Descrição:** Faz Login na plataforma;

### Parâmetros da Solicitação

- `email` (obrigatório): Email
- `password` (obrigatório): Senha

### Response 200

COOKIE DE SESSÃO ADICIONADO AO HEADER;

### Endpoint: `/register`

- **Método:** `POST`
- **Descrição:** Faz Cadastro na plataforma;

### Parâmetros da Solicitação

- `name` (obrigatório): Email
- `email` (obrigatório): Email
- `password` (obrigatório): Senha
- - `password_confirmation` (obrigatório): Confirmação da senha

### Response 200

```json
{
message: Cadastro Realizado com sucesso
}
```





