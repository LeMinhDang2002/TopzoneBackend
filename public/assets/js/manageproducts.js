function addParameter() {
    var newRow = document.createElement("div");
    newRow.className = "row mb-2";

    var newCol1 = document.createElement("div");
    newCol1.className = "col-lg-10";

    var newInput = document.createElement("input");
    newInput.className = "form-control form-control-user";
    newCol1.appendChild(newInput);

    var newCol2 = document.createElement("div");
    newCol2.className = "col-lg-2";

    var newButton = document.createElement("button");
    newButton.className = "btn btn-danger btn-user btn-block";
    newButton.textContent = "X";
    newButton.addEventListener("click", function() {
        newRow.remove();
    });
    newCol2.appendChild(newButton);

    newRow.appendChild(newCol1);
    newRow.appendChild(newCol2);

    var areaSizeScreen = document.getElementById("area_size_screen");
    areaSizeScreen.appendChild(newRow);
}
function addSpecification(id) {
    var newRow = document.createElement("div");
    newRow.className = "row mb-2";

    var newCol1 = document.createElement("div");
    newCol1.className = "col-lg-10";

    var newInput = document.createElement("input");
    newInput.className = "form-control form-control-user";
    newCol1.appendChild(newInput);

    var newCol2 = document.createElement("div");
    newCol2.className = "col-lg-2";

    var newButton = document.createElement("button");
    newButton.className = "btn btn-danger btn-user btn-block";
    newButton.textContent = "X";
    newButton.addEventListener("click", function() {
        newRow.remove();
    });
    newCol2.appendChild(newButton);

    newRow.appendChild(newCol1);
    newRow.appendChild(newCol2);

    var areaSizeScreen = document.getElementById(id);
    areaSizeScreen.appendChild(newRow);
}
function addSupplier() {
    var newRow = document.createElement("div");
    newRow.className = "row mb-2";

    var newCol1 = document.createElement("div");
    newCol1.className = "col-lg-10";

    var newInput = document.createElement("input");
    newInput.className = "form-control form-control-user";
    newInput.name = "name"
    newCol1.appendChild(newInput);

    var newCol2 = document.createElement("div");
    newCol2.className = "col-lg-2";

    var newButton = document.createElement("button");
    newButton.className = "btn btn-danger btn-user btn-block";
    newButton.textContent = "X";
    newButton.addEventListener("click", function() {
        newRow.remove();
    });
    newCol2.appendChild(newButton);

    newRow.appendChild(newCol1);
    newRow.appendChild(newCol2);

    var areaSizeScreen = document.getElementById("area_supplier");
    areaSizeScreen.appendChild(newRow);
}
function deleteSupplier(id){
    var Element = document.getElementById(id);
    Element.remove();
}

function UpdateSupplier(id){
    var Element = document.getElementById(id);
    var suppliers = []
    for(var i=0; i<Element.children.length; i++){
        suppliers.push(Element.children[i].children[0].children[0].value);
    }
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var formData = new FormData();

    for(var i = 0; i < suppliers.length; i++){
        formData.append('suppliers[]', JSON.stringify(suppliers[i]));
    }

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/updatesupplier", true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log(xhr.responseText); 
            location.reload();
          } else {
            console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
          }
        }
      };
    xhr.send(formData);
}

function updateSpecification(id, name, groupid){
    var Element = document.getElementById(id);
    var specifications = []
    for(var i=0; i<Element.children.length; i++){
        specifications.push(Element.children[i].children[0].children[0].value);
    }
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    var formData = new FormData();

    for(var i = 0; i < specifications.length; i++){
        formData.append('specifications[]', JSON.stringify(specifications[i]));
    }
    formData.append('name', name);
    formData.append('groupid', groupid);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "/updatespecification", true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log(xhr.responseText); 
            location.reload();
          } else {
            console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
          }
        }
      };
    xhr.send(formData);
}