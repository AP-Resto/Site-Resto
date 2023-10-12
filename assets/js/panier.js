/**
 * 
 * @param {HTMLElement} element: Bouton ajouter au panier 
 */
function ajouterAuPanier(element){
    let id = parseInt(element.getAttribute("data-item-id"));

    
    fetch(`actions/ajout_panier.php?idProduit=${id}`).then(r => {
        window.location.reload();
    });
}

/**
 * 
 * @param {HTMLElement} element: Bouton ajouter au panier 
 */
function supprimerDuPanier(element){
    let id = parseInt(element.getAttribute("data-item-id"));    
    fetch(`actions/suppression_panier.php?idProduit=${id}`).then(r => {
        window.location.reload();
    });
}