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

var editIphoneModal = document.getElementById('editIphoneModal');
editIphoneModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    var Variants = button.getAttribute('data-Variants');
    var Colors = button.getAttribute('data-Colors');
    var Storage = button.getAttribute('data-Storage');
    var Price = button.getAttribute('data-Price');

    document.getElementById('edit-id-display').textContent = id; // Use textContent for safety
    document.getElementById('edit-id').value = id;
    document.getElementById('edit-Variants').value = Variants;
    document.getElementById('edit-Colors').value = Colors;
    document.getElementById('edit-Storage').value = Storage;
    document.getElementById('edit-Price').value = Price;
});

var deleteIphoneModal = document.getElementById('deleteIphoneModal');
deleteIphoneModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var id = button.getAttribute('data-id');
    document.getElementById('delete-id').value = id;
});