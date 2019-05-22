<?php include_once "header.php"; ?>

    <br>
    <br>
    <br>

    <!-- Middle Column -->
    <div class="w3-col m12">

        <div class="w3-row-padding">
            <!-- Middle Column -->
            <form name="frmBusca" method="post" class="form-group">
                <div class="col-12">
                    <div class="form-group">
                        <input type="text" name="palavra" class="form-control" placeholder="Digite o nome para pesquisar" required>
                        <br>
                        <center>
                            <button type="button"><i class="fa fa-search"></i> Procurar</button>
                        </center>
                    </div>
                </div>
            </form>

        </div>
    </div>

    <br>
    <br>
    <br>
    <br>

    <?php include_once "footer.php"; ?>

        <script>
            // Accordion
            function myFunction(id) {
                var x = document.getElementById(id);
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                    x.previousElementSibling.className += " w3-theme-d1";
                } else {
                    x.className = x.className.replace("w3-show", "");
                    x.previousElementSibling.className =
                        x.previousElementSibling.className.replace(" w3-theme-d1", "");
                }
            }

            // Used to toggle the menu on smaller screens when clicking on the menu button
            function openNav() {
                var x = document.getElementById("navDemo");
                if (x.className.indexOf("w3-show") == -1) {
                    x.className += " w3-show";
                } else {
                    x.className = x.className.replace(" w3-show", "");
                }
            }
        </script>

        </body>

        </html>
        <!-- http://rafaelcouto.com.br/sistema-de-busca-interna-com-php-mysql/ -->