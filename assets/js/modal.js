// JavaScript for Modals
var viewIphoneModal = document.getElementById('viewIphoneModal');
viewIphoneModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var Variants = button.getAttribute('data-Variants');
    var Colors = button.getAttribute('data-Colors');
    var Storage = button.getAttribute('data-Storage');
    var Price = button.getAttribute('data-Price');

    document.getElementById('view-id').textContent = id;
    document.getElementById('view-Variants').textContent = Variants;
    document.getElementById('view-Colors').textContent = Colors;
    document.getElementById('view-Storage').textContent = Storage;
    document.getElementById('view-Price').textContent = Price;
});