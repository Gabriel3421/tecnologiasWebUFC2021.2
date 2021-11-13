function squareArea(side) {
  return side * side
}
function rectangleArea(biggerSide, smallSide) {
  return biggerSide * smallSide
}
function triangleArea(base, height) {
  return (base * height) / 2
}
function diamondArea(biggerDiagonal, smallDiagonal) {
  return (biggerDiagonal * smallDiagonal) / 2
}

console.log("Área do quadrado: " + squareArea(2))
console.log("Área do retângulo: " + rectangleArea(2, 3))
console.log("Área do triângulo: " + triangleArea(2, 5))
console.log("Área do losangolo: " + diamondArea(2, 4))