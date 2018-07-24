// Get the modal
var modal = document.getElementById('myModal');
  
// Get the buttons that opens the modal
var buttons = document.getElementsByClassName("col-md-3");
for (var i = 0; i < buttons.length; i++) {
    buttons[i].onclick = function () {
      modal.style.display = "block";
      javascript:void(0);
      showModal();
    }
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
    javascript:void(0);
    hideModal();
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
        javascript:void(0);
        hideModal();
    }
}
function noscroll()
{
  window.scrollTo(0,0);
}

function yesscroll()
{
  window.scrollTo(1000,1000);
  
}

var $html = $(document.documentElement);
var $modal = $('myModal');

function showModal() {
  $html.css('overflow', 'hidden');
  $modal.show().css('overflow', 'auto');
}

function hideModal() {
  $html.css('overflow', '');
  $modal.hide();
}

$('.modal-open-button').on('click', showModal);
$('.modal-close-button').on('click', hideModal);