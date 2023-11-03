function show_logout(id){
    var show = document.getElementById(id)
    show.style.display = "flex"
}
function hide_logout(id){
    var show = document.getElementById(id)
    show.style.display = "none"
}
function show_option(id1, id2){
    var hide = document.getElementById(id1)
    // console.log(hide)
    if(hide.value === 'custom'){
        // console.log('alo')
        hide.style.display = "none"
        var show = document.getElementById(id2)
        show.style.display = "block"
    }
}
function show_type_product(id){
    var show = document.getElementById(id)
    if(show.value === 'iphone'){
        var iphone = document.getElementById('iphone')
        iphone.style.display = "block"
        var ipad = document.getElementById('ipad')
        ipad.style.display = "none"
        var mac = document.getElementById('mac')
        mac.style.display = "none"
        var watch = document.getElementById('watch')
        watch.style.display = "none"
        var sound = document.getElementById('sound')
        sound.style.display = "none"
    }
    if(show.value === 'mac'){
        var iphone = document.getElementById('iphone')
        iphone.style.display = "none"
        var ipad = document.getElementById('ipad')
        ipad.style.display = "none"
        var mac = document.getElementById('mac')
        mac.style.display = "block"
        var watch = document.getElementById('watch')
        watch.style.display = "none"
        var sound = document.getElementById('sound')
        sound.style.display = "none"
    }
    if(show.value === 'ipad'){
        var iphone = document.getElementById('iphone')
        iphone.style.display = "none"
        var ipad = document.getElementById('ipad')
        ipad.style.display = "block"
        var mac = document.getElementById('mac')
        mac.style.display = "none"
        var watch = document.getElementById('watch')
        watch.style.display = "none"
        var sound = document.getElementById('sound')
        sound.style.display = "none"
    }
    if(show.value === 'watch'){
        var iphone = document.getElementById('iphone')
        iphone.style.display = "none"
        var ipad = document.getElementById('ipad')
        ipad.style.display = "none"
        var mac = document.getElementById('mac')
        mac.style.display = "none"
        var watch = document.getElementById('watch')
        watch.style.display = "block"
        var sound = document.getElementById('sound')
        sound.style.display = "none"
    }
    if(show.value === 'sound'){
        var iphone = document.getElementById('iphone')
        iphone.style.display = "none"
        var ipad = document.getElementById('ipad')
        ipad.style.display = "none"
        var mac = document.getElementById('mac')
        mac.style.display = "none"
        var watch = document.getElementById('watch')
        watch.style.display = "none"
        var sound = document.getElementById('sound')
        sound.style.display = "block"
    }
}
function formatNumber(number) {
    return number.toLocaleString('vi-VN');
}

// function displayFormattedNumber() {
//     const element = document.getElementById('number');
//     const number = parseInt(element.textContent);
//     const formattedNumber = formatNumber(number);
//     element.textContent = formattedNumber + 'đ';
// }

function displayFormattedNumbers() {
    const elements = document.querySelectorAll('td[id^="number"]');
  
    elements.forEach(function(element) {
      const number = parseInt(element.textContent);
      const formattedNumber = formatNumber(number);
      element.textContent = formattedNumber + 'đ';
    });
}
  
displayFormattedNumbers();



// var selectedFiles = [];
// var preview = document.querySelector('#preview');
// childrenElement = preview.children;
// if(childrenElement.length != 0){
//     for(var i = 0; i < childrenElement.length; i++){
//         file = {
//             'src': childrenElement[i].children[0].src,
//             'alt': childrenElement[i].children[0].alt,
//         };
//         selectedFiles.push(file);
//     }
// }


// function openFilePicker(id) {
//     document.querySelector(id).click();
// }

// function removeImage(index) {
//     console.log(index);
//     selectedFiles.splice(index, 1);
//     updatePreview();
// }

// function updatePreview() {
//     var preview = document.querySelector('#preview');
//     preview.innerHTML = '';

//     selectedFiles.forEach(function (file, index) {
//         if(file instanceof File){
//             var image = new Image();
//             image.height = 100;
//             image.width = 100;
//             image.alt = file.name;
//             image.src = URL.createObjectURL(file);
    
//             var container = document.createElement('div');
//             container.classList.add('image-container');
    
//             container.appendChild(image);
    
//             var removeButton = document.createElement('button');
//             removeButton.textContent = 'x';
//             removeButton.addEventListener('click', function () {
//                 removeImage(index);
//             });
    
