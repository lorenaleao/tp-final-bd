# [Trabalho Prático Final de IBD](https://homepages.dcc.ufmg.br/~mirella/DCC011/aula19-TPfinal.pdf)

O objetivo deste trabalho é projetar e implementar um banco de dados relacional para realizar consultas interessantes.

## O que deve ser apresentado
* Diagrama entidade-relacionamento 
* Esquema relacional (https://docs.google.com/document/d/11nT_eNIpbQ9Q5jwggO74jjW5C3hePKVsgjrZiPa_65k/edit?usp=sharing)
* Dados inseridos
* Consultas realizadas

### Diagrama ER com requisitos:
* Pelo menos 4 tipos de entidade, cada tipo com ao
menos 2 atributos (além de atributo identificador)
* Pelo menos 3 tipos de relacionamento, ao menos
um com cardinalidade M:N
* Pode ser necessário alterar os dados originais para
atender a esses requisitos

### Consultas
Deverão ser especificadas e executadas um total de 10 consultas em SQL, sendo:
* 2 operações de seleção e projeção
* 3 junção de duas relações
* 3 junção de três ou mais relações
* 2 funções de agregação sobre o resultado da junção de pelo menos duas relações

Apresentar: Descrição textual + comando SQL (+resultados)

### Características avançadas
A segunda metade da avaliação deste trabalho considera três dessas quatro opções:
1. avaliação de eficiência das consultas (cada uma das 10 consultas especificadas é formulada de pelo menos 2 formas)
2. dados e consultas mais interessantes, com dados de tipo não-convencional
3. mais três consultas do tipo relatório
4. interface gráfica (e.g., um website) para visualização interativa dos dados


## Referências

1. https://pypi.org/project/imdb-sqlite/ (Explica como criar o db de uma forma fácil)
2. https://www.joblo.com/movie-posters/archives/F?from=160 (movies' posters)
3. https://stackoverflow.com/questions/29659701/how-to-insert-data-into-a-specific-column-in-a-sqlite-database (atualizando apenas um subconjunto de colunas/linhas em uma tabela no sqlite)
