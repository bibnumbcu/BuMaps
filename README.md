# BuMaps
## Description
Ce module permet d'afficher une carte sur la page d'une collection et sur la page d'un item dans omeka S.
Il affiche les localisations présentes dans le champ dublin core "couverture" d'un item.

## Utilisation
Ce module s'appelle via des helpers :
- pour un item 
`<div id="map"> <?php echo $this->BuMapsItem('Item', $resource); ?> </div>`
- pour une collection `<div id="map"> <?php echo $this->BuMapsItem('ItemSet', $itemSet); ?> </div>`


    

