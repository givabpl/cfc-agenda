# cfc-agenda


Boa tarde, Vania! Estou com uma dúvida sobre a orientação a objetos nos métodos que interagem com o banco de dados (classes DAO).
No início dos meus arquivos DAO, fiz uma função que forma o objeto, pra ser chamada em alguns métodos:

Porém não sei se é algo sem sentido/desnecessário para o nosso foco. No método de exclusão por exemplo, eu estou utilizando a função para formar o objeto:

Me lembro que no semestre passado, você apontou alguns erros nas minhas funções e eles estavam relacionados ao uso do objeto inteiro (como parâmetro), quando eu poderia passar somente o $id como parâmetro.

Apesar dos meus métodos estarem funcionando perfeitamente dessa forma, eu gostaria de saber a sua orientação! Devo me livrar do formar_objeto()? 