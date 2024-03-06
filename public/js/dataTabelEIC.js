document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('selectEIC').addEventListener('change', function () {
        var selectedEIC = this.value;
        var firstOption = this.options[0];
        
        if (firstOption.value.trim() === "") {
            firstOption.disabled = true;
        }

        fetch('/get-EIC-table/' + selectedEIC)
            .then(response => response.text())
            .then(data => {
                document.getElementById('EICTableContainer').innerHTML = data;
            });
    });
});
