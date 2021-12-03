const gameConfig = {
    name: "",
    background: "diurno",
    abertura: 200,
    espaco: 400,
    velocidadeCanos: 3,
    personagem: "passaro",
    isReal: true,
    velocidadePersonagemCima: 8,
    velocidadePersonagemBaixo: -5,
    multiplicadorDePontuacao: 1,
}

function setConfigurations() {
    gameConfig.name = document.querySelector("#name").value
    gameConfig.background = document.querySelector("#background").value
    gameConfig.abertura = Number(document.querySelector("#abertura").value)
    gameConfig.espaco = Number(document.querySelector("#espaco").value)
    gameConfig.velocidadeCanos = Number(document.querySelector("#velocidade").value)
    gameConfig.isReal = document.querySelector("#tipo").value === "real" ? true : false
    const velocidadePersonagem = document.querySelector("#velocidadePersonagem").value
    switch (velocidadePersonagem) {
        case "baixa":
            gameConfig.velocidadePersonagemCima = 6
            gameConfig.velocidadePersonagemBaixo = -3
            break;

        case "media":
            gameConfig.velocidadePersonagemCima = 8
            gameConfig.velocidadePersonagemBaixo = -5
            break;

        case "alta":
            gameConfig.velocidadePersonagemCima = 10
            gameConfig.velocidadePersonagemBaixo = -7
            break;

        default:
            gameConfig.velocidadePersonagemCima = 8
            gameConfig.velocidadePersonagemBaixo = -5
            break;
    }
    gameConfig.multiplicadorDePontuacao = Number(document.querySelector("#pontuacao").value)
    gameConfig.personagem = document.querySelector("#personagem").value
}

function startGame() {
    setConfigurations()
    document.querySelector("[wm-flappy]").style.display = "block"
    document.querySelector(".form").style.display = "none"
    new FlappyBird().start()
}

function novoElemento(tagName, className) {
    const elemento = document.createElement(tagName)
    elemento.className = className
    return elemento
}

function Barreira(reversa = false) {
    this.elemento = novoElemento('div', 'barreira')
    const borda = novoElemento('div', 'borda')
    const corpo = novoElemento('div', 'corpo')
    this.elemento.appendChild(reversa ? corpo : borda)
    this.elemento.appendChild(reversa ? borda : corpo)

    this.setAltura = altura => corpo.style.height = `${altura}px`

}

function ParDeBarreiras(altura, abertura, popsicaoNaTela) {
    this.elemento = novoElemento('div', 'par-de-barreiras')
    this.superior = new Barreira(true)
    this.inferior = new Barreira(false)

    this.elemento.appendChild(this.superior.elemento)
    this.elemento.appendChild(this.inferior.elemento)


    this.sortearAbertura = () => {
        const alturaSuperior = Math.random() * (altura - abertura)
        const alturaInferior = altura - abertura - alturaSuperior
        this.superior.setAltura(alturaSuperior)
        this.inferior.setAltura(alturaInferior)
    }
    this.getX = () => parseInt(this.elemento.style.left.split('px')[0])
    this.setX = popsicaoNaTela => this.elemento.style.left = `${popsicaoNaTela}px`
    this.getLargura = () => this.elemento.clientWidth

    this.sortearAbertura()
    this.setX(popsicaoNaTela)
}

function Barreiras(altura, largura, abertura, espaco, notificarPonto) {
    this.pares = [
        new ParDeBarreiras(altura, abertura, largura),
        new ParDeBarreiras(altura, abertura, largura + espaco),
        new ParDeBarreiras(altura, abertura, largura + espaco * 2),
        new ParDeBarreiras(altura, abertura, largura + espaco * 3)
    ]

    const deslocamento = gameConfig.velocidadeCanos
    this.animar = () => {
        this.pares.forEach(par => {
            par.setX(par.getX() - deslocamento)

            if (par.getX() < -par.getLargura()) {
                par.setX(par.getX() + espaco * this.pares.length)
                par.sortearAbertura()
            }
            const meio = largura / 2
            const cruzouMeio = par.getX() + deslocamento >= meio
                && par.getX() < meio
            if (cruzouMeio) {
                notificarPonto()
            }
        })
    }
}

function Passaro(alturaJogo) {
    let voando = false

    this.elemento = novoElemento('img', 'passaro')
    this.elemento.src = `img/${gameConfig.personagem}.png`

    this.getY = () => parseInt(this.elemento.style.bottom.split('px')[0])
    this.setY = y => this.elemento.style.bottom = `${y}px`

    window.onkeydown = e => voando = true
    window.onkeyup = e => voando = false

    this.animar = () => {
        const novoY = this.getY() + (voando ? gameConfig.velocidadePersonagemCima : gameConfig.velocidadePersonagemBaixo)
        const alturaMaxima = alturaJogo - this.elemento.clientWidth

        if (novoY <= 0) {
            this.setY(0)
        } else if (novoY >= alturaMaxima) {
            this.setY(alturaMaxima)
        } else {
            this.setY(novoY)
        }
    }
    this.setY(alturaJogo / 2)
}

function Progresso() {

    this.elemento = novoElemento('span', 'progresso')
    this.atualizarPontos = pontos => {
        this.elemento.innerHTML = pontos * gameConfig.multiplicadorDePontuacao
    }
    this.atualizarPontos(0)
}

function estaoSobrepostos(elementoA, elementoB) {

    const a = elementoA.getBoundingClientRect()
    const b = elementoB.getBoundingClientRect()
    const horizontal = a.left + a.width >= b.left && b.left + b.width >= a.left
    const vertical = a.top + a.height >= b.top && b.top + b.height >= a.top

    return horizontal && vertical
}

function colidiu(passaro, barreiras) {
    let colidiu = false

    barreiras.pares.forEach(parDeBarreiras => {
        if (!colidiu) {
            const superior = parDeBarreiras.superior.elemento
            const inferior = parDeBarreiras.inferior.elemento
            colidiu = estaoSobrepostos(passaro.elemento, superior)
                || estaoSobrepostos(passaro.elemento, inferior)
        }
    })
    return colidiu

}

function FlappyBird() {
    let pontos = 0
    const areaDoJogo = document.querySelector('[wm-flappy]')
    if (gameConfig.background === "noturno") {
        areaDoJogo.style.background = "url('img/noite.jpeg')"
    } else {
        areaDoJogo.style.background = "deepskyblue"
    }
    const altura = areaDoJogo.clientHeight
    const largura = areaDoJogo.clientWidth
    const progresso = new Progresso()
    const barreiras = new Barreiras(altura, largura, gameConfig.abertura, gameConfig.espaco,
        () => progresso.atualizarPontos(++pontos))

    const passaro = new Passaro(altura)

    areaDoJogo.appendChild(progresso.elemento)
    areaDoJogo.appendChild(passaro.elemento)
    barreiras.pares.forEach(par => areaDoJogo.appendChild(par.elemento))

    this.start = () => {
        const temporizador = setInterval(() => {
            barreiras.animar()
            passaro.animar()

            if (colidiu(passaro, barreiras) && gameConfig.isReal) {
                clearGame(temporizador, pontos)
            }
        }, 20)
    }
}

function removeAllChildNodes(parent) {
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
}

function clearGame(temporizador, pontos) {
    clearInterval(temporizador)
    document.querySelector("[wm-flappy]").style.display = "none"
    removeAllChildNodes(document.querySelector("[wm-flappy]"))
    document.querySelector(".form").style.display = "flex"
    alert(`O jogador ${gameConfig.name} fez ${pontos * gameConfig.multiplicadorDePontuacao} pontos, Parabéns!!`)
}