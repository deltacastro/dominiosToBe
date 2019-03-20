let ajaxProveedor = (form, url, method, type = 'POST') => {
    let formSerialize = new FormData(form);
    $.ajax({
        type: type,
        url: url,
        data: type == 'POST' ? formSerialize : '', // serializes the form's elements.
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
                } else if (method == 'GET') {
                    editForm(form, data.modelData, data.route);
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
    let registro = row.insertCell(1);
    let expiracion = row.insertCell(2);
    let opciones = row.insertCell(3);
    nombre.innerHTML = modelData.nombre;
    registro.innerHTML = modelData.registro;
    expiracion.innerHTML = modelData.expiracion;
    opciones.innerHTML = `
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-put="${route.edit}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-delete="${route.delete}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
    `;
}

let updateRow = (form, modelData, route) => {
    let rowId = `nombre${modelData.id}`;
    let row = document.getElementById(rowId);
    let nombre = row.cells[0];
    let registro = row.cells[1];
    let expiracion = row.cells[2];
    let opciones = row.cells[3];
    nombre.innerHTML = modelData.nombre;
    registro.innerHTML = modelData.registro;
    expiracion.innerHTML = modelData.expiracion;
    opciones.innerHTML = `
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-put="${route.edit}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-delete="${route.delete}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
    `;
}

let editForm = (form, modelData, route) => {
    let nombre = document.getElementById('nombre');
    let fechaRegistro = document.getElementById('fechaRegistro');
    let descripcion = document.getElementById('descripcion');
    let costo = document.getElementById('costo');
    let periodicidad_id = document.getElementById('periodicidad_id');
    let proveedor = document.getElementById('proveedor_id');
    nombre.value = modelData.nombre;
    fechaRegistro.value = modelData.fechaRegistro;
    descripcion.value = modelData.descripcion;
    costo.value = modelData.costo;
    periodicidad_id.value = modelData.periodicidad_id;
    proveedor_id.value = modelData.proveedor_id;
    var elems = document.querySelectorAll('select');
    var instances = M.FormSelect.init(elems);
    M.updateTextFields();
    let editSubmit = document.getElementById('editSubmit');
    editSubmit.classList.remove('scale-out');
    let cancelSubmit = document.getElementById('cancelSubmit');
    cancelSubmit.classList.remove('scale-out');
    let storeSubmit = document.getElementById('storeSubmit');
    storeSubmit.classList.add('scale-out');
    storeSubmit.style.display = 'none';
    let url = route.edit;
    let formId = form.id;
    let form2 = document.getElementById(formId);
    form2.dataset.put = url;
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
        let elem = document.querySelector('.modal1');
        let instance = M.Modal.init(elem, '');
        instance.open();
    });

    $('tbody').on('click', '.editar', function() {
        let formId = this.dataset.form;
        let form = document.getElementById(formId);
        let url = this.dataset.put;
        form._method.value = 'GET';
        let method = 'GET';
        ajaxProveedor(form, url, method, 'GET');
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
        document.getElementById('cancelSubmit').click();
        let formId = this.dataset.form;
        let form = document.getElementById(formId);
        let url = form.dataset.put;
        form._method.value = 'DELETE';
        ajaxProveedor(form, url, form._method.value);
    });

    $('#cancelSubmit').on('click', function() {
        let inputNombre = document.getElementsByName('nombre')[0];
        inputNombre.value = '';
        let inputDescripcion = document.getElementsByName('descripcion')[0];
        inputDescripcion.value = '';
        let inputCosto = document.getElementsByName('costo')[0];
        inputCosto.value = '';
        let inputFechaRegistro = document.getElementsByName('fechaRegistro')[0];
        inputFechaRegistro.value = '';
        M.updateTextFields();
        let selectProveedor_id = document.getElementsByName('proveedor_id')[0];
        selectProveedor_id.value = '';
        let selectPeriodicidad_id = document.getElementsByName('periodicidad_id')[0];
        selectPeriodicidad_id.value = '';
        var elems = document.querySelectorAll('select');
        var instances = M.FormSelect.init(elems);
        let editSubmit = document.getElementById('editSubmit');
        editSubmit.classList.add('scale-out');
        let cancelSubmit = document.getElementById('cancelSubmit');
        cancelSubmit.classList.add('scale-out');
        let storeSubmit = document.getElementById('storeSubmit');
        storeSubmit.style.display = 'inline-block';
        storeSubmit.classList.remove('scale-out');
    });
});