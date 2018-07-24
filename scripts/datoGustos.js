
function like(){
    var gustosSelect = document.getElementById("misGustos");
    var category = gustosSelect.options[gustosSelect.selectedIndex].value;

    window.location.assign("likesViewModel.php?category="+category+
    "&action=like");
 
}


function unlike(){
    var gustosSelect = document.getElementById("otrosGustos");
    var category = gustosSelect.options[gustosSelect.selectedIndex].value;
    window.location.assign("likesViewModel.php?category="+category+
    "&action=unlike");

 
}