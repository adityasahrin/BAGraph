document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('selectFakultas').addEventListener('change', function () {
        var selectedFakultas = this.value;
        var firstOption = this.options[0];
        if (firstOption.value === "") {
            firstOption.disabled = true;
        }

        fetch('/get-fakultas-table/' + selectedFakultas)
            .then(response => response.text())
            .then(data => {
                document.getElementById('fakultasTableContainer').innerHTML = data;
            });
    });
});