//             container.appendChild(removeButton);
    
//             preview.appendChild(container);
//         }
//         else{
//             var image = new Image();
//             image.height = 100;
//             image.width = 100;
//             image.alt = file.alt;
//             image.src = file.src;
    
//             var container = document.createElement('div');
//             container.classList.add('image-container');
    
//             container.appendChild(image);
    
//             var removeButton = document.createElement('button');
//             removeButton.textContent = 'x';
//             removeButton.addEventListener('click', function () {
//                 removeImage(index);
//             });
    
//             container.appendChild(removeButton);
    
//             preview.appendChild(container);
//         }
//     });
// }

// function handleFileSelect(event) {
//     var files = event.target.files;
//     console.log(files);

//     for (var i = 0; i < files.length; i++) {
//     selectedFiles.push(files[i]);
//     }

//     updatePreview();
// }



// function readAndPreview(file) {
//     if (/\.(jpe?g|png|gif)$/i.test(file.name)) {
//       var reader = new FileReader();

//       reader.addEventListener('load', function () {
//         var image = new Image();
//         image.height = 200;
//         image.title = file.name;
//         image.src = this.result;

//         var imgElement = document.querySelector('#image-thumbnail');
//         imgElement.src = image.src;
//         imgElement.alt = image.title;
//         imgElement.name = image.title;
//       });

//       reader.readAsDataURL(file);
//     }
// }

// function previewImages() {
//     var files = document.querySelector('#file-thumbnail').files;

//     if (files) {
//       [].forEach.call(files, readAndPreview);
//     }
// }

function handleRadio(radioId) {
    var radio = document.getElementById(radioId);
    radio.checked = true;
    if(radioId == "radio-1"){
        var range = document.getElementById("range-discount");
        range.style.display = "none"
    }
    else if(radioId == "radio-2"){
        var range = document.getElementById("range-discount");
        range.style.display = "block"
    }
    else{}
}

function updateDiscountPercentage(value) {
    var discountPercentage = document.getElementById("discountPercentage");
    discountPercentage.textContent = value + "%";
  }

// let index = 0
// function addSpecifition(specificationData){
//     // console.log(categoriesData);
//     var inputContainer = document.getElementById("inputContainer");
//     index = index + 1;
//     var select = `select_${index}`;
//     var input = `input_${index}`;
//     var div = `div_${index}`;
//     var element = `element_${index}`;
//     var html =  `<div class="flex-gap-30" id="${element}"> 
//                     <div class="specification-left">
//                         <select class="add-select" id="${select}" name="sound_Remote" onclick="show_Specification(\'${select}\', \'${input}\', \'${div}\')">
//                             <option value="" disabled selected></option>
//                             ${specificationData.map(specification => `<option value="${specification.SpecificationDetailID}" id="${specification.SpecificationDetailID}">${specification.SpecificationName}</option>`).join('')}
//                             <option value="custom">Tùy chỉnh</option>
//                         </select>
//                         <input id="${input}" class="add-input option-hide" type="text" name="" placeholder="Tùy chỉnh">
//                     </div>
//                     <div class="specification-right">
//                         <div id="${div}" class="width-full"></div>
//                         <button class="btn-delete-spec" onclick="removeSpecifition(\'${element}\')">X</button>
//                     </div>
//                 </div>`;
    
//     inputContainer.innerHTML += html;
// }
let index = 0;
function specificationOfProduct(specificationData, specOfProduct){
    var inputContainer = document.getElementById("inputContainer");
    index = index + 1;
    var select = `select_${index}`;
    var input = `input_${index}`;
    var div = `div_${index}`;
    var element = `element_${index}`;

    var divElement = document.createElement("div");
    divElement.classList.add("flex-gap-30");
    divElement.id = element;

    var leftDiv = document.createElement("div");
    leftDiv.classList.add("specification-left");

    var selectElement = document.createElement("select");
    selectElement.classList.add("add-select");
    selectElement.id = select;
    selectElement.name = "sound_Remote";
    selectElement.setAttribute("change", `show_Specification('${select}', '${input}', '${div}')`);

    
    specificationData.forEach(specification => {
        var optionElement = document.createElement("option");
        optionElement.value = specification.Key;
        optionElement.id = specification.Key;
        optionElement.textContent = specification.Name;
        selectElement.appendChild(optionElement);

        if(specification.Key == specOfProduct.Key){
            optionElement.selected = true;
        }
    });
    selectElement.disabled = true;
  
    leftDiv.appendChild(selectElement);
  
    var rightDiv = document.createElement("div");
    rightDiv.classList.add("specification-right");
  
    var divElement2 = document.createElement("div");
    divElement2.id = div;
    divElement2.classList.add("width-full");
  
    var deleteButton = document.createElement("button");
    deleteButton.classList.add("btn-delete-spec");
    deleteButton.textContent = "X";
    deleteButton.setAttribute("onclick", `removeSpecifition('${element}')`);
  
    rightDiv.appendChild(divElement2);
    rightDiv.appendChild(deleteButton);
  
    divElement.appendChild(leftDiv);
    divElement.appendChild(rightDiv);
  
    inputContainer.appendChild(divElement);
    show_Specification(select, input, div, specOfProduct.SpecificationDetailID);
}


