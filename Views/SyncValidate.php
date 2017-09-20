<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Consulta de Actividades</title>
        <?php include_once 'header.php'; ?>
        <script type="text/javascript" src="js/forms/SyncValidate.js"></script>

    </head>
    <body onload="onLoadBody();">
        <?php include '../Views/menu.php'; ?>
        <div class="general-container">
            <form id='frmConsultSync' name='frmConsultSync' enctype="multipart/form-data">
                <div class="container-fluid">
                    <div class="col s12 m8 l12 center-align">
                        <div class="row">
                            <div class="col s12 m12 l12 center-align"><div>Haga click en la lupa para ir al formulario de búsqueda</div></div>
                            <br>
                            <br>
                        </div>
                        <div class="row">
                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <a class="waves-effect waves-light" href="#!" onclick="openModal();">
                                        <img src="../Views/images/view.png" class="icon-search">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div id="userData" class="row">

                        </div>
                    </div>
                </div>
            </form>

            <div id="modalBottom" class="modal bottom-sheet">
                <div class="modal-content">
                    <h4>Lista de Usuarios</h4>
                    <div class="row">
                        <div class="col s12 m12 l12">

                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field col s12">
                                        <i class="material-icons prefix">search</i>
                                        <input id="txtSearchUsers" type="text" class="validate" onkeydown="findUsers(event);">
                                        <label for="txtSearchUsers">Realice la búsqueda por nombre o área.</label>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <ul id="userList" class="collection" style="display: none;">

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>