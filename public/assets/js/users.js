mobiscroll.setOptions({
    locale: mobiscroll.localeEn,                                             // Specify language like: locale: mobiscroll.localePl or omit setting to use default
    theme: 'ios',                                                            // Specify theme like: theme: 'ios' or omit setting to use default
        themeVariant: 'light'                                                // More info about themeVariant: https://docs.mobiscroll.com/5-26-2/select#opt-themeVariant
});
// $(function () {
//     // Mobiscroll Select initialization
//     $('#demo-multiple-select').mobiscroll().select({
//         inputElement: document.getElementById('demo-multiple-select-input')  
//     });
// });

function initializeMobiscrollSelect(selectId, inputId) {
    $('#' + selectId).mobiscroll().select({
        inputElement: document.getElementById(inputId)  
    });
}

document.addEventListener('DOMContentLoaded', function() {
    for (var i = 0; i < users.length; i++) {
        initializeMobiscrollSelect(`select-${users[i].id}`, `input-${users[i].id}`);
        initializeMobiscrollSelect(`select-position-${users[i].id}`, `input-position-${users[i].id}`);
    }
});

function UpdateUser(id1, id2, id3, id4, id5, userid){
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    NameElement = document.getElementById(id1).textContent;
    PhoneElement = document.getElementById(id2).textContent;
    EmailElement = document.getElementById(id3).textContent;
    PositionElement = document.getElementById(id4);
    AuthElement = document.getElementById(id5);
    var PositionValues = [];

    for (var i = 0; i < PositionElement.options.length; i++) {
        var option = PositionElement.options[i];
        if (option.selected) {
            PositionValues.push(option.value);
        }
    }

    AuthValues = [];
    for (var i = 0; i < AuthElement.options.length; i++) {
        var option = AuthElement.options[i];
        if (option.selected) {
            AuthValues.push(option.value);
        }
    }

    var formData = new FormData();

    for(var i = 0; i < PositionValues.length; i++){
        formData.append('positions[]', JSON.stringify(PositionValues[i]));
    }
    for(var i = 0; i < AuthValues.length; i++){
        formData.append('authorizations[]', JSON.stringify(AuthValues[i]));
    }
    formData.append('name', NameElement);
    formData.append('phone', PhoneElement);
    formData.append('email', EmailElement);

    var xhr = new XMLHttpRequest();
    xhr.open("POST", `/updateuser/${userid}`, true);
    xhr.setRequestHeader("X-CSRF-TOKEN", csrfToken);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log(xhr.responseText); 
            window.location.reload(true);
          } else {
            console.log('Lỗi ' + xhr.status + ' đã xảy ra.');
          }
        }
      };
    xhr.send(formData);
}