function addSpecifition(specificationData) {
    var inputContainer = document.getElementById("inputContainer");
    index = index + 1;
    var select = `select_${index}`;
    var input = `input_${index}`;
    var div = `div_${index}`;
    var element = `element_${index}`;
  
    var divElement = document.createElement("div");
    divElement.classList.add("flex-gap-30");
    divElement.id = element;
  
    var leftDiv = document.createElement("div");
    leftDiv.classList.add("specification-left");
  
    var selectElement = document.createElement("select");
    selectElement.classList.add("add-select");
    selectElement.id = select;
    selectElement.name = "sound_Remote";
    selectElement.setAttribute("onclick", `show_Specification('${select}', '${input}', '${div}')`);
    // Add options to selectElement
    var defaultOptionElement = document.createElement("option");
    defaultOptionElement.value = "";
    defaultOptionElement.textContent = "";
    selectElement.appendChild(defaultOptionElement);

    specificationData.forEach(specification => {
      var optionElement = document.createElement("option");
      optionElement.value = specification.Key;
      optionElement.id = specification.Key;
      optionElement.textContent = specification.Name;
      selectElement.appendChild(optionElement);
    });

    var customOptionElement = document.createElement("option");
    customOptionElement.value = "custom";
    customOptionElement.textContent = "Tùy chỉnh";
    selectElement.appendChild(customOptionElement);
  
    var inputElement = document.createElement("input");
    inputElement.id = input;
    inputElement.classList.add("add-input", "option-hide");
    inputElement.type = "text";
    inputElement.name = "";
    inputElement.placeholder = "Tùy chỉnh";
  
    leftDiv.appendChild(selectElement);
    leftDiv.appendChild(inputElement);
  
    var rightDiv = document.createElement("div");
    rightDiv.classList.add("specification-right");
  
    var divElement2 = document.createElement("div");
    divElement2.id = div;
    divElement2.classList.add("width-full");
  
    var deleteButton = document.createElement("button");
    deleteButton.classList.add("btn-delete-spec");
    deleteButton.textContent = "X";
    deleteButton.setAttribute("onclick", `removeSpecifition('${element}')`);
  
    rightDiv.appendChild(divElement2);
    rightDiv.appendChild(deleteButton);
  
    divElement.appendChild(leftDiv);
    divElement.appendChild(rightDiv);
  
    inputContainer.appendChild(divElement);
}

function show_SpecificationDetail(id1, id2){
    var hide = document.getElementById(id1);
    // var spec = document.getElementById(id3);
    // var selectedOption = hide.options[hide.selectedIndex];
    // selectedOption.selected = true;
    // selectedOption.setAttribute('selected', true);
    // console.log(selectedOption);
    // console.log(hide)
    if(hide.value === 'custom'){
        // console.log('alo')
        hide.style.display = "none"
        var show = document.getElementById(id2);
        show.style.display = "block";
    }
}

