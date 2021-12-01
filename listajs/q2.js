const prompt = require('prompt-sync')();

class Aluno {
  constructor({ nome, matricula, nota1, nota2, nota3 }) {
    this.nome = nome
    this.matricula = matricula
    this.nota1 = Number(nota1)
    this.nota2 = Number(nota2)
    this.nota3 = Number(nota3)
    this.media = this.calcularMedia()
  }

  calcularMedia() {
    return (this.nota1 + this.nota2 + this.nota3) / 3
  }
}

const alunos = []

console.log("Siga as instruções para criar um aluno.")

for (let i = 0; i < 5; i++) {
  console.log(`\n Criando aluno: ${i + 1}\n`)

  const aluno = {}
  const name = prompt('Qual o nome desse aluno? ')
  aluno.nome = name
  const matricula = prompt('Qual a matricula desse aluno? ')
  aluno.matricula = matricula
  const nota1 = prompt('Qual a primeira nota desse aluno? ')
  aluno.nota1 = nota1
  const nota2 = prompt('Qual a segunda nota desse aluno? ')
  aluno.nota2 = nota2
  const nota3 = prompt('Qual a terceira nota desse aluno? ')
  aluno.nota3 = nota3
  alunos.push(new Aluno(aluno))
}

function maiorMedia(alunos) {
  const melhorAluno = {
    media: -1,
    nome: ''
  }
  alunos.forEach(aluno => {
    if (aluno.media > melhorAluno.media) {
      melhorAluno.media = aluno.media
      melhorAluno.nome = aluno.nome
    }
  })
  console.log(`O aluno(a) com maior média foi o ${melhorAluno.nome}`)
}

function maiorNota1(alunos) {
  const melhorAluno = {
    nota1: -1,
    nome: ''
  }
  alunos.forEach(aluno => {
    if (aluno.nota1 > melhorAluno.nota1) {
      melhorAluno.nota1 = aluno.nota1
      melhorAluno.nome = aluno.nome
    }
  })
  console.log(`O aluno(a) com maior nota na prova 1 foi o ${melhorAluno.nome}`)
}

function menorMedia(alunos) {
  const piorAluno = {
    media: Infinity,
    nome: ''
  }
  alunos.forEach(aluno => {
    if (aluno.media < piorAluno.media) {
      piorAluno.media = aluno.media
      piorAluno.nome = aluno.nome
    }
  })
  console.log(`O aluno(a) com menor média foi o ${piorAluno.nome}`)
}
function resultadoFinal(alunos) {
  alunos.forEach(aluno => {
    if (aluno.media >= 6) {
      console.log(`O aluno(a) ${aluno.nome} está aprovado!`)
    } else {
      console.log(`O aluno(a) ${aluno.nome} está reprovado!`)
    }
  })
}
console.log("\n Informações sobre os alunos: \n")
maiorNota1(alunos)
maiorMedia(alunos)
menorMedia(alunos)
console.log("\n Resultados: \n")
resultadoFinal(alunos)

process.exit()