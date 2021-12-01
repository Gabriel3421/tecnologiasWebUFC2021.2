const prompt = require('prompt-sync')();

class Aluno {
  constructor({ nome, matricula, curso }) {
    this.nome = nome
    this.matricula = matricula
    this.curso = curso
  }
}

function printAluno(aluno) {
  console.log(
    `Aluno:\n nome: ${aluno.nome} \n matricula: ${aluno.matricula}\n curso: ${aluno.curso} `
  )
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
  const curso = prompt('Qual o curso desse aluno? ')
  aluno.curso = curso
  alunos.push(new Aluno(aluno))
}
alunos.forEach(aluno => {
  printAluno(aluno)
});

process.exit()