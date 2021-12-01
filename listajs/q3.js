const prompt = require('prompt-sync')();

class Aluno {
  constructor({ nome, matricula, media }) {
    this.nome = nome
    this.matricula = matricula
    this.media = Number(media)
  }
}

const alunos = []
const alunosAprovados = []
const alunosReprovados = []

console.log("Siga as instruções para criar um aluno.")

for (let i = 0; i < 10; i++) {
  console.log(`\n Criando aluno: ${i + 1}\n`)

  const aluno = {}
  const name = prompt('Qual o nome desse aluno? ')
  aluno.nome = name
  const matricula = prompt('Qual a matricula desse aluno? ')
  aluno.matricula = matricula
  const media = prompt('Qual a media desse aluno? ')
  aluno.media = media
  alunos.push(new Aluno(aluno))
}

function printAlunos(alunos) {
  alunos.forEach(aluno => {
    console.log(
      `Aluno:\n nome: ${aluno.nome} \n matricula: ${aluno.matricula}\n media: ${aluno.media} `
    )
  });
}

function resultadoFinal(alunos) {
  alunos.forEach(aluno => {
    if (aluno.media >= 5) {
      alunosAprovados.push(aluno)
    } else {
      alunosReprovados.push(aluno)
    }
  })
}

resultadoFinal(alunos)

console.log("\n Alunos aprovados: \n")
printAlunos(alunosAprovados)
console.log("\n Alunos reprovados: \n")
printAlunos(alunosReprovados)

process.exit()