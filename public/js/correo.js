let ajaxProveedor = (form, url, method, type = 'POST') => {
  let formSerialize = new FormData(form);
  $.ajax({
    type: type,
    url: url,
    data: type == 'POST' ? formSerialize : '', // serializes the form's elements.
    processData: false,
    contentType: false,
    success: function (data) {
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

let removeValidClass = () => {
  document.getElementById('nombre').classList.remove('valid');
  document.getElementById('nombre').classList.remove('invalid');
  document.getElementById('correo').classList.remove('valid');
  document.getElementById('correo').classList.remove('invalid');
}

let validateForm = () => {
  let nombre = document.getElementById('nombre');
  let spanNombre = document.getElementById('spanNombre');
  let correo = document.getElementById('correo');
  let spanCorreo = document.getElementById('spanCorreo');
  let pass = true;
  if (!nombre.checkValidity()) {
    spanNombre.dataset.error = nombre.validationMessage;
    nombre.classList.add('invalid');
    pass = false;
  }
  if (!correo.checkValidity()) {
    spanCorreo.dataset.error = correo.validationMessage;
    correo.classList.add('invalid');
    pass = false;
  }
  return pass;
}

let addRow = (form, modelData, route) => {
  document.getElementById('cancelSubmit').click();
  let table = document.getElementById('proveedor');
  let bodyTable = table.getElementsByTagName('tbody')[0];
  let row = bodyTable.insertRow(0);
  row.id = `nombre${modelData.id}`;
  let nombre = row.insertCell(0);
  let correo = row.insertCell(1);
  let opciones = row.insertCell(2);
  nombre.innerHTML = modelData.nombre;
  correo.innerHTML = modelData.correo;
  opciones.innerHTML = `
    <a data-form="generalForm" data-nombre="${modelData.nombre}" data-put="${route.edit}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
    <a data-form="generalForm" data-nombre="${modelData.nombre}" data-delete="${route.destroy}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
  `;
  removeValidClass();
}

let updateRow = (form, modelData, route) => {
  let rowId = `nombre${modelData.id}`;
  let row = document.getElementById(rowId);
  let nombre = row.cells[0];
  let correo = row.cells[1];
  let opciones = row.cells[2];
  nombre.innerHTML = modelData.nombre;
  correo.innerHTML = modelData.correo;
  opciones.innerHTML = `
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-put="${route.edit}" title="Editar" class="editar btn-floating btn-small waves-effect waves-light yellow"><i class="material-icons">edit</i></a>
        <a data-form="generalForm" data-nombre="${modelData.nombre}" data-delete="${route.destroy}" title="Eliminar" class="eliminar btn-floating btn-small waves-effect waves-light red accent-4"><i class="material-icons">delete</i></a>
    `;
  removeValidClass();
}

let editForm = (form, modelData, route) => {
  let nombre = document.getElementById('nombre');
  let correo = document.getElementById('correo');
  nombre.value = modelData.nombre;
  correo.value = modelData.correo;
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
  removeValidClass();
}

let deleteRow = (form, modelData, route) => {
  let rowId = `nombre${modelData.id}`;
  let row = document.getElementById(rowId);
  row.parentNode.removeChild(row);
}

$(document).ready(function () {
  $('.guardar').on('click', function () {
    if (validateForm()) {
      let formId = $(this).data('form');
      let form = document.getElementById(formId);
      let url = form.action;
      form._method.value = 'POST';
      let method = 'POST';
      ajaxProveedor(form, url, method);
    }
  });

  $('tbody').on('click', '.eliminar', function () {
    let dataId = this.dataset.id;
    let eliminarSubmit = document.getElementById('eliminarSubmit');
    let nombre = this.dataset.nombre;
    let url = this.dataset.delete;
    let formId = this.dataset.form;
    let form = document.getElementById(formId);
    form.dataset.put = url;
    let elem = document.querySelector('#modal1');
    let instance = M.Modal.init(elem, '');
    instance.open();
  });

  $('tbody').on('click', '.editar', function () {
    let formId = this.dataset.form;
    let form = document.getElementById(formId);
    let url = this.dataset.put;
    form._method.value = 'GET';
    let method = 'GET';
    ajaxProveedor(form, url, method, 'GET');
  });

  $('#editSubmit').on('click', function () {
    if (validateForm()) {
      let formId = this.dataset.form;
      let form = document.getElementById(formId);
      let url = form.dataset.put;
      let method = 'PUT';
      form._method.value = 'PUT';
      ajaxProveedor(form, url, method);
    }
  });

  $('#eliminarSubmit').on('click', function () {
    document.getElementById('cancelSubmit').click();
    let formId = this.dataset.form;
    let form = document.getElementById(formId);
    let url = form.dataset.put;
    form._method.value = 'DELETE';
    ajaxProveedor(form, url, form._method.value);
  });

  $('#cancelSubmit').on('click', function () {
    let inputNombre = document.getElementsByName('nombre')[0];
    inputNombre.value = '';
    let inputDescripcion = document.getElementsByName('correo')[0];
    inputDescripcion.value = '';
    let editSubmit = document.getElementById('editSubmit');
    editSubmit.classList.add('scale-out');
    let cancelSubmit = document.getElementById('cancelSubmit');
    cancelSubmit.classList.add('scale-out');
    let storeSubmit = document.getElementById('storeSubmit');
    storeSubmit.style.display = 'inline-block';
    storeSubmit.classList.remove('scale-out');
    removeValidClass();
  });
});