function show_Specification(id1, id2, id3, specid = null){
    var hide = document.getElementById(id1);
    var spec = document.getElementById(id3);
    // var selectedOption = hide.options[hide.selectedIndex];
    // console.log(selectedOption);
    // selectedOption.setAttribute('selected', 'selected');
    // console.log(selectedOption);
    // console.log(hide)
    if(hide.value === 'custom'){
        // console.log('alo')
        hide.style.display = "none"
        var show = document.getElementById(id2);
        show.style.display = "block";
        var inputContainer = document.getElementById(id3);
        var html = `<input class="add-input" type="text" placeholder="Base Price">`;
        inputContainer.innerHTML += html;
    }
    else if(hide.value != ""){
        var inputContainer = document.getElementById(id3);
        // var html = `<input class="add-input" type="text" placeholder="Base Price">`;
        // inputContainer.innerHTML += html;
        var xhr = new XMLHttpRequest();
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var selectedID = hide.value;
        console.log(selectedID);
        xhr.open('POST', "/getspecificationdetail", true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE ) {
                if(xhr.status === 200){
                    // Nhận phản hồi JSON từ máy chủ
                    var jsonResponse = JSON.parse(xhr.responseText);
                    // console.log(jsonResponse);
                    var spec_select = `spec_select_${index}`;
                    var spec_input = `spec_input_${index}`;

                    var html =  `<select class="add-select" id="${spec_select}" name="sound_Remote" onclick="show_SpecificationDetail(\'${spec_select}\', \'${spec_input}\')">
                                    <option value="" disabled selected></option>
                                    ${jsonResponse.map(spec => `<option value="${spec.id}" id="${spec.id}" ${ specid != null ? specid == spec.id ? 'selected': '': ''}>${spec.Description}</option>`).join('')}
                                    <option value="custom">Tùy chỉnh</option>
                                </select>
                                <input id="${spec_input}" class="add-input option-hide" type="text" name="sound_Remote_custom" placeholder="Tùy chỉnh">`;
                    
                    inputContainer.innerHTML += html;
                }
                else{
                    console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
                }
            }
        };
        xhr.send("Key=" + encodeURIComponent(selectedID));
        hide.disabled = true;
    }
    else{

    }
}

function removeSpecifition(elementID) {
    var element = document.getElementById(elementID);
    element.remove();
}

function postAction(id) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var selectElement = document.getElementById(id);
    var selectedValue = selectElement.value;
    if(selectedValue == 'update'){
        window.location.href = `/admin/updateproduct/${id}`;
    }
    else if(selectedValue == 'delete'){
        // Gửi yêu cầu POST tới đích của bạn với dữ liệu tùy chọn đã chọn
        var xhr = new XMLHttpRequest();
        xhr.open("DELETE", `/admin/products/${id}`, true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
              if (xhr.status === 200) {
                console.log(xhr.responseText); // In ra phản hồi từ máy chủ
                window.location.reload;
              } else {
                console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
              }
            }
          };
        xhr.send("selectedOption=" + encodeURIComponent(selectedValue));
    }

}

function getStatus(){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var inserData = document.getElementById('tbody');
    var selectElement = document.getElementById('status_select');
    var selectedValue = selectElement.value;
    var formData = new FormData();
    formData.append('status', selectedValue);

    var xhr = new XMLHttpRequest();
        xhr.open("POST", "/admin/getstatus", true);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var datas = JSON.parse(xhr.responseText);
                inserData.innerHTML = "";

                var html = `${datas.map(data => 
                    `<tr>
                        <td>
                            <a class="link-proudct" href="">
                                <div class="flex-gap-20">
                                    <img src="${data.thumbnail}" alt="">
                                    <p>${data.ProductDescription}</sp>
                                </div>
                            </a>
                        </td>
                        <td class="center-td">${data.Version}</td>
                        <td class="center-td">${data.NameColor}</td>
                        <td class="center-td" id="number">${data.Price}</td>
                        <td class="center-td">${data.Discount}</td>
                        <td class="center-td">${data.QuantityInStock}</td>
                        <td class="center-td">${data.ProductAvailable}</td>
                        <td class="center-td">
                            <form action="" >
                                <select class="add-select" id="${data.id}" name="${data.id}" onchange="postAction(${data.id})">
                                    <option value="0">Acction</option>
                                    <option value="delete">Xóa</option>
                                    <option value="update">Cập Nhật</option>
                                </select>
                            </form>
                        </td>
                    </tr>`
                )}`
                inserData.innerHTML += html;
            } else {
                console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
            }
            }
        };
        xhr.send(formData);
}

function sendAjaxRequest(formData) {
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    return new Promise(function (resolve, reject) {
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "/admin/postaddspecdetail", true);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                resolve(data);
            } else {
                reject('Lỗi ' + xhr.status + ' đã xảy ra.');
            }
            }
        };
        xhr.send(formData);
    });
}

