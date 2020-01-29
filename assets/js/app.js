$(function() {
  getAll();
  //Seccion registro
  $("#form-sign").submit(function(e) {
    e.preventDefault();
    const datos = {
      nombre: $("#nombre").val(),
      email: $("#email").val(),
      password: $("#password").val()
    };
    $.post("registro.php", datos, function(response) {
      if (response) {
        $(location).attr("href", "index.html");
      } else {
        alert("Datos incorrectos");
      }
    });
  });

  //Seccion Login
  $("#form-login").submit(function(e) {
    e.preventDefault();
    email = $("#email").val();
    password = $("#password").val();
    $.ajax({
      url: "login.php",
      type: "POST",
      data: {
        email: email,
        password: password
      },
      beforeSend: function() {
        console.log("cargando...");
      },
      success: function(data) {
        if (isJSON(data)) {
          $(location).attr("href", "contactos.php");
        } else {
          $("#respuesta").html(data);
        }
      }
    });
  });

  //Añadir contacto
  $("#form-contacto").submit(function(e) {
    e.preventDefault();
    let nombre = $("#nombre").val(),
      email = $("#email").val(),
      tel = $("#telefono").val();

    $.ajax({
      url: "añadir-contacto.php",
      type: "POST",
      data: {
        nombre: nombre,
        email: email,
        telefono: tel
      },
      success: function(response) {
        if (response == "añadido") {
          Swal.fire({
            type: "success",
            title: "Contacto añadido",
            text: "Llamalo!"
          });
          $("#form-contacto").trigger("reset");
          getAll();
        } else {
          Swal.fire({
            type: "error",
            title: "Ha ocurrido un error",
            text: "Todos los campos son necesarios"
          });
        }
      }
    });
    getAll();
  });

  //Buscar
  $("#buscar").keyup(function() {
    if ($("#buscar").val()) {
      let buscar = $("#buscar").val();
      $.ajax({
        url: "busqueda.php",
        type: "POST",
        data: { buscar },
        success: function(response) {
          let contactos = JSON.parse(response);
          let template = "";
          contactos.forEach(contacto => {
            template += `
                  <tr taskID='${contacto.id}'>
                      <td>${contacto.nombre}</td>
                      <td><a href='tel:${contacto.telefono}'>${
              contacto.telefono
            }</a></td>
                      <td><a href='mailto:${contacto.email}'>${
              contacto.email
            }</a></td>
                      <td> <button class='btn btn-danger delete-contact'>Eliminar</button>
                  </tr>
              `;
          });
          $("#contactos").html(template);
        }
      });
    } else {
      getAll();
    }
  });

  //Funciones

  function getAll() {
    $.ajax({
      url: "lista-contactos.php",
      type: "GET",
      success: function(response) {
        let contactos = JSON.parse(response);
        let template = "";
        contactos.forEach(contact => {
          template += `
                    <tr taskID='${contact.id}'>
                        <td>${contact.nombre}</td>
                        <td><a href='tel:${contact.telefono}'>${
            contact.telefono
          }</a></td>
                        <td><a href='mailto:${contact.email}'>${
            contact.email
          }</a></td>
                        <td> <button class='delete-contact btn btn-danger'>Eliminar</button></td>
                    </tr>
                `;
        });
        $("#contactos").html(template);
      }
    });
  }
//Evento click para el boton eliminar con la clase delete-contact
  $(document).on("click", ".delete-contact", function() {
    //Subir en el DOM hasta el tr
    let elemento = $(this)[0].parentElement.parentElement;
    //Obtener el valor en el data atribute taskID
    let id = $(elemento).attr("taskID");
    //Lanzar alerta
    Swal.fire({
      title: "Estas seguro?",
      text: "No podras recuperar el contacto",
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Borrar"
    }).then(result => {
       //Si acepta, enviar peticion Ajax
      if (result.value) {
        $.ajax({
          url: "remover.php",
          type: "POST",
          data: { id },
          success: function(response) {
            getAll();
          }
        });
        Swal.fire("Eliminado!", "El contacto se ha eliminado", "success");
      }else{
        return false;
      }
    });
  });

  function isJSON(str) {
    try {
      JSON.parse(str);
    } catch (e) {
      return false;
    }
    return true;
  }
});
