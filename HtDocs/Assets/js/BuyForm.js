const searchString = 'BuyForm.php';
if (window.location.href.includes(searchString)) {
    var FrstNm = document.getElementById('first_name').value;
    if (FrstNm !== '') {
        var InputValue = {};
        var InputValueFile = {};
        $('#BuyForm').submit(function(event) {
            event.preventDefault();
            var formData = new FormData(this);
            formData.forEach(function(value, key) {
                if (typeof value === "string") {
                    InputValue[key] = value;
                }
            });
            $('#UserForm input[type="file"]').each(function() {
                var fileInput = $(this)[0];
                if (fileInput.files.length > 0) {
                    InputValueFile[fileInput.name] = fileInput.files[0].name;
                }
            });
        });
    }
}