async function updateProduct(id){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var thumbnail = document.getElementById('file-thumbnail').files;

    //status
    var status = document.getElementById('status_select').value;
    //categoryid
    var categoryid = document.getElementById('category_select').value;
    //supplier
    var supplierid = document.getElementById('supplier_select').value;
    //status
    var status = document.getElementById('status_select').value;
    //general
    var productName = document.getElementById('NameProduct').value;
    var description = document.getElementById('Description').value;
    var version = document.getElementById('Version').value;
    var quantity = document.getElementById('Quantity').value;
    //Media
    var nameColor = document.getElementById('NameColor').value;
    var codeColor = document.getElementById('CodeColor').value;
    var fileInput = document.getElementById('file-input-img');
    var files = fileInput.files;
    //Price
    var price = document.getElementById('Price').value;
    var radio = document.getElementById('radio-2');
    var discount = 0;
    if(radio.checked == true){
        discount = document.getElementById('Discount').value;
    }
    
    var imagesOld = [];
    var imagesNew = [];
    selectedFiles.forEach(image =>{
        if(image instanceof File){
            imagesNew.push(image);
        }
        else{
            imagesOld.push(image);
        }
    })
    var xhr = new XMLHttpRequest();

    var formData = new FormData();

    //Specification
    var specs = document.getElementById('inputContainer');
    var childElement = specs.children;
    var listIDSpec = [];
    for( var i=0; i<childElement.length; i++)
    {
        var childElementDiv = childElement[i].children;
        var key = childElementDiv[0].children[0].value;
        var value = childElementDiv[1].children[0].children[0].value;

        if(key === 'custom'){
            var specName = childElementDiv[0].children[1].value;
            var specValue = childElementDiv[1].children[0].children[0].value;
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var Key = '';

            for (var i = 0; i < 10; i++) {
            var randomIndex = Math.floor(Math.random() * characters.length);
            Key += characters[randomIndex];
            }

            var formData = new FormData();
            formData.append('Key', Key);
            formData.append('Name', specName);
            formData.append('Description', specValue);

            var data = await sendAjaxRequest(formData);
            listIDSpec.push(data);
        }
        else{
            var specID = key;
            if(value === 'custom'){
                var specValue = childElementDiv[1].children[0].children[1].value;
                
                var formData = new FormData();
                formData.append('SpecID', specID);
                formData.append('Description', specValue);

                var data = await sendAjaxRequest(formData);
                listIDSpec.push(data);
            }
            else{
                var specValue = childElementDiv[1].children[0].children[0].value;
                var formData = new FormData();
                formData.append('specValue', specValue);

                var data = await sendAjaxRequest(formData);
                listIDSpec.push(data);
            }
        }
    }   


    formData.append('productName', productName);
    formData.append('description', description);
    formData.append('version', version);
    formData.append('price', price);
    formData.append('discount', discount);
    formData.append('categoryid', categoryid);
    formData.append('supplierid', supplierid);
    formData.append('quantity', quantity);
    formData.append('status', status);

    formData.append('nameColor', nameColor);
    formData.append('codeColor', codeColor);
    for(var i = 0; i < listIDSpec.length; i++){
        formData.append('specs[]', JSON.stringify(listIDSpec[i]));
    }
    for (var i = 0; i < imagesNew.length; i++) {
        formData.append('newimages[]', imagesNew[i]);
        // console.log(files[i]);
    }
    for( var i = 0; i < imagesOld.length; i++){
        formData.append('oldimages[]', JSON.stringify(imagesOld[i]));
    }
    if(thumbnail.length!=0){
        for( var i = 0; i < thumbnail.length; i++){
            formData.append('thumbnail[]', thumbnail[i]);
        }
    }


    xhr.open("POST", `${id}`, true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log(xhr.responseText); 
            window.location.href = `${id}`;
          } else {
            console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
          }
        }
      };
    xhr.send(formData);
}

