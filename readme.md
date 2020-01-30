# CRUD Pokémon

> Les commentaires explicatifs se trouvent dans le CRUD de Type uniquement !


## Table Pokemon
- id            INT AI PK
- name          VARCHAR(30)
- description   TEXT
- size          INT
- weight        INT
- evolution_id  FK
- pokedex_id    INT
- 
## Table Type
- id            INT AI PK
- name          VARCHAR(30)

## Table POKEMON_TYPE
- id_pokemon    PK FK
- id_type       PK FK