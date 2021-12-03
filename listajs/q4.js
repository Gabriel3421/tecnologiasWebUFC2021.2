const prompt = require('prompt-sync')();
const numberRegex = new RegExp(/^\d+$/g)

class Produto {
  constructor({ nome, codigo, preco, quantidade }) {
    this.nome = nome
    this.codigo = codigo
    this.preco = preco
    this.quantidade = quantidade
  }
}

const produtos = [{
  nome: "arroz",
  codigo: 1,
  preco: 3,
  quantidade: 10,
}]

console.log("Siga as instruções para criar um produto.")

for (let i = 0; i < 1; i++) {
  console.log(`\n Criando produto: ${i + 1}\n`)

  const produto = {
    nome: ""
  }
  while (1) {
    produto.nome = prompt('Qual o nome desse produto? ')
    if (produto.nome.length <= 15 && produto.nome.length > 0) {
      break
    } else {
      console.log("O nome do produto deve ter no minimo 1 letra e no maximo 15")
    }
  }
  while (1) {
    produto.codigo = Number(prompt('Qual o codigo desse produto? '))
    if (numberRegex.test(produto.codigo)) {
      break
    } else {
      console.log("O codigo deve ser um numero")
    }
  }
  const preco = prompt('Qual o preço desse produto? ')
  produto.preco = preco
  const quantidade = prompt('Qual a quantidade desse produto? ')
  produto.quantidade = quantidade
  produtos.push(new Produto(produto))
}

function realizarPedido(codigo, quantidade) {
  const encontrarProdutoIndex = produtos.findIndex(produto => produto.codigo === codigo)
  if (encontrarProdutoIndex === -1) {
    console.log("\nProduto não encontrado\n")
    return
  }
  if (produtos[encontrarProdutoIndex].quantidade < quantidade) {
    console.log(`\nQuantidade maior que a do estoque que é de ${produtos[encontrarProdutoIndex].quantidade} \n`)
    return
  }

  produtos[encontrarProdutoIndex].quantidade = produtos[encontrarProdutoIndex].quantidade - quantidade
  console.log("\nPedido realizado com sucesso, entregaremos seu produto em breve.\n")
  return
}

console.log("\n Bem vindo a mercearia do Gabriel: \n")
console.log(" Faça já o seu pedido! \n")
console.log(" Para sair basta digitar o numero 0 no codigo do pedido. \n")

while (1) {
  let codigo
  let quantidade
  while (1) {
    codigo = Number(prompt('Qual o codigo de produto do seu pedido? '))
    if (numberRegex.test(codigo)) {
      break
    } else {
      console.log("O codigo deve ser um numero")
    }
  }
  if (codigo === 0) {
    console.log("\nObrigado pela preferencia!!\n")
    break
  }
  quantidade = Number(prompt('Qual a quantidade desse produto? '))
  realizarPedido(codigo, quantidade)
}

process.exit()