async function postImages()
{
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    //thumbnail
    var thumbnail = document.getElementById('file-thumbnail').files;
    //status
    var status = document.getElementById('status_select').value;
    //categoryid
    var categoryid = document.getElementById('category_select').value;
    //supplier
    var supplierid = document.getElementById('supplier_select').value;
    //status
    var status = document.getElementById('status_select').value;
    //general
    var productName = document.getElementById('NameProduct').value;
    var description = document.getElementById('Description').value;
    var version = document.getElementById('Version').value;
    var quantity = document.getElementById('Quantity').value;
    //Media
    var nameColor = document.getElementById('NameColor').value;
    var codeColor = document.getElementById('CodeColor').value;
    var fileInput = document.getElementById('file-input-img');
    var files = fileInput.files;
    //Price
    var price = document.getElementById('Price').value;
    var radio = document.getElementById('radio-2');
    var discount = 0;
    if(radio.checked == true){
        discount = document.getElementById('Discount').value;
    }

    //Specification
    var specs = document.getElementById('inputContainer');
    var childElement = specs.children;
    var listIDSpec = [];
    for( var i=0; i<childElement.length; i++)
    {
        var childElementDiv = childElement[i].children;
        var key = childElementDiv[0].children[0].value;
        var value = childElementDiv[1].children[0].children[0].value;

        if(key === 'custom'){
            var specName = childElementDiv[0].children[1].value;
            var specValue = childElementDiv[1].children[0].children[0].value;
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var Key = '';

            for (var i = 0; i < 10; i++) {
                var randomIndex = Math.floor(Math.random() * characters.length);
                Key += characters[randomIndex];
            }

            var formData = new FormData();
            formData.append('Key', Key);
            formData.append('Name', specName);
            formData.append('Description', specValue);

            var data = await sendAjaxRequest(formData);
            listIDSpec.push(data);
        }
        else{
            var specID = key;
            if(value === 'custom'){
                var specValue = childElementDiv[1].children[0].children[1].value;
                var selectElement = childElementDiv[0].children[0];
                var selectedOption = selectElement.options[selectElement.selectedIndex];
                var optionText = selectedOption.textContent;
                
                var formData = new FormData();
                formData.append('SpecKey', specID);
                formData.append('Description', specValue);
                formData.append('Name', optionText);

                // formData.forEach(function (value, key) {
                //     console.log(key + ': ' + value);
                //   });
                var data = await sendAjaxRequest(formData);
                listIDSpec.push(data);
            }
            else{
                var specValue = childElementDiv[1].children[0].children[0].value;
                var formData = new FormData();
                formData.append('specValue', specValue);

                var data = await sendAjaxRequest(formData);
                listIDSpec.push(data);
            }
        }
    }
    console.log(listIDSpec);

    var formData = new FormData();
    for (var i = 0; i < files.length; i++) {
        formData.append('images[]', files[i]);
        // console.log(files[i]);
    }
    formData.append('thumbnail', thumbnail[0]);
    formData.append('categoryID', categoryid);
    formData.append('supplierID', supplierid);
    formData.append('productName', productName);
    formData.append('description', description);
    formData.append('version', version);
    formData.append('quantity', quantity);
    formData.append('nameColor', nameColor);
    formData.append('codeColor', codeColor);
    formData.append('status', status);
    formData.append('price', price);
    formData.append('discount', discount);

    for(var i = 0; i < listIDSpec.length; i++){
        formData.append('specs[]', JSON.stringify(listIDSpec[i]));
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/addition-product", true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log(xhr.responseText); 
            window.location.href = additionProduct;
          } else {
            console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
          }
        }
      };
    xhr.send(formData);
}

function postCategoryOption(id){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var selectElement = document.getElementById(id);
    var elementSelected = selectElement.value;
    if(elementSelected == 1)
    {
        var xhr = new XMLHttpRequest();
        xhr.open("DELETE", `/admin/deletecategories/${id}`, true);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); 
                    window.location.href = '/admin/categoriesproducts';
                } else {
                    console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
                }
            }
        };
        xhr.send('');
    }
    else if(elementSelected == 2){

        var xhr = new XMLHttpRequest();
        xhr.open("GET", `/admin/updatecategory/${id}`, true);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); 
                    window.location.href = `/admin/updatecategory/${id}`;
                } else {
                    console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
                }
            }
        };
        xhr.send('');
    }
}

function getCategoryPost(){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var selectElement = document.getElementById('category_select');
    var elementSelected = selectElement.value;
    var inserData = document.getElementById('tbody');
    
    var formData = new FormData();
    formData.append('id', elementSelected);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/admin/getcategoriesbytype", true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var datas = JSON.parse(xhr.responseText);
                console.log(datas);
                inserData.innerHTML = "";

                var html = `${datas.map(data => 
                    `<tr>
                        <td>
                            <a class="link-proudct" href="{{ route('getUpdatePost', ['id' => ${data.id}]) }}">
                                <div class="flex-gap-20">
                                    <img src="${data.LinkThumbnail}" alt="">
                                    <div class="align-start">
                                        <p>${data.Title}</p>
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td>${data.CategoryName}</td>
                        <td class="center-td">
                            <select class="add-select" id="${data.id}" name="" onchange="postPostOption(${data.id})">
                                <option value="0" >Acction</option>
                                <option value="1">Xóa</option>
                                <option value="2">Cập Nhật</option>
                            </select>
                        </td>
                    </tr>`
                )}`
                inserData.innerHTML += html;
            } else {
                console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
            }
        }
    };
    xhr.send(formData);
}

