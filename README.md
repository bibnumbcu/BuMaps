# BuMaps
## Description
Ce module permet d'afficher une carte sur la page d'une collection et sur la page d'un item dans omeka S.
Il affiche les localisations présentes dans le champ dublin core "couverture" d'un item.

## Utilisation
Ce module s'appelle via des helpers et le code suivant :
- pour un item
```
<?php $this->trigger('view.show.before'); ?>
<div id="map">
    <?php echo $this->BuMapsItem('Item', $resource); ?>
</div>
```
- pour une collection
```
<?php $this->trigger('view.browse.before'); ?>
<div id="map">
    <?php echo $this->BuMapsItem('ItemSet', $itemSet); ?>
</div>
```

Ce module crée deux tables dans la base :
- **bu_maps_locations** : qui contient les localisations présentes dans les items avec leurs coordonnées de latitude et longitude.
- **bu_maps_resources_locations** : qui fait la correspondance entre un item et une localisation présente dans la table bu_maps_locations

**Ce module ne permet pas pour le moment de remplir ces deux tables** qui doivent être alimentées par un autre moyen (par l'interrogation d'open street map par exemple pour aller chercher les coordonnées gps des localisations)


    

