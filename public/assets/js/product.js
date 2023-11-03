function DeleteGroupSpecification(id){
    var Element = document.getElementById(id);
    Element.remove();
}

function convertToVietnameseNumber(number) {
    const formatter = new Intl.NumberFormat('vi-VN');
    return formatter.format(number);
}
document.addEventListener('DOMContentLoaded', function() {
    var priceInput = document.getElementById('Price');
    var formattedPrice = convertToVietnameseNumber(priceInput.value);
    priceInput.value = formattedPrice;
});

function convertToVietnameseNumber(number) {
    const formatter = new Intl.NumberFormat('vi-VN');
    return formatter.format(number);
}

let selectedFiles = [];
function runCode() {
    var preview = document.querySelector('#preview');
    var childrenElement = preview.children;

    if (childrenElement.length !== 0) {
        for (var i = 0; i < childrenElement.length; i++) {
            var file = {
                'src': childrenElement[i].children[0].src,
                'alt': childrenElement[i].children[0].alt,
            };
            selectedFiles.push(file);
        }
    }
}

// Gọi hàm runCode khi chương trình được tải
window.onload = runCode;
console.log(selectedFiles);

function openFilePicker(id) {
    document.querySelector(id).click();
}

function removeImage(index) {
    console.log(index);
    selectedFiles.splice(index, 1);
    updatePreview();
}

function updatePreview() {
    var preview = document.querySelector('#preview');
    preview.innerHTML = '';

    selectedFiles.forEach(function (file, index) {
        if(file instanceof File){
            var image = new Image();
            image.height = 100;
            image.width = 100;
            image.alt = file.name;
            image.src = URL.createObjectURL(file);
    
            var container = document.createElement('div');
            container.classList.add('image-container');
    
            container.appendChild(image);
    
            var removeButton = document.createElement('button');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', function () {
                removeImage(index);
            });

            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'images_old[]';
            hiddenInput.value = file.name;
    
            container.appendChild(removeButton);
            container.appendChild(hiddenInput);
    
            preview.appendChild(container);
        }
        else{
            var image = new Image();
            image.height = 100;
            image.width = 100;
            image.alt = file.alt;
            image.src = file.src;
    
            var container = document.createElement('div');
            container.classList.add('image-container');
    
            container.appendChild(image);
    
            var removeButton = document.createElement('button');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', function () {
                removeImage(index);
            });
            var hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = 'images_old[]';
            hiddenInput.value = file.alt;
    
            container.appendChild(removeButton);
            container.appendChild(hiddenInput);
    
            preview.appendChild(container);
        }
    });
}

function handleFileSelect(event) {
    var files = event.target.files;
    console.log(files);

    for (var i = 0; i < files.length; i++) {
    selectedFiles.push(files[i]);
    }

    updatePreview();
}



function readAndPreview(file) {
    if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
      var reader = new FileReader();

      reader.addEventListener('load', function () {
        var image = new Image();
        image.height = 200;
        image.title = file.name;
        image.src = this.result;

        var imgElement = document.querySelector('#image-thumbnail');
        imgElement.src = image.src;
        imgElement.alt = image.title;
        imgElement.name = image.title;
      });

      reader.readAsDataURL(file);
    }
}

function previewImages() {
    var files = document.querySelector('#file-thumbnail').files;

    if (files) {
      [].forEach.call(files, readAndPreview);
    }
}