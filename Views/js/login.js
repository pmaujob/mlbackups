function login() {

    Materialize.Toast.removeAll();

    var email = document.getElementById("in_user").value;
    var pass = document.getElementById("in_pass").value;

    if (email == "" || pass == "") {

        Materialize.toast("Los campos no pueden estar vacios.", 3000);
        var toasts = document.getElementById('toast-container').getElementsByTagName("div");

        for (var i = 0; i < toasts.length; i++) {
            toasts[i].style.background = "#f50057";
            toasts[i].style.fontWeight = "400";
        }

        return;

    }

//    document.getElementById('loading').style.display = "block";
//    document.body.style.overflow = "hidden";

    jQuery.ajax({
        type: 'POST',
        url: 'Controllers/Admin/CLogin.php',
        async: true,
        data: {email: email, pass: pass},
        success: function (response) {

            if (response === "Ok") {

                location.href = "Views/index.php";

            } else if (response === "No") {

                Materialize.toast("El usuario o la contraseña son incorrectos intentelo de nuevo.", 3000);//Agregar toasts, si no hay ninguno crea un contenedor llamado "toast-container"
                var toasts = document.getElementById('toast-container').getElementsByTagName("div");//traer todos los toasts

                for (var i = 0; i < toasts.length; i++) {
                    toasts[i].style.background = "#f50057";
                    toasts[i].style.fontWeight = "400";
                }

            } else {

                Materialize.toast("Error inesperado", 3000);
                var toasts = document.getElementById('toast-container').getElementsByTagName("div");

                for (var i = 0; i < toasts.length; i++) {
                    toasts[i].style.background = "#f50057";
                    toasts[i].style.fontWeight = "400";
                }

                console.log("Error en MlBackup: " + response);

            }

//            document.getElementById('loading').style.display = "none";
//            document.body.style.overflow = "scroll";

        },

        error: function () {

            Materialize.toast("Error inesperado ajax", 3000);
            var toasts = document.getElementById('toast-container').getElementsByTagName("div");

            for (var i = 0; i < toasts.length; i++) {
                toasts[i].style.background = "#f50057";
                toasts[i].style.fontWeight = "400";
            }
        }

    });

}