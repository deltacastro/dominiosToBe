let ajaxProveedor = (form, url, method) => {
    let formSerialize = new FormData(form);
    $.ajax({
        type: "POST",
        url: url,
        data: formSerialize, // serializes the form's elements.
        processData: false,
        contentType: false,
        success: function(data) {
            if (data.code === 200) {
                if (method == 'POST') {
                    addRow(form, data.modelData, data.route);
                } else if (method == 'PUT') {
                    updateRow(form, data.modelData, data.route);
                    document.getElementById('cancelSubmit').click();
                } else if (method == 'DELETE') {
                    deleteRow(form, data.modelData, data.route);
                }
            } else {
                alert('algo paso, lo siento!');
            }
        }
    });
}

let addRow = (form, modelData, route) => {
    let formElements = form.elements;
    let table = document.getElementById('proveedor');
    let bodyTable = table.getElementsByTagName('tbody')[0];
    let row = bodyTable.insertRow(0);
    row.id = `nombre${modelData.id}`;
    let nombre = row.insertCell(0);
    let opciones = row.insertCell(1);
    nombre.innerHTML = formElements.nombre.value;
    opciones.innerHTML = `
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-put="${route.edit}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-delete="${route.delete}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
    `;
}

let updateRow = (form, modelData, route) => {
    let rowId = `nombre${modelData.id}`;
    let row = document.getElementById(rowId);
    let nombre = row.cells[0];
    let opciones = row.cells[1];
    nombre.innerHTML = modelData.nombre;
    opciones.innerHTML = `
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-put="${route.edit}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-delete="${route.delete}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
    `;
}

let deleteRow = (form, modelData, route) => {
    let rowId = `nombre${modelData.id}`;
    let row = document.getElementById(rowId);
    row.parentNode.removeChild(row);
}

$(document).ready(function() {
    $('.guardar').on('click', function() {
        let formId = $(this).data('form');
        let form = document.getElementById(formId);
        let url = form.action;
        form._method.value = 'POST';
        let method = 'POST';
        ajaxProveedor(form, url, method);
    });


    $('tbody').on('click', '.eliminar', function() {
        let dataId = this.dataset.id;
        let eliminarSubmit = document.getElementById('eliminarSubmit');
        let nombre = this.dataset.nombre;
        let url = this.dataset.delete;
        let formId = this.dataset.form;
        let form = document.getElementById(formId);
        form.dataset.put = url;
        let elem = document.querySelector('.modal');
        let instance = M.Modal.init(elem, '');
        instance.open();
    });


    $('tbody').on('click', '.editar', function() {
        let editSubmit = document.getElementById('editSubmit');
        editSubmit.classList.remove('scale-out');
        let cancelSubmit = document.getElementById('cancelSubmit');
        cancelSubmit.classList.remove('scale-out');
        let storeSubmit = document.getElementById('storeSubmit');
        storeSubmit.classList.add('scale-out');
        storeSubmit.style.display = 'none';
        let nombre = this.dataset.nombre;
        let url = this.dataset.put;
        let formId = this.dataset.form;
        console.log(formId);

        let form = document.getElementById(formId);
        form.dataset.put = url;
        let inputNombre = document.getElementsByName('nombre')[0];
        inputNombre.focus();
        inputNombre.value = nombre;
    });

    $('#editSubmit').on('click', function() {
        let formId = this.dataset.form;
        console.log(formId);
        let form = document.getElementById(formId);
        let url = form.dataset.put;
        let method = 'PUT';
        form._method.value = 'PUT';
        ajaxProveedor(form, url, method);
    });

    $('#eliminarSubmit').on('click', function() {
        let formId = this.dataset.form;
        let form = document.getElementById(formId);
        let url = form.dataset.put;
        form._method.value = 'DELETE';
        ajaxProveedor(form, url, form._method.value);
    });

    $('#cancelSubmit').on('click', function() {
        let inputNombre = document.getElementsByName('nombre')[0];
        inputNombre.value = '';
        let editSubmit = document.getElementById('editSubmit');
        editSubmit.classList.add('scale-out');
        let cancelSubmit = document.getElementById('cancelSubmit');
        cancelSubmit.classList.add('scale-out');
        let storeSubmit = document.getElementById('storeSubmit');
        storeSubmit.style.display = 'inline-block';
        storeSubmit.classList.remove('scale-out');
    });
});