function postPostOption(id){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var selectElement = document.getElementById(id);
    var elementSelected = selectElement.value;
    if(elementSelected == 1)
    {
        var xhr = new XMLHttpRequest();
        xhr.open("DELETE", `/admin/deletepost/${id}`, true);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    console.log(xhr.responseText); 
                    window.location.href = '/admin/post';
                } else {
                    console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
                }
            }
        };
        xhr.send('');
    }
    else if(elementSelected == 2){

        var xhr = new XMLHttpRequest();
        xhr.open("GET", `/admin/updatepost/${id}`, true);
        xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
        xhr.onreadystatechange = function() 
        {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    window.location.href = `/admin/updatepost/${id}`;
                } else {
                    console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
                }
            }
        };
        xhr.send('');
    }
}

function getProductBySearch(){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var search = document.getElementById('search-input').value;
    var inserData = document.getElementById('tbody');

    var formData = new FormData();
    formData.append('search', search);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", `/admin/searchproduct`, true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() 
    {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var datas = JSON.parse(xhr.responseText);
                inserData.innerHTML = "";

                var html = `${datas.map(data => 
                        `<tr>
                            <td>
                                <a class="link-proudct" href="{{ route('updateProduct', ['id' => ${data.id}]) }}">
                                    <div class="flex-gap-20">
                                        <img src="${data.thumbnail}" alt="">
                                        <p>${data.ProductDescription }</sp>
                                    </div>
                                </a>
                            </td>
                            <td class="center-td">${data.Version }</td>
                            <td class="center-td">${data.NameColor }</td>
                            <td class="center-td" id="number">${data.Price }</td>
                            <td class="center-td">${data.Discount }</td>
                            <td class="center-td">${data.QuantityInStock }</td>
                            <td class="center-td">${data.ProductAvailable }</td>
                            <td class="center-td">
                                <form action="" >
                                    <select class="add-select" id="${data.id }" name="${data.id }" onchange="postAction(${data.id })">
                                        <option value="0">Acction</option>
                                        <option value="delete">Xóa</option>
                                        <option value="update">Cập Nhật</option>
                                    </select>
                                </form>
                            </td>
                        </tr>`
                    )}`;
                inserData.innerHTML += html;
            } else {
                console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
            }
        }
    };
    xhr.send(formData);

}

function getPostBySearch(){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var search = document.getElementById('search-input').value;
    var inserData = document.getElementById('tbody');

    var formData = new FormData();
    formData.append('search', search);
    var xhr = new XMLHttpRequest();
    xhr.open("POST", `/admin/searchpost`, true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() 
    {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                var datas = JSON.parse(xhr.responseText);
                inserData.innerHTML = "";

                var html = `${datas.map(data => 
                        `<tr>
                            <td>
                                <a class="link-proudct" href="{{ route('getUpdatePost', ['id' => ${data.id}]) }}">
                                    <div class="flex-gap-20">
                                        <img src="${data.LinkThumbnail}" alt="">
                                        <div class="align-start">
                                            <p>${data.Title}</p>
                                        </div>
                                    </div>
                                </a>
                            </td>
                            <td>${data.CategoryName}</td>
                            <td class="center-td">
                                <select class="add-select" id="{${data.id}" name="" onchange="postPostOption(${data.id})">
                                    <option value="0" >Acction</option>
                                    <option value="1">Xóa</option>
                                    <option value="2">Cập Nhật</option>
                                </select>
                            </td>
                        </tr>`
                    )}`;
                inserData.innerHTML += html;
            } else {
                console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
            }
        }
    };
    xhr.send(formData);

}

function updateMessage(id){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var xhr = new XMLHttpRequest();
    xhr.open("POST", `/updatemessage/${id}`, true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() 
    {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log(xhr.responseText); 
            } else {
                console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
            }
        }
    };
    xhr.send('');
}