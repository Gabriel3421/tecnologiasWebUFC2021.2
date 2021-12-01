const prompt = require('prompt-sync')();

class Telefone {
  constructor({ ddd, numero }) {
    this.ddd = ddd
    this.numero = numero
  }
  imprimirTelefone() {
    return `(${this.ddd}) ${this.numero}`
  }
}
class Aniversario {
  constructor({ dia, mes, ano }) {
    this.dia = dia
    this.mes = mes
    this.ano = ano
  }
  imprimirAniversario() {
    return `${this.dia}/${this.mes}/${this.ano}`
  }
}
class Endereco {
  constructor({ rua, numero, complemento, bairro, cep, cidade, estado, pais }) {
    this.rua = rua
    this.numero = numero
    this.complemento = complemento
    this.bairro = bairro
    this.cep = cep
    this.cidade = cidade
    this.estado = estado
    this.pais = pais
  }
  imprimirEndereco() {
    return `${this.rua}, ${this.numero}, ${this.complemento}, ${this.bairro}, ${this.cidade}, ${this.estado}, ${this.pais}, ${this.cep} `
  }
}
class Pessoa {
  constructor({ nome, email, endereco, telefone, aniversario, observacoes }) {
    this.nome = nome
    this.email = email
    this.endereco = new Endereco(endereco)
    this.telefone = new Telefone(telefone)
    this.aniversario = new Aniversario(aniversario)
    this.observacoes = observacoes
  }
  printPessoa() {
    console.log(
      `Dados da pessoa:\n
        nome: ${this.nome} \n
        email: ${this.email}\n
        endereco: ${this.endereco.imprimirEndereco()}\n
        telefone: ${this.telefone.imprimirTelefone()}\n
        aniversario: ${this.aniversario.imprimirAniversario()}\n
        observacoes: ${this.observacoes} `
    )
  }
}

let agenda = []

function buscarPorNome(agenda, nome) {
  agenda.forEach((pessoa) => {
    if (pessoa.nome === nome) {
      console.log("\n Resutado Busca por nome\n")
      pessoa.printPessoa()
    }
  })
}

function buscarPorAniversarioMes(agenda, mes) {
  agenda.forEach((pessoa) => {
    if (pessoa.aniversario.mes === mes) {
      console.log("\n Resutado Busca por mes de aniversario\n")
      pessoa.printPessoa()
    }
  })
}

function buscarPorAniversarioDiaEMes(agenda, dia, mes) {
  agenda.forEach((pessoa) => {
    if (pessoa.aniversario.dia === dia) {
      if (pessoa.aniversario.mes === mes) {
        console.log("\n Resutado Busca por mes e dia de aniversario\n")
        pessoa.printPessoa()
      }
    }
  })
}

function organizaAgenda(agendaDesorganizada) {
  const agendaOrganizada = agendaDesorganizada.sort((a, b) => {
    return (a.nome > b.nome) ? 1 : ((b.nome > a.nome) ? -1 : 0);
  })
  agenda = agendaOrganizada
}

function addPessoa(dados) {
  if (agenda.length === 100) {
    console.log("\nAgenda cheia.\n")
    return
  }
  agenda.push(new Pessoa(dados))
  organizaAgenda(agenda)
}

function removerPessoa(nome) {
  const existePessoa = agenda.find(pessoa => pessoa.nome === nome)
  if (!existePessoa) {
    console.log("Pessoa não encontrada.")
    return
  }
  const aux = []
  agenda.forEach(pessoa => {
    if (pessoa.nome != nome) {
      aux.push(pessoa)
    }
  })
  agenda = aux
}
// Exemplos de uso das funções
// addPessoa({
//   nome: "Joao",
//   email: "joao@email.com",
//   endereco: {
//     rua: "rua jose maria",
//     numero: 23,
//     complemento: "apto 100",
//     bairro: "centro",
//     cep: "62345074",
//     cidade: "Houston",
//     estado: "CE",
//     pais: "Brasil",
//   },
//   telefone: {
//     ddd: 88,
//     numero: 999345678
//   },
//   aniversario: {
//     dia: 12,
//     mes: 12,
//     ano: 2000
//   },
//   observacoes: "um cara muito legal",
// })
// addPessoa({
//   nome: "Ana",
//   email: "ana@email.com",
//   endereco: {
//     rua: "maria antonia",
//     numero: 534,
//     complemento: "apto 103",
//     bairro: "centro",
//     cep: "62345074",
//     cidade: "Houston",
//     estado: "CE",
//     pais: "Brasil",
//   },
//   telefone: {
//     ddd: 88,
//     numero: 999675678
//   },
//   aniversario: {
//     dia: 12,
//     mes: 12,
//     ano: 2002
//   },
//   observacoes: "minha irmã",
// })

// removerPessoa("Joao")

// buscarPorNome(agenda, "Ana")
// buscarPorAniversarioMes(agenda, 12)
// buscarPorAniversarioDiaEMes(agenda, 12, 12)

console.log("\n Imprimir Agenda: \n")

while (1) {
  let codigo
  console.log(" Digite o numero de umas das opções abaixo: \n")
  console.log(" [1] Imprime nome;\n [2] Imprime Telefone e e-mail;\n [3] Imprime todos os dados;\n [0] Para sair;\n")
  codigo = Number(prompt('Qual opção voce deseja? '))
  switch (codigo) {
    case 1:
      agenda.forEach(pessoa => console.log(
        `Dados da pessoa:\n
          nome: ${pessoa.nome} \n`
      ))
      break;
    case 2:
      agenda.forEach(pessoa => console.log(
        `Dados da pessoa:\n
          email: ${pessoa.email}\n
          telefone: ${pessoa.telefone.imprimirTelefone()}\n `
      ))
      break;
    case 3:
      agenda.forEach(pessoa => pessoa.printPessoa())
      break;

    default:
      break;
  }
  if (codigo === 0) {
    console.log("\nObrigado por utilizar a agenda!!\n")
    break
  }
}

process.exit()