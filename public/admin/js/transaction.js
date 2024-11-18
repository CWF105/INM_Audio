document.addEventListener('DOMContentLoaded', function () {
    var editModal = document.getElementById('editModal');
    editModal.addEventListener('show.bs.modal', function (event) {
        var button = event.relatedTarget;
        var transactionId = button.getAttribute('data-transaction-id');
        var status = button.getAttribute('data-status');

        var modalTransactionId = editModal.querySelector('#transaction_id');
        var modalStatus = editModal.querySelector('#status');

        modalTransactionId.value = transactionId;
        modalStatus.value = status;
    